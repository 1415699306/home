<div class="introduction" id="0">
    <h3>合作介绍模块</h3>
    <div class="row"><label>合作资格标语:</label><input value="<?php echo !empty($params) ? $params["introduction"]['title_qualification'] : ''?>"  name="Introduction[title_qualification]" type="text" size="60" maxlength="1024" class="{required:true,messages:{required:'请输入内容'}}" /></div>
    <div class="row"><label>合作资格介绍:</label><textarea style="float: left;" name="Introduction[description_qualification]" cols="50" rows="5" class="{required:true,messages:{required:'请输入内容'}}" ><?php echo !empty($params) ? $params["introduction"]['description_qualification'] : ''?></textarea><span style="float: left;color:#ccc;">每一行文字用半角[]符号括起来如:<br />[1、具有独立承担民事责任的能力；]<br />[2、具有良好的商业信誉和健全的财务会计制t度；]</span></div>
    <?php echo CHtml::hiddenField('Introduction[template_id]',0);?>
    <?php echo CHtml::hiddenField('Introduction[template_name]','introduction');?>
    <div class="rows image">
        <label>模块图片:</label>
        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'Introduction',
                'config'=>array(
                       'action'=>Yii::app()->createUrl('/api/upload/ajaxupload/type/investment'),
                       'allowedExtensions'=>array("jpg","jpeg","gif",'png'),
                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1024,// minimum file size in bytes
                        'onSubmit'=>"js:function(id, fileName){
                            var len = $('.introduction .listImg').length;
                            if(len > 3){
                                $('.introduction .qq-upload-button').css('background','#ccc');
                                $('.introduction .qq-upload-button').click(function(){return false;});
                                $(this).showMsg({title:'系统消息',msg:'超出数量限制'});
                                return false;
                            }                          
                        }",
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                           $('#Introduction').append('<div class=listImg><img src='+responseJSON.image+' /></div>');
                           $('.introduction').append('<input type=hidden name=Introduction[introduction_image][] value='+responseJSON.filename+' />');
                        }",
                       'showMessage'=>"js:function(message){ alert(message); }"
                      ),
            )); ?>
    </div>  
    <?php if(!empty($params)):?><?php $this->renderPartial('_imageList',array('params'=>$params));?><?php endif;?>
</div>