<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ICutThumbBySwf
 *
 * @author Administrator
 */
class ICutThumbBySwf extends CInputWidget{
    
    public $debug=false;
    public $folder;
    public $model;
    public $ext='thumb';
    public function init() 
    {
        if(!$this->_setOldFile())return;
        $this->_setClientScript();
        $this->widget('application.extensions.swfupload.CSwfUpload', array(
            'jsHandlerUrl'=>'/js/swfupload/handler.js', //Relative path
            'id'=>'SWFUpload',
            'postParams'=>array(),
            'config'=>array(
                'use_query_string'=>true,
                'upload_url'=>Yii::app()->createUrl('/api/upload/swfupload',array('folder'=>$this->folder,'ext'=>$this->ext,'PHPSESSID'=>Yii::app()->session->getSessionId())), //Use $this->createUrl method or define yourself
                'file_size_limit'=>'6MB',
                'file_types'=>'*.jpg;*.png;*.gif',
                'file_types_description'=>'Image Files',
                'file_upload_limit'=>1,
                'file_queue_error_handler'=>'js:fileQueueError',
                'file_dialog_complete_handler'=>'js:fileDialogComplete',
                'upload_progress_handler'=>'js:uploadProgress',
                'upload_error_handler'=>'js:uploadError',
                'upload_success_handler'=>'js:uploadSuccess',
                'upload_complete_handler'=>'js:uploadComplete',
                'button_placeholder_id'=>'swfupload',
                'button_width'=>150,
                'button_height'=>20,
                'button_text'=>'<span class="button">'.Yii::t('messageFile', '上传文件').' (最大上传 6 MB)</span>',
                'button_text_style'=>'.button { font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif; font-size: 11pt; text-align: center; }',
                'button_text_top_padding'=>0,
                'button_text_left_padding'=>0,
                'button_window_mode'=>'js:SWFUpload.WINDOW_MODE.TRANSPARENT',
                'button_cursor'=>'js:SWFUpload.CURSOR.HAND',
                ),
            )
        );
    }
    
