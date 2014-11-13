<?php $js = Yii::app()->clientScript;$js->registerCssFile('/css/view.css');$js->registerScriptFile('/js/fancy/jquery.fancybox.js');$js->registerCssFile('/js/fancy/jquery.fancybox.css');?>
<?php $this->pageTitle='名人绘_'.$model->title.'_乐荟网';?>
<div class="main">
<?php
$this->breadcrumbs=array(
    '名人绘'=>DIRECTORY_SEPARATOR.$this->module->id,
    $model['title'],
);
?>
<div class="news_left">
	<div class="news_top">
    	<div class="title">
        	<h1><?php echo CHtml::encode($model->title);?></h1>
            <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'public_top_list');?>
            <div class="video">
                <div class="player">   
					<?php if(!empty($model['video_url']) && $model['video_url']!=HOME_URL):?>
                    <?php $this->widget('ext.EjwPlayer.EjwPlayer',array(
                    'width' => 500,
                    'height' => 380,
                    'title' => 'Video',
                    'controls' => 'true',
                    'fallback'=>'true',
                    'primary'=>'flash',
                    'playlist' => array(
                        array(
                            'sources' => array(
                                array('file' =>$model['video']),
                            )
                        ),
                    ),
                )); ?>     
				<?php else:?>
                 <img width="400" height="360" src="/images/video.jpg" >
            <?php endif;?>
                </div>
                <span><label>访谈时间:</label><?php echo date('Y-m-d H:i:s',$model['interview_time']);?></span>
                <span><label>嘉宾:</label><?php echo CHtml::encode($model['guests']);?></span>
                <span><label>简介:</label><?php echo CHtml::encode($model['discription']);?></span>
            </div>
            <div class="text">文字语录</div>
            <div class="new_content"><?php echo  BaseApp::pageByContent($model->celebrityContent->content,$model->celebrityContent->pages);?></div>
            <?php $this->widget('ext.widgets.listpage.IListPage',array('model'=>$model));?>
        </div>
    </div> 
<?php $this->widget('ext.widgets.recommand.IRcommand',array('model'=>$model,'thumb'=>'celebrity'));?>
<?php $this->widget('ext.widgets.read.IRead',array('model'=>$model,'module'=>$this->module->id));?>
<?php $this->widget('ext.widgets.countupload.ICountUpload',array('app_id'=>BaseApp::CELEBRITY,'res_id'=>$model['id']));?>
<div class="Comment">
<div class="Comment_title"><span></span>网友评论：<i><?php echo PublicComment::getCommantCount(Yii::app()->request->getParam('id'),BaseApp::CELEBRITY);?></i> 人参与评论</div>
    <?php $this->widget('ext.widgets.publicComment.IPbulicCommant',array('id'=>$model->id,'app_id'=>BaseApp::CELEBRITY));?>
 </div>                   
</div>
    <div class="content_right">
        <?php $this->widget('ext.widgets.rightlist.INewsList',array('model'=>'Celebrity','title'=>'访谈实录','app_id'=>BaseApp::CELEBRITY));?>
        <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::CELEBRITY,'res_id'=>60,'type'=>1,'width'=>312));?>
   </div>
</div>

    