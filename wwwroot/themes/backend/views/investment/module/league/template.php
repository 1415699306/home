<div class="league" id="0">
    <h3>项目支持模块</h3>
    <div class="row"><label>支持模块标语:</label><input value="<?php echo !empty($params) ? $params["league"]['title_backgroud'] : ''?>" name="League[title_backgroud]" type="text" size="60" maxlength="1024" class="{required:true,messages:{required:'请输入内容'}}" /></div>
    <?php echo CHtml::hiddenField('League[template_id]',0);?>
    <?php echo CHtml::hiddenField('League[template_name]','league');?>
    <div class="rows image test_a">
        <label>项目服务图片:</label>
        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'description_train',
                'config'=>array(
                       'action'=>Yii::app()->createUrl('/api/upload/ajaxupload/type/investment?thumb=1&w=230&h=210'),
                       'allowedExtensions'=>array("jpg","jpeg","gif",'png'),
                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1024,// minimum file size in bytes
                        'onSubmit'=>"js:function(id, fileName){
                                var len = $('.league .test_0').length;
                                if(len > 4){
                                    $('.league .test_a .qq-upload-button').css('background','#ccc');
                                    $('.league .test_a .qq-upload-button').click(function(){return false;});
                                    $(this).showMsg({title:'系统消息',msg:'超出数量限制'});
                                    return false;
                                }                          
                            }",
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                           $('#description_train').append('<div class=\'listImg test_0\'><img src='+responseJSON.image+' /><input type=text name=League[description_train_image_name][] class={required:true,messages:{required:\"请输入内容\"}}/>');
                           $('.league').append('<input type=hidden name=League[description_train_image][] value='+responseJSON.filename+' />');
                        }",
                       'showMessage'=>"js:function(message){ alert(message); }"
                      ),
            )); ?>
    </div>
    <div class="rows image test_b">
        <label>推广支持图片:</label>
        <?php $this->widget('ext.EAjaxUpload.EAjaxUpload',
            array(
                'id'=>'description_generalize',
                'config'=>array(
                       'action'=>Yii::app()->createUrl('/api/upload/ajaxupload/type/investment?thumb=1&w=230&h=210'),
                       'allowedExtensions'=>array("jpg","jpeg","gif",'png'),
                       'sizeLimit'=>10*1024*1024,// maximum file size in bytes
                       'minSizeLimit'=>1024,// minimum file size in bytes
                       'onSubmit'=>"js:function(id, fileName){
                                var len = $('.league .test_1').length;
                                if(len > 4){
                                    $('.league .test_b .qq-upload-button').css('background','#ccc');
                                    $('.league .test_b .qq-upload-button').click(function(){return false;});
                                    $(this).showMsg({title:'系统消息',msg:'超出数量限制'});
                                    return false;
                                }                          
                            }",
                       'onComplete'=>"js:function(id, fileName, responseJSON){
                           $('#description_generalize').append('<div class=\'listImg test_1\'><img src='+responseJSON.image+' /><input type=text name=League[description_generalize_image_name][] class={required:true,messages:{required:\"请输入内容\"}}/>');
                           $('.league').append('<input type=hidden name=League[description_generalize_image][] value='+responseJSON.filename+' />');
                        }",
                       'showMessage'=>"js:function(message){ alert(message); }"
                      ),
            )); ?>
    </div> 
    <?php if(!empty($params)):?><?php $this->renderPartial('_imageList',array('params'=>$params));?><?php endif;?>
</div>