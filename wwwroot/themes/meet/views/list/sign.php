<?php $js = Yii::app()->clientScript;$js->registerCssFile('/css/view.css');$js->registerScriptFile('/js/fancy/jquery.fancybox.js');$js->registerCssFile('/js/fancy/jquery.fancybox.css');?>
<?php $this->pageTitle='乐聚会_'.$model->title.'_乐荟网';?>
<div class="main">
<?php
$this->breadcrumbs=array(
    '乐聚会'=>DIRECTORY_SEPARATOR.$this->module->id,
    $model->title,
);
?>
<div class="news_left">
	<div class="news_top">
    	<div class="title">
        	<h1><?php echo CHtml::encode($model->title);?></h1>
            <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'public_top_list');?>
            <div class="new_content"><?php echo  BaseApp::pageByContent($model->meetContent->content,$model->meetContent->pages);?></div>
            <?php if($model->off_time < time()):?>
                <p class="sign_pass">活动已结束!</p>
            <?php else:?>
                <?php if($return === false):?>
                    <?php echo $this->renderPartial('_form',array('sign'=>$sign));?>
                <?php else:?>
                    <p class="sign_pass">报名已提交!</p>
                <?php endif;?>
            <?php endif;?>
            <?php $this->widget('ext.widgets.listpage.IListPage',array('model'=>$model));?>
        </div>
    </div> 
<?php $this->widget('ext.widgets.recommand.IRcommand',array('model'=>$model));?>
<?php $this->widget('ext.widgets.read.IRead',array('model'=>$model,'module'=>$this->module->id));?>
<?php $this->widget('ext.widgets.countupload.ICountUpload',array('app_id'=>BaseApp::MEET,'res_id'=>$model['id']));?>
<div class="Comment">
<div class="Comment_title"><span></span>网友评论：<i>20</i> 人参与评论</div>
    <?php $this->widget('ext.widgets.publicComment.IPbulicCommant',array('id'=>$model->id,'app_id'=>BaseApp::MEET));?>
 </div>                  
</div>
    <div class="content_right">
        <?php $this->widget('ext.widgets.rightlist.IsignRecommend',array('model'=>'Meet','title'=>'推荐聚会','app_id'=>BaseApp::MEET));?>
        <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::MEET,'res_id'=>71,'type'=>1,'width'=>312));?>
        <?php $this->widget('ext.widgets.rightlist.IsignHistory',array('model'=>'Meet','title'=>'过往聚会','app_id'=>BaseApp::MEET));?>
   </div>
</div>
<style>
.form{display: block;clear: both;overflow: hidden;}
.form h2{margin: 5px 0;}
.form .row label{width:80px;float: left;text-align: right;margin-right: 5px;line-height: 30px;}
.form .row{width: 370px;float: left;margin: 5px;height: 48px;overflow: hidden;}
.form .row input{width:260px;height: 30px;border:1px solid #ccc;}
.form .rows{text-align: center;clear: both;overflow: hidden;display: block;}
.form .row div.errorMessage{margin-left: 90px;color: #c80303;}
.form .rows input.button{width: 200px;height: 40px;background: #356aa0;color: #fff;font-size: 18px; line-height: 40px; font-weight: 400;border:1px solid #10467d;}
.form .verifyCode{height: 80px;position:relative;z-index: 300;}
.form .verifyCode img{float: left;margin-right: 5px;}
.news_left .sign_pass{text-indent: 2em;border: 1px dotted #ccc;margin: 0;padding: 10px;font-weight: bold;color: red;background: url('/images/note/info.gif') no-repeat;}
</style>
