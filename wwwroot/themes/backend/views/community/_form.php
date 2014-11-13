<div class="form">
        <?php $form = $this->beginWidget('CActiveForm', array(
            'id'=>'life-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation'=>true,
            'htmlOptions'=>array(
                'validateOnSubmit'=>true,
                'enctype'=>'multipart/form-data',
            ),
        )); ?>
    <div class="content target">
        <h5>基本信息</h5>
        <div class="row">
            <?php echo $form->labelEx($model,'title'); ?>
            <?php echo $form->dropDownList($model,'category_id',$category); ?>
            <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'title'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'discription'); ?>
            <?php echo $form->textArea($model,'discription',array('maxlength'=>255,'cols'=>'52','rows'=>'6')); ?>
            <?php echo $form->error($model,'discription'); ?>
        </div> 
    </div>
    <div class="content target">
        <h5>基本设置</h5>
        <div class="row">
            <?php echo $form->labelEx($model,'source'); ?>
            <?php echo $form->textField($model,'source',array('size'=>60,'maxlength'=>128,'id'=>'source')); ?><?php echo CHtml::button('插入lfeel网址',array('id'=>'setSource'));?>
            <?php echo $form->error($model,'source'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'tags'); ?>
            <?php echo $form->textField($model,'tags',array('size'=>60,'maxlength'=>80)); ?>
            <?php echo $form->error($model,'tags'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'recommand'); ?>
            <?php echo $form->RadioButtonList($model,'recommand',array('0'=>'否','1'=>'是'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
            <?php echo $form->error($model,'recommand'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'channel_recommand'); ?>
            <?php echo $form->RadioButtonList($model,'channel_recommand',array('0'=>'否','1'=>'是'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
            <?php echo $form->error($model,'channel_recommand'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'status'); ?>
            <?php echo $form->RadioButtonList($model,'status',array('0'=>'开','1'=>'关'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
            <?php echo $form->error($model,'status'); ?>
        </div>
        <div class="row">
            <?php echo $form->labelEx($model,'history'); ?>
            <?php echo $form->RadioButtonList($model,'history',array('1'=>'开','0'=>'关'),array('separator'=>'','template'=>'<li>{input}{label}</li>')); ?>
            <?php echo $form->error($model,'history'); ?>
        </div>
    </div>
    <div class="content target">
        <h5>文章内容</h5>
        <div class="row">
            <?php echo $form->labelEx($model->communityContent,'content'); ?>
            <?php $this->widget('ext.widgets.baiduEdit.IBaiduEdit',array('model'=>$model->communityContent,'form'=>$form,'attribute'=>'content','value'=>$newContent));?>
            <?php echo $form->error($model->communityContent,'content'); ?>
        </div>  
    </div>
        <h5>缩略图设置</h5>
        <div class="row thumb_body">
            <?php $this->widget('ext.widgets.cut.ICutThumb',array('app_id'=>BaseApp::COMMUNITY,'model'=>$model,'folder'=>'community','ext'=>'thumb','thumb'=>!empty($model->thumbs->track_id) ? $model->thumbs->track_id : null));?>  
        </div>
        <div class="row button">
            <?php echo CHtml::submitButton('提交',array('class'=>'button action-create')); ?>
            <?php echo CHtml::button('展开全部',array('id'=>'show'));?>
        </div>
        <?php $this->endWidget(); ?>
    </div>
<style>
#show{float: left;padding:4px;margin: 6px;}
.form .action-create{cursor: pointer;float: left;padding:5px;border:1px solid #ccc;}
.form .content{margin: 5px 0;}
.row, .form .content{display: block;overflow: hidden;clear: both;}
.form .row label{width:80px;float: left;}
.form h5, .form h3{border-bottom: 1px dotted #ccc;font-size: 14px;padding: 5px;text-shadow: 0px 1px 0px #fff;background: #bae7ff;}
.form h3{background:#e7e7e7;padding: 0px 3px;}
div.row label {float: left;text-align: right;padding-right: 5px;font-size: 12px;font-weight: bold;width: 90px;}
.form .row label, .form .row span li label{line-height: 20px;}
.form .row label, .form .row span li, .form .row span li input{float: left;}
.form .row label{width: 80px;}
.form .row li{list-style: none;}
.form .row span li{width:50px;}
.form .row span li label{width: auto;background: none;}
.form .row span li label.big_label{width: 35px;background: none;}
.form .row span li input{padding: 0; margin: 2px;}
.form .row em{font-size: 12px;line-height: 20px;color: #ccc;}
.qq-upload-button {display: block;width: 80px;padding:0;text-align: center;background: #880000;border-bottom: 1px solid #ddd;color: #fff;top:4px;}
.qq-upload-list li {margin: 5px;padding: 5px;line-height: 15px;font-size: 12px;float: left;border: 1px solid;width: 200px;background: #ccc;}
.qq-upload-list li a{border:none;background: none;}
.submit, .row .row a {border-radius: 5px;cursor: pointer;background:none;background-position: 5px;border: none;padding: 0;text-indent: 1.2em;}
.thumb_body h3{padding: 5px;}
.qq-upload-list {margin:0;padding: 0;list-style: disc;float: left;width: 100%;position: absolute;top:-3px;right: 300px;}
.qq-uploader {position: relative;width: 100%;margin: 5px 0;}
</style>
<script>
$('#setSource').click(function(){
    $('#source').val('http://www.lfeel.com');
});
$('#show').click(function(){
   $('.target').show(); 
});
</script>