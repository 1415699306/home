<?php

/**
 * This is the model class for table "storage".
 *
 * The followings are the available columns in table 'storage':
 * @property string $id
 * @property string $app_id
 * @property string $res_id
 * @property string $group_id
 * @property string $track_id
 * @property string $ctime
 * @property string $mtime
 */
class Storage extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Storage the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'storage';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, res_id, track_id', 'required'),
			array('app_id, res_id, ctime, mtime', 'length', 'max'=>11),
			array('group_id', 'length', 'max'=>10),
			array('track_id', 'length', 'max'=>1024),
            array('extension', 'length', 'max'=>32),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, res_id, group_id, track_id, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'app_id' => 'App',
			'res_id' => 'Res',
			'group_id' => 'Group',
			'track_id' => 'Track',
			'ctime' => 'Ctime',
			'mtime' => 'Mtime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('res_id',$this->res_id,true);
		$criteria->compare('group_id',$this->group_id,true);
		$criteria->compare('track_id',$this->track_id,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave() {
        $time = time();
        if($this->isNewRecord){
            $this->ctime = $time;
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    /**
     * 定义存储应用ID
     * 
     * @param string $id
     * @return int $id
     */
    public static function getAppId($id)
    {
        $param = array(
            'article'=>'0',
            'investment'=>'1',
            'meet'=>'2',
            'eminent'=>'3',
        );       
        return array_key_exists($id, $param) ? $param[$id] : null;
    }
    
    /**
     * 文件URL拆分数组
     */
    public static function stringToArray($string)
    {          
        $matchesarray = array();
        preg_match_all('/^\/.*?\/.*?\/(.*?)\/(.*?)\/(.*?)\/(.*?)\.(.*?)/iU',$string, $matchesarray);
        return $matchesarray;
        
    }
    
    /**
     * 删除普通本地文件
     * 
     * @param string $path 删除文件路径
     * @param int $app_id
     * @param int $res_id
     * @param string $route
     * @param array $size this is a thumb by size 100X100....
     * @return boolean
     */    
    public static function deleteByFile($app_id,$res_id,$route,$size=array())
    {
        $return = false;
        $app_id = (int)$app_id;
        $res_id = (int)$res_id;
        if(is_file(WEB_PATH.$route) && !is_null($app_id) && 0 < $res_id)
        {
            try 
            {                 
                 if(unlink(WEB_PATH.$route))
                {
                     if(!empty($size))
                     {
                         $info = pathinfo($route);
                         if(!empty($info) && !empty($info['extension']))
                         {
                             foreach($size as $key)
                             {
                                 $filename = WEB_PATH.$info['filename'].'_'.$key.'.'.$info['extension'];
                                 if(is_file($filename))
                                     unlink ($filename);
                             }
                         }
                     }
                    $return = true;
                    self::model()->deleteAllByAttributes(array('app_id'=>$app_id,'res_id'=>$res_id));
                 }
            }
            catch(Exception $e)
            {
                Yii::log('user_id:'.Yii::app()->user->id.'用户删除了附件,ID:'.$this->id,'info','system.backend.storage');
            }
        }
        return $return;
    }
    
    /**
     * 保存单个文件入库
     * 
     * @param string $AppId 应用ID
     * @param int $resId 资源ID
     * @param string $tackId URL
     * @return boolean
     */
    public static function saveByStorage($AppId,$resId,$filename,$ext=null)
    {
        $AppId = (int)$AppId;
        $resId = (int)$resId;
        $tackId = (string)($filename);
        if(!is_null($AppId) && 0 <$resId && 0 < strlen($tackId))
        {
            $storage = Storage::model()->findByAttributes(array('res_id'=>$resId,'app_id'=>$AppId));
            if(empty($storage))
            {
                $storage = new Storage();
            }
            $storage->app_id = $AppId;
            $storage->res_id = $resId;
            $storage->track_id = $tackId;
            $storage->extension = self::getFileExt($filename);
            return $storage->save();
        }
        else
            return false;
    }
    
    /**
     * 多个文件入库
     */
    public static function saveByStorageAll($AppId,$resId,$filename)
    {
        $return = false;
        $AppId = (int)$AppId;
        $resId = (int)$resId;
        $tackId = (string)($filename);
        if(!is_null($AppId) && 0 <$resId && 0 < strlen($tackId))
        {          
            $storage = new Storage();
            $storage->app_id = $AppId;
            $storage->res_id = $resId;
            $storage->track_id = $tackId;
            $storage->extension = self::getFileExt($filename);
            $return = &$storage->save();
        }
        return $return;
    }
    /**
     * 生成缩略图
     * 
     * @staticvar array $name
     * @param string $folder
     * @param string $filename
     * @param array $size
     */
    public static function cutThumbs($folder,$filename,$size=array('100X100','200X200'))
    {
        $path = '';
        static $name = null;
        foreach($size as $key)
        {
            $size = explode('X',$key);
            if(count($size)==2)
            {
                $folders = WEB_PATH.$folder;
                if($name === null){
                    preg_match('/(.*?)\.(\w+)$/iU',$filename,$name);
                }
                if(count($name) < 1)continue;
                $path = $folders.$name[1].'_'.$key.'.'.$name[2];     
                $thumb=Yii::app()->phpThumb->create($folders.$filename);
                $thumb->resize($size[0],$size[1]);
                $thumb->save($path);    
            }
            else
                continue;
        }
    }
    
    /**
     * 生成比例缩略图 16：9，4：3，9：16
     */
    public static function cutThumbsOnly($params,$folder,$ext='')
    {
        $thumb = null;
        $name = array();
        $postName = array_keys($params);
        if(array_key_exists('YII_CSRF_TOKEN', array_flip($postName)))array_shift ($postName);
        $className = $postName[0];
        if(!empty($ext))$ext = DIRECTORY_SEPARATOR.$ext;
        $path = RESOURCE_PATH.DIRECTORY_SEPARATOR.$folder.$ext;
        if(isset($params[$className]['thumb']))$thumb = $params[$className]['thumb'];
        if(is_file($path.DIRECTORY_SEPARATOR.$thumb))
        {            
            Yii::import('ext.jcrop.EJCropper');
            $temp = pathinfo($params[$className]['thumb']);
            if(empty($temp))return;
            /*生成16：9*/
            if (!empty($params[$className]['big_w']) && !empty($params[$className]['big_h']))
            {                                    
                $copy_big = $path.DIRECTORY_SEPARATOR.$temp["filename"].'_16_9.'.$temp["extension"];
                if(copy($path.DIRECTORY_SEPARATOR.$thumb,$copy_big))
                {
                    $jcropper = new EJCropper();
                    $jcropper->thumbPath = $path;
                    $jcropper->jpeg_quality = 100;
                    $jcropper->png_compression = 10;
                    //$jcropper->targ_w = $params[$className]['big_w'];
                    //$jcropper->targ_h = $params[$className]['big_h'];
                    $jcropper->targ_w = 250;
                    $jcropper->targ_h = 140;
                    $coords = $jcropper->getCoordsFromPost($className,'big');
                    $jcropper->crop($copy_big, $coords);
                }                
            }
            /*生成4：3*/
            if (isset($params[$className]['min_w']) && isset($params[$className]['min_h']))
            {
                $copy_min = $path.DIRECTORY_SEPARATOR.$temp["filename"].'_4_3.'.$temp["extension"];
                if(copy($path.DIRECTORY_SEPARATOR.$thumb,$copy_min))
                {
                    $jcropper = new EJCropper();
                    $jcropper->thumbPath = $path;
                    $jcropper->jpeg_quality = 100;
                    $jcropper->png_compression = 10;
                    $jcropper->targ_w = 200;
                    $jcropper->targ_h = 160;
                    $coords = $jcropper->getCoordsFromPost($className,'min');
                    $jcropper->crop($copy_min, $coords);
                }
                
            }
            /*生成9：16*/
            if (isset($params[$className]['height_w']) && isset($params[$className]['height_h']))
            {                
                $copy_height = $path.DIRECTORY_SEPARATOR.$temp["filename"].'_9_16.'.$temp["extension"];
                if(copy($path.DIRECTORY_SEPARATOR.$thumb,$copy_height))
                {
                    $jcropper = new EJCropper();
                    $jcropper->thumbPath = $path;
                    $jcropper->jpeg_quality = 140;
                    $jcropper->png_compression = 250;
                    $jcropper->targ_w = $params[$className]['height_w'];
                    $jcropper->targ_h = $params[$className]['height_h'];
                    $coords = $jcropper->getCoordsFromPost($className,'height');
                    $jcropper->crop($copy_height, $coords);
                }               
            }
        }
    }
    
    /**
     * 获取比例缩略图
     * @param string $name 文件名称
     * @param string $folder 文件夹
     * @param string $size 尺寸 16:9,4:3,9:16
     */
    /*
    public static function getImageBySize($name,$folder,$size='16_9',$ext=null)
    {
        $arr = array();
        $ext = !empty($ext) ? DIRECTORY_SEPARATOR.$ext.DIRECTORY_SEPARATOR : DIRECTORY_SEPARATOR;
        preg_match('/(.*?)\.(\w+)$/iU',$name,$arr);
        if(2 < count($arr))
        {
            $path = RESOURCE_URL.DIRECTORY_SEPARATOR.$folder.$ext;
            return $path.$arr[1]."_{$size}.".$arr[2];
        }
        else
            return null;
    }*/
    public static function getImageBySize($name,$folder,$size=null,$ext=null)
    {
        $arr = array();
        $ext = !empty($ext) ? DIRECTORY_SEPARATOR.$ext.DIRECTORY_SEPARATOR : DIRECTORY_SEPARATOR;
        $path = HOME_URL.DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.$folder.$ext;
        $source = $path.$name;
        $info = pathinfo($name);
        if(!empty($info))
        {           
            if(!empty($size) && !empty($info["extension"]))
            {
                if(is_file(RESOURCE_PATH.DIRECTORY_SEPARATOR.$folder.$ext.$info["filename"]."_{$size}.".$info["extension"]))
                    return $path.$info["filename"]."_{$size}.".$info["extension"];
                else
                    return $source;
            }
            else
                return $source;
        }
        else
            return $source;
    }
    
    public static function deleteImageBySize($folder,$name,$ext=null)
    {
        $arr = array();
        $array = array('16_9','4_3','9_16');
        $ext = !empty($ext) ? DIRECTORY_SEPARATOR.$ext.DIRECTORY_SEPARATOR : DIRECTORY_SEPARATOR;
        $route = RESOURCE_PATH.DIRECTORY_SEPARATOR.$folder.$ext;
        $file = $route.$name;
        $info = pathinfo($name);
        if(is_file($file))
            unlink ($file);
        else
            return false;
        if(!empty($info) && !empty($info["extension"]))
        {
            foreach($array as $key)
            {
                $thumb = $route.$info["filename"]."_{$key}.".$info["extension"];
                $life =  $route.'life_'.$info["filename"].".".$info["extension"];
                if(is_file($thumb))unlink ($thumb);
                if(is_file($life))unlink ($life);
            }
        }
        return true;
    }
    
    /**
     * 等比生成单张图片
     * @param type $file
     */
    public static function cutThumbByOne($file,$path,$width=100,$height=100,$ext='16_9')
    {
        $info = pathinfo($file);
        if(!empty($info))
        {
            $route = RESOURCE_PATH.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.'thumb';
            if(is_file($route.DIRECTORY_SEPARATOR.$file))
            {
                $target = $route.DIRECTORY_SEPARATOR.$info["filename"]."_{$ext}.".$info["extension"];  
                Storage::resize($route.DIRECTORY_SEPARATOR.$file,$target,$width,$height);
            }
        }
    }


    public static function getFileExt($filename)
    {
        $info = pathinfo($filename);
        if(!empty($info) && !empty($info["extension"]))
            return $info["extension"];
        else
            return null;
    }
    
    /**
     * *
     *等比缩放
     * @param unknown_type $srcImage   源图片路径
     * @param unknown_type $toFile     目标图片路径
     * @param unknown_type $maxWidth   最大宽
     * @param unknown_type $maxHeight  最大高
     * @param unknown_type $imgQuality 图片质量
     * @return unknown
     */
    public static function resize($srcImage,$toFile,$maxWidth = 100,$maxHeight = 100,$imgQuality=100,$multiple=1.5)
    {

        list($width, $height, $type, $attr) = getimagesize($srcImage);
        if($width < $maxWidth  || $height < $maxHeight) return ;
        switch ($type) {
        case 1: $img = imagecreatefromgif($srcImage); break;
        case 2: $img = imagecreatefromjpeg($srcImage); break;
        case 3: $img = imagecreatefrompng($srcImage); break;
        }
        $scale = min($maxWidth/$width, $maxHeight/$height); //求出绽放比例

        if($scale < 1) {
        $newWidth = floor($scale*$width);
        $newHeight = floor($scale*$height*$multiple);
        $newImg = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        $newName = "";
        $toFile = preg_replace("/(.gif|.jpg|.jpeg|.png)/i","",$toFile);
        switch($type) {
            case 1: if(imagegif($newImg, "$toFile$newName.gif", $imgQuality))
            return "$newName.gif"; break;
            case 2: if(imagejpeg($newImg, "$toFile$newName.jpg", $imgQuality))
            return "$newName.jpg"; break;
            case 3: if(imagepng($newImg, "$toFile$newName.png", $imgQuality))
            return "$newName.png"; break;
            default: if(imagejpeg($newImg, "$toFile$newName.jpg", $imgQuality))
            return "$newName.jpg"; break;
        }
        imagedestroy($newImg);
        }
        imagedestroy($img);
        return false;
    }
    
    
    /**
     * 
     */
   
            
}