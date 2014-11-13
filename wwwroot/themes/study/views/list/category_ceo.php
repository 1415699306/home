<?php
$this->breadcrumbs=array(
    '慧学习'=>Yii::app()->createUrl($this->module->id),
    Category::getTitleName(Yii::app()->request->getParam('id')),
);
$study_url=Yii::app()->theme->baseUrl."/image/";
?>
<div class="main">
    <div class="wrap">
    <div class="advertising">
    	<img src="<?php echo $study_url;?>27.jpg" />
    </div>
    <div class="column">
        	<h1><span>The Recent Party</span>CEO阅读</h1>
        <div class="content">
        	<div class="left">
                <?php foreach($model as $key):?>
            	<div class="list">
                	<div class="leftImg">
                    	<?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'study','4_3','thumb'),$key['title'],array('width'=>201,'height'=>184)),$this->createUrl('/study/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?>
                    </div>
                    <div class="article articles">
                    	<h3><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($key['title'],15,false)),$this->createUrl('/study/list/view',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?></h3>
                        
                        <div class="article_l article_2"><span class="name">简介：</span><span class="text"><?php echo CHtml::encode(Helper::truncate_utf8($key['discription'],120));?></span></div>
                    </div>
                </div>
                <?php endforeach;?>  
                 <?php $this->widget('CLinkPager', array(
            'pages' => $pages,
			'header'=>false,
        )) ?>
            </div>
            <div class="right">
            	<!--课程推荐-->
            	<div class="rightDiv">
					<h2>游学推荐</h2><div class="news"><ul class="newslist">
                    <?php foreach($recommend1 as $key=>$val):?>
                    <?php if($key < 3):?>
                        	 <li><div class="newsImg"><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($val['track_id'],'study','4_3','thumb'),$val['title'],array('width'=>98,'height'=>98)),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('target'=>'_blank'));?></div> <div class="newsText"><h3><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></h3><p>国家：<?php echo CHtml::encode(!empty($val['country'])?$val['country']:'暂无数据');?></p><p>学校：<?php echo CHtml::encode(!empty($val['scholl'])?$val['country']:'暂无数据');?></p><p>课程：<?php echo CHtml::encode(!empty($val['course'])?$val['course']:'暂无数据');?></p></div>
                    <?php else:  ?></li></ul>
                    <div class="ktwo"><span><?php echo ($key+1);?> </span>
                        <div class="ktwocontent"><h3><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></h3>
                            <p>作者：<?php echo CHtml::encode(!empty($val['author'])?$val['author']:'暂无数据');?></p></div></div>
                     <?php endif;?>
                  <?php endforeach;?> 
                        </div>         
                </div>
                <div class="viewtwo">
                	<?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::STUDY,'res_id'=>93,'type'=>1,'width'=>312));?>
                </div>
                <!--推荐阅读-->
				<div class="rightDiv">
                <h2>CEO阅读</h2> <div class="news"><ul class="newslist">
                    <?php foreach($recommend2 as $key=>$val):?>
                    <?php if($key < 3):?>
                        	<li><div class="newsImg"><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($val['track_id'],'study','4_3','thumb'),$val['title'],array('width'=>98,'height'=>98)),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('target'=>'_blank'));?></div>
                        <div class="newsText"><h3><?php echo CHtml::link(CHtml::encode($key['title']),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></h3><p>作者：<?php echo CHtml::encode(!empty($val['author'])?$val['author']:'暂无数据');?></p><p>出版社：<?php echo CHtml::encode(!empty($val['press'])?$val['press']:'暂无数据');?></p><p>出版时间：<?php echo !empty($val['ptime']) ? $val['ptime'] :'暂无数据';?></p></div>
                   <?php else:  ?></li></ul>
                    <div class="ktwo"><span><?php echo ($key+1);?></span>
                        <div class="ktwocontent"><h3><?php echo CHtml::link(CHtml::encode($key['title']),$this->createUrl('/study/list/view',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?></h3><p>作者：<?php echo CHtml::encode(!empty($key['author'])?$key['author']:'暂无数据');?></p></div></div> 
                    <?php endif;?>
                  <?php endforeach;?> 
                    </div> 
                    </div>       
                <div class="rightDiv">
				<h2>讲师推荐</h2><ul class="lector">
                    <?php foreach($expert as $key):?>
                        	<li><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'study','4_3','thumb'),$key['title'],array('width'=>85,'height'=>85)),$this->createUrl('/study/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?><p>
                        	讲师：<?php echo CHtml::encode(!empty($key['professor'])?$val['professor']:'暂无数据');?></p></li>
                   <?php endforeach;?></ul>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<style>
.lone{word-break:break-all;}    
a{color: #444444;display: inline-block;line-height: 18px;text-decoration: none;}
</style>