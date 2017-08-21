<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//+-------------------------------
//+ 系统管理员登录模型类文件:System_login_model.php;
//+-------------------------------

class System_login_model extends CI_Model {

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
        $this->load->library('session');
    }

    /**
    * 获取管理员单条信息
    */
    public function login($admin_name, $password){
        $sql = "SELECT * FROM {$this->_adminTable} WHERE name='{$admin_name}' AND status=1;";
        $result = $this->db->query($sql)->row_array();
        if(!$result){
            //用户不存在
            return 0; 
        } else if ( md5($password.$result['salt'].'youjike') !== $result['pwd']) {
            //密码不正确
            return -1;
        }
        $session = array(
                   'admin_id'  => $result['id'],
                   'admin_name' => $result['name'],
                   'realname' => $result['realname'],
                   'role_id' => $result['role_id'],
                   'phone' => $result['phone']
                );
        $this->session->set_userdata($session);
        return 1;
    }
}