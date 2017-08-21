<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends MY_Controller {

	/**
	 * 管理员操作
	 */
	public function __construct(){
		parent::__construct();
		$this->load->model('activity_model');
	}

    public function index(){
        $this->activityList();
    }

	/**
	 * 活动列表
	 */
	public function activityList(){
		$getName = $this->input->get('title', TRUE);
		$where = array();
		if(!empty($getName)){
			$where['title'] = $getName;
		}
		//分页处理
		$getPn = $this->input->get('pn', TRUE);
		$page = (intval($getPn) < 1) ? 1 : intval($getPn);
		$limit = 10;
		$offset = ($page - 1) * $limit;
		$adminResult = $this->activity_model->getList($where, $offset, $limit);
		$Paging = $this->_paging($adminResult['cnt'], $limit, 5, $page, 'admin');

		$data = array(
					'list' => $adminResult['list'],
					'Paging' => $Paging,
					'page' => $page,
					'getName' => $getName,
                    'select'=> $this->input->get()
				);
		$this->_view('activity/list', $data);
	}

	/**
	 * 添加活动
	 */
	public function add(){
        $data = array();
		$this->_view('activity/add', $data);
	}

	/**
	* 添加操作
	*/
	public function do_add(){
		if(count($_POST) > 0){
            $info = array();
			$info['title'] = $this->input->post('title', TRUE);
			$info['img'] = $this->input->post('game_img', TRUE);
			$info['content'] = $this->input->post('content', TRUE);
			$info['end_time'] = $this->input->post('end_time', TRUE);
            $info['add_time'] = date('Y-m-d H:i:s');
            $res = $this->activity_model->insert($info);
            if($res){
                echo json_encode(array('status'=>1,'msg'=>'成功')); exit;
            }else{
                echo json_encode(array('status'=>-2,'msg'=>'失败'));exit;
            }

		}
	}

	/**
	 * 编辑管理员
	 */
	public function edit(){
		$id = (int) $this->input->get('id', TRUE);
		$res = $this->activity_model->getRow($id);
		if(empty($res)){
			redirect('/activity/activityList');
		}

		$data = array(
					'info' => $res
				);
		$this->_view('activity/edit', $data);
	}

	/**
	* 编辑操作
	*/
	public function do_edit(){
		if(count($_POST) > 0){
            $info = array();
            $info['title'] = $this->input->post('title', TRUE);
            $info['img'] = $this->input->post('game_img', TRUE);
            $info['content'] = $this->input->post('content', TRUE);
            $info['end_time'] = $this->input->post('end_time', TRUE);
            $id = $this->input->post('id',true);
            $res = $this->activity_model->update($info,array('id'=>$id));
            if($res){
                echo json_encode(array('status'=>1,'msg'=>'成功')); exit;
            }else{
                echo json_encode(array('status'=>-2,'msg'=>'失败'));exit;
            }

		}

	}

    /**
     * 删除操作
     */
    public function do_del(){
        $id = $this->input->get('id', TRUE);
        if(intval($id) > 0){
            $editData = array('status' => 1);
            $res = $this->activity_model->update($editData,array('id'=>$id));
            if($res){
                echo json_encode(array('status'=>1,'msg'=>'操作成功'));exit;
            }else{
                echo json_encode(array('status'=>-2,'msg'=>'失败'));exit;
            }
        }
        echo json_encode(array('status'=>-1,'msg'=>'参数错误'));exit;
    }

}