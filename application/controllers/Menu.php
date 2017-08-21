<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends MY_Controller {

	/**
	 * 菜单操作
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('system_menu_model');
	}

	/**
	 * 菜单首页
	 */
	public function index(){
		$data = array(
					'list' => $this->system_menu_model->getList()
				);
		$this->_view('system/menu_list', $data);
	}

	/**
	 * 添加菜单页面
	 */
	public function add(){
		$data = array(
					'list' => $this->system_menu_model->getList()
				);
		$this->_view('system/menu_add', $data);
	}

	/**
	* 添加操作
	*/
	public function do_add(){
		if(count($_POST) > 0){
			$postData = array(
							'parent_id' => $this->input->post('parent_id', TRUE),
							'name' => $this->input->post('name', TRUE),
							'controller' => $this->input->post('controller', TRUE),
							'action' => $this->input->post('action', TRUE),
							'sort' => $this->input->post('sort', TRUE),
							'icon' => $this->input->post('icon', TRUE),
							'is_show' => $this->input->post('is_show', TRUE),
							'description' => $this->input->post('description', TRUE)
						);
			$insertID = $this->system_menu_model->save($postData);
			$callBackData = array('lastID' => $insertID);
			$this->renderSuccess($callBackData);
		}
		$this->renderFaild();
	}

	/**
	* 编辑菜单页面
	*/
	public function edit(){
		$menu_id = (int) $this->input->get('id', TRUE);
		$menuInfo = $this->system_menu_model->getRow($menu_id);
		if(empty($menuInfo)){
			show_404();
		}
		$data = array(
					'list' => $this->system_menu_model->getList(),
					'info' => $menuInfo
				);
		$this->_view('system/menu_edit', $data);
	}

	/**
	* 编辑操作
	*/
	public function do_edit(){
		if(count($_POST) > 0){
			$menu_id = $this->input->post('id', TRUE);
			$editData = array(
							'parent_id' => $this->input->post('parent_id', TRUE),
							'name' => $this->input->post('name', TRUE),
							'controller' => $this->input->post('controller', TRUE),
							'action' => $this->input->post('action', TRUE),
							'sort' => $this->input->post('sort', TRUE),
							'icon' => $this->input->post('icon', TRUE),
							'is_show' => $this->input->post('is_show', TRUE),
							'description' => $this->input->post('description', TRUE)
						);
			$this->system_menu_model->edit($menu_id, $editData);
			$this->renderSuccess();
		}
		$this->renderFaild();
	}

	/**
	* 删除操作
	*/
	public function do_del(){
		$menu_id = $this->input->get('id', TRUE);
		if(intval($menu_id) > 0){
			$this->system_menu_model->del($menu_id);
			$this->renderSuccess();
		}
		$this->renderFaild();
	}
}