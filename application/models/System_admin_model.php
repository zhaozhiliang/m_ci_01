<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//+-------------------------------
//+ 系统管理员模型类文件:System_admin_model.php;
//+-------------------------------

class System_admin_model extends CI_Model {

    /**
    * 定义数据库表名
    */
    private $_adminTable = SYSTEM_ADMIN;

    /**
    * 构造函数
    */
    public function __construct(){
        parent::__construct();
        $this->_adminTable = $this->db->dbprefix(SYSTEM_ADMIN);
    }

    /**
    * 查询管理员列表
    */
    public function getList($postWhere, $offset=0, $limit=10){
        $where = "WHERE `status`='1'";
        if(is_array($postWhere) && !empty($postWhere)){
            foreach($postWhere AS $key => $val){
                if($key == 'name'){
                    $where .= " AND `" . $key . "` LIKE '%" . $val . "%'";
                } else {
                    $where .= " AND `" . $key . "`='" . $val . "'";
                }
            }
        }
        $list = array();
        $sql = "SELECT * FROM {$this->_adminTable} {$where} LIMIT {$offset}, {$limit};";
        $list = $this->db->query($sql)->result_array();
        $cntSql = "SELECT COUNT(*) AS cnt FROM {$this->_adminTable} {$where}";
        $cntRow = $this->db->query($cntSql)->row_array();
        $result = array(
                    'list' => $list,
                    'cnt' => $cntRow['cnt']
                );
        return $result;
    }

    /**
    * 获取管理员单条信息
    */
    public function getRow($admin_id){
        $sql = "SELECT * FROM {$this->_adminTable} WHERE id={$admin_id};";
        $result = $this->db->query($sql)->row_array();
        if(!$result){
            return false; 
        }
        return $result;
    }

    /**
    * 用户名是否被占用
    */
    public function isExists($accountName){
        $sql = "SELECT * FROM {$this->_adminTable} WHERE name='{$accountName}';";
        $result = $this->db->query($sql)->row_array();
        if(!$result){
            return true; 
        }
        return false;
    }

    /**
    * 添加管理员
    */
    public function save($insertData){
        if(empty($insertData) || !is_array($insertData)) return false;
        $insertData['create_time'] = date('Y-m-d H:i:s');
        $insertData['create_id'] = $this->session->userdata('admin_id');
        $insertData['status'] = 1;
        $this->db->insert($this->_adminTable, $insertData);
        $lastInsertID = $this->db->insert_id();
        return $lastInsertID;
    }

    /**
    * 更新管理员
    */
    public function edit($role_id, $upData){
        $where = array('id' => $role_id);
        $upData['update_id'] = $this->session->userdata('admin_id');
        $upData['update_time'] = date('Y-m-d H:i:s');
        $upFlag = $this->db->update($this->_adminTable, $upData, $where);
        return $upFlag;
    }
}