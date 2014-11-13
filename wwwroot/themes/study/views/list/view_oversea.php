<?php $this->pageTitle='慧学习_'.$model->title.'_乐荟网';?>
<?php $study_url=Yii::app()->theme->baseUrl."/image/";?>
<?php $js = Yii::app()->clientScript;$js->registerCssFile('/css/view.css');?>
<?php
$this->breadcrumbs=array(
    '慧学习'=>DIRECTORY_SEPARATOR.$this->module->id,
    $model->category->name=>Yii::app()->createUrl($this->module->id.'/list/category',array('id'=>$model->category->id)),
    $model->title,
);
?>
<div class="main">
    	<div class="mainTop">
        <div class="leftVideo">
		<?php if(!empty($model['video_url']) && $model['video_url']!=HOME_URL):?>
    		<?php $this->widget('ext.EjwPlayer.EjwPlayer',array(
                        'width' => 400,
                        'height' => 360,
                        'title' => 'Video',
                        'controls' => 'true',
                        'fallback'=>'true',
                        'primary'=>'flash',
                        'playlist' => array(
                            array(
                                'sources' => array(
                                    array('file' =>$model['video_url']),
                                )
                            ),
                        ),
                    )); ?>
            <?php else:?>
                 <img width="400" height="360" src="/images/video.jpg" >
            <?php endif;?>
    	</div>
        <div class="rightText">
        	<h1><?php echo CHtml::encode($model->title);?></h1>
            <div class="zywztwo">
            	<p class="description">国家：<?php echo CHtml::encode(!empty($model->country)?$model->country:'暂无数据');?></p>
                <p class="description">学校：<?php echo CHtml::encode(!empty($model->scholl)?$model->scholl:'暂无数据');?></p>
				<p class="description">课程：<?php echo CHtml::encode(!empty($model->course)?$model->course:'暂无数据');?></p>
                <p class="description">适合岁数：<?php echo CHtml::encode(!empty($model->suitable)?$model->suitable:'暂无数据');?></p>
                <p class="description">费用：<?php echo CHtml::encode(!empty($model->cost)?$model->cost:'暂无数据');?></p>
            <p class="description"><em class="Tag"></em><?php $this->widget('ext.widgets.tag.ITags',array('app_id'=>BaseApp::STUDY,'res_id'=>$model->id));?></div>
            <div class="pastext"><div class="Summary">课程摘要：</div>
                <p><?php echo CHtml::encode($model->discription);?></p>
            </div>
            <div class="zywzfive">
            	<ul>
                     <a href="javascript:void(0)" class="sina public" onclick="wei();">新浪微博</a>
                    <a href="javascript:void(0)" onclick="postToWb();" class="qq public" title="分享到腾讯微博">腾讯微博</a>
                    <a class="favorites public" href="javascript:;" onclick="javascript:addFavorite2();">收藏本页</a>
                </ul>
            </div>
        </div>
    </div>
      <div class="main_bottom">
    	<div class="main_left">
			<div class="mydzlone">	
                <div class="new_content"><?php echo  BaseApp::pageByContent($model->studyContent->content,$model->studyContent->pages);?></div>
                 <?php $this->widget('ext.widgets.listpage.IListPage',array('model'=>$model));?>
            </div>

           <?php $this->widget('ext.widgets.recommand.IRcommand',array('model'=>$model,'thumb'=>'study'));?>
            <?php $this->widget('ext.widgets.countupload.ICountUpload',array('app_id'=>BaseApp::STUDY,'res_id'=>$model['id']));?>
                      
<div class="Comment">
    <div class="Comment_title">  
    <div class="Comment_title"><span></span>网友评论：<i><?php echo PublicComment::getCommantCount(Yii::app()->request->getParam('id'),BaseApp::STUDY);?></i> 人参与评论</div>
    <?php $this->widget('ext.widgets.publicComment.IPbulicCommant',array('id'=>$model->id,'app_id'=>BaseApp::STUDY));?>
    </div>
 </div>
</div>
        
        
        <div class="right">
			<!--推荐阅读-->
				<div class="rightDiv nobor">
					<h2>游学推荐</h2> <div class="news"><ul class="newslist">
                    <?php foreach($recommend as $key=>$val): ?>
                    <?php if($key < 3):?>
                            <li><div class="newsImg"><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($val['track_id'],'study','4_3','thumb'),$val['title'],array('width'=>99,'height'=>99)),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('target'=>'_blank'));?>
                        </div>
                        <div class="newsText"><h3><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?>
        	                 </h3>
                                <p>国家：<?php echo CHtml::encode($val['country']);?></p>
                                <p>学校：<?php echo CHtml::encode($val['scholl']);?></p>
                                <p>介绍：<?php echo CHtml::encode(Helper::truncate_utf8($val['discription'],15));?></p>
            	             </div>
                    <?php else:?></li></ul>
                    <div class="ktwo">
                    	<span><?php echo ($key+1);?></span>
                        <div class="ktwocontent"><h3><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?>
                            </h3>
                            <p>国家：<?php echo CHtml::encode($val['country']);?></p></div> 
                </div>
                    <?php endif;?>
                     <?php endforeach;?>
                </div>
                </div>
                <!--马上登记-->
                <div id="msview">
                	<?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::STUDY,'res_id'=>94,'type'=>1,'width'=>312));?>
                </div>
                
                <!--专家讲师-->
                	<div class="rightDiv">
                    	<h2>专家讲师</h2><ul class="lector">
                    <?php foreach($expert as $key): ?>
                    <li><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'study','4_3','thumb'),$key['title'],array('width'=>79,'height'=>80)),$this->createUrl('/study/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?>
                        	<p>讲师：<?php echo CHtml::encode($key['professor']);?></p></li>
                    
                    <?php endforeach;?></ul>


    </div>
    </div> 

</div>
<style>
    .mydzlone{
     clear: both;
     border-bottom: 1px solid #A9A9A9;
     overflow: hidden;
     width: 922px;
    }
    


    .new_bL{
        float: left;
        padding-left: 20px;
    }
    
.new_bR p {
    background: url("/themes/life/images/new_05.jpg") no-repeat scroll right 0  transparent ;
 
}

#zy .zywenzi {
    float: left;
    padding-left: 10px;
    width: 590px;
}

#tjjsleft {
width: 920px;
background-color: white;
float: left;
}

.zywzfour{
    word-wrap: break-word; word-break: normal;
}

.kone{
    word-break:break-all;
}

.tjkcyd{
     margin-top: 3px;
}

.public {
    background: url("/images/view_icon.png") no-repeat scroll 0 0 transparent;
    height: 25px;
    line-height: 25px;
    margin-right: 15px;
    text-indent: 2.5em;
    width: 86px;
}


#tjjsleft{
     border: 1px solid #A9A9A9;
}

.zywzft {
    margin: 5px;
}
</style>


    