    private function _setOldFile()
    {
        $return = true;
        if(!$this->model->isNewRecord){
            $thumb = !empty($this->model->thumbs->track_id) ? $this->model->thumbs->track_id  : (!empty($this->model->thumb->track_id) ? $this->model->thumb->track_id : null);
            if(is_file(RESOURCE_PATH.DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.$this->ext.DIRECTORY_SEPARATOR.$thumb)){
                $token = Yii::app()->request->getCsrfToken();
                $js = Yii::app()->getClientScript();
                $js->registerCss("{$this->id}","#delete{cursor: pointer;width: 100px;border: 1px solid #ccc;margin: 5px 0;padding: 2px 5px;}");
                $js->registerScript('#show_thumb_list',"
                        $('#delete').click(function(){
                            if(confirm('确定要删除吗?')){
                                var name = '{$thumb}';
                                var folder = '{$this->folder}';
                                var ext = '{$this->ext}';
                                var pk = '{$this->model->thumbs->id}';
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
                $html=CHtml::image(HOME_URL.DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.$this->ext.DIRECTORY_SEPARATOR.$thumb);               
                $html.='<div id="delete">删除重新上传</div>';
                echo $html;
                $return = false;
            }
        }
        return $return;
    }


    private function _setClientScript()
    {
        $name =get_class($this->model);
        $js = Yii::app()->getClientScript();
        $js->registerCssFile('/js/swfupload/default.css');
        $js->registerScriptFile('/js/jcrop/jquery.Jcrop.min.js'); 
        $js->registerCssFile('/js/jcrop/jquery.Jcrop.min.css'); 
        $js->registerCss("{$this->id}","#thumb_target_16_9 input, #thumb_target_4_3 input, #thumb_target_9_16 input{width:3.5em;margin-right:5px;}.swfupload{display: block;clear: both;overflow: hidden;}#thumb_target_9_16,#thumb_target_4_3, #thumb_target_16_9{float: left;margin: 5px;border: 1px solid #ccc;overflow: hidden;display: block;padding: 1px;}#total{float: left;font-size: 14px;color: red;line-height: 35px;padding: 0 10px;}#SWFUpload_0{border: 1px solid #000;padding: 5px 0;background: #ccc;color: white;float:left;}");
        $js->registerScript("{$this->id}","SWFUpload.prototype.uploadComplete = function (file) {
    file = this.unescapeFilePostParams(file);
    this.queueEvent('upload_complete_handler', file);
};
SWFUpload.prototype.uploadProgress = function (file, bytesComplete, bytesTotal) {
    try {
    file = this.unescapeFilePostParams(file);
    this.queueEvent('upload_progress_handler', [file, bytesComplete, bytesTotal]);
    $('#total').html('上传进度：'+bytesComplete/bytesTotal*100+'%');
    } catch (ex) {
        alert(ex);
    }
};

SWFUpload.prototype.uploadComplete = function(file){
    if(typeof(file.name)!=='undefined'){
    $('.target').hide();
        $(function(){                                       
            $('#cropbox_big').Jcrop({ aspectRatio:16/9,onSelect: updateCoords});
              function updateCoords(c){
                $('#b_x,#sbx').val(c.x);
                $('#b_y').val(c.y);
                $('#b_w').val(c.w);
                $('#b_h').val(c.h);
              };
        });
        $(function(){                                       
            $('#cropbox_min').Jcrop({ aspectRatio:1,onSelect: updateCoords});
              function updateCoords(c){
                $('#m_x').val(c.x);
                $('#m_y').val(c.y);
                $('#m_w').val(c.w);
                $('#m_h').val(c.h);
              };
        });
        $(function(){                                       
            $('#cropbox_height').Jcrop({ aspectRatio:9/16,onSelect: updateCoords});
              function updateCoords(c){
                $('#h_x').val(c.x);
                $('#h_y').val(c.y);
                $('#h_w').val(c.w);
                $('#h_h').val(c.h);
              };
        });
    }
};

SWFUpload.prototype.uploadSuccess=function(file,data){
    msg = eval(data);
    if(msg[0].success==='1'){
        $('#thumb_target_16_9').append('<input type=hidden name={$name}[thumb] value='+msg[0].filename+' />');
        $('#thumb_target_16_9').append('<img src='+msg[0].path+' id=cropbox_big />X:<input type=text id=b_x name={$name}[big_x] />Y:<input type=teext id=b_y name={$name}[big_y] />W:<input type=text id=b_w name={$name}[big_w] />H:<input type=text id=b_h name={$name}[big_h] />');
        $('#thumb_target_4_3').append('<img src='+msg[0].path+' id=cropbox_min />X:<input type=text id=m_x name={$name}[min_x] />Y:<input type=text id=m_y name={$name}[min_y] />W:<input type=text id=m_w name={$name}[min_w] />H:<input type=text id=m_h name={$name}[min_h] />');
        $('#thumb_target_9_16').append('<img src='+msg[0].path+' id=cropbox_height />X:<input type=text id=h_x name={$name}[height_x] />Y:<input type=text id=h_y name={$name}[height_y] />W:<input type=text id=h_w name={$name}[height_w] />H:<input type=text id=h_h name={$name}[height_h] />');
        $('#thumb').val(msg[0].filename);
        this.setButtonDisabled(true);
        document.getElementById(this.customSettings.uploadButtonId).disabled = true;
    }else{
        $('#total').html('文件上传失败,请重新上传');
    }};");
    }
  
    public function run()
    {
        $html ='<div class="swfupload"><span id="swfupload"></span><span id="total"></span></div>';
        $html.='<div id="thumb_target_16_9"></div>';
        $html.='<div id="thumb_target_4_3"></div>';
        $html.='<div id="thumb_target_9_16"></div>';
        echo $html;
        
    }
}