<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of uploadCreate
 *
 * @author martin
 */
class uploadCreate extends CAction{
    
    public function run() 
    {
        $avatar = Yii::app()->request->getParam('avatar',null);
        $uid = Yii::app()->user->id;
        $pic = UserProfile::model()->find("user_id={$uid}");
        if (!empty($avatar) && !empty($pic)) {
            $file = base64_decode($avatar);
            $type = $this->getImageMimeType($file);
            $setType = (!empty($type) ? $type : 'png');
            $filename = md5(uniqid());
            $source = ($filename.'.'.$setType);
            $path = RESOURCE_PATH.DIRECTORY_SEPARATOR.'temp'.DIRECTORY_SEPARATOR;
            $userFolder = RESOURCE_PATH.DIRECTORY_SEPARATOR.'user';
            if(!is_dir($path))mkdir($path,0777);
            if(!is_dir($userFolder))mkdir($userFolder,0777);
            $target = $path.$source;
            if(file_put_contents($target,$file)){        
                if(!empty($pic->avatar) && is_file(WEB_PATH.$pic->avatar) && $pic->avatar != '/images/user/avatar.gif'){                 
                    if(preg_match_all('/^\/.*?\/.*?\/(.*?)\/(.*?)\/(.*?)\/(.*?)\.(.*?)/iU',$pic->avatar, $matchesarray)){   
                        if(0 < count($matchesarray[1]) && 0 <count($matchesarray[2]) && 0 < count($matchesarray[3])){
                            $folder = DIRECTORY_SEPARATOR.$matchesarray[1][0].DIRECTORY_SEPARATOR.$matchesarray[2][0].DIRECTORY_SEPARATOR.$matchesarray[3][0];                           
                            $big = WEB_PATH.$route = $pic->avatar;                           
                            $small = RESOURCE_PATH.DIRECTORY_SEPARATOR.'user'.$folder.DIRECTORY_SEPARATOR.$matchesarray[4][0].'_small.'.$matchesarray[5][0];                       
                            $min = RESOURCE_PATH.DIRECTORY_SEPARATOR.'user'.$folder.DIRECTORY_SEPARATOR.$matchesarray[4][0].'_min.'.$matchesarray[5][0];
                        }
                    }
                }else{
                                                    
					//$folder= upfile::setRoute('user',Yii::app()->user->id);
                    $component = Yii::createComponent('FileComponent');
                    $component->route = 'user';
                    $folder = $component->createRoute('avatar');
					$big = $folder.$filename.'.'.$setType;
					$route = DIRECTORY_SEPARATOR.$big;
					$small = $folder.$filename.'_small.'.$setType;
					$min = $folder.$filename.'_min.'.$setType;	
				}			
                $thumb=Yii::app()->phpThumb->create($target);
                $thumb->resize(100,100);
                $thumb->save($big);
                $thumb->resize(50,50);
                $thumb->save($small);
                $thumb->resize(25,25);
                $thumb->save($min);
                $pic->avatar = $route;
                if($pic->validate() && $pic->save()){
                    Yii::app()->end(CJSON::encode(array('success'=>'1')));
				}  else {
                    var_dump($pic->errors);
                }
            }
            if(is_file($target))unlink($target);
        }
    }
    
    public function getBytesFromHexString($hexdata)
    {
      for($count = 0; $count < strlen($hexdata); $count+=2)
        $bytes[] = chr(hexdec(substr($hexdata, $count, 2)));

      return implode($bytes);
    }

    public function getImageMimeType($imagedata)
    {
      $imagemimetypes = array( 
        "jpeg" => "FFD8", 
        "png" => "89504E470D0A1A0A", 
        "gif" => "474946",
        "bmp" => "424D", 
        "tiff" => "4949",
        "tiff" => "4D4D"
      );

      foreach ($imagemimetypes as $mime => $hexbytes)
      {
        $bytes = $this->getBytesFromHexString($hexbytes);
        if (substr($imagedata, 0, strlen($bytes)) == $bytes)
          return $mime;
      }
      return NULL;
    }
}
