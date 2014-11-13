<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UploadController
 *
 * @author martin
 */
class UploadController extends CController{
    
    public function filters()
    {
        return array(
        'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array(
            'allow',
            'actions'=>array('editor'),
            'users'=>array('@'),
            ),
        );
    }
       
    public function actionEditor()
    {
        $config = array(
            "fileType"=>array(".gif",".png",".jpg",".jpeg",".bmp"),
            "fileSize"=>2048
        );
        $oriName = htmlspecialchars($_POST['fileName'], ENT_QUOTES);
        $title = htmlspecialchars($_POST['pictitle'], ENT_QUOTES);
        $file = $_FILES["upfile"];
        $state = "SUCCESS";
        $fileName="";        
        $componet = Yii::createComponent('FileComponent');
        $componet->route = 'editor';
        $path = $componet->createRoute('images');
        $current_type = strtolower(strrchr($file["name"], '.'));
        if(!in_array($current_type, $config['fileType'])){
            $state = $current_type;
        }
        $file_size = 1024 * $config['fileSize'];
        if( $file["size"] > $file_size ){
            $state = "b";
        }
        if($state == "SUCCESS"){
            $tmp_file=$file["name"];
            $fileName = rand(1,10000).time().strrchr($tmp_file,'.');
            $result = move_uploaded_file($file["tmp_name"],$path['path'].$fileName);
            if(!$result){
                $state = "c";
            }else{
                $waterMask = Yii::createComponent('WaterMaskComponent',RESOURCE_PATH.'/editor/'.$path['folder'].$fileName);
                $waterMask->pos = 9;
                $waterMask->waterType = 1; //类型：0为文字水印、1为图片水印               
                $waterMask->output(); //输出水印图片文件覆盖到输入的图片文件 
            }
        } 
        Yii::app()->end("{'url':'".RESOURCE.'/editor/'.$path['folder'].$fileName."','title':'".$title."','original':'".$oriName."','state':'".$state."'}");
    }
    
    /**
     * 百度编辑器附件上传
     */
    public function actionFileUpload()
    {          
        $config = array(
            "fileType" => array( ".rar" , ".doc" , ".docx" , ".zip" , ".pdf" , ".txt" , ".swf", ".wmv" ) ,
            "fileSize" => 10
        );
        $state = "SUCCESS";
        $fileName = "";
        //$rootPath = RESOURCE_PATH.DIRECTORY_SEPARATOR.'editor';
        //if(!is_dir($rootPath))mkdir ($rootPath,0777);
        $componet = Yii::createComponent('FileComponent');
        $componet->route = 'editor';
        $path = $componet->createRoute('files');
        
        $clientFile = $_FILES[ "upfile" ];
        if(!isset($clientFile)){
            echo "{'state':'文件大小超出服务器配置！','url':'null','fileType':'null'}";
            exit;
        }
        $current_type = strtolower( strrchr( $clientFile[ "name" ] , '.' ) );
        if ( !in_array( $current_type , $config[ 'fileType' ] ) ) {
            $state = "不支持的文件类型！";
        }
        $file_size = 1024 * 1024 * $config[ 'fileSize' ];
        if ( $clientFile[ "size" ] > $file_size ) {
            $state = "文件大小超出限制！";
        }
        if ( $state == "SUCCESS" ) {
            $tmp_file = $clientFile[ "name" ];
            $fileName = rand( 1 , 10000 ) . time() . strrchr( $tmp_file , '.' );
            $result = move_uploaded_file( $clientFile[ "tmp_name" ] ,$path['path'].$fileName );
            if ( !$result ) {
                $state = "文件保存失败！";
            }
        }
        
        
        Yii::app()->end("{'state':'" . $state . "','url':'" .RESOURCE.'/editor/'.$path['folder'].$fileName . "','fileType':'" . $current_type . "'}");
    }
    
    /**
     * 百度编辑器图片转存
     */
    public function actionImageUp()
    {
        $config = array(
            "fileType"=>array(".gif",".png",".jpg",".jpeg",".bmp"),
            "fileSize"=>1000
        );
        $oriName = htmlspecialchars($_POST['fileName'], ENT_QUOTES);
        $title = htmlspecialchars($_POST['pictitle'], ENT_QUOTES);
        $file = $_FILES["upfile"];
        $state = "SUCCESS";
        $fileName="";
        //$rootPath = RESOURCE_PATH.DIRECTORY_SEPARATOR.'editor';
        //if(!is_dir($rootPath))mkdir ($rootPath,0777);
        $componet = Yii::createComponent('FileComponent');
        $componet->route = 'editor';
        $path = $componet->createRoute('files');
        $current_type = strtolower(strrchr($file["name"], '.'));
        if(!in_array($current_type, $config['fileType'])){
            $state = $current_type;
        }
        $file_size = 1024 * $config['fileSize'];
        if( $file["size"] > $file_size ){
            $state = "b";
        }
        if($state == "SUCCESS"){
            $tmp_file=$file["name"];
            $fileName = rand(1,10000).time().strrchr($tmp_file,'.');
            $result = move_uploaded_file($file["tmp_name"],$path['path'].$fileName);
            if(!$result){
                $state = "c";
            }else{
                $waterMask = Yii::createComponent('WaterMaskComponent',RESOURCE_PATH.'/editor/'.$path['folder'].$fileName);
                $waterMask->pos = 9;
                $waterMask->waterType = 1; //类型：0为文字水印、1为图片水印               
                $waterMask->output(); //输出水印图片文件覆盖到输入的图片文件 
            }
        }
        echo "{'url':'".RESOURCE.'/editor/'.$path['folder'].$fileName."','title':'".$title."','original':'".$oriName."','state':'".$state."'}";
    }
    
    /**
     * ajaxupload API
     * 
     * @param string $type 文件夹名称
     */
    public function actionAjaxUpload($type)
    {
        $type = (string)$type;
        /*是否使用二级目录*/
        $ext = (string)Yii::app()->request->getParam('ext',null);
        /*是否生成缩略图*/
        $themb = (string)Yii::app()->request->getParam('thumb',0);
        /*缩略图度*/
        $width = (int)Yii::app()->request->getParam('w',100);
        /*缩略图高度*/
        $height = (int)Yii::app()->request->getParam('h',100);
        Yii::import("ext.EAjaxUpload.qqFileUploader");
        if(!empty($ext)){
            $type .= DIRECTORY_SEPARATOR.$ext;
        }
        $folder=RESOURCE_PATH.DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR;
        $allowedExtensions = array("jpg","jpeg","gif",'png');
        $sizeLimit = 10 * 1024 * 1024;// maximum file size in bytes
        $uploader = new qqFileUploader($allowedExtensions, $sizeLimit);
        $result = $uploader->handleUpload($folder);
		if(!empty($result['error']))exit($result['error']);
        $source = RESOURCE_URL.DIRECTORY_SEPARATOR.$type.DIRECTORY_SEPARATOR.$result['filename'];
        $image = array('image'=>$source);
        $result = array_merge($result,$image);
        $return = htmlspecialchars(json_encode($result), ENT_NOQUOTES);
        if(!empty($result) && $themb == 1)
        {
            $info = pathinfo($result["filename"]);
            if(!empty($info) && !empty($info["extension"]))
            {
                $path = $folder.$info["filename"].'_thumb.'.$info["extension"];
                $thumb=Yii::app()->phpThumb->create($folder.$result["filename"]);
                $thumb->resize($width,$height);
                $thumb->save($path); 
            }
        }
        $fileSize=filesize($folder.$result['filename']);//GETTING FILE SIZE
        $fileName=$result['filename'];//GETTING FILE NAME
 
        Yii::app()->end($return);// it's array
    }
    
    /**
     * 删除文件API
     * 
     * @param boolean $route
     */
    public function actionDelete($route)
    {
        $return = false;
        if(is_file(WEB_PATH.$route))
        {
            try 
            {
                 if(unlink(WEB_PATH.$route)){
                    $return = true;                 
                 }
            }
            catch(Exception $e)
            {
                Yii::log($e,'info','system.backend.api');
                
            }
        }
        Yii::app()->end(CJSON::encode(array('success'=>$return,'code'=>'1')));
    }
    
    public function actionDeleteThumb()
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'非法操作');
        $name = Yii::app()->request->getParam('name');
        $folder = Yii::app()->request->getParam('folder');
        $ext = Yii::app()->request->getParam('ext');
        $app = Yii::app()->request->getParam('app',0);
        $res = Yii::app()->request->getParam('res',0);
        if(Storage::deleteImageBySize($folder,$name,$ext))
        {
            if(0 < $app && 0 < $res)
            {
                $model = Storage::model()->findByAttributes(array('app_id'=>$app,'res_id'=>$res,'track_id'=>$name));
                if(!is_null($model))$model->delete();
            }
            Yii::app()->end(CJSON::encode(array('success'=>true,'code'=>'1')));
        }
        else
            Yii::app()->end(CJSON::encode(array('success'=>false,'code'=>'-1')));
    }
    
    public function actionDeleteByStorge()
    {
        if(!Yii::app()->request->isAjaxRequest)throw new CHttpException(403,'非法操作');
            $pk = (int)Yii::app()->request->getParam('pk');
        Storage::model()->deleteByPk($pk);
    }
    
    
    public function actionSwfUpload($folder,$ext,$app=0,$res=0)
    {
        $filedata=$_FILES['Filedata'];
        $info = pathinfo($filedata['name']);
        if(empty($info['extension']) || empty($info['filename']))
            Yii::app ()->end(CJSON::encode(array('0'=>array('success'=>'0'))));
        $path = RESOURCE_PATH.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$ext;
        $url = HOME_URL.DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$ext;
        $filename = md5($info['filename'].microtime()).'.'.$info['extension'];
        if(move_uploaded_file($filedata['tmp_name'],$path.DIRECTORY_SEPARATOR.$filename))
        {
            if(0 < $app && 0 < $res)
            {
                $storage = new Storage();          
                $storage->app_id = $app;
                $storage->res_id = $res;
                $storage->track_id = $filename;
                $storage->extension = $info['extension'];
                $storage->save();
            }
            Yii::app ()->end(CJSON::encode(array('0'=>array('success'=>'1','path'=>$url.DIRECTORY_SEPARATOR.$filename,'filename'=>$filename))));
        }
        else
            Yii::app ()->end(CJSON::encode(array('0'=>array('success'=>'0'))));
    }
    
    public function actionSwfUploadReplace($folder,$ext,$app=0,$res=0)
    {
        $filedata=$_FILES['Filedata'];
        $info = pathinfo($filedata['name']);
        if(empty($info['extension']) || empty($info['filename']))
            Yii::app ()->end(CJSON::encode(array('0'=>array('success'=>'0'))));
        $path = RESOURCE_PATH.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$ext;
        $url = HOME_URL.DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.$folder.DIRECTORY_SEPARATOR.$ext;
        $filename = md5($info['filename'].microtime()).'.'.$info['extension'];
        if(move_uploaded_file($filedata['tmp_name'],$path.DIRECTORY_SEPARATOR.$filename))
        {
            if(0 < $app && 0 < $res)
            {
                $storage = Storage::model()->findByAttributes(array('res_id'=>$res,'app_id'=>$app));
                if(empty($storage))
                {
                    $storage = new Storage();
                }
                else
                {
                    Storage::deleteImageBySize('dream', $storage->track_id,'thumb');
                }
                $storage->app_id = $app;
                $storage->res_id = $res;
                $storage->track_id = $filename;
                $storage->extension = $info['extension'];
                $storage->save();
            }
            Yii::app ()->end(CJSON::encode(array('0'=>array('success'=>'1','path'=>$url.DIRECTORY_SEPARATOR.$filename,'filename'=>$filename))));
        }
        else
            Yii::app ()->end(CJSON::encode(array('0'=>array('success'=>'0'))));
    }
}

