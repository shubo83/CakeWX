<?php
App::uses('AppController', 'Controller');
/**
 * Admin Controller
 *
 * @property Admin $Admin
 */
class PersonController extends AppController {
	
	public $components = array('RequestHandler');
	
	public function beforeFilter() {
	    parent::beforeFilter();
	    $this->Auth->allow('login'); // Letting users register themselves
	
		// load Model
		$this->loadModel('TPerson');
		$this->RequestHandler->renderAs($this, 'json');
	}
	
	public function index()
	{
		// init
		$limit = isset($this->request->query['limit']) ? $this->request->query['limit'] : 100;
		$offset = isset($this->request->query['start']) ? $this->request->query['start'] : 0;
		$desc = isset($this->request->query['dir']) ? $this->request->query['dir'] : 'asc';
		$sort = isset($this->request->query['sort']) ? $this->request->query['sort'] : FALSE;
		$node = isset($this->request->query['node']) ? $this->request->query['node'] : FALSE;
		$query = isset($this->request->query['query']) ? $this->request->query['query'] : FALSE;
	
		$attr = array('limit' => $limit, 'offset' => $offset);
		if ($sort) $attr['order'] = array($sort => $desc);
		$query_a = $query ? is_numeric($query) ? array("TPerson.FMemberId LIKE" => "%{$query}%") : array("TPerson.FullName LIKE" => "%{$query}%") : FALSE;
		if ($query_a) $attr['conditions'] = $query_a;
		
		// data from model
		if ($node)
		{
			$a_node = explode('/', $node);
			$q_node = end(explode('/', $node));
			$prefix = substr($q_node, 0, strripos($q_node, '_'));
			$value = substr($q_node, strripos($q_node, '_') + 1, 100);
			$sConditions = $query_a ? $query_a : array();
			
			if ($prefix == 'grid_classm')
			{ 
				// 班级管理里面的班级
				$params['college'] = substr($a_node[0], strripos($a_node[0], '_') + 1);
				$params['grade'] = substr($a_node[1], strripos($a_node[1], '_') + 1);
				$params['subject'] = substr($a_node[2], strripos($a_node[2], '_') + 1);
				$classResut = ClassRegistry::init('TClass')->find('first', array('conditions' => array('TClass.Id' => $value)));
				$params['class'] = $classResut['TClass']['FName'];
				$data = $this->TPerson->getClassPersonResult($params['college'], $params['grade'], $params['subject'], $params['class'], FALSE, $limit, $offset, $sort, $desc, $sConditions);
				$count = $this->TPerson->getClassPersonResult($params['college'], $params['grade'], $params['subject'], $params['class'], TRUE, NULL, NULL, NULL, NULL, $sConditions);
 			}
			else if ($prefix == 'grid_class')
			{
				// 学院管理里面的班级
				$classResut = ClassRegistry::init('TClass')->find('first', array('conditions' => array('TClass.Id' => $value)));
				$params['college'] = $classResut['TCollege']['FName'];
				$params['grade'] = date('Y', strtotime($classResut['TClass']['FStartdate']));
				$params['subject'] = $classResut['TSpecialty']['FName'];
				$params['class'] = $classResut['TClass']['FName'];
				$data = $this->TPerson->getClassPersonResult($params['college'], $params['grade'], $params['subject'], $params['class'], FALSE, $limit, $offset, $sort, $desc, $sConditions);
				$count = $this->TPerson->getClassPersonResult($params['college'], $params['grade'], $params['subject'], $params['class'], TRUE, NULL, NULL, NULL, NULL, $sConditions);
			}
			else if ($prefix == 'grid_college')
			{
				// 学院
				$classResut = ClassRegistry::init('TCollege')->find('first', array('conditions' => array('TCollege.Id' => $value)));
				$params['college'] = $classResut['TCollege']['FName'];
				$data = $this->TPerson->getCollegePersonResult($params['college'], FALSE, $limit, $offset, $sort, $desc, $sConditions);
				$count = $this->TPerson->getCollegePersonResult($params['college'], TRUE, NULL, NULL, NULL, NULL, $sConditions);
			}
			else if ($prefix == 'grid_grade')
			{
				// 年级
				$college = substr($a_node[0], strripos($a_node[0], '_') + 1);
				$classResut = ClassRegistry::init('TCollege')->find('first', array('conditions' => array('TCollege.Id' => $college)));
				$params['college'] = $classResut['TCollege']['FName'];
				$params['grade'] = $value;
				$data = $this->TPerson->getGradePersonResult($params['college'], $params['grade'], FALSE, $limit, $offset, $sort, $desc, $sConditions);
				$count = $this->TPerson->getGradePersonResult($params['college'], $params['grade'], TRUE, NULL, NULL, NULL, NULL, $sConditions);
			}
			else
			{
				// 专业
				$college = substr($a_node[0], strripos($a_node[0], '_') + 1);
				$grade = substr($a_node[1], strripos($a_node[1], '_') + 1);
				$specialty = substr($a_node[2], strripos($a_node[2], '_') + 1);
				$classResut = ClassRegistry::init('TClass')->find('first', array('conditions' => array('TCollege.Id' => $college, "date_format(TClass.FStartDate, '%Y')" => $grade, "TClass.FSpecialty" => $specialty)));
				$params['college'] = $classResut['TCollege']['FName'];
				$params['grade'] = $grade;
				$params['subject'] = $classResut['TSpecialty']['FName'];
				$data = $this->TPerson->getSubjectPersonResult($params['college'], $params['grade'], $params['subject'], FALSE, $limit, $offset, $sort, $desc, $sConditions);
				$count = $this->TPerson->getSubjectPersonResult($params['college'], $params['grade'], $params['subject'], TRUE, NULL, NULL, NULL, NULL, $sConditions);
			}
		}
		else
		{
			$data = $this->TPerson->find('all', $attr);
			$data = array();
			$count = $this->TPerson->find('count');
		}
		
		if (is_array($data))
		{
			foreach ($data as $key => $vals)
			{
				$data[$key] = $vals['TPerson'];
				$vals['T002'] = isset($vals['T002']) ? $vals['T002'] : array();
				$data[$key]['T002'] = $vals['T002'];
			}
		}
		// echo $this->element('sql_dump');
        $this->set(array(
            'TPerson' => $data,
			'totalCount' => $count,
            '_serialize' => array('TPerson', 'totalCount')
        ));
	}
	
	
	/**
	 * undocumented function
	 *
	 * @return void
	 * @author apple
	 **/
	function export()
	{
		$this->autoRender = FALSE;
		$node = isset($this->request->query['node']) ? $this->request->query['node'] : FALSE;
		if (!$node) return FALSE;
		
		// node
		$a_node = explode('/', $node);
		$q_node = end(explode('/', $node));
		$prefix = substr($q_node, 0, strripos($q_node, '_'));
		$value = substr($q_node, strripos($q_node, '_') + 1, 100);
		$roles = TRUE;
		$params = array();
		if ($prefix == 'grid_classm')
		{ 
			// 班级管理里面的班级
			$params['college'] = substr($a_node[0], strripos($a_node[0], '_') + 1);
			$params['grade'] = substr($a_node[1], strripos($a_node[1], '_') + 1);
			$params['subject'] = substr($a_node[2], strripos($a_node[2], '_') + 1);
			$classResut = ClassRegistry::init('TClass')->find('first', array('conditions' => array('TClass.Id' => $value)));
			$params['class'] = $classResut['TClass']['FName'];
			$data = $this->TPerson->getClassPersonResult($params['college'], $params['grade'], $params['subject'], $params['class'], FALSE);
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TClass', $value, 'export');
		}
		else if ($prefix == 'grid_class')	
		{
			// 学院管理里面的班级
			$classResut = ClassRegistry::init('TClass')->find('first', array('conditions' => array('TClass.Id' => $value)));
			$params['college'] = $classResut['TCollege']['FName'];
			$params['grade'] = date('Y', strtotime($classResut['TClass']['FStartdate']));
			$params['subject'] = $classResut['TSpecialty']['FName'];
			$params['class'] = $classResut['TClass']['FName'];
			$data = $this->TPerson->getClassPersonResult($params['college'], $params['grade'], $params['subject'], $params['class'], FALSE);
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TClass', $value, 'export');
		}
		else if ($prefix == 'grid_college')
		{
			// 学院
			$classResut = ClassRegistry::init('TCollege')->find('first', array('conditions' => array('TCollege.Id' => $value)));
			$params['college'] = $classResut['TCollege']['FName'];
			$data = $this->TPerson->getCollegePersonResult($params['college'], FALSE);
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $value, 'export');
		}
		else if ($prefix == 'grid_grade')
		{
			// 年级
			$college = substr($a_node[0], strripos($a_node[0], '_') + 1);
			$classResut = ClassRegistry::init('TCollege')->find('first', array('conditions' => array('TCollege.Id' => $college)));
			$params['college'] = $classResut['TCollege']['FName'];
			$params['grade'] = $value;
			$data = $this->TPerson->getGradePersonResult($params['college'], $params['grade'], FALSE);
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $college, 'export');
		}
		else
		{
			// 专业
			$college = substr($a_node[0], strripos($a_node[0], '_') + 1);
			$grade = substr($a_node[1], strripos($a_node[1], '_') + 1);
			$specialty = substr($a_node[2], strripos($a_node[2], '_') + 1);
			$classResut = ClassRegistry::init('TClass')->find('first', array('conditions' => array('TCollege.Id' => $college, "date_format(TClass.FStartDate, '%Y')" => $grade, "TClass.FSpecialty" => $specialty)));
			$params['college'] = $classResut['TCollege']['FName'];
			$params['grade'] = $grade;
			$params['subject'] = $classResut['TSpecialty']['FName'];
			$data = $this->TPerson->getSubjectPersonResult($params['college'], $params['grade'], $params['subject'], FALSE);
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $college, 'export');
		}
		
		// roles
		if (!$roles) exit('Access Denied！<br /><br />对不起，您没有此操作权限。');
		
		// 导出EXCEL
		App::import('Vendor', 'PHPExcel/PHPExcel');
	    if (class_exists('PHPExcel')) 
		{
			if (!is_array($data)) return FALSE;
	        foreach ($data as $key => $vals)
			{
				$objPHPExcel = new PHPExcel();
				$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
				$objWriter->setOffice2003Compatibility(true);
				
				//设置文档基本属性
				$objProps = $objPHPExcel->getProperties();
				$objProps->setCreator("NianCode");
				$objProps->setLastModifiedBy("NianCode");
				$objProps->setTitle("Office XLS Persons Document");
				$objProps->setSubject("Office XLS Persons Document");
				$objProps->setDescription("Office XLS Persons Document");
				$objProps->setKeywords("Office XLS Persons Document");
				$objProps->setCategory("Persons");
				$objPHPExcel->setActiveSheetIndex(0);
				$objActSheet = $objPHPExcel->getActiveSheet();

				//设置当前活动sheet的名称
				$objActSheet->setTitle('人员数据');
				
				// debug
				// echo '<pre>';print_r($data);exit;
				//由PHPExcel根据传入内容自动判断单元格内容类型
				$jj = 1;
				$excel = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y','Z');
				$fieldIsExport = array(
					'TPerson' => array(
						'FMemberId' => array('cname' => "会员号"), 
						'FullName' => array('cname' => "姓名"), 
						'FSex' => array('cname' => "性别"), 
						'FEMail' => array('cname' => "常用邮箱"), 
						'FMobileNumber' => array('cname' => "手机", 'type' => 'string'), 
						'FIDNumber' => array('cname' => "证件号", 'type' => 'string'), 
						'FCompanyName' => array('cname' => "工作单位"), 
						'FCompanyPosition' => array('cname' => "现任职务"), 
						'FAddress' => array('cname' => "通讯地址"), 
						'CreateDate' => array('cname' => "创建日期")
					),
					'T002' => array(
						'Extra_college' => array('cname' => "学院"), 
						'Extra_grade' => array('cname' => "年级"), 
						'Extra_subject' => array('cname' => "专业"), 
						'Extra_class' => array('cname' => "所在班级"),
					)
				);	
							
				if (!is_array($data)) return FALSE;
				foreach ($data as $key => $vals)
				{
					// 表头
					if ($key == 0)
					{
						$ii = 1;
						foreach ($fieldIsExport as $fe_key => $fe_vals)
						{
							$prefix = $fe_key;
							foreach ($fe_vals as $fe_k => $fe_v)
							{
								$ve_value = $fe_v['cname'];		// 字段的值
								$els_key = isset($excel[$ii-1]) ? $excel[$ii-1] : FALSE;
								if ($els_key)
								{
									// echo $els_key.'||'.$ve_value.'<br />';
									$objActSheet->setCellValue($els_key.'1', $ve_value);  // 字符串内容
									$objActSheet->getColumnDimension($els_key)->setAutoSize(true);
									$objActSheet->getStyle($els_key)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER);
									$objActSheet->getStyle($els_key)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_LEFT);
									$objActSheet->getStyle($els_key)->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
								}
								$ii++;
							}
						}
					}
				
					$ii = 1;
					$isPlus = FALSE;

					// 内容
					foreach ($vals as $k => $v)
					{
						if (in_array($k, array_keys($fieldIsExport)))
						{
							$prefix = $k;
							if ($isPlus) $ii = 1;
							foreach ($v as $kk => $vv)
							{
								$els2_arykes = array_keys($fieldIsExport[$prefix]);
								$count = count($fieldIsExport['TPerson']);
								if (in_array($kk, $els2_arykes))
								{
									$els2_key = isset($excel[$ii-1]) ? $excel[$ii-1] : FALSE;
									$els2_key2 = $jj + 1;
									$els2_all = $els2_key.$els2_key2;
									$els2_kks = ($k == 'T002') ? $ii-1-$count : $ii - 1;
									$els2_vvkk = isset($els2_arykes[$els2_kks]) ? $els2_arykes[$els2_kks] : FALSE;
									$els2_vv = isset($v[$els2_vvkk]) ? $v[$els2_vvkk] : '';
									$els2_type = isset($fieldIsExport[$prefix][$kk]['type']) ? $fieldIsExport[$prefix][$kk]['type'] : FALSE;
									// echo $els2_type.$els2_all.'||'.$els2_vv.'<br />';
									if ($els2_key) 
									{
										if ($els2_type == 'string')
										{
											$objActSheet->setCellValueExplicit($els2_all, $els2_vv, PHPExcel_Cell_DataType::TYPE_STRING);  // 字符串内容
										}
										else
										{
											$objActSheet->setCellValue($els2_all, $els2_vv);  // 字符串内容
										}
									}
									$ii++;
								}
							}
							
						}
						if ($k == 'T002') $isPlus = TRUE;
					}
					$jj++;
				}
				
				// export excel
				$filename = "person.xlsx";
				$objWriter->save($filename);
				// echo file_get_contents($filename);
				$this->redirect("/{$filename}");
			}
	    }
	
	}
	
	public function view($id)
	{
		$data = $this->TPerson->findById($id);
        $this->set(array(
            'data' => $data,
            '_serialize' => array('data')
        ));
	}
	
	public function add()
	{
		$params = array();
		$node = isset($this->request->query['node']) ? $this->request->query['node'] : FALSE;
		$a_node = explode('/', $node);
		$q_node = end(explode('/', $node));
		$prefix = substr($q_node, 0, strripos($q_node, '_'));
		$value = substr($q_node, strripos($q_node, '_') + 1, 100);
		$roles = TRUE;
		
		if (!$node) return FALSE;
		if ($prefix == 'grid_classm')
		{ 
			// 班级管理里面的班级
			$params['college'] = substr($a_node[0], strripos($a_node[0], '_') + 1);
			$params['grade'] = substr($a_node[1], strripos($a_node[1], '_') + 1);
			$params['grade'] = date('Y', strtotime($params['grade'])).'-09-01';
			$params['subject'] = substr($a_node[2], strripos($a_node[2], '_') + 1);
			$classResut = ClassRegistry::init('TClass')->find('first', array('conditions' => array('TClass.Id' => $value)));
			$params['class'] = $classResut['TClass']['FName'];
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TClass', $value, 'add');
		}
		else if ($prefix == 'grid_class')	
		{
			// 学院管理里面的班级
			$classResut = ClassRegistry::init('TClass')->find('first', array('conditions' => array('TClass.Id' => $value)));
			$params['college'] = $classResut['TCollege']['FName'];
			$params['grade'] = date('Y', strtotime($classResut['TClass']['FStartdate'])).'-09-01';
			$params['subject'] = $classResut['TSpecialty']['FName'];
			$params['class'] = $classResut['TClass']['FName'];
			$data = $this->TPerson->getClassPersonResult($params['college'], $params['grade'], $params['subject'], $params['class'], FALSE);
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TClass', $value, 'add');
		}
		else if ($prefix == 'grid_college')
		{
			// 学院
			$classResut = ClassRegistry::init('TCollege')->find('first', array('conditions' => array('TCollege.Id' => $value)));
			$params['college'] = $classResut['TCollege']['FName'];
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $value, 'add');
		}
		else if ($prefix == 'grid_grade')
		{
			// 年级
			$college = substr($a_node[0], strripos($a_node[0], '_') + 1);
			$classResut = ClassRegistry::init('TCollege')->find('first', array('conditions' => array('TCollege.Id' => $college)));
			$params['college'] = $classResut['TCollege']['FName'];
			$params['grade'] = date('Y', strtotime($value)).'-09-01';
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $college, 'add');
		}
		else
		{
			// 专业
			$college = substr($a_node[0], strripos($a_node[0], '_') + 1);
			$grade = substr($a_node[1], strripos($a_node[1], '_') + 1);
			$specialty = substr($a_node[2], strripos($a_node[2], '_') + 1);
			$classResut = ClassRegistry::init('TClass')->find('first', array('conditions' => array('TCollege.Id' => $college, "date_format(TClass.FStartDate, '%Y')" => $grade, "TClass.FSpecialty" => $specialty)));
			$params['college'] = $classResut['TCollege']['FName'];
			$params['grade'] = date('Y', strtotime($grade)).'-09-01';
			$params['subject'] = $classResut['TSpecialty']['FName'];
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $college, 'add');
		}
		
		// 权限
		if ($roles)
		{
			$data = $this->request->data;
			$data['Id'] = String::uuid();
			$data['CreateDate'] = date('Y-m-d H:i:s');
			$data['CreateMan'] = $this->username;
			$this->TPerson->id = $data['Id'];
			if ($this->TPerson->SaSave($data)) {
				ClassRegistry::init('T002')->store_insert($data['Id'], $params);
				$message = 'Saved';
				$success = TRUE;
	        } else {
	            $message = 'Error';
				$success = FALSE;
	        }
		}
		else
		{
			$message = '你没有此操作权限。';
			$success = FALSE;
		}
		
        $this->set(array(
            'message' => $message,
			'success' => $success,
            '_serialize' => array('message', 'success')
        ));
	}
	
	public function edit($id)
	{
		$node = isset($this->request->query['node']) ? $this->request->query['node'] : FALSE;
		$a_node = explode('/', $node);
		$q_node = end(explode('/', $node));
		$prefix = substr($q_node, 0, strripos($q_node, '_'));
		$value = substr($q_node, strripos($q_node, '_') + 1, 100);
		$roles = TRUE;
		if (!$node) return FALSE;
		if ($prefix == 'grid_classm')
		{ 
			// 班级管理里面的班级
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TClass', $value, 'edit');
		}
		else if ($prefix == 'grid_class')	
		{
			// 学院管理里面的班级
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TClass', $value, 'edit');
		}
		else if ($prefix == 'grid_college')
		{
			// 学院
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $value, 'edit');
		}
		else if ($prefix == 'grid_grade')
		{
			// 年级
			$college = substr($a_node[0], strripos($a_node[0], '_') + 1);
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $college, 'edit');
		}
		else
		{
			// 专业
			$college = substr($a_node[0], strripos($a_node[0], '_') + 1);
			$grade = substr($a_node[1], strripos($a_node[1], '_') + 1);
			$specialty = substr($a_node[2], strripos($a_node[2], '_') + 1);
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $college, 'edit');
		}
		
		// 权限
		if ($roles)
		{
			$this->TPerson->id = $id;
	 		if ($this->TPerson->reSave($this->request->data, $this->uid)) 
			{
	            $message = 'Saved';
				$success = true;
	        } 
			else 
			{
	            $message = 'Error';
				$success = false;
	        }
		}
		else
		{
			$message = '你没有此操作权限。';
			$success = FALSE;
		}
		
        $this->set(array(
            'message' => $message,
			'success' => $success,
            '_serialize' => array('message', 'success')
        ));
	}
	
	public function delete($id)
	{
		
		$node = isset($this->request->query['node']) ? $this->request->query['node'] : FALSE;
		$a_node = explode('/', $node);
		$q_node = end(explode('/', $node));
		$prefix = substr($q_node, 0, strripos($q_node, '_'));
		$value = substr($q_node, strripos($q_node, '_') + 1, 100);
		$roles = TRUE;
		if (!$node) return FALSE;
		if ($prefix == 'grid_classm')
		{ 
			// 班级管理里面的班级
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TClass', $value, 'del');
		}
		else if ($prefix == 'grid_class')	
		{
			// 学院管理里面的班级
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TClass', $value, 'del');
		}
		else if ($prefix == 'grid_college')
		{
			// 学院
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $value, 'del');
		}
		else if ($prefix == 'grid_grade')
		{
			// 年级
			$college = substr($a_node[0], strripos($a_node[0], '_') + 1);
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $college, 'del');
		}
		else
		{
			// 专业
			$college = substr($a_node[0], strripos($a_node[0], '_') + 1);
			$grade = substr($a_node[1], strripos($a_node[1], '_') + 1);
			$specialty = substr($a_node[2], strripos($a_node[2], '_') + 1);
			$roles = ClassRegistry::init('TChapterAdmin')->getRolesCase($this->uid, 'TCollege', $college, 'del');
		}
		
		// 权限
		if ($roles)
		{
			if ($this->TPerson->delete($id)) {
	            $message = 'Deleted';
				$success = TRUE;
	        } else {
	            $message = 'Error';
				$success = FALSE;
	        }
		}
		else
		{
			$message = '你没有此操作权限。';
			$success = FALSE;
		}
		
        $this->set(array(
            'message' => $message,
			'success' => $success,
            '_serialize' => array('message', 'success')
        ));
	}

	
}