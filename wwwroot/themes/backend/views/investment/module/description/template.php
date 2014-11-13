<div class="description" id="0">
    <h3>项目介绍模块</h3>
    <div class="row"><label>项目模块标语:</label><input value="<?php echo !empty($params) ? $params["description"]['title_backgroud'] : ''?>" name="Description[title_backgroud]" type="text" size="60" maxlength="1024" class="{required:true,messages:{required:'请输入内容'}}" /></div>
    <?php echo CHtml::hiddenField('Description[template_id]',0);?>
    <?php echo CHtml::hiddenField('Description[template_name]','description');?>
    <div class="rows image">
        <label>介绍图片:</label>
        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'descriptions',
                'config'=>array(
                       'action'=>Yii::app()->createUrl('/api/upload/ajaxupload/type/investment/?thumb=1&w=230&h=210'),
                       'allowedExtensions'=>array("jpg","jpeg","gif",'png'),
                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1024,// minimum file size in bytes
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                           $('#descriptions').append('<div class=listImg><img src='+responseJSON.image+' /><input type=text name=Description[description_image_name][] class={required:true,messages:{required:\"请输入内容\"}}/></div>');
                           $('.description').append('<input type=hidden name=Description[description_image][] value='+responseJSON.filename+' />');
                        }",
                       'showMessage'=>"js:function(message){ alert(message); }"
                      ),
            )); ?>
    </div>    
    <?php if(!empty($params)):?><?php $this->renderPartial('_imageList',array('params'=>$params));?><?php endif;?>
</div>