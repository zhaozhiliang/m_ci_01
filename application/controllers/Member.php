<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends MY_Controller {

    /**
     * 构造函数
     * 加载数据model
     */
    public function __construct() {
        parent::__construct();
        //$this->load->model('user_model');
    }

     /**
     * 查看普通会员index
     */
    public function index() {
        //分页处理
        
        
        $where['id'] = $search['id'] = $this->input->get('id', TRUE)?$this->input->get('id', TRUE):'';
        $where['sex'] = $search['sex'] = $this->input->get('sex', TRUE)?$this->input->get('sex', TRUE):'';
        $where['nickname'] = $search['nickname'] = $this->input->get('nickname', TRUE)?$this->input->get('nickname', TRUE):'';
        $where['mobile'] = $search['mobile'] = $this->input->get('mobile', TRUE)?$this->input->get('mobile', TRUE):'';
        
        $url = "/member/";
        $where['state'] = 0;
        $getPn = $this->input->get('pn', TRUE);
        $page = (intval($getPn) < 1) ? 1 : intval($getPn);
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $userResult = $this->user_model->getList($where, $offset, $limit);
        $Paging = $this->_paging($userResult['cnt'], $limit, 7, $page, $url);
        
        $data = array(
           'list' => $userResult['list'],
           'Paging' => $Paging,
           'page' => $page,
           'cnt' => $userResult['cnt'],
           'url' => $url,
           'search' => $search
        );
        
        $data['title'] = "会员列表";
        $this->_view('member/member_list', $data);
    }
    
    public function do_del() {
        $id = $this->input->get('id', TRUE);
        if (intval($id) > 0) {
            $editData = array('state' => 1);
            $this->user_model->edit($id, $editData);
            $this->renderSuccess();
        }
        $this->renderFaild();
    }
    
    public function del_list(){
        //分页处理
         
        $where['id'] = $search['id'] = $this->input->get('id', TRUE)?$this->input->get('id', TRUE):'';
        $where['sex'] = $search['sex'] = $this->input->get('sex', TRUE)?$this->input->get('sex', TRUE):'';
        $where['nickname'] = $search['nickname'] = $this->input->get('nickname', TRUE)?$this->input->get('nickname', TRUE):'';
        $where['mobile'] = $search['mobile'] = $this->input->get('mobile', TRUE)?$this->input->get('mobile', TRUE):'';
        
        $url = "/member/del_list";
        $where['state'] = 1;
        $getPn = $this->input->get('pn', TRUE);
        $page = (intval($getPn) < 1) ? 1 : intval($getPn);
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $userResult = $this->user_model->getList($where, $offset, $limit);
        $Paging = $this->_paging($userResult['cnt'], $limit, 7, $page, $url);
        
        $data = array(
           'list' => $userResult['list'],
           'Paging' => $Paging,
           'page' => $page,
           'cnt' => $userResult['cnt'],
           'url' => $url,
           'search' => $search
        );
         
        $data['title'] = "已删除会员";
        $this->_view('member/del_list', $data);
    }
    
    public function un_del() {
        $id = $this->input->get('id', TRUE);
        if (intval($id) > 0) {
            $editData = array('state' => 0);
            $this->user_model->edit($id, $editData);
            $this->renderSuccess();
        }
        $this->renderFaild();
    }
    
    public function member_edit(){
        $id = $this->input->get('id', TRUE);
        
        $data['member'] = $this->user_model->getRow($id);
        
        $data['title'] = "修改会员信息";
        
        $this->_view('member/member_edit', $data);
    }
    
    /**
     * 编辑操作
     */
    public function do_edit() {
        $id = $this->input->post('id', TRUE);

        $nickname = $this->input->post('nickname', TRUE);
        $mobile = $this->input->post('mobile', TRUE);
        $sex = $this->input->post('sex', TRUE);
        $personality = $this->input->post('personality', TRUE);
        
        
//        $where['nickname'] = $nickname;
//        $member_nickname = $this->user_model->getMemberRow($where);
//        if(!empty($member_nickname) && $member_nickname['id'] != $id){
//            $result['callbackMsg'] = '昵称已经存在';
//            $this->renderFaild($result);
//        }
//        $where = array();
        
        if(!empty($mobile)){
            $where['mobile'] = $mobile;
            $member_mobile = $this->user_model->getMemberRow($where);
            if(!empty($member_mobile)   && $member_mobile['id'] != $id){
                $result['callbackMsg'] = '手机号已经存在';
                $this->renderFaild($result);
            }
        }
        
        if(!empty($nickname)){
            $data_member['nickname'] = $nickname;
        }
        if(!empty($mobile)){
            $data_member['mobile'] = $mobile;
        }
        
        $data_member['updatedAt'] = date('Y-m-d H:i:s');
        $this->user_model->edit($id, $data_member);
        
        $where = array();
        $where['user'] = $id;
        $member_info = $this->user_model->getMemberinfoRow($where);
        
        if(empty($member_info)){
            $data_info['sex'] = $sex;
            $data_info['personality'] = $personality;
            $data_info['user'] = $id;
            $data_info['createdAt'] = date('Y-m-d H:i:s');
            
            $flag  = $this->user_model->insert_info($data_info);
            if($flag){
                $this->renderSuccess();
            }
        }else{
            
            if(!empty($sex)){
                $data_info['sex'] = $sex;
            }

            if(!empty($personality)){
                $data_info['personality'] = $personality;
            }

            $data_info['updatedAt'] = date('Y-m-d H:i:s');
            $this->user_model->edit_info($id, $data_info);
        }
        $this->renderSuccess();
    }
    
    
    public function member_add(){
        
        $data['title'] = "添加会员";
        
        $this->_view('member/member_add', $data);
    }
    
    public function do_add(){
        if(count($_POST) > 0){
            $mobile = $this->input->post('mobile', TRUE);
            $password = $this->input->post('pwd', TRUE);
            $rePassword = $this->input->post('re_pwd', TRUE);
            $nickname = $this->input->post('nickname', TRUE);
            $username = $this->input->post('username', TRUE);
            
            if($password !== $rePassword){
                $callBackData = array('callbackMsg' => '密码两次输入不一致');
                $this->renderFaild($callBackData);
            }
            $postData = array(
                    'password' => md5($password),
                    'nickname' => $nickname,
                    'mobile' => $mobile,
                    'username' => $username
                );
            if($this->user_model->isExists($postData['mobile'])){
                
                if($this->user_model->isExists($postData['mobile'])){
                    $insertID = $this->user_model->save($postData);
                    $callBackData = array('lastID' => $insertID);
                    $this->renderSuccess($callBackData);
                } else {
                    $callBackData = array('callbackMsg' => '用户名已存在');
                    $this->renderFaild($callBackData);
                }
            } else {
                $callBackData = array('callbackMsg' => '手机号已占用');
                $this->renderFaild($callBackData);
            }
        }
        $this->renderFaild();
    }
}
