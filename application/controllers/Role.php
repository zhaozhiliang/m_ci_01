<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends MY_Controller {

	/**
	 * 角色操作
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('system_role_model');
	}

	/**
	 * 角色首页
	 */
	public function index(){
		$data = array(
					'list' => $this->system_role_model->getList()
				);
		$this->_view('system/role_list', $data);
	}

	/**
	 * 添加角色
	 */
	public function add(){
		$this->_view('system/role_add');
	}

	/**
	* 添加操作
	*/
	public function do_add(){
		if(count($_POST) > 0){
			$postData = array(
							'name' => $this->input->post('name', TRUE),
							'is_super' => $this->input->post('is_super', TRUE),
							'description' => $this->input->post('description', TRUE)
						);
			$insertID = $this->system_role_model->save($postData);
			$callBackData = array('lastID' => $insertID);
			$this->renderSuccess($callBackData);
		}
		$this->renderFaild();
	}

	/**
	* 编辑角色页面
	*/
	public function edit(){
		$role_id = (int) $this->input->get('id', TRUE);
		$roleInfo = $this->system_role_model->getRow($role_id);
		if(empty($roleInfo)){
			show_404();
		}
		$data = array(
					'info' => $roleInfo
				);
		$this->_view('system/role_edit', $data);
	}

	/**
	* 编辑操作
	*/
	public function do_edit(){
		if(count($_POST) > 0){
			$role_id = $this->input->post('id', TRUE);
			$editData = array(
							'name' => $this->input->post('name', TRUE),
							'is_super' => $this->input->post('is_super', TRUE),
							'description' => $this->input->post('description', TRUE)
						);
			$this->system_role_model->edit($role_id, $editData);
			$this->renderSuccess();
		}
		$this->renderFaild();
	}

	/**
	* 删除操作
	*/
	public function do_del(){
		$role_id = $this->input->get('id', TRUE);
		if(intval($role_id) > 0){
			$editData = array('status' => 0);
			$this->system_role_model->edit($role_id, $editData);
			$this->renderSuccess();
		}
		$this->renderFaild();
	}

	/**
	* 权限配置
	*/
	public function authorization_config(){
		$this->load->model('system_menu_model');
		$role_id = (int) $this->input->get('id', TRUE);
		$roleInfo = $this->system_role_model->getRow($role_id);
		if(empty($roleInfo)){
			show_404();
		}
		$roleInfo['authorization_array'] = explode(',', $roleInfo['authorization']);
		$menuList = $this->system_menu_model->getList();
		$result = array();
		foreach($menuList AS $key => $val){
			$exPath = explode('_', $val['path']);
			if(!empty($exPath[2])) {
				$result[$exPath[0]]['list'][$exPath[1]]['list'][] = $val;
			} else if(!empty($exPath[1])) {
				$result[$exPath[0]]['list'][$exPath[1]] = $val;
			} else {
				$result[$exPath[0]] = $val;
			}
		}
		$data = array('list' => $result, 'info' => $roleInfo);
		$this->_view('system/role_authorization_config', $data);
	}

	/**
	* 权限配置操作
	*/
	public function do_authorization_config(){
		if(count($_POST) > 0){
			$role_id = $this->input->post('id', TRUE);
			$authorizationRes = array();
			foreach($_POST AS $key => $val){
				if(substr($key, 0, 14) == 'authorization_'){
					$authorizationRes[] = $val;
				}
			}
			$editData = array(
							'authorization' => implode(',', $authorizationRes)
						);
			$this->system_role_model->edit($role_id, $editData);
			$this->renderSuccess();
		}
		$this->renderFaild();
	}
}