<?php
$this->pageTitle=Yii::app()->name . ' - 修改用户头像';
$this->breadcrumbs=array(
    '用户中心'=>'/usercenter',
	'修改用户头像',
);
?>
<h1>修改用户头像 - <?php echo CHtml::encode(Yii::app()->user->name);?></h1>

<div class='content_left'>
	<div class="list">
    <?php $this->widget('ext.widgets.avatar.avatarUpload');?>
	</div>
	<div class='right'>
		<h3>关于当前我的头像</h3>
		<p>如果您还没有设置自己的头像，系统会显示为默认头像，您需要自己上传一张新照片来作为自己的个人头像</p>
		<h3>设置我的新头像</h3>
		<p>头像保存后，您可能需要刷新一下本页面(按F5键)，才能查看最新的头像效果</p>
	</div>
</div>
<style>
.content_left .list .object-upload{border:1px solid #ccc;}
.content_left .right{width: 260px;float: left;padding: 5px;}
.content_left .right h3 {margin: 5px 0;text-indent: 0.2em;border-left: 5px solid #CCC;font-weight: bold;font-size: 14px;}
.content_left .list{width:452px;float:left;}
</style>