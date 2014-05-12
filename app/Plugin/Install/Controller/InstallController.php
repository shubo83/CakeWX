<?php

App::uses('Controller', 'Controller');
App::uses('File', 'Utility');
App::uses('InstallManager', 'Install.Lib');

/**
 * Install Controller
 *
 * @category Controller
 * @package  Croogo
 * @version  1.0
 * @author   Fahad Ibnay Heylaal <contact@fahad19.com>
 * @license  http://www.opensource.org/licenses/mit-license.php The MIT License
 * @link     http://www.croogo.org
 */
class InstallController extends Controller {

/**
 * Components
 *
 * @var array
 * @access public
 */
	public $components = array('Session');

/**
 * Helpers
 *
 * @var array
 * @access public
 */
	public $helpers = array(
		'Html' => array(
			'className' => 'CroogoHtml',
		),
		'Form' => array(
			'className' => 'CroogoForm',
		),
		'Croogo.Layout',
	);

/**
 * beforeFilter
 *
 * @return void
 * @access public
 */
	public function beforeFilter() {
		parent::beforeFilter();
		
		$this->layout = 'install';
		$this->_generateAssets();
	}

/**
 * Generate assets
 */
	protected function _generateAssets() {
		$file = CakePlugin::path('Croogo') . 'webroot' . DS . 'css' . DS . 'croogo-bootstrap.css';
		if (!file_exists($file)) {
			App::uses('AssetGenerator', 'Install.Lib');
			$generator = new AssetGenerator();
			try {
				$generator->generate();
			} catch (Exception $e) {
				$this->log($e->getMessage());
				$this->Session->setFlash('Asset generation failed. Please verify that dependencies exists and readable.', 'default', array('class' => 'error'));
			}
		}
	}

/**
 * If settings.json exists, app is already installed
 *
 * @return void
 */
	protected function _check() {
		if (Configure::read('Croogo.installed') && Configure::read('Install.secured')) {
			$this->Session->setFlash('Already Installed');
			$this->redirect('/');
		}
	}

/**
 * Step 0: welcome
 *
 * A simple welcome message for the installer.
 *
 * @return void
 * @access public
 */
	public function index() {
		$this->_check();
		$this->set('title_for_layout', __d('croogo', '欢迎进入安装程序'));
	}

/**
 * Step 1: database
 *
 * Try to connect to the database and give a message if that's not possible so the user can check their
 * credentials or create the missing database
 * Create the database file and insert the submitted details
 *
 * @return void
 * @access public
 */
	public function database() {
		$this->_check();
		$this->set('title_for_layout', __d('croogo', '第一步：设置数据库信息'));

		if (Configure::read('Croogo.installed')) {
			$this->redirect(array('action' => 'adminuser'));
		}

		if (!empty($this->request->data)) {
			$InstallManager = new InstallManager();
			$result = $InstallManager->createDatabaseFile(array(
				'Install' => $this->request->data,
			));
			if ($result !== true) {
				$this->Session->setFlash($result, 'default', array('class' => 'error'));
			} else {
				$this->redirect(array('action' => 'data'));
			}
		}
	}

/**
 * Step 2: Run the initial sql scripts to create the db and seed it with data
 *
 * @return void
 * @access public
 */
	public function data() {
		$this->_check();
		$this->set('title_for_layout', __d('croogo', '第二步：初始化数据库'));

		$this->loadModel('Install.Install');
		$ds = $this->Install->getDataSource();
		$ds->cacheSources = false;
		$sources = $ds->listSources();
		if (!empty($sources)) {
			$this->Session->setFlash(
				__d('croogo', 'Warning: Database "%s" is not empty.', $ds->config['database']),
				'default', array('class' => 'error')
			);
		}

		if (isset($this->request->params['named']['run'])) {
			$this->Install->setupDatabase();

			$InstallManager = new InstallManager();
			$result = $InstallManager->createCroogoFile();

			$this->redirect(array('action' => 'adminuser'));
		}
	}

/**
 * Step 3: get username and passwords for administrative user
 */
	public function adminuser() {
		if (!file_exists(APP . 'Config' . DS . 'database.php')) {
			$this->redirect('/');
		}

		if ($this->request->is('post')) {
			$this->loadModel('TPerson');
			$this->TPerson->set($this->request->data);
			$this->TPerson->validator()->add('FMemberId', 'unique', array(
			    'rule' => 'isUnique',
			    'required' => 'create',
				'message' => "此账号已经存在了，请更换一个新的。"
			));
			$this->TPerson->validator()->remove('FRePassWord');
			$this->TPerson->validator()->add('FRePassWord', 'validIdentical_noEn', array(
				'rule' => "validIdentical_noEn"
			));
			// print_r($this->TPerson->validator());exit;
			// unset($this->TPerson->validator()['FRePassWord']);
			//unset($this->TPerson->validate['FRePassWord']);
			//$this->TPerson->validator()->add('FRePassWord', 'rule', "validIdentical_noEn");
			if ($this->TPerson->validates(array('fieldList' => array('FMemberId', 'FPassWord', 'FRePassWord')))) {
				$user = $this->TPerson->addAdminUser($this->request->data);
				if ($user) {
					$this->Session->write('Install.user', $user);
					$this->redirect(array('action' => 'finish'));
				}
			}
		}
	}

/**
 * Step 4: finish
 *
 * Copy settings.json file into place and create user obtained in step 3
 *
 * @return void
 * @access public
 */
	public function finish($token = null) {
		$this->set('title_for_layout', __d('croogo', '安装完成'));
		$this->_check();
		$InstallManager = new InstallManager();
		$InstallManager->stvs();
		$result = $InstallManager->createSettingsFile();
		if ($result) {
			$InstallManager->installCompleted();
		} else {
			$this->log(__d('croogo', '安装失败，不能创建settings文件。'));
		}

		$urlBlogAdd = Router::url(array(
			'plugin' => 'nodes',
			'admin' => true,
			'controller' => 'nodes',
			'action' => 'add',
			'blog',
		));
		$urlSettings = Router::url(array(
			'plugin' => 'settings',
			'admin' => true,
			'controller' => 'settings',
			'action' => 'prefix',
			'Site',
		));

		$this->set('user', $this->Session->read('Install.user'));
		$this->Session->destroy();
		$this->set(compact('urlBlogAdd', 'urlSettings'));
	}

}
