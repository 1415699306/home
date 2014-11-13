<?php 
    $js = Yii::app()->getClientScript();
    $js->registerCssFile(Yii::app()->theme->baseUrl.'/css/gxy.css');
?>
<div class='community_main'>
        	<div class='g_sidebar'>
            <div class='g_banner'>
                <?php $this->widget('ext.widgets.slide.ISlideWidget',array('app_id'=>BaseApp::COMMUNITY,'res_id'=>78,'type'=>1,'width'=>924,'height'=>380));?>
            </div>
            <div class='g_Information'>
                <h1><em><?php echo CHtml::link('查看全部>>',$this->createUrl('/community/list/category',array('id'=>'74')),array('target'=>'_blank'));?></em><span>公益资讯</span></h1>
                
                <div class="Information_right">
                	<ul class="right_list">
                        <?php if(empty($consultancy)):?><p>暂无数据</p><?php endif;?>
                        <?php foreach ($consultancy as $c):?>
                    	<li>
                            <em><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($c['track_id'],'community','4_3','thumb'),$c['title'],array('width'=>83,'height'=>83)),$this->createUrl('/community/list/view',array('id'=>$c['id'])),array('target'=>'_blank'));?></em>
                            <strong><?php echo CHtml::link(CHtml::encode($c['title']),$this->createUrl('/community/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank'));?></strong>  
                            <p><?php echo CHtml::encode($c['discription']);?></p>
                        </li>     
                        <?php endforeach;?>
                        <div style="clear:both"></div>
                     </ul>
                </div> 
            </div>
                
            <div class='Platform'>
            	<h1><em><?php echo CHtml::link('查看全部>>',$this->createUrl('/community/list/category',array('id'=>'83')),array('target'=>'_blank'));?></em><span>求助平台</span></h1>
                <!--<div class='Platform_left'>-->
                <ul class="Platform_left_list" style="margin: 20px 0 0 30px; display:inline;">
                    <?php if(empty($SeekHelpImage)):?><p>暂无数据</p><?php endif;?>
                    <?php foreach($SeekHelpImage as $s):?>
                	<li>
                        <?php echo CHtml::link(CHtml::image(Storage::getImageBySize($s['track_id'],'community','4_3','thumb'),$s['title'],array('width'=>100,'height'=>80)),$this->createUrl('/community/list/view',array('id'=>$s['id'])),array('target'=>'_blank'));?>
                        <p><?php echo CHtml::link(CHtml::encode($s['title']),$this->createUrl('/community/list/view',array('id'=>$s['id'])),array('title'=>$s['title'],'target'=>'_blank'));?></p>
                    </li>
                    <?php endforeach;?>
                </ul> 
                   <ul class="right_list">
                       <?php if(empty($SeekHelpText)):?><p>暂无数据</p><?php endif;?>
                        <?php foreach($SeekHelpText as $se):?>
                    	<li><?php echo CHtml::link(CHtml::encode($se['title']),$this->createUrl('/community/list/view',array('id'=>$se['id'])),array('title'=>$se['title'],'target'=>'_blank'));?></li>   
                        <?php endforeach;?>                        
                     </ul>	
               <!-- </div>-->
            </div>
            <div class="gb_wrap">
                <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::COMMUNITY,'res_id'=>80,'type'=>1,'width'=>925));?>
            </div>
             <div class='persom'>
            	<h1><em><?php echo CHtml::link('查看全部>>',$this->createUrl('/community/list/category',array('id'=>'76')),array('target'=>'_blank'));?></em><span>公益人物</span></h1>
                <?php if(empty($Character)):?><p>暂无数据</p><?php endif;?>
                <?php $i=0;?>
                <?php foreach($Character as $h):?>
               	 <?php echo $i==0 ? '<ul class="left_list">':''?>
                    <li><?php echo CHtml::link(CHtml::encode($h['title']),$this->createUrl('/community/list/view',array('id'=>$h['id'])),array('title'=>$h['title'],'target'=>'_blank'));?></li>             
                 <?php echo $i==9 ? '</ul>':''?>
                 <?php $i < 9 ? ++$i : $i=0;?>
                <?php endforeach;?>
            </div>
            </div>
            <div class='g_right' style='float:right;'>
            	<div class='active'>
                    <h1><em><?php echo CHtml::link('查看全部>>',$this->createUrl('/community/list/category',array('id'=>'73')),array('target'=>'_blank'));?></em><span>活动预告</span></h1>
                    <?php if(empty($Notice)):?><p>暂无数据</p><?php endif;?>
                    <?php foreach($Notice as $lk=>$ln):?>
                    <?php if($lk==0):?>
                    <h2>
                    <?php echo CHtml::link(CHtml::image(Storage::getImageBySize($ln['track_id'],'community','16_9','thumb'),$ln['title'],array('width'=>281,'height'=>139)),$this->createUrl('/community/list/view',array('id'=>$ln['id'])),array('target'=>'_blank'));?>
                    <strong><?php echo CHtml::link(CHtml::encode($ln['title']),$this->createUrl('/community/list/view',array('id'=>$ln['id'])),array('title'=>$ln['title'],'target'=>'_blank'));?></strong>
                    <p><?php echo CHtml::decode($ln['discription']);?><span><?php echo CHtml::link('[详细]',$this->createUrl('/community/list/view',array('id'=>$ln['id'])),array('title'=>$ln['title'],'target'=>'_blank'));?></span></p></h2>
                    <?php else:?>
                    <?php $lk =='1' ? '<ul class="activ_list">':'';?>
                      <li class="active_list"><?php echo CHtml::link(CHtml::encode($ln['title']),$this->createUrl('/community/list/view',array('id'=>$ln['id'])),array('title'=>$ln['title'],'target'=>'_blank'));?></li>      
                    <?php $lk =='1' ? '</ul>':'';?>
                    <?php endif;?>
                    <?php endforeach;?>
                </div>
                <div class='g_wrap'>
                    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::COMMUNITY,'res_id'=>81,'type'=>1,'width'=>312));?>
                </div>
                <div class='Activity'>
                <h1><span>过往活动</span></h1>
                	<ul class='Activity_list'>
                        <?php foreach ($history as $key):?>
                    	<li>
                            <em><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'community','4_3','thumb'),$key['title'],array('width'=>80,'height'=>80)),$this->createUrl('/community/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></em>
                            <?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($key['title']),12),$this->createUrl('/community/list/view',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?>
                            <span><?php echo CHtml::encode(!empty($key['discription'])?Helper::truncate_utf8($key['discription'],45):'');?></span>
                        </li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class='g_wrap'>
                    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::COMMUNITY,'res_id'=>82,'type'=>1,'width'=>312));?>
                </div>
                
                
                </div>
            </div>
        </div>
        
