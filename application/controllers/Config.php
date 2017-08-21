<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends MY_Controller {

    /**
     * 菜单操作
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('config_info_model');
    }

    /**
     * 菜单首页
     */
    public function index() {
        $configResult = $this->config_info_model->getListItem();
        $data = array(
            'list' => $configResult,
        );
        $this->_view('config/config_list', $data);
    }
    /**
     * 配置项列表
     */
    public function item_list() {
        $data['config_code'] = $this->input->get('config_code', TRUE);
        $data['list'] = $this->config_info_model->getList($data['config_code']);
        $this->_view('config/item_list', $data);
    }

    /**
     * 添加菜单页面
     */
    public function add() {
        $data['config_code'] = $this->input->get('config_code', TRUE);
        $data['code_list'] = $this->config_info_model->loadConfigList();
        $this->_view('config/config_add', $data);
    }

    /**
     * 批量添加配置
     */
    public function adds() {
        $data = array('code_list' => $this->config_info_model->loadConfigList());
        $data['config_code'] = $this->input->get('config_code', TRUE);
        $this->_view('config/config_adds', $data);
    }

    /**
     * 批量添加操作
     */
    public function do_adds() {
        if (count($_POST) > 0) {
            $config_value = array_filter(explode("\n", $this->input->post('config_value', TRUE)));
            $postData['config_code'] = $this->input->post('config_code', TRUE);
            $postData['config_rank'] = $this->input->post('config_rank', TRUE);
            foreach ($config_value as $config_val) {
                $postData['config_value'] = $config_val;
                $this->config_info_model->save($postData);
                $postData['config_rank']++;
            }
            $this->renderSuccess();
        }
        $this->renderFaild();
    }

    /**
     * 添加操作
     */
    public function do_add() {
        if (count($_POST) > 0) {
            $postData = array(
                'config_code' => $this->input->post('config_code', TRUE),
                'config_key' => $this->input->post('config_key', TRUE),
                'config_value' => $this->input->post('config_value', TRUE),
                'config_rank' => $this->input->post('config_rank', TRUE)
            );
//            echo "<pre>";
//            var_dump($postData);
//            exit;
            $insertID = $this->config_info_model->save($postData);
            $callBackData = array('lastID' => $insertID);
            $this->renderSuccess($callBackData);
        }
        $this->renderFaild();
    }

    /**
     * 编辑菜单页面
     */
    public function edit() {
        $config_id = (int) $this->input->get('config_id', TRUE);
        $configInfo = $this->config_info_model->getRow($config_id);
//        echo "<pre>";
//        var_dump($configInfo);
//        exit;
        if (empty($configInfo)) {
            show_404();
        }
        $data = array(
//            'list' => $this->config_info_model->getList(),
            'info' => $configInfo,
            'code_list' => $this->config_info_model->loadConfigList()
        );
        $this->_view('config/config_edit', $data);
    }

    /**
     * 编辑操作
     */
    public function do_edit() {
        if (count($_POST) > 0) {
            $config_id = $this->input->post('config_id', TRUE);
//echo $config_id;
//exit;
            $editData = array(
                'config_code' => $this->input->post('config_code', TRUE),
                'config_key' => $this->input->post('config_key', TRUE),
                'config_value' => $this->input->post('config_value', TRUE),
                'config_rank' => $this->input->post('config_rank', TRUE)
            );
            $this->config_info_model->edit($config_id, $editData);
            $this->renderSuccess();
        }
        $this->renderFaild();
    }

    /**
     * 删除操作
     */
    public function do_del() {
        $config_id = $this->input->get('id', TRUE);
//        echo $config_id;
//        exit;
        if (intval($config_id) > 0) {
            $this->config_info_model->del($config_id);
            $this->renderSuccess();
        }
        $this->renderFaild();
    }
    
        /**
     * 删除配置操作
     */
    public function do_del_code() {
        $config_code = $this->input->get('config_code', TRUE);
//        echo $config_id;
//        exit;
        if ($config_code) {
            $this->config_info_model->delCode($config_code);
            $this->renderSuccess();
        }
        $this->renderFaild();
    }
}
