<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authorization extends MY_Controller {

	/**
	 * 权限操作
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('system_menu_model');
	}

	/**
	 * 权限首页
	 */
	public function index(){
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
		$data = array('list' => $result);
		$this->_view('system/authorization_list', $data);
	}
}