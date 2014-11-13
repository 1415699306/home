<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Resources
 * 资源助手类
 * @author martin
 */
class ResourcesHelper {
    
   /**
    * 删除内容不存在的图片
    * 
    * @param boolean $model;
    */        
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
          
    /**
      * 查找内容图片正则
      * @param $content type string
      * @return image array serialize
      */
     public static function getImageMatch($content)
     {
         $arr = array();
         preg_match_all('/([%+\*\w\/:\._-]+([\/resources\/]?)+(?:jpg|gif|bmp|jpeg|png))/ismU',$content, $arr);
         return $arr;
     }
             
    /**
     *对比删除文章内容不存在的图片
     * 
     * @param type $params $model
     */
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
}

