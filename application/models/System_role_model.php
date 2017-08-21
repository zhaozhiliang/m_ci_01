<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//+-------------------------------
//+ 系统角色模型类文件:System_role_model.php;
//+-------------------------------

class System_role_model extends CI_Model {

    /**
    * 定义数据库表名
    */
    private $_roleTable;

    /**
    * 构造函数
    */
    public function __construct(){
        parent::__construct();
        $this->_roleTable = $this->db->dbprefix(SYSTEM_ROLE);
        $this->load->driver('cache', array('adapter' => 'file'));
    }

    /**
    * 查询角色列表
    */
    public function getList(){
        $sql = "SELECT * FROM {$this->_roleTable} WHERE `status`=1;";
        $result = $this->db->query($sql)->result_array();
        if(!$result){
            return false; 
        }
        return $result;
    }

    /**
    * 获取单条信息
    */
    public function getRow($role_id){
        $sql = "SELECT * FROM {$this->_roleTable} WHERE id={$role_id};";
        $result = $this->db->query($sql)->row_array();
        if(!$result){
            return false; 
        }
        return $result;
    }

    /**
    * 添加角色
    */
    public function save($insertData){
        if(empty($insertData) || !is_array($insertData)) return false;
        $insertData['create_time'] = date('Y-m-d H:i:s');
        $insertData['create_id'] = $this->session->userdata('admin_id');
        $insertData['status'] = 1;
        $this->db->insert($this->_roleTable, $insertData);
        $lastInsertID = $this->db->insert_id();
        $this->cache->clean();
        return $lastInsertID;
    }

    /**
    * 更新角色
    */
    public function edit($role_id, $upData){
        $where = array('id' => $role_id);
        $upData['update_id'] = $this->session->userdata('admin_id');
        $upData['update_time'] = date('Y-m-d H:i:s');
        $upFlag = $this->db->update($this->_roleTable, $upData, $where);
        $this->cache->clean();
        return $upFlag;
    }
}