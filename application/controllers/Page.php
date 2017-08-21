<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends MY_Controller {

    /**
     * 页面操作
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('page_model');
    }

    /**
     * 查看页面列表
     */
    public function index() {
        //分页处理
        $getPn = $this->input->get('pn', TRUE);
        $page = (intval($getPn) < 1) ? 1 : intval($getPn);
        $limit = 10;
        $offset = ($page - 1) * $limit;
        $pageResult = $this->page_model->getList(array(), $offset, $limit);
        $Paging = $this->_paging($pageResult['cnt'], $limit, 5, $page, 'page');

        $data = array(
            'list' => $pageResult['list'],
            'Paging' => $Paging,
            'page' => $page,
        );
        $this->_view('page/page_list', $data);
    }

    /**
     * 发布页面页面
     */
    public function add() {
        $data = array('code_list' => $this->page_model->getPageType());
//        echo "<pre>";
//        var_dump($data);
//        exit;
        $this->_view('page/page_add', $data);
    }

    /**
     * 发布页面
     */
    public function do_add() {
        if (count($_POST) > 0) {
            $postData = array(
                'page_name' => $this->input->post('page_name', TRUE),
                'page_type' => $this->input->post('page_type', TRUE),
                'page_title' => $this->input->post('page_title', TRUE),
                'page_content' => $this->input->post('page_content', TRUE)
            );
            $this->page_model->save($postData);
            $this->renderSuccess();
        }
        $this->renderFaild();
    }

    /**
     * 编辑页面
     */
    public function edit() {
        $page_id = $this->input->get('page_id', TRUE);
        $date['page'] = $this->page_model->getRow($page_id);
        $date['code_list'] = $this->page_model->getPageType();
        
//        echo "<pre>";
//        var_dump($date);
//        exit;
        $this->_view('page/page_edit', $date);
    }

    /**
     * 编辑操作
     */
    public function do_edit() {
        $page_id = $this->input->post('page_id', TRUE);
        if (count($_POST) > 0) {
            $postData = array(
                'page_name' => $this->input->post('page_name', TRUE),
                'page_type' => $this->input->post('page_type', TRUE),
                'page_title' => $this->input->post('page_title', TRUE),
                'page_content' => $this->input->post('page_content')
            );
            $this->page_model->edit($page_id, $postData);
            $this->renderSuccess();
        }
        $this->renderFaild();
    }

}
