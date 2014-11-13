<?php 
    $this->breadcrumbs=array('慧学习');
    $js = Yii::app()->getClientScript();
    $js->registerCssFile(Yii::app()->theme->baseUrl.'/css/study.css');
?>
<?php $study_url=Yii::app()->theme->baseUrl."/image/";?>
		<div class="main">
         <div class="left">
           <div class="view">
              <?php $this->widget('ext.widgets.slide.ISlideWidget',array('app_id'=>BaseApp::STUDY,'res_id'=>96,'type'=>1,'width'=>924,'height'=>380));?>
		   </div>
           <div class="course">
           	<h1><em><?php echo CHtml::link('查看全部',$this->createUrl('/study/list/category',array('id'=>'87')),array('target'=>'_blank'));?></em><span>课程精选</span></h1>
                 <div class="detail">
                     <?php foreach ($consultancy as $c):?>
                   	  <ul class="list">
                       	 <li><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($c['track_id'],'study','16_9','thumb'),$c['title'],array('width'=>176,'height'=>125)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('target'=>'_blank','class'=>'img'));?>
                       	 
                         <h2><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($c['title'],10,false)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank'));?></h2>
                                  <p class="discription"><?php echo CHtml::encode(Helper::truncate_utf8($c['discription'],60));?></p>
								  <?php echo CHtml::link('[查看详情]',$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank','class'=>'ceo'));?></li>
                     </ul> 
                     <?php endforeach;?>
                 </div>
                 </div>
             <!--海外游学-->
             <div class="Travel">
                 <h1><em><?php echo CHtml::link('查看全部',$this->createUrl('/study/list/category',array('id'=>'90')),array('target'=>'_blank'));?></em><span>海外游学</span></h1>
                 <div class="detail">
                     <?php foreach ($overseas as $c):?>
                   	  <ul class="list">
                             <li><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($c['track_id'],'study','16_9','thumb'),$c['title'],array('width'=>174,'height'=>124)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('target'=>'_blank','class'=>'img'));?>
                           	    <h2><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($c['title'],10,false)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank'));?></h2>
                                  <p class="discription"><?php echo CHtml::encode(Helper::truncate_utf8($c['discription'],60));?></p>
								  <?php echo CHtml::link('[查看详情]',$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank','class'=>'ceo'));?></li>
                         </ul>
                     <?php endforeach;?>   
             </div>
             </div>
             
             <div class="view">
             		<?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::STUDY,'res_id'=>92,'type'=>1,'width'=>924));?>
             </div>
             
             <div class="ceoyuedu">
                  <h1><em><?php echo CHtml::link('查看全部',$this->createUrl('/study/list/category',array('id'=>'88')),array('target'=>'_blank'));?></em><span>CEO阅读</span></h1>
                    <div class="ceoleft">
                        <?php foreach ($ceoread_3 as $c):?>
                            <h2><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($c['title'],15,false)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank'));?></h2>
                        <?php endforeach;?> 
                            <?php foreach ($ceoread_3 as $c):?>
                            <p class="discription">
                                <?php echo CHtml::encode(Helper::truncate_utf8($c['discription'],200));?>
								<?php echo CHtml::link('[查看详情]',$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank','class'=>'ceo'));?></p>
                            <?php endforeach;?> 
                        <ul>
                            <?php foreach ($ceoread_1 as $c):?>
                        	<li><em></em><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($c['title'],15,false)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank'));?></li>  
                            <?php endforeach;?> 
                        </ul>
                    </div>
                    <div class="ceoleft" style="border:none;">
                        <?php foreach ($ceoread_4 as $c):?>
                        	 <h2><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($c['title'],15,false)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank'));?></h2>
                        <?php endforeach;?> 
                            <?php foreach ($ceoread_4 as $c):?>
                        	<p class="discription">
                                <?php echo CHtml::encode(Helper::truncate_utf8($c['discription'],175));?>
								<?php echo CHtml::link('[查看详情]',$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank','class'=>'ceo'));?></p>
                            <?php endforeach;?> 
                        <ul>
                        	 <?php foreach ($ceoread_2 as $c):?>
                        	<li><em></em><?php echo CHtml::link(CHtml::encode(Helper::truncate_utf8($c['title'],15,false)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank'));?></li>  
                            <?php endforeach;?> 
                        </ul>
                    </div>
         </div>
         </div>
         <div class="sidebar">
             <div class="rightDiv">
                  <h1><em><?php echo CHtml::link('更多',$this->createUrl('/study/list/category',array('id'=>'87')),array('target'=>'_blank'));?></em><span>新课来了</span></h1>
                         <?php foreach ($leftElite_1 as $c):?>
                		  <div class="pic">
                	 			<?php echo CHtml::link(CHtml::image(Storage::getImageBySize($c['track_id'],'study','16_9','thumb'),$c['title'],array('width'=>281,'height'=>160)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('target'=>'_blank'));?>
		              	  </div>
                        <?php endforeach;?> 
                        <div class="news">
                      	  <ul class="newslist">
                               <?php foreach ($lefttitle_1 as $c):?>
                      		<li>
                                <em></em><?php echo CHtml::link(CHtml::encode($c['title']),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank'));?>
                            </li>
                            <?php endforeach;?> 
                           
                          </ul>
                          </div>
                		<?php foreach ($leftElite_2 as $c):?>
                		  <div class="pic">
                	 			<?php echo CHtml::link(CHtml::image(Storage::getImageBySize($c['track_id'],'study','16_9','thumb'),$c['title'],array('width'=>281,'height'=>160)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('target'=>'_blank'));?>
		              	  </div>
                        <?php endforeach;?> 
                        <div class="news">
                			<ul class="newslist">
								 <?php foreach ($lefttitle_2 as $c):?>
                                <li><em></em><?php echo CHtml::link(CHtml::encode($c['title']),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('title'=>$c['title'],'target'=>'_blank'));?></li>
                                <?php endforeach;?> 
                    	  </ul>    
            	</div>
            </div>
            
            <div class="rightDiv">
                    	<h1><em><?php echo CHtml::link('更多',$this->createUrl('/study/list/category',array('id'=>'89')),array('target'=>'_blank'));?></em><span  style="padding-left:5px;">专家讲师团</span></h1>
                   
                    <div class="member">
                     <?php foreach ($instructors as $c):?>
                    <ul class="person">
                    	<li><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($c['track_id'],'study','4_3','thumb'),$c['title'],array('width'=>85,'height'=>85)),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('target'=>'_blank'));?><p><?php echo CHtml::link(CHtml::encode(!empty($c['professor'])?$c['professor']:'暂无数据'),$this->createUrl('/study/list/view',array('id'=>$c['id'])),array('professor'=>$c['professor'],'target'=>'_blank'));?></p>
                        </li>
                    </ul>
                     <?php endforeach;?> 
                     </div>
                </div>
                <?php $this->widget('ext.widgets.tag.ICloudTags',array('title'=>'云标签','app_id'=>BaseApp::STUDY));?>
            <div class="viewthree" style="width:310px; float:right;"> 
                    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::STUDY,'res_id'=>102,'type'=>1,'width'=>310));?>
             </div>
             <div class="pictwo" style="width:310px; float:right;">
                    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::STUDY,'res_id'=>103,'type'=>1,'width'=>310));?>
              </div>   
            
            </div>

         </div>
         
         
         
