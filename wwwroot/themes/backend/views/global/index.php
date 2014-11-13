<?php
$this->breadcrumbs=array(
    '基本设置'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'global',
	'系统基本管理',
);
?>
<?php if(Yii::app()->user->name=='admin'):?>
<div class="inner">
    <div class="form">
        <?php echo CHtml::form('','post'); ?>
        <h3>系统相关</h3>
        <div class="row">
            <?php echo CHtml::label('系统开关','system_status');?>
            <?php echo CHtml::RadioButtonList('ConfigForm[system_status]',Yii::app()->setting->base->system_status,array('0'=>'开','1'=>'关'),array('separator'=>'','template'=>'<li>{input}{label}</li>'));?>
            <em>系统全局开关</em>
        </div>
        <h3>用户相关</h3>
        <div class="row">
            <?php echo CHtml::label('用户注册','register');?>
            <?php echo CHtml::RadioButtonList('ConfigForm[register]',Yii::app()->setting->base->register,array('0'=>'开','1'=>'关'),array('separator'=>'','template'=>'<li>{input}{label}</li>'));?>
            <em>是否允许用户注册</em>
        </div>
        <div class="row">
            <?php echo CHtml::label('注册审核','register_status');?>
            <?php echo CHtml::RadioButtonList('ConfigForm[register_status]',Yii::app()->setting->base->register_status,array('0'=>'开','1'=>'关'),array('separator'=>'','template'=>'<li>{input}{label}</li>'));?>
            <em>用户注册注册后是否需要管理员审核</em>
        </div>
        <div class="row">
            <?php echo CHtml::label('用户登录','login_in');?>
            <?php echo CHtml::RadioButtonList('ConfigForm[login_in]',Yii::app()->setting->base->login_in,array('0'=>'开','1'=>'关'),array('separator'=>'','template'=>'<li>{input}{label}</li>'));?>
            <em>用户注册注册后是否需要登录才能进入网站</em>
        </div>
        <h3>SEO</h3>
        <div class="area">
            <label>keyword</label>
            <?php echo CHtml::textArea('ConfigForm[keyword]',Yii::app()->setting->base->keyword,array('rows'=>5,'cols'=>54));?>
        </div>
        <div class="area">
            <label>discription</label>
            <?php echo CHtml::textArea('ConfigForm[discription]',Yii::app()->setting->base->discription,array('rows'=>5,'cols'=>54));?>
        </div>
        <h3>网站统计代码</h3>
        <div class="area">
            <label>统计代码</label>
            <?php echo CHtml::textArea('analytics',  CHtml::decode($analytics),array('rows'=>5,'cols'=>54));?>
        </div>
        <div class="row button">
            <?php echo CHtml::submitButton('提交',array('class'=>'button action-create')); ?>
        </div>
        <?php echo CHtml::endForm(); ?>
    </div>
</div>
<?php else:?>
<p>没有权限</p>
<?php endif;?>
<style>
.button{height: 25px;}
div.area{height: 80px;width: 100%;font-size: 12px;font-weight: bold;margin-top: 5px;}
div.form h3{border-bottom: 1px dotted #ccc;font-size: 14px;padding:5px;text-shadow: 0px 1px 0px #fff;background:#bae7ff ;}
div.row{position: relative; z-index: 800;display: block;clear: both;overflow: hidden;-webkit-box-shadow: inset 0 3px 3px #edf9ff;box-shadow: inset 0 3px 3px #edf9ff;_height:32px;}
div.area label, div.row label{text-align: right; margin-right: 5px;background: url(/themes/backend/images/admincp/icons-13x13.png) no-repeat;background-position: 0 -86px;}
div.area label, div.row label, div.row span li label{line-height: 20px;}
div.area label, div.row label, div.row span li, div.row span li input{float: left;}
div.area label, div.row label{width: 80px;}
div.row li{list-style: none;}
div.row span li{width:50px;}
div.row span li label{width: 15px;background: none;}
div.row span li input{padding: 0; margin: 2px;}
div.row em{font-size: 12px;line-height: 20px;color: #ccc;width:300px;position: absolute;top: 5px;left: 180px;z-index: 900;}
</style>