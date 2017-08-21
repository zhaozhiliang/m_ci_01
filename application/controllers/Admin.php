<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends MY_Controller {

	/**
	 * 管理员操作
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('system_admin_model');
		$this->load->model('system_role_model');
	}

	/**
	 * 管理员首页
	 */
	public function index(){
		$getName = $this->input->get('name', TRUE);
		$where = array();
		if(!empty($getName)){
			$where['name'] = $getName;
		}
		//分页处理
		$getPn = $this->input->get('pn', TRUE);
		$page = (intval($getPn) < 1) ? 1 : intval($getPn);
		$limit = 10;
		$offset = ($page - 1) * $limit;
		$adminResult = $this->system_admin_model->getList($where, $offset, $limit);
		$Paging = $this->_paging($adminResult['cnt'], $limit, 5, $page, 'admin');

		$data = array(
					'roleInfo' => $this->_roleList(),
					'list' => $adminResult['list'],
					'Paging' => $Paging,
					'page' => $page,
					'getName' => $getName
				);
		$this->_view('system/admin_list', $data);
	}

	/**
	* 角色整理
	*/
	private function _roleList(){
		$roleList = $this->system_role_model->getList();
		$roleResult = array();
		if($roleList){
			foreach($roleList AS $key => $val){
				$roleResult[$val['id']] = $val['name'];
			}
		}
		return $roleResult;
	}

	/**
	 * 添加管理员
	 */
	public function add(){
		$data = array(
					'role_list' => $this->system_role_model->getList()
				);
		$this->_view('system/admin_add', $data);
	}

	/**
	* 添加操作
	*/
	public function do_add(){
		if(count($_POST) > 0){
			$roleIds = $this->input->post('role_id', TRUE);
			$password = $this->input->post('pwd', TRUE);
			$rePassword = $this->input->post('re_pwd', TRUE);
			if($password !== $rePassword){
				$callBackData = array('callbackMsg' => '管理员密码两次输入不一致');
				$this->renderFaild($callBackData);
			}
            $salt = $this->generate_salt(6);
			$postData = array(
							'name' => $this->input->post('name', TRUE),
                            'salt'=>$salt,
							'pwd' => md5($password.$salt.'youjike'),
							'realname' => $this->input->post('realname', TRUE),
							'phone' => $this->input->post('phone', TRUE),
							'telphone' => $this->input->post('telphone', TRUE),
							'role_id' => implode(',', $roleIds),
							'detail' => $this->input->post('detail', TRUE)
						);
			if($this->system_admin_model->isExists($postData['name'])){
				$insertID = $this->system_admin_model->save($postData);
				$callBackData = array('lastID' => $insertID);
				$this->renderSuccess($callBackData);
			} else {
				$callBackData = array('callbackMsg' => '管理员名称已经被占用');
				$this->renderFaild($callBackData);
			}
		}
		$this->renderFaild();
	}

	/**
	 * 编辑管理员
	 */
	public function edit(){
		$admin_id = (int) $this->input->get('id', TRUE);
		$adminInfo = $this->system_admin_model->getRow($admin_id);
		if(empty($adminInfo)){
			show_404();
		}
		$adminInfo['role_array'] = explode(',', $adminInfo['role_id']);
		$data = array(
					'info' => $adminInfo,
					'role_list' => $this->system_role_model->getList()
				);
		$this->_view('system/admin_edit', $data);
	}

	/**
	* 编辑操作
	*/
	public function do_edit(){
		if(count($_POST) > 0){
			$admin_id = $this->input->post('id', TRUE);
			$roleIds = $this->input->post('role_id', TRUE);
			$password = $this->input->post('pwd', TRUE);
			$rePassword = $this->input->post('re_pwd', TRUE);
			if($password !== $rePassword){
				$callBackData = array('callbackMsg' => '管理员密码两次输入不一致');
				$this->renderFaild($callBackData);
			}
			$editData = array(
							'name' => $this->input->post('name', TRUE),
							'realname' => $this->input->post('realname', TRUE),
							'phone' => $this->input->post('phone', TRUE),
							'telphone' => $this->input->post('telphone', TRUE),
							'role_id' => implode(',', $roleIds),
							'detail' => $this->input->post('detail', TRUE)
						);
			if(!empty($password)) $editData['pwd'] = md5($password);
			$this->system_admin_model->edit($admin_id, $editData);
			$this->renderSuccess();
		}
		$this->renderFaild();
	}

	/**
	* 删除操作
	*/
	public function do_del(){
		$admin_id = $this->input->get('id', TRUE);
		if(intval($admin_id) > 0){
			$editData = array('status' => 0);
			$this->system_admin_model->edit($admin_id, $editData);
			$this->renderSuccess();
		}
		$this->renderFaild();
	}

    private function generate_salt( $length = 6 ) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for ( $i = 0; $i < $length; $i++ )
        {
        // 这里提供两种字符获取方式
        // 第一种是使用 substr 截取$chars中的任意一位字符；
        // 第二种是取字符数组 $chars 的任意元素
        // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
            $password .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        return $password;
}
}