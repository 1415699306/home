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
	<h1><span>The Recent Party</span>专家讲师</h1>
        <div class="content">
        	<div class="left">
                <?php foreach($model as $key):?>
            	<div class="list">
                	<div class="leftImg">
                    	<?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'study','4_3','thumb'),$key['title'],array('width'=>201,'height'=>184)),$this->createUrl('/study/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?>
                    </div>
                    <div class="article">
                    	<h3><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($key['title'],10,false)),$this->createUrl('/study/list/view',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?></h3>
                        
                        <div class="article_l"><span class="name">讲师：</span><span class="text"><?php echo CHtml::encode(!empty($key['professor'])?$key['professor']:'暂无数据');?></span></div>
                       <div class="article_l"><span class="name">介绍：</span><span class="text"><?php echo CHtml::encode(Helper::truncate_utf8($key['discription'],120));?></span></div>
                    </div>
                    <div class="tip">
                    	<div class="shipmianf">视频费用</div>
                        <div class="damianf">免费</div>
                    	<div class="numb"><em><i class="one"></i>158</em>|<em><i class="two"></i>3</em></div>
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
					<h2>课程推荐</h2><div class="news"><ul class="newslist">
                    <?php foreach($recommend1 as $key=>$val):?>
                     <?php if($key < 3):?>
                        	<li><div class="newsImg"><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($val['track_id'],'study','4_3','thumb'),Helper::truncate_utf8($val['title'],5),array('width'=>98,'height'=>98)),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('target'=>'_blank'));?></div>
                        <div class="newsText">
	                        	<h3><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($val['title'],5)),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></h3>
                                <p>讲师：<?php echo CHtml::encode(!empty($val['professor'])?$val['professor']:'暂无数据');?></p>
                                <p>类型：<?php echo CHtml::encode(!empty($val['vidty'])?$val['vidty']:'暂无数据');?></p>
            	             </div>
                    <?php else:  ?></li></ul>
                    <div class="ktwo"><span><?php echo ($key+1);?></span>
                        <div class="ktwocontent">
                        	<h3><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?>
                            </h3>
                            <p>讲师：<?php echo CHtml::encode(!empty($val['professor'])?$val['professor']:'暂无数据');?></p></div></div>
                      <?php endif;?>
                  <?php endforeach;?>
                   </div>
                   </div>
				<div class="viewtwo">
                	<?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::STUDY,'res_id'=>93,'type'=>1,'width'=>312));?>
                </div>
            	
                

                <!--推荐阅读-->
				<div class="rightDiv">
					<h2>专家讲师</h2> <div class="news"><ul class="newslist">
                    <?php foreach($recommend2 as $key=>$val):?>
                    <?php if($key < 3):?>
                                       	<li><div class="newsImg"><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($val['track_id'],'study','4_3','thumb'),$val['title'],array('width'=>98,'height'=>98)),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('target'=>'_blank'));?>
                        </div>
                        <div class="newsText">
	                        	<h3><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?>
        	                 </h3>
                               <p>讲师：<?php echo CHtml::encode(!empty($val['professor'])?$val['professor']:'暂无数据');?></p>
                               <p>视频时长：<?php echo CHtml::encode(!empty($val['video'])?$val['video']:'暂无数据');?></p>   
            	             </div>
                  <?php else:  ?></li> </ul>
                    <div class="ktwo"><span><?php echo ($key+1);?></span>
                        <div class="ktwocontent">
                            	<h3><?php echo CHtml::link(CHtml::encode($val['title']),$this->createUrl('/study/list/view',array('id'=>$val['id'])),array('title'=>$val['title'],'target'=>'_blank'));?></h3>
                            <p>讲师：<?php echo CHtml::encode(!empty($val['professor'])?$val['professor']:'暂无数据');?></p>
                            </div> 
               			 </div>
                        
                     <?php endif;?>
                  <?php endforeach;?> 
				</div>
                </div>
                <!---->
                <div class="rightDiv">
					<h2>讲师推荐</h2> <ul class="lector">
                    <?php foreach($expert as $key):?>
                    <li>
                        	<?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'study','4_3','thumb'),$key['title'],array('width'=>85,'height'=>85)),$this->createUrl('/study/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?>
                        <p>讲师：<?php echo CHtml::encode(!empty($key['professor'])?$val['professor']:'暂无数据');?>
                        </p>
                    </li>
                     <?php endforeach;?> </ul>   
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