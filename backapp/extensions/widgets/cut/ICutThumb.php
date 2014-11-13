<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ICutThumb
 *
 * @author martin
 */
class ICutThumb extends CInputWidget{
    
    public $model;
    public $folder;
    public $ext;
    public $thumb;
    public $app_id;
    private $_script;
    private $_html;
    public function init() 
    {   
        $this->_script = Yii::app()->getClientScript();
        $this->_registerScript();        
    }
    
    private function _show()
    {
       $arr = array(); 
       $array = array('16_9','4_3','9_16');
       $ext = !empty($this->ext) ? DIRECTORY_SEPARATOR.$this->ext.DIRECTORY_SEPARATOR : DIRECTORY_SEPARATOR;
       $route = RESOURCE_URL.DIRECTORY_SEPARATOR.$this->folder.$ext;
       $path = $route;
       $thumb = !empty($this->thumb) ? $this->thumb : $this->model->thumb;
       $id = Yii::app()->request->getParam('id',0);
       $silde = Storage::model()->findByAttributes(array('app_id'=>$this->app_id,'res_id'=>$id));
        if(is_file(RESOURCE_PATH.DIRECTORY_SEPARATOR.$this->folder.$ext.$thumb) && !empty($silde))
        {
            if(preg_match('/(.*?)\.(\w+)$/iU',$thumb,$arr))
            {                      
                $token = Yii::app()->request->getCsrfToken();
                $this->_script->registerScript('#show_thumb_list',"
                        $('.thumb_show span a').click(function(){
                            if(confirm('确定要删除吗?')){
                                var name = '{$thumb}';
                                var folder = '{$this->folder}';
                                var ext = '{$this->ext}';
                                var pk = '{$silde->id}';
                                $.ajax({
                                type: 'POST',
                                url: '/api/upload/deletethumb',
                                dataType:'json',
                                data: 'name='+name+'&folder='+folder+'&ext='+ext+'&YII_CSRF_TOKEN='+'{$token}',
                                success: function(msg){
                                    if(msg.code === '1'){
                                     $.ajax({
                                            type: 'POST',
                                            url: '/api/upload/deleteByStorge',
                                            data: 'pk='+pk+'&YII_CSRF_TOKEN='+'{$token}',
                                       });
                                        window.location = window.location;
                                    }else{
                                        $(this).showMsg({title:'系统消息',msg:'删除失败'});
                                    }
                                }
                             });
                            }
                        });
                    ");
                    $html = '<div class="thumb_show"><div class="image_list">';
                    foreach($array as $key)
                    {
                        if(is_file(RESOURCE_PATH.DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.$ext.$arr[1]."_{$key}.".$arr[2])){
                            $html .= CHtml::image($path.$arr[1]."_{$key}.".$arr[2],$key);
                        }
                    }
                    $html .= '</div><span><a href="javascript:void(0);">删除缩略图重新上传</a></span></div>';
                    echo $html;
                }
        }
    }

    /**
     * this is registerScript
     */
    private function _registerScript() 
    {       
        $this->_script->registerScriptFile('/js/jcrop/jquery.Jcrop.min.js'); 
        $this->_script->registerCssFile('/js/jcrop/jquery.Jcrop.min.css'); 
        $this->_registerCss();
    }
    
    /**
     * this is css
     */
    private function _registerCss()
    {
        $this->_script->registerCss('#thumb',".thumb_show img{border:5px solid #ccc;margin:5px;}.thumb_body .thumb_show span a{padding: 2px 5px 3px;border:none;background:#880000;border-radius:0;color:#fff;} .thumb_show span{position: absolute;top: 11px;right: 100px;}#thumb input.checkbox{width:100%;}.qq-uploader{top:5px;left:5px}.qq-upload-button{display: block;width: 105px;padding: 2px 0;text-align: center;background: #880000;border-bottom: 1px solid #ddd;color: #fff;}.thumb_body{position: relative;z-index: 300;border: 1px solid #ccc;}.thumb_body h3{padding: 5px;background: #e7e7e7;}#thumb{overflow:hidden;clear: both;}#thumb_target_16_9,#thumb_target_4_3,#thumb_target_9_16{margin-right: 5px;float:left;}#public_thmub_16_9{TOP: 200px;margin-top: 20px;position: absolute;top: -23px;right: 15px;}");
    }
    
    private function _setWidget()
    {
        $name = get_class($this->model);
        $this->_html = '<h3>上传一张图片进行16:9,4:3,6:19规格裁剪,注意：图片进行更新或删除,必须重新生成所有规格!</h3><div id="thumb">';       
        $this->beginWidget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'public_thmub_16_9',
                'config'=>array(
                       'action'=>Yii::app()->createUrl("/api/upload/ajaxupload/type/{$this->folder}/?ext={$this->ext}"),
                       'allowedExtensions'=>array("jpg","jpeg","gif",'png'),
                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1,// minimum file size in bytes
                       'maxConnections'=>1,
                       'multiple'=>true,
                        'onSubmit'=>"js:function(id, fileName){
                                 var len = $('.thumb_show .image_list img').length;
                                 if(len > 0){
                                     $('#public_thmub_16_9 .qq-upload-button').css('background','#ccc');
                                     $('#public_thmub_16_9 .qq-upload-button').click(function(){return false;});
                                     $(this).showMsg({title:'系统消息',msg:'请先删除旧缩略图'});
                                     return false;
                                 }                          
                             }",
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                                $('.target').hide();
                                $('#thumb_target_16_9').append('<input type=hidden name={$name}[thumb] value='+responseJSON.filename+' />');
                                $('#public_thmub_16_9 .qq-upload-button').css('background','#ccc');
                                $('#public_thmub_16_9 .qq-upload-button').click(function(){return false;});
                                $('#thumb_target_16_9').append('<span><img src='+responseJSON.image+' id=\'cropbox_big\'/><input class=checkbox id=big_on type=checkbox name={$name}[big_on] /></span>');
                                $('#thumb_target_4_3').append('<span><img src='+responseJSON.image+' id=\'cropbox_min\'/><input class=checkbox type=checkbox name={$name}[min_on] />');
                                $('#thumb_target_9_16').append('<img src='+responseJSON.image+' id=\'cropbox_height\'/><input class=checkbox type=checkbox name={$name}[height_on] /></span>');
                                $(function(){                                       
                                    $('#cropbox_big').Jcrop({ aspectRatio:16/9,onSelect: updateCoords});
                                    $('.qq-upload-success').hide();
                                      function updateCoords(c){
                                        $('#b_x').val(c.x);
                                        $('#b_y').val(c.y);
                                        $('#b_w').val(c.w);
                                        $('#b_h').val(c.h);
                                      };
                                });
                                $(function(){                                       
                                    $('#cropbox_min').Jcrop({ aspectRatio:1,onSelect: updateCoords});
                                    $('.qq-upload-success').hide();
                                      function updateCoords(c){
                                        $('#m_x').val(c.x);
                                        $('#m_y').val(c.y);
                                        $('#m_w').val(c.w);
                                        $('#m_h').val(c.h);
                                      };
                                });
                                $(function(){                                       
                                    $('#cropbox_height').Jcrop({ aspectRatio:9/16,onSelect: updateCoords});
                                    $('.qq-upload-success').hide();
                                      function updateCoords(c){
                                        $('#h_x').val(c.x);
                                        $('#h_y').val(c.y);
                                        $('#h_w').val(c.w);
                                        $('#h_h').val(c.h);
                                      };
                                });
                        }",
                       'showMessage'=>"js:function(message){ alert(message); }"
                      ),
            )); 
        $this->_html .= '<div id="thumb_target_16_9"><input type="hidden" id="b_x" name="'.$name.'[big_x]" /><input type="hidden" id="b_y" name="'.$name.'[big_y]" /><input type="hidden" id="b_w" name="'.$name.'[big_w]" /><input type="hidden" id="b_h" name="'.$name.'[big_h]" /></div>';
        $this->_html .= '<div id="thumb_target_4_3"><input type="hidden" id="m_x" name="'.$name.'[min_x]" /><input type="hidden" id="m_y" name="'.$name.'[min_y]" /><input type="hidden" id="m_w" name="'.$name.'[min_w]" /><input type="hidden" id="m_h" name="'.$name.'[min_h]" /></div>';
        $this->_html .= '<div id="thumb_target_9_16"><input type="hidden" id="h_x" name="'.$name.'[height_x]" /><input type="hidden" id="h_y" name="'.$name.'[height_y]" /><input type="hidden" id="h_w" name="'.$name.'[height_w]" /><input type="hidden" id="h_h" name="'.$name.'[height_h]" /></div>';
        $this->endWidget();
        echo $this->_html .= '</div>';
    }


    public function run() 
    {
        $this->_setWidget();
        if(!$this->model->isNewRecord)$this->_show();    
    }
}