<?php
$this->breadcrumbs=array(
	'角色权限管理'
);
Yii::app()->clientScript->registerScript('search', "
$('.search-form form').submit(function(){   
$.fn.yiiListView.update('user_role', {
        data: $(this).serialize()
    });
    return false;
});
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
");
?>
<div class="inner">
    <div class="noitce">
        <h3>关于用户角色</h3>
        <p><font color="red">1.除系统管理员admin外,任何角色都继承至上一级角色授予的权限!</font></p>
        <p><font color="red">2.系统推荐使用单一角色设置!即除管理员外,其它角色一率不推荐授权角色设置的权限,统一由管理员设置添加!</font></p>
        <p><font color="red">3.更新和删除角色将直接影响已授予权限的全部下级角色!</font></p>
    </div>
    <?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
    <div class="search-form" style="display:none">
    <?php $this->renderPartial('_rolesearch',array('model'=>$model,)); ?>
    </div>
    <?php $this->widget('zii.widgets.CListView', array(
        'id'=>'user_role',
        'dataProvider'=>$dataProvider,
        'ajaxUpdate'=>true,
        'pager'=>array(
            'cssFile'=>FALSE,
            'header'=>FALSE,
        ),
        'itemView'=>'_competence',
            'sortableAttributes'=>array(
                'name',
                'ctime',
            ),
        ));
    ?>
    <div class="form">
        <h3>添加角色</h3>
        <?php $form = $this->beginWidget('CActiveForm', array(
                'id'=>'role-form',
                'enableAjaxValidation'=>true,
                'enableClientValidation'=>true,
                'htmlOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
        )); ?>
        <div class="row">
            <?php echo $form->labelEx($model,'name'); ?>
            <?php echo $form->textField($model,'name'); ?>
            <?php echo $form->error($model,'name'); ?>
        </div>
        <?php echo CHtml::submitButton('提交');?>
        <?php $this->endWidget(); ?>
    </div>
<style>
.list-view .summary{margin: 0 0 5px 0;text-align: left;float: left;}
.inner .list{border: 1px solid #09C;padding:5px 10px;clear: both;overflow: hidden;margin-bottom: 5px;border-radius: 5px;}
.inner .list h3, .inner .form h3{clear: both;border-left: 3px solid #c22417;padding: 0 5px;color: #333333;font-weight: bold;text-shadow: 0px 1px 0px #e7e7e7;}
.inner .list h3{width: 100%;height: 18px;line-height: 18px;}
.inner .list h5 {width: 100%;height: 16px;line-height: 16px;clear: both;margin: 5px 0;font-weight: bold;margin-right: 5px;background: url(/themes/backend/images/admincp/icons-13x13.png) no-repeat;background-position: 0 -278px;text-indent: 1.4em;}
.inner .list h3 span{float: right;font-size: 14px;font-weight: 200;}
.inner .list ul{display: block;width: 100%;}
.inner .list ul li{float:left;margin-right: 5px;}
.inner .list em{color: #ccc;}
#user_role #delete{padding:0 0 0 15px;background: url('/themes/backend/images/admincp/delete.png') 0 3px no-repeat;}
#user_role #update{padding:0 0 0 15px;background: url('/themes/backend/images/admincp/update.png') 0 3px no-repeat;}
.inner .form{border: 1px solid #c22417;border-radius: 5px;padding: 5px;margin-top: 10px;}
.inner .noitce{border: 1px solid #ccc;margin-bottom: 10px;padding: 5px;border-radius: 5px;-webkit-box-shadow: 0 0 8px rgba(0,0,0,0.3);-moz-box-shadow: 0 0 8px rgba(0,0,0,0.3);box-shadow: 0 0 8px rgba(0,0,0,0.3);}
</style>
<script>
$(document).ready(function(){
    $('#user_role #delete').live('click',function(){
        if(confirm('确定要删除这个角色吗?所有关联此角色的用户权限将会被同时被删除!')){
            var link = $(this).attr('href');
            $.ajax({
                type: "GET",
                url: link,
                dataType: "json",
                success:function(xhr){
                    if(xhr.code==='1'){
                        $(this).yiiListView.update('user_role'); 
                    }else{
                        $(this).showMsg({title:'错误消息',msg:'删除失败'});
                    }
                }
            });  
        }
        return false;
    });
});
</script>