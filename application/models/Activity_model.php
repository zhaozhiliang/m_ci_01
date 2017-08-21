<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//+-------------------------------
//+ 系统角色模型类文件:System_role_model.php;
//+-------------------------------

class Activity_model extends CI_Model {

    /**
    * 定义数据库表名
    */
    private $_activityTable;

    /**
    * 构造函数
    */
    public function __construct(){
        parent::__construct();
        $this->_activityTable = $this->db->dbprefix(ACTIVITY);
    }

    /**
    * 查询列表
    */
    public function getList($getWhere,$offset,$num){
        $field = " * ";
        $where = "where `status`=0 ";
        $orderBy = " order by id desc ";

        if(is_array($getWhere) && !empty($getWhere)){
            foreach($getWhere AS $key => $val){
                if($key == 'order'){
                    $orderBy = $getWhere["order"];
                }else if($key == 'title'){
                    $where .= " AND title like '%{$val}%'";
                } else if($key != 'page' && $key != 'limit') {
                    $where .= " AND `" . $key . "`='" . $val . "'";
                }
            }
        }

        $result = array();
        $sql = "SELECT {$field} FROM {$this->_activityTable} {$where} {$orderBy} LIMIT {$offset}, {$num} ";
        $query = $this->db->query($sql);

        $_list = $query->result_array();

        $result['list'] = $_list;
        $cntQuery = $this->db->query("SELECT COUNT(*) AS cnt FROM {$this->_activityTable} {$where};");
        $cntRow = $cntQuery->row_array();
        $result['cnt'] = $cntRow['cnt'];
        return $result;
    }

    /**
    * 获取单条信息
    */
    public function getRow($id){
        $sql = "SELECT * FROM {$this->_activityTable} WHERE id={$id};";
        $result = $this->db->query($sql)->row_array();
        if(!$result){
            return false; 
        }
        return $result;
    }

    /**
    * 添加活动
    */
    public function insert($insertData){
        if(empty($insertData) || !is_array($insertData)) return false;

        $this->db->insert($this->_activityTable, $insertData);
        $lastInsertID = $this->db->insert_id();
        return $lastInsertID;
    }

    /**
    * 更新活动
    */
    public function update( $upData,$where){
        if(empty($where)){
            return false;
        }
        $upFlag = $this->db->update($this->_activityTable, $upData, $where);
        return $upFlag;
    }
}