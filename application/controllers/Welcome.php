<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MY_Controller {

	public function __construct(){
            parent::__construct();
            $this->load->model('system_login_model');
	}

	/**
	 * Index Page for default.
	 */
	public function index(){
//		redirect(base_url() . 'defaultstart');

        $this->_view('welcome');
	}

	/**
	 * 登录页
	 */
	public function login(){
            $this->load->view('login/index');
	}

	/**
	 * 登录操作
	 */
	public function do_login(){

		if($_SERVER['REQUEST_METHOD'] !== 'POST'){
			$this->renderFaild();
		}
		$username	= $this->input->post('username', TRUE);
        $password	= $this->input->post('password', TRUE);
		$loginFlag = $this->system_login_model->login($username, $password);
        if($username == '')
        {
        	$callBackData = array(
        						'callbackMsg' => "用户名不能为空！"
        					);
        	$this->renderFaild($callBackData);
        } else if($password == '') {
        	$callBackData = array(
        						'callbackMsg' => "密码不能为空！"
        					);
        	$this->renderFaild($callBackData);
        } else if($loginFlag == 1) {
        	$callBackData = array(
        						'callbackMsg' => "系统登录成功！"
        					);
        	$this->renderSuccess($callBackData);
        } else if($loginFlag == -1) {
        	$callBackData = array(
        						'callbackMsg' => "密码不正确！"
        					);
        	$this->renderFaild($callBackData);
        } else if($loginFlag == 0) {
        	$callBackData = array(
        						'callbackMsg' => "用户不存在！"
        					);
        	$this->renderFaild($callBackData);
        }
	}

	/**
    * 登出操作
    */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url() . 'welcome/login');
    }
}
