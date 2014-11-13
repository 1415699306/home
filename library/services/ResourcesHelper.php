<?php
class ResourcesHelper {
      
    public static function deleteContentImg($content)
    {            
       $arr = array();
       $return = false;
       if(!is_null($content))
       {               
           preg_match_all('/([%+\*\w\/:\._-]+[\/resources\/]?+(?:jpg|gif|bmp|jpeg|png))/ism',$content, $arr);    
           if(0 < count($arr[1]))
           {
                foreach($arr[1] as $key)
                {
                    if(is_file(WEB_PATH.$key))
                    {
                       if(unlink(WEB_PATH.$key)){
                           $return &= true;
                       }
                    }
                }
           }
       }
       return $return;
    }
          
     public static function getImageMatch($content)
     {
         $arr = array();
         preg_match_all('/([%+\*\w\/:\._-]+([\/resources\/]?)+(?:jpg|gif|bmp|jpeg|png))/ismD',$content, $arr);
         return $arr;
     }
             
     public static function updateContentFile($params,$old)
     {
         $oldFile = ResourcesHelper::getImageMatch($old);
         $newFile = ResourcesHelper::getImageMatch($params);
         $result = array_diff($oldFile[1],$newFile[1]);          
         if(0 < count($result))
         {
             foreach($result as $key)
             {
                 if(is_file(WEB_PATH.$key))
                 {                    
                     unlink(WEB_PATH.$key);
                 }                
             }
         }
     }
	 
	public static function setAllSource()
	{
		$script=Yii::app()->clientScript;
        $js_file = 'all.js';
        $script->scriptMap=array(
				'common.js'=>"/js/{$js_file}",
                'function.js'=>"/js/{$js_file}",
                'showMsg.js'=>"/js/{$js_file}",
                'jquery.wresize.js'=>"/js/{$js_file}",
			);
	}
}

