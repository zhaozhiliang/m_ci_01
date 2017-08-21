<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH.'third_party/ALIOSS/autoload.php';
use OSS\OssClient;
use OSS\Core\OssException;
//+-------------------------------
//+ 阿里云OSS模型类文件:Alioss_model.php;
//+-------------------------------

class Alioss_model extends CI_Model {

	/**
	* OSS Access ID
	*/
	private $_ossAccessID = 'LTAIiGwrsKyJwKr6';
    
	/**
	* OSS Access Key
	*/
	private $_ossAccessKey = 'lg4rm7ZhT14UPUrksITo3aobTWJxhV';
    
	/**
	* OSS Request Host
	*/
	private $_endPoint = 'http://oss-cn-beijing.aliyuncs.com';
	/**
	* buket
	*/
	public $bucket = 'yi-play';//yi-play
    
    /**
     * 构造函数
     */
    public function __construct(){
        parent::__construct();
    }

    /**
    * 获取阿里OSS操作对象
    */
    public function get_oss_client(){
    	try {
		    $oss_client = new OssClient($this->_ossAccessID, $this->_ossAccessKey, $this->_endPoint);
		} catch (OssException $e) {
		    print $e->getMessage();
		}
		return $oss_client;
    }

    function uploadFile($FILES,$name='',$dir='head')
    {
        $ossClient = $this->get_oss_client();

        $name_arr = explode('.',$FILES['name']);
        $ext = array_pop($name_arr);

        if(empty($name)){
            $new_name = uniqid().rand(100000, 999999).".$ext";
        }else{
            $new_name = $name;
        }
        $object = "yiqi/{$dir}/".date('Y-m-d')."/$new_name";

        try{
            $ossClient->uploadFile($this->bucket, $object, $FILES['tmp_name']);
        } catch(OssException $e) {
            return array('status'=>false,'msg'=>$e->getMessage());
        }

        return array('status'=>true, 'db_path'=>"/".$object);
    }


    function resize($object){
        $ossClient = $this->get_oss_client();
        // 图片缩放
        $options = array(
            OssClient::OSS_FILE_DOWNLOAD => '123.jpg',
            OssClient::OSS_PROCESS => "image/resize,m_fixed,h_100,w_100" );
        $ossClient->getObject($this->bucket, $object, $options);
    }

}