<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('CroogoRouter', 'Croogo.Lib');
Router::connect('/signup', array('controller' => 'user', 'action' => 'register'));
Router::connect('/loggout', array('controller' => 'user', 'action' => 'loggout'));
Router::connect('/admin', array('controller' => 'admin', 'action' => 'index'));
Router::connect('/wxapi/*', array('controller' => 'wxapi', 'action' => 'index'));
Router::connect('/admin/wc/*', array('controller' => 'admin', 'action' => 'wc'));
Router::connect('/version', array('controller' => 'user', 'action' => 'version'));
Router::mapResources('users');
Router::mapResources('education');
Router::mapResources('wx');
CakePlugin::routes();
Router::connect('/', array('controller' => 'user', 'action' => 'login'));
Router::parseExtensions('json', 'rss');
CroogoRouter::localize();
require CAKE . 'Config' . DS . 'routes.php';
