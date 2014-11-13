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
class IbulkUpload extends CInputWidget{
    
    public $model;  
    public $folder;   
    public $thumb;
    private $_script;
    private $_html;
    public function init() 
    {   
        $this->_script = Yii::app()->getClientScript();
    }
    
    private function _show()
    {
        $array = array(); 

        $token = Yii::app()->request->getCsrfToken();
        $html = '<div class="thumb_show">';
        $this->_script->registerScript('#show_thumb_list',"
            $('#delete').live('click',function(){
                if(confirm('确定要删除吗?')){
                    var route = $(this).attr('d');
                    $.ajax({
                    type: 'GET',
                    url: '/api/upload/delete',
                    dataType:'json',
                    data: 'route='+route+'&YII_CSRF_TOKEN='+'{$token}',
                        success:function(xhr){
                        window.location = window.location;
                        }
                 });
                }
            });
        ");
        $name = get_class($this->model);
        $data = CJSON::decode($this->model->data);
        if(empty($data))return;
        foreach($data as $key=>$val)
        {
            $route = RESOURCE_PATH.DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.$val;
            if(is_file($route)){
                $html .= CHtml::tag('div',array('class'=>'image_list')).CHtml::hiddenField($name."[slide][]",$val)
                        .CHtml::image(DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR.$this->folder.DIRECTORY_SEPARATOR.$val,null,array('width'=>100,'height'=>50))
                        .CHtml::tag('div',array('style'=>'padding:0;text-align:center;')).CHtml::link('删除','javascript:void(0);',array('id'=>'delete','d'=>DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.'slide'.DIRECTORY_SEPARATOR.$val))
                        .CHtml::closeTag('div').CHtml::closeTag('div');                        
            }
        }        
        echo $html;     
    }
    
    /**
     * this is css
     */
    private function _registerCss()
    {
        $this->_script->registerCss('#thumb',"#thumb_target_16_9 img{border:5px solid #ccc;margin:5px;}.thumb_show img{border:5px solid #ccc;margin:5px;}.thumb_body .thumb_show span a{padding: 2px 5px 3px;border:none;background:#880000;border-radius:0;color:#fff;} .thumb_show span{position: absolute;top: 12px;right: 120px;}#thumb input.checkbox{width:100%;}.qq-uploader{top:5px;left:5px}.qq-upload-button{display: block;width: 105px;padding: 2px 0;text-align: center;background: #880000;border-bottom: 1px solid #ddd;color: #fff;}.thumb_body{position: relative;z-index: 300;border: 1px solid #ccc;}.thumb_body h3{padding: 5px;background: #e7e7e7;}#thumb{overflow:hidden;clear: both;}#thumb_target_16_9,#thumb_target_4_3,#thumb_target_9_16{margin-right: 5px;float:left;}#public_thmub_16_9{TOP: 200px;margin-top: 20px;position: absolute;top: -23px;right: 15px;}");
    }
    
    private function _setWidget()
    {
        $name = get_class($this->model);
        $this->_html = '<h3 style="border-top: 1px solid #ccc;padding: 5px;">上传组图</h3><div id="thumb">';       
        $this->beginWidget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'public_thmub_16_9',
                'config'=>array(
                       'action'=>Yii::app()->createUrl("/api/upload/ajaxupload/type/{$this->folder}"),
                       'allowedExtensions'=>array("jpg","jpeg","gif",'png'),
                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1,// minimum file size in bytes
                       'maxConnections'=>1,
                       'multiple'=>true,
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                                $('.target').hide();
                                $('#thumb_target_16_9').append('<input type=hidden name={$name}[slide][] value='+responseJSON.filename+' />');
                                $('#thumb_target_16_9').append('<span><img src='+responseJSON.image+' id=\'cropbox_big\' width=100 height=50/></span>');
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
        $this->_show();    
    }
}