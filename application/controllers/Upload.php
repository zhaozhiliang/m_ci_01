<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends MY_Controller {

	/**
	 * 管理员操作
	 */
	public function __construct(){
		parent::__construct();
	}

    public function index(){

    }


    //本地上传
    public function local_upload(){
        $db_path = '/uploads/'.date('Y').'/'.date('m').'/';
        $config['upload_path']      = '.'.$db_path;
        $config['allowed_types']    = 'gif|jpg|png';
        $config['max_size']     = 10*1024;
        $config['file_name'] = uniqid().rand(100000, 999999);

        if(!file_exists($config['upload_path'])) mkdir($config['upload_path'], 0777, true); //必须要

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file'))
        {

         //   $error = array('error' => $this->upload->display_errors());

            echo json_encode(array('status'=>-2,'msg'=>'上传失败'));exit;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());
            echo json_encode(array('status'=>1,'msg'=>'成功','data'=>array('file_name'=>$db_path.$data['upload_data']['file_name'])));exit;
        }
    }



}