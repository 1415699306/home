<?php
Yii::app()->getClientScript()->registerCssFile('/css/login.css');
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>
<div class="banner"><?php echo CHtml::link(CHtml::image('/images/login/login_05.jpg','首页'),$this->createUrl('/site'))?></div>
      <div class="login">
      <div class="login_title">
     	 <p>会员登录　<i>上乐荟,享尊贵!</i></p>
      </div>
    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
        <div class="row username">
            <?php echo $form->label($model,'username'); ?>
            <?php echo $form->textField($model,'username',array('autocomplete'=>'off')); ?>
            <?php echo $form->error($model,'username'); ?>
        </div>
        <div class="row password">
            <div class="repass">忘记密码?</div>
            <?php echo $form->label($model,'password'); ?>
            <?php echo $form->PasswordField($model,'password',array('autocomplete'=>'off')); ?>
            <?php echo $form->error($model,'password'); ?>
        </div>
        <?php if (extension_loaded('gd')): ?>
        <div class="row verifyCode">
            <?php echo $form->labelEx($model,'verifyCode'); ?>
            <?php $this->widget('CCaptcha',array('buttonLabel'=>'看不清换一张')); ?>
            <?php echo $form->textField($model,'verifyCode',array('class'=>'verify')); ?>
            <?php echo $form->error($model,'verifyCode'); ?>
        </div>
        <div class="btn row ">
        <?php endif;?>
            <?php echo CHtml::submitButton('登录',array('class'=>'loginButton'));?>
            <input type="button" value="预注册" class="registerButton" onclick="location.href='<?php echo(Yii::app() -> createUrl('/site/register'));?>'"/>

        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
