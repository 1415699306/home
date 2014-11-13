<div class="company" id="0">
    <h3>公司介绍模块</h3>
    <div class="row"><label>视频播放地址:</label><input value="<?php echo !empty($params) ? $params["company"]['video'] : ''?>" name="Company[video]" type="text" size="100" maxlength="1024" class="{required:true,url:true,messages:{required:'请输入内容',url:'请输入正确的视频地址'}}" /></div>
    <div class="row"><label>公司背景标语:</label><input value="<?php echo !empty($params) ? $params["company"]['title_backgroud'] : ''?>" name="Company[title_backgroud]" type="text" size="60" maxlength="1024" class="{required:true,messages:{required:'请输入内容'}}" /></div>
    <div class="row"><label>公司背景介绍:</label><textarea name="Company[description_backgroud]" cols="50" rows="5" class="{required:true,messages:{required:'请输入内容'}}"><?php echo !empty($params) ? $params["company"]['description_backgroud'] : ''?></textarea></div>
    <div class="row"><label>品牌定位标语:</label><input value ="<?php echo !empty($params) ? $params["company"]['title_brand'] : ''?>" name="Company[title_brand]" type="text" size="60" maxlength="1024" class="{required:true,messages:{required:'请输入内容'}}" /></div>
    <div class="row"><label>品牌定位介绍:</label><textarea name="Company[description_Brand]" cols="50" rows="5" class="{required:true,messages:{required:'请输入内容'}}" ><?php echo !empty($params) ? $params["company"]['description_Brand'] : ''?></textarea></div>
    <?php echo CHtml::hiddenField('Company[template_id]',0);?>
    <?php echo CHtml::hiddenField('Company[template_name]','company');?>
    <div class="rows image">
        <label>荣誉资质图片:</label>
        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'Company',
                'config'=>array(
                       'action'=>Yii::app()->createUrl('/api/upload/ajaxupload/type/investment/?thumb=1&w=200'),
                       'allowedExtensions'=>array("jpg","jpeg","gif",'png'),
                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1024,// minimum file size in bytes
                        'onSubmit'=>"js:function(id, fileName){
                            var len = $('.company .listImg').length;
                            if(len > 4){
                                $('.company .qq-upload-button').css('background','#ccc');
                                $('.company .qq-upload-button').click(function(){return false;});
                                $(this).showMsg({title:'系统消息',msg:'超出数量限制'});
                                return false;
                            }                          
                        }",
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                            $('#Company').append('<div class=listImg><img src='+responseJSON.image+' /></div>');
                            $('.company').append('<input type=hidden name=Company[company_imgae][] value='+responseJSON.filename+' />');
                        }",
                       'showMessage'=>"js:function(message){ alert(message); }"
                      ),
            )); ?>
    </div>
    <?php if(!empty($params)):?>
        <?php $this->renderPartial('_imageList',array('params'=>$params));?>
    <?php endif;?>
</div>
<div class="company" id="1">
    <h3>公司介绍模块</h3>
    <div class="row"><label>视频播放地址:</label><input name="Company[video]" type="text" size="60" maxlength="1024"/></div>      
</div>