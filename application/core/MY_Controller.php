<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

  /**
  * 管理员权限
  */
  private $_leftCacheName;

  /**
  * 请求controller
  */
  protected $_requestController;

  /**
  * 请求method
  */
  protected $_requestMethod;


  /**
  * 构造函数
  */
	public function __construct(){
            parent::__construct();
            $this->_requestController = $this->router->fetch_class();
            $this->_requestMethod = $this->router->fetch_method();
            $this->_checkLogin();
            $this->load->driver('cache', array('adapter' => 'file'));
            $this->_leftCacheName = 'left_sidebar_' . $this->session->userdata('admin_id');
	}

  /**
  * 校验登录
  */
  private function _checkLogin(){
    if (!$this->_is_ignored() && !$this->session->userdata('admin_id')){
        redirect(base_url() . 'welcome/login');
    }
    $this->_adminAuth();
  }

  /**
  * 登录忽略链接
  */
  private function _is_ignored(){
    $requestUrl = $this->_requestController . '/' . $this->_requestMethod;
    $ignoreArray = array(
                  'welcome/login',
                  'welcome/do_login'
              );
    if(in_array($requestUrl, $ignoreArray)){
      return true;
    }
    return false;
  }

  /**
  * 边栏导航
  */
  private function _leftMenu(){
    $leftMenuList = $this->cache->get($this->_leftCacheName);
    if(empty($leftMenuList)){
        $leftMenuList = $this->_adminAuth();
    }
    $requestUrl = $this->_requestController . '/' . $this->_requestMethod;
    $result = array();
    $adminAllow = array();
	$activeFlag = false;
	$activeIndex_0 = $activeIndex_1 = 0;
    foreach($leftMenuList AS $key => $val){
      $adminAllow[] = $val['requestPath'];
      $exPath = explode('_', $val['path']);
      if($val['depth'] == 3) {
        $result[$exPath[0]]['list'][$exPath[1]]['list'][] = $val;
      } else if($val['depth'] == 2) {
        $val['is_active'] = 0;
        $result[$exPath[0]]['list'][$exPath[1]] = $val;
      } else {
        $val['left_open'] = 0;
        $result[$exPath[0]] = $val;
      }
      if($val['controller'] == $this->_requestController){
		$activeIndex_0 = $exPath[0];
		if(isset($exPath[1]) && $activeIndex_1 == 0) $activeIndex_1 = $exPath[1];
        $result[$exPath[0]]['left_open'] = 1;
		if(isset($result[$exPath[0]]['list']) && $result[$exPath[0]]['list'][$exPath[1]]['requestPath'] == $requestUrl){
          $result[$exPath[0]]['list'][$exPath[1]]['is_active'] = 1;
		  $activeFlag = true;
        }
      }
    }
	if(!$activeFlag && $activeIndex_1 > 0){
		$result[$activeIndex_0]['list'][$activeIndex_1]['is_active'] = 1;
	}
	//访问权限判断
    $configAllAuth = array();
    $menuList = $this->system_menu_model->getSidebar();
    foreach($menuList AS $menuKey => $menuVal){
      $configAllAuth[] = $menuVal['controller'] . '/' . $menuVal['action'];
    }
    if(in_array($requestUrl, $configAllAuth) && !in_array($requestUrl, $adminAllow)){
      show_405();
    }
    return $result;
  }

  /**
  * 用户权限
  */
  private function _adminAuth(){
    $this->load->model('system_role_model');
    $this->load->model('system_menu_model');
    //角色
    $roleList = $this->system_role_model->getList();
    $isSuper = false;
    $adminRoleAuth = array();
    $adminRole = explode(',', $this->session->userdata('role_id'));
    foreach($roleList AS $roleKey => $roleVal){
      if(in_array($roleVal['id'], $adminRole)){
        if($roleVal['is_super'] == 1) $isSuper = true;
        $roleMenuIds = explode(',', $roleVal['authorization']);
        $adminRoleAuth = array_merge($adminRoleAuth, $roleMenuIds);
      }
    }
    //权限
    $adminAuthor = array();
    $menuList = $this->system_menu_model->getSidebar();
    foreach($menuList AS $menuKey => $menuVal){
      $menuVal['requestPath'] = $menuVal['controller'] . '/' . $menuVal['action'];
      if($isSuper){
        $adminAuthor[] = $menuVal;
      } else if(in_array($menuVal['id'], $adminRoleAuth)) {
        $adminAuthor[] = $menuVal;
      }
    }
    $this->cache->save($this->_leftCacheName, $adminAuthor, 86400);
    return $adminAuthor;
  }

	/**
	* 请求成功, 返回JSON串
	*/
  protected function renderSuccess($result = array()) {
    header('application/json;charset="UTF-8"');
    $result['callbackCode'] = 1;
    if(!isset($result['callbackMsg']) || empty($result['callbackMsg'])){
      $result['callbackMsg'] = '执行成功';
    }
     
    echo json_encode($result);
    exit();
  }

  /**
  * 请求失败, 返回JSON串
  */
  protected function renderFaild($result = array()) {
    header('application/json;charset="UTF-8"');
    $result['callbackCode'] = 0;
    if(!isset($result['callbackMsg']) || empty($result['callbackMsg'])){
      $result['callbackMsg'] = '执行失败';
    }
    echo json_encode($result);
    exit();
  }

    /**
  * 列表分页
  */
  protected function _paging($total, $scale, $pagescale, $pn, $params)
  {
    $pn = ($pn < 1) ? 1 : $pn;
    $cutpage_num = (int)ceil($total/$scale);
    $se = (int)floor($pagescale/2);
    $start_num = $pn - $se;
    if($start_num < 1) $start_num = 1;
    $end_num = $start_num + $pagescale - 1;
    if($end_num > $cutpage_num) {
      $end_num = $cutpage_num;
      $start_num = $cutpage_num - $pagescale + 1;
    } else if($end_num < $pagescale) {
      $start_num = 1;
    }
    if($start_num < 1) $start_num = 1;
    $left_img = $cutvars = $right_img = '';
    unset($_GET['pn']);
    $suffix = http_build_query($_GET);
    $suffix = (empty($suffix)) ? '' : '&' . $suffix;
    if($pn > 1) {
      $prev_num = $pn - 1;
      $left_img .= '<li><a href="' . base_url() . $params . '?pn=1' . $suffix . '">第一页</a></li>';
      $left_img .= '<li><a href="' . base_url() . $params . '?pn=' . $prev_num . $suffix . '">上一页</a></li>';
    } else {
      $left_img .= '<li class="disabled"><a href="javascript:;">第一页</a></li>';
      $left_img .= '<li class="disabled"><a href="javascript:;">上一页</a></li>';
    }
    for($i=$start_num;$i<=$end_num;$i++) {
      if ($i == $pn) {
        $cutnum = '<li class="disabled"><a href="javascript:;">' . $i . '</a></li>';
      } else {
        $cutnum = '<li><a href="' . base_url() . $params . '?pn=' . $i . $suffix . '">' . $i . '</a></li>';
      }
      $cutvars .= $cutnum;
    }
    if($pn < $cutpage_num) {
      $next_num = $pn + 1;
      $right_img = '<li><a href="' . base_url() . $params . '?pn=' . $next_num . $suffix . '">下一页</a></li>';
      $right_img .= '<li><a href="' . base_url() . $params . '?pn=' . $cutpage_num . $suffix . '">最末页</a></li>';
    } else {
      $right_img = '<li class="disabled"><a href="javascript:;">下一页</a></li>';
      $right_img .= '<li class="disabled"><a href="javascript:;">最末页</a></li>';
    }
    $paging = array('<li class="disabled"><a href="javascript:;">共计'.$total.'个</a></li>'.$left_img,$cutvars,$right_img);
    return $paging;
  }

  /**
  * 重写view
  */
  protected function _view($viewFile, $vars = array(), $return = FALSE){
    $leftVar = array(
                  'leftMenu' => $this->_leftMenu()
              );
    $vars = array_merge($leftVar, $vars);
    $this->load->view($viewFile, $vars , $return);
  }
}