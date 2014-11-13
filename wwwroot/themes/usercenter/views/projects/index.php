<?php
$js = Yii::app()->getClientScript();
$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/index.css');
?>
<div class='RightDiv'>
       	  <div class='bigDiv'>
              <h1><?php echo Yii::app()->user->name;?></h1>
                <p>2013年05月16日 加入点名时间</p>
                <p>户外纪录片预售项目发起人、中国英文户外资料网站长、国家三级心理咨询师</p>
                <p>博客或微博</p>
                <p><a href="#">http://weibo.com/1803710461/profile?topnav=1&wvr=5 </a></p>
                <p><a href="#">http://weibo.com/rosewinde</a></p>
            </div>
        	<div class='bigDiv'>
                <div class='subtitle'>我的梦想</div>
                <?php if(!empty($dreams)):?>
                <div class='content'>
                    <?php foreach($dreams as $dream):?>
            		<div class='listdiv'>
                        <div class='listTop'></div>
                        <div class='list'>
                            <div class='pic'><?php echo  CHtml::link(CHtml::image(!empty($dream->thumbs->track_id)?Storage::getImageBySize($dream->thumbs->track_id,'dream',null,'thumb'):'/images/no-image.png',$dream->title,array('width'=>265,'height'=>143)),$this->createUrl('/dream/projects/view',array('id'=>$dream->id)),array('target'=>'_blank'));?><span class='float'><?php echo Dream::getStatus($dream->status);?></span></div>
                            <div class='text'>
                                <h2><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($dream->title),16),$this->createUrl('/dream/projects/view',array('id'=>$dream->id)),array('target'=>'_blank'));?></h2>
                                <p><?php echo Helper::truncate_utf8(CHtml::encode($dream->discription),65);?></p>
                            </div>
                            <?php if(1 < $dream->status):?>
                            <div class='view-bar'>
                                <div class='speed'></div>
                            </div>
                            <div class='textList'>
                                <ul class='complete'>
                                    <li class='f_size'><?php echo $dream->targetItems.'%';?></li>
                                    <li>达到</li>
                                </ul>
                                <ul class='support'>
                                    <li><span>¥</span><span class='f_size'><?php echo $dream->payment;?></span></li>
                                    <li>已获支持</li>
                                </ul>
                                <ul class='date'>
                                    <li  class='f_size'><span class='f_size'><?php echo $dream->lastDays;?></span>天</li>
                                    <li>剩余时间</li>
                                </ul>
                         </div>
                            <?php else:?>
                            <div class='function'>
                                <?php echo CHtml::link('修改',$this->createUrl('/usercenter/projects/update',array('id'=>$dream['id'])));?>
                                <?php echo CHtml::link('删除',$this->createUrl('/usercenter/projects/delete',array('id'=>$dream['id'])),array('id'=>'delete'));?>
                            </div>
                            <?php endif;?>
                      </div>
                    <div class='listBottom'></div>           
                </div>
                    <?php endforeach;?>
                </div>
                <?php else:?>
            	<div class='subButtom'>
                    <div class='subButtom_left'><?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl.'/images/Personal_33.jpg'),$this->createUrl('/usercenter/projects/create'),array('target'=>'_blank'));?></div>
                    <div class='subButtom_right'>
                        <div class='sub_img'><?php echo CHtml::image(Yii::app()->theme->baseUrl.'/images/Personal_34.jpg');?></div>
                        <div class='sub_text'>
                            <span>梦想的分类：</span><br />
                            <a href="#" class='textarea'>设计</a>
                            <a href="#" class='textarea'>科技</a>
                            <a href="#" class='textarea'>影视</a>
                            <a href="#" class='textarea'>摄影</a>
                            <a href="#" class='textarea'>音乐</a>
                            <a href="#" class='textarea'>出版</a>
                            <a href="#" class='textarea'>活动</a>
                            <a href="#" class='textarea'>游戏</a>
                            <a href="#" class='textarea'>旅行</a>
                            <a href="#" class='textarea'>其他</a>
                        </div>
                    </div>
                </div>
                <?php endif;?>
            </div>
        	<div class='bigDiv'>
            	<div class='subtitle'>我支持中梦想</div>
                <div class='content'>
                    <?php foreach ($supports as $support):?>
                	<div class='listdiv'>
                        <div class='listTop'></div>
                        <div class='list'>
                            <div class='pic'><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($support->dreamPledge->dream->thumbs->track_id,'dream',null,'thumb'),$support->dreamPledge->dream->title,array('width'=>265,'height'=>143)),$this->createUrl('/dream/projects/view',array('id'=>$support->id)),array('target'=>'_blank'));?><span class='float'><?php echo Dream::getStatus($support->dreamPledge->dream->status);?></span></div>
                            <div class='text'>
                                <h2><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($support->dreamPledge->dream->title),16),$this->createUrl('/dream/projects/view',array('id'=>$support->dreamPledge->dream->id)),array('target'=>'_blank'));?></h2>
                                <p><?php echo Helper::truncate_utf8(CHtml::encode($support->dreamPledge->dream->discription),65);?></p>
                            </div>
                            <div class='view-bar'>
                                <div class='speed'></div>
                            </div>
                            <div class='textList'>
                                <ul class='complete'>
                                    <li class='f_size'><?php echo $support->dreamPledge->dream->targetItems.'%';?></li>
                                    <li>达到</li>
                                </ul>
                                <ul class='support'>
                                    <li><span>¥</span><span class='f_size'><?php echo $support->dreamPledge->dream->payment;?></span></li>
                                    <li>已获支持</li>
                                </ul>
                                <ul class='date'>
                                    <li  class='f_size'><span class='f_size'><?php echo $support->dreamPledge->dream->lastDays;?></span>天</li>
                                    <li>剩余时间</li>
                                </ul>
                            </div>
                        </div>
                        <div class='listBottom'></div>       
                    </div>
                    <?php endforeach;?>
                </div>
                <?php if(empty($dreams) && empty($supports)):?>
            	<div class='subButtom'>
                    <div class='subButtom_left'><?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl.'/images/Personal_42.jpg'),$this->createUrl('/usercenter/projects/create'),array('target'=>'_blank'));?></div>
                    <div class='subButtom_right'>
                        <div class='sub_img'><?php echo CHtml::image(Yii::app()->theme->baseUrl.'/images/Personal_43.jpg');?></div>
                        <div class='sub_text'>
                            <span>梦想的分类：</span><br />
                            <a href="#" class='textarea'>设计</a>
                            <a href="#" class='textarea'>科技</a>
                            <a href="#" class='textarea'>影视</a>
                            <a href="#" class='textarea'>摄影</a>
                            <a href="#" class='textarea'>音乐</a>
                            <a href="#" class='textarea'>出版</a>
                            <a href="#" class='textarea'>活动</a>
                            <a href="#" class='textarea'>游戏</a>
                            <a href="#" class='textarea'>旅行</a>
                            <a href="#" class='textarea'>其他</a>
                        </div>
                    </div>
                </div>
            </div>
        	<div class='bigDiv style'>
            	<div class='subtitle'>推荐梦想</div>
                <div class='content'>
                    <?php foreach ($discoverys as $discovery):?>
                	<div class='listdiv'>
                        <div class='listTop'></div>
                        <div class='list'>
                            <div class='pic'><?php echo CHtml::link(CHtml::image(!empty($discovery->thumbs->track_id)?Storage::getImageBySize($discovery->thumbs->track_id,'dream',null,'thumb'):'/images/no-image.png',$discovery->title,array('width'=>265,'height'=>143)),$this->createUrl('/dream/projects/view',array('id'=>$discovery->id)),array('target'=>'_blank'));?><span class='float'><?php echo Dream::getStatus($discovery->status);?></span></div>
                            <div class='text'>
                                <h2><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($discovery->title),16),$this->createUrl('/dream/projects/view',array('id'=>$discovery->id)),array('target'=>'_blank'));?></h2>
                                <p><?php echo Helper::truncate_utf8(CHtml::encode($discovery->discription),65);?></p>
                            </div>
                            <div class='view-bar'>
                                <div class='speed'></div>
                            </div>
                            <div class='textList'>
                                <ul class='complete'>
                                    <li class='f_size'><?php echo $discovery->targetItems.'%';?></li>
                                    <li>达到</li>
                                </ul>
                                <ul class='support'>
                                    <li><span>¥</span><span class='f_size'><?php echo $discovery->payment;?></span></li>
                                    <li>已获支持</li>
                                </ul>
                                <ul class='date'>
                                    <li  class='f_size'><span class='f_size'><?php echo $discovery->lastDays;?></span>天</li>
                                    <li>剩余时间</li>
                                </ul>
                         </div>
                      </div>
                        <div class='listBottom'></div>           
                    </div>
                    <?php endforeach;?>          		
                </div>
        </div>
        <?php endif;?>
    	</div>
   </div>
</div>