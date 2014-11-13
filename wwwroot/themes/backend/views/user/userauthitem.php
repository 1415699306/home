<?php
$this->breadcrumbs=array(
    '用户管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'user',
    '用户授权管理'
);
?>
<div class="inner">
    <div class="noitce">
        <h3>关于用户角色授权的更新和删除注意事项</h3>
        <p><font color="red">1.注意,更新用户角色时,所有关联用户原有下级的角色及设置都将被线性全部删除!被更新的用户角色设置将被清空!</font></p>
        <p><font color="red">2.删除角色将直接影响已授予权限的全部成员!用户的全部下级角色及设置都将被线性全部删除!</font></p>
    </div>
    <div class="search-form">
    <?php $this->renderPartial('_itemsearch',array('model'=>$model,)); ?>
    </div>
    <?php if(isset($_GET['User'])):?>
        <?php if(empty($models)):?>
        <p>没有任何结果</p>
        <?php else:?>
            <label>用户ID:</label><?php echo $models->id;?>
            <label>用户名称:</label><?php echo $models->username;?>
            <label>用户邮箱:</label><?php echo $models->email;?>
            <label>用户角色:</label><?php echo !empty($models->assign) ? $models->assign->role->name : '未设置';?>
            <?php if(!empty($models->assign)):?>
            <label>角色创建者:</label><?php echo $models->assign->role->user->username;?>
                    <?php if($models->assign->role->user_id === Yii::app()->user->id || Yii::app()->user->name === Yii::app()->getModule('backend')->adminName):?>
                        <?php echo CHtml::form();?>
                        <?php echo CHtml::hiddenField('UserAuthItem[id]',$models->id);?>
                        <?php echo CHtml::dropDownList('UserAuthItem[role_id]', 0 ,CHtml::listData($listData,'id', 'name','user.username'));?>
                        <?php echo CHtml::submitButton('修改');?>
                        <?php CHtml::endForm();?>
                    <?php endif;?>
            <?php else:?>
                    <?php echo CHtml::form();?>
                    <?php echo CHtml::hiddenField('UserAuthItem[id]',$models->id);?>
                    <?php echo CHtml::dropDownList('UserAuthItem[role_id]', 0 ,CHtml::listData($listData,'id', 'name','user.username'));?>
                    <?php echo CHtml::submitButton('修改');?>
                    <?php CHtml::endForm();?>
            <?php endif;?>
        <?php endif;?>
    <?php endif;?>
</div>
<style>
.inner .noitce{border: 1px solid #ccc;margin-bottom: 10px;padding: 5px;border-radius: 5px;-webkit-box-shadow: 0 0 8px rgba(0,0,0,0.3);-moz-box-shadow: 0 0 8px rgba(0,0,0,0.3);box-shadow: 0 0 8px rgba(0,0,0,0.3);}
</style>