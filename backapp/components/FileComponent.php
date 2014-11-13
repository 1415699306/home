<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 * 文件上传下载删除组件
 * 
 * controller 上传fastDFS调用示例
 * $component = Yii::createComponent('FileComponent'); //调用组件类
 * $component->tempName = $file->url->tempName;        //设置临时文件名
 * $component->fileName =  $file->url->name;           //设置上传文件名
 * $res = $component->upload();                        //执行上传,成功返回数组,否则返回空数组
 */

/**
 * Description of FileComponent
 *
 * @author martin 
 * @copyright 2013 
 * @version 1.0
 */
class FileComponent extends CComponent{
    
    /**
     * 上传文件模式 
     * @param true = 普通上传 , false = fastDFS
     * @var boolean
     */
    public $mode = true;
    
    /**
     * 临时文件名
     * @var string
     */
    public $temp_name;
    
    /**
     * 文件名称
     * @var string
     */
    public $file_name;   
    
    /**
     * 普通文件上传目录
     * 
     * @var string
     */
    public $route;
    
   /**
    * 文件扩展名
    * 
    * @var string
    */
    public $extName;
    
    /**
     * fastDFS group参数,下载或删除时要设置
     * 
     * @var string
     */
    public $group;
    
    /**
     * 普通上传主目录
     */
    const ATTACHMENT = 'resources';
    
    /**
     * 允许上传的目录
     * 
     * @var array
     */
    private $_routeAllow = array();

    
    public function __construct()
    {
        $this->_routeAllow = Yii::app()->params['routeAllow'];
    }
    
    /**
     * 设置mode
     * 
     * @param boolean $mode 
     */
    public function setMode($mode)
    {
        $mode = (boolean)$mode;
        $this->mode = $mode;
    }
    
    /**
     * 设置临时文件名
     * 
     * @param type $name 
     */
    public function setTempName($name)
    {
        $this->temp_name = (string)$name;
    }
    
    /**
     * 设置$_FILE文件名
     * 
     * @param type $name 
     */
    public function setFileName($name)
    {
        $this->file_name = (string)$name;
    }
    
    /**
     * 设置普通文件上传目录
     * 
     * @param string $name 
     */   
    public function setRoute($route)
    {
        $this->route = (string)$route;
    }
    
    /**
     * 设置扩展名
     * 
     * @param string $extname 
     */
    public function setExtName($extname)
    {
        $this->extName = (string)$extname;
    }
    
    /**
     * 设置fastDFS文件的group参数
     * 
     * @param string $extname 
     */
    public function setGroup($group)
    {
        $this->group = $group;
    }
    
    /**
     * 上传文件
     * 
     * @return array [$mode = false group_name,group_id],[$mode = true file_path,file_name]
     */
    public function upload($ext = null)
    {     
        if(empty($this->temp_name) || empty($this->file_name))throw new CHttpException(403,'params error');
        $return = array();
        if($this->mode == false)
            $return = $this->_fastFDS();
        else
            $return = $this->_jestUpLoad($ext);
        return $return;
    }
       
    /**
     * 下载文件
     * 
     * @return stream 
     */
    public function download()
    {
        if($this->mode == false)
            $this->_jsetDownLoad();
        else
            $this->_downloadFastDFS();
    }
    
    /**
     * 下载普通文件流
     * 
     * @return file_strem 
     */
    private function _jsetDownLoad()
    {
        if(is_file($this->route))
            return file_get_contents($this->route);
        else
            return null;
                
    }
    
    /**
     * 下载fastDFS文件
     * 
     * @return file_strem
     */
    private function _downloadFastDFS()
    {
        $this->_checkExtension();
        if(!is_null($this->group) && !is_null($this->route))
            return fastdfs_storage_download_file_to_buff($this->group, $this->route);
        else
            return null;
    }
    
    /**
     * 删除fastDFS文件
     * 
     * @return boolean
     */
    public function deleteByDFS()
    {
        $this->_checkExtension();
        if(is_null($this->group) || is_null($this->route))return false;
        return fastdfs_storage_delete_file($this->group,$this->route);
    }

