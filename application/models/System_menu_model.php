<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//+-------------------------------
//+ 系统菜单模型类文件:system_menu_model.php;
//+-------------------------------

class System_menu_model extends CI_Model {

    /**
    * 菜单变量
    */
    private $_menuList;

    /**
    * 菜单缓存名
    */
    private $_menuCacheName;

    /**
    * 定义数据库表名
    */
    private $_menuTable = SYSTEM_MENU;

    /**
    * 构造函数
    */
    public function __construct(){
        parent::__construct();
        $this->_menuTable = $this->db->dbprefix(SYSTEM_MENU);
        $this->load->driver('cache', array('adapter' => 'file'));
        $this->_menuCacheName = 'system_menu';
    }

    /**
     * 查询菜单
     */
    public function getList(){
        $this->_menuList = array();
        $parentMenus = $this->getMainMenu();
        $this->_setMenu($parentMenus);
        $this->_saveMenuCache();
        return $this->_menuList;
    }

    /**
    * 获取后台边栏导航
    */
    public function getSidebar(){
        $this->_menuList = $this->cache->get($this->_menuCacheName);
        if(empty($this->_menuList)){
            $this->getList();
        }
        return $this->_menuList;
    }

    /**
    * 生成后台菜单
    */
    private function _saveMenuCache(){
        $this->cache->delete($this->_menuCacheName);
        $this->cache->save($this->_menuCacheName, $this->_menuList, 86400);
    }

    /**
    * 设置菜单列表
    */
    private function _setMenu($menuArray){
        if(empty($menuArray) || !is_array($menuArray)) return false;
        foreach($menuArray AS $parentMenuKey => $parentMenuVal){
            $this->_menuList[] = $parentMenuVal;
            $childrenMenus = $this->getChildrenMenu($parentMenuVal['id']);
            if($childrenMenus === false) CONTINUE;
            $this->_setMenu($childrenMenus);
        }
    }

    /**
    * 查询一级菜单
    */
    public function getMainMenu(){
        $sql = "SELECT * FROM {$this->_menuTable} WHERE `status`=1 AND depth=1 ORDER BY `sort` ASC;";
        $result = $this->db->query($sql)->result_array();
        if(!$result){
            return false; 
        }
        return $result;
    }

    /**
    * 查询子菜单
    */
    public function getChildrenMenu($parent_id){
        $sql = "SELECT * FROM {$this->_menuTable} WHERE `status`=1 AND parent_id={$parent_id} ORDER BY `sort` ASC;";
        $result = $this->db->query($sql)->result_array();
        if(!$result){
            return false; 
        }
        return $result;
    }

    /**
    * 获取单条信息
    */
    public function getRow($menu_id){
        $sql = "SELECT * FROM {$this->_menuTable} WHERE id={$menu_id};";
        $result = $this->db->query($sql)->row_array();
        if(!$result){
            return false; 
        }
        return $result;
    }

    /**
    * 添加菜单
    */
    public function save($insertData){
        if(empty($insertData) || !is_array($insertData)) return false;
        $insertData['create_time'] = date('Y-m-d H:i:s');
        $insertData['create_id'] = $this->session->userdata('admin_id');
        $insertData['status'] = 1;
        $this->db->insert($this->_menuTable, $insertData);
        $lastInsertID = $this->db->insert_id();
        $this->_editPath($lastInsertID, $insertData['parent_id']);
        return $lastInsertID;
    }

    /**
    * 更新菜单
    */
    public function edit($menu_id, $upData){
        $menuInfo = $this->getRow($menu_id);
        $pathSql = "SELECT * FROM {$this->_menuTable} WHERE path LIKE '".$menuInfo['path']."_%';";
        $pathResult = $this->db->query($pathSql)->result_array();
        $where = array('id' => $menu_id);
        $upData['update_id'] = $this->session->userdata('admin_id');
        $upData['update_time'] = date('Y-m-d H:i:s');
        $upFlag = $this->db->update($this->_menuTable, $upData, $where);
        $this->_editPath($menu_id, $upData['parent_id']);
        foreach($pathResult AS $pathKey => $pathVal){
            $this->_editPath($pathVal['id'], $pathVal['parent_id']);
        }
        return $upFlag;
    }

    /**
    * 更新菜单路径
    */
    private function _editPath($menu_id, $parent_id){
        if($parent_id == 0){
            $updateData = array(
                            'path' => $menu_id,
                            'depth' => 1
                        );
        } else {
            $parentInfo = $this->getRow($parent_id);
            $updateData = array(
                            'path' => $parentInfo['path'] . '_' . $menu_id,
                            'depth' => $parentInfo['depth'] + 1
                        );
        }
        $where = array('id' => $menu_id);
        $this->db->update($this->_menuTable, $updateData, $where);
        return TRUE;
    }

    /**
    * 删除菜单
    */
    public function del($menu_id){
        $where = array('id' => $menu_id);
        $upData['update_id'] = $this->session->userdata('admin_id');
        $upData['update_time'] = date('Y-m-d H:i:s');
        $upData['status'] = 0;
        $upFlag = $this->db->update($this->_menuTable, $upData, $where);
        return $upFlag;
    }
}