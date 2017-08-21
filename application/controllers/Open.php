<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Open extends MY_Controller {

    public function __construct(){
        parent::__construct();
    	$this->load->model('member_info_model');
    	$this->load->model('tag_model');
        $this->load->model('group_info_model');
    }

    /**
     * Index Page for default.
     */
    public function index(){
        $where['keyword'] = $keyword = $this->input->get('keyword', TRUE);
        $where = array('keyword' => $keyword,'open_id'=>-1);
        //分页处理
        $getPn = $this->input->get('pn', TRUE);
        $page = (intval($getPn) < 1) ? 1 : intval($getPn);
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $adminResult = $this->member_info_model->getOpenList($where,' open_time ASC ', $offset, $limit);
        $Paging = $this->_paging($adminResult['cnt'], $limit, 5, $page, 'open');
        foreach($adminResult['list']  as $key => $member){
            $tag_list = $this->tag_model->getTagByItem($member['member_id']);
            $tag_name = array();
            foreach($tag_list as $tag){
                $tag_name[] = $tag['tag_name'];
            }
            $adminResult['list'][$key]['tag_list'] = implode(",", $tag_name);

            $group_list = $this->group_info_model->getUserList($member['member_id']);
            $group_name = array();
            foreach ($group_list as $group) {
                $group_name[] = $group['group_name'];
            }

            $adminResult['list'][$key]['group_list'] =  $group_name;

        }
        $data = array(
            'list' => $adminResult['list'],
            'Paging' => $Paging,
            'page' => $page,
            'keyword' => $keyword,
            'action' => '/open/index'
        );
        $this->_view('open/list', $data);
    }

    /**
     * Index Page for default.
     */
    public function all(){
        $where['keyword'] = $keyword = $this->input->get('keyword', TRUE);
        $where = array('keyword' => $keyword,'open_id'=>0);
        //分页处理
        $getPn = $this->input->get('pn', TRUE);
        $page = (intval($getPn) < 1) ? 1 : intval($getPn);
        $limit = 20;
        $offset = ($page - 1) * $limit;
        $adminResult = $this->member_info_model->getOpenList($where,' open_id DESC ', $offset, $limit);
        $Paging = $this->_paging($adminResult['cnt'], $limit, 5, $page, 'open/all');
        foreach($adminResult['list']  as $key => $member){
            $tag_list = $this->tag_model->getTagByItem($member['member_id']);
            $tag_name = array();
            foreach($tag_list as $tag){
                $tag_name[] = $tag['tag_name'];
            }
            $adminResult['list'][$key]['tag_list'] = implode(",", $tag_name);

            $group_list = $this->group_info_model->getUserList($member['member_id']);
            $group_name = array();
            foreach ($group_list as $group) {
                $group_name[] = $group['group_name'];
            }

            $adminResult['list'][$key]['group_list'] =  $group_name;
        }
        $data = array(
            'list' => $adminResult['list'],
            'Paging' => $Paging,
            'page' => $page,
            'keyword' => $keyword,
            'action' => '/open/all'
        );
        $this->_view('open/list', $data);
    }
    
    public function add(){
        $member_id = $this->input->get('member_id', TRUE);
        $member = $this->member_info_model->getRow($member_id);
        $data['member_id'] = $member_id;
        $data['member'] = $member;
        $this->_view('open/add', $data);
    }
    
    
    public function get_url(){
        $open_id = $this->input->get('open_id', TRUE);
        $url = $this->member_info_model->getOpenUrl($open_id);
        $this->renderSuccess(array('open_url'=>($url?$url['open_url']:"")));
    }
    
    
    public function do_add(){
        $member_id = $this->input->post('member_id', TRUE);
        $postWhere['open_id'] = $this->input->post('open_id', TRUE);
        $postWhere['open_number'] = $this->input->post('open_number', TRUE);
        $postWhere['open_url'] = $this->input->post('open_url', TRUE);
        $postWhere['open_remark'] = $this->input->post('open_remark', TRUE);
        $this->member_info_model->edit($member_id, $postWhere);
        $this->renderSuccess();
    }
    
}