    /**
     * 一般上传方法
     * 
     * @return array file_path,file_name
     */
    private function _jestUpLoad($ext)
    {
        $path = $this->createRoute($ext);
        if(is_null($this->extName))throw new CHttpException(403,"扩展名有误");
        $fileName = md5(time().$this->extName).'.'.$this->extName;
        try
        {
            if(move_uploaded_file($this->temp_name,$path['path'].$fileName))
            return array('file_path'=>HOME_URL.DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.$this->route.DIRECTORY_SEPARATOR.$path['folder'],'file_name'=>$fileName);
        }
        catch (Exception $e)
        {
            Yii::log($e,'info','system.backend.fileComponenet');
            throw new CHttpException(403,$e);
        }
    }   

    /**
     * fastDFS上传模式
     * 
     * @return array 
     */
    private function _fastFDS()
    {
        $this->_checkExtension();
        $return = array();
        try
        {
            $tracker = fastdfs_tracker_get_connection();
            $server = fastdfs_connect_server($tracker['ip_addr'], $tracker['port']); 
            $storage = fastdfs_tracker_query_storage_store();    
            $file_tmp = $this->temp_name;
            $real_name = $this->file_name;
            $file_name = dirname($file_tmp).DIRECTORY_SEPARATOR.$real_name;
            if(rename($file_tmp, $file_name))
                $return = fastdfs_storage_upload_by_filename($file_name, null, array(), null, $tracker, $storage);
            return $return;
        }  
        catch (Exception $e)
        {
            Yii::log($e,'info','system.backend.fileComponenet');
            throw new CHttpException(403,$e);
        }
    }
    
    /**
     * 检查fastDFS扩展
     * 如果扩展不存在使用fastDFS时直接返回false给调用者
     * 
     * @return boolean
     */
    private function _checkExtension()
    {
        if(!get_loaded_extensions('fastdfs_client'))throw new CHttpException(403,'Extension is Null');
    }
    
    /**
     * 生成目录路径
     * 
     * @return string 主路径
     */
    public function createRoute($ext = null)
    {
        $route = '';
        if(is_null($this->route) || is_Bool(array_search($this->route,$this->_routeAllow)))throw new CHttpException(403,'上传未授权!');
        $year=date('Y');$month=date('m');       
        $root_path = WWW_PATH.DIRECTORY_SEPARATOR.self::ATTACHMENT;
        if(!is_dir($root_path))mkdir($root_path,0777);
        $folder = self::ATTACHMENT.DIRECTORY_SEPARATOR.$this->route;
        if($ext == null)
        {
            $path = WWW_PATH.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$year.DIRECTORY_SEPARATOR.$month.DIRECTORY_SEPARATOR;
            $route = $year.DIRECTORY_SEPARATOR.$month.DIRECTORY_SEPARATOR;
        }
        else
        {
            $path = WWW_PATH.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$ext.DIRECTORY_SEPARATOR.$year.DIRECTORY_SEPARATOR.$month.DIRECTORY_SEPARATOR;
            $route = $ext.DIRECTORY_SEPARATOR.$year.DIRECTORY_SEPARATOR.$month.DIRECTORY_SEPARATOR;
        }
        //如果目录不存在就创建目录 
        try 
        {
            if(!is_dir(WWW_PATH.DIRECTORY_SEPARATOR.$folder)){
                 mkdir(WWW_PATH.DIRECTORY_SEPARATOR.$folder,0777);    
            }
            if(!is_null($ext)){
                $folder = WWW_PATH.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$ext;
                if(!is_dir($folder)){
                    mkdir($folder,0777);    
                }                
            }
            if(!is_dir($folder.DIRECTORY_SEPARATOR.$year)){ 
                mkdir($folder.DIRECTORY_SEPARATOR.$year,0777);                
            }                 
            if(!is_dir($path)){ 
                mkdir($path,0777);                    
            }
            return array('path'=>$path,'folder'=>$route);
        }
        catch (Exception $e)
        {
            Yii::log($e,'info','system.backend.fileComponenet');
            throw new CHttpException(403,$e);
        }
    }
}