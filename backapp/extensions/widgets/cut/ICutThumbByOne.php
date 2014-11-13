<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ICutThumbByOne
 *
 * @author Administrator
 */
class ICutThumbByOne extends CInputWidget{
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
       $ext = !empty($this->ext) ? DIRECTORY_SEPARATOR.$this->ext.DIRECTORY_SEPARATOR : DIRECTORY_SEPARATOR;
       $route = RESOURCE_URL.DIRECTORY_SEPARATOR.$this->folder.$ext;
       $path = $route;
       $id = Yii::app()->request->getParam('id',0);
       $thumb = !empty($this->thumb) ? $this->thumb : $this->model->thumb;
       $silde = Storage::model()->findByAttributes(array('app_id'=>$this->app_id,'res_id'=>$id));
        if(is_file(RESOURCE_PATH.DIRECTORY_SEPARATOR.$this->folder.$ext.$thumb))
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
                    
                        if(is_file(RESOURCE_PATH.DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.$ext.$thumb)){
                            $html .= CHtml::image($path.$thumb);
                        }
                    
                    $html .= '</div><span><a href="javascript:void(0);">删除重新上传</a></span></div>';
                    echo $html;
                
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
        $this->_script->registerCss('#thumb',".thumb_show img{border:5px solid #ccc;margin:5px;}.thumb_body .thumb_show span a{padding: 4px 5px;border:none;background:#880000;border-radius:0;color:#fff;} .thumb_show span{position: absolute;top: 10px;right: 130px;}#thumb input.checkbox{width:100%;}.qq-uploader{top:5px;left:5px}.qq-upload-button{display: block;width: 105px;padding: 2px 0;text-align: center;background: #880000;border-bottom: 1px solid #ddd;color: #fff;}.thumb_body{position: relative;z-index: 300;border: 1px solid #ccc;}.thumb_body h3{padding: 5px;background: #e7e7e7;}#thumb{overflow:hidden;clear: both;}#thumb_target_16_9,#thumb_target_4_3,#thumb_target_9_16{margin-right: 5px;float:left;}#public_thmub_16_9{TOP: 200px;margin-top: 20px;position: absolute;top: -23px;right: 15px;}");
    }
    
    private function _setWidget()
    {
        $name = get_class($this->model);
        $this->_html = '<h3>上传一张图片</h3><div id="thumb">';       
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
                                $('#thumb_target_16_9').append('<span><img src='+responseJSON.image+' id=\'cropbox_big\'/></span>');
                            
                        }",
                       'showMessage'=>"js:function(message){ alert(message); }"
                      ),
            )); 
        $this->_html .= '<div id="thumb_target_16_9"></div>';
        $this->endWidget();
        echo $this->_html .= '</div>';
    }


    public function run() 
    {
        $this->_setWidget();
        if(!$this->model->isNewRecord)$this->_show();  
    }
}
