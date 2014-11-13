<?php 
    $js = Yii::app()->getClientScript();
    $js->registerCssFile(Yii::app()->theme->baseUrl.'/css/list.css');
?>
<div class='main'>
<div class='project'>
	<h3><?php echo Category::getTitleName(Yii::app()->request->getParam('id'));?></h3>
    <div class='project_view'>
    	<ul class="list">
            <?php if(!empty($model['image'])):?>
            <?php foreach($model['image'] as $key):?>
           
              
               <li>
                <?php echo CHtml::link(CHtml::image($key['min_thumb'],$key['title'],array('width'=>200,'height'=>150)),$this->createUrl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?>
                <p><?php echo CHtml::encode($key['highlighted']==1 ? ''.CHtml::encode($key['title']) : ''.CHtml::encode($key['title']));?></p>
            </li>              
                      
            <?php endforeach;?>
            <?php else:?>
            <p>暂无数据</p>
            <?php endif;?>
        </ul>
    </div>
    <div class="project_wrap">    	
        <?php if(!empty($model['text'])):?>
        <?php $i=0;?>   
            <?php foreach($model['text'] as $key):?>
            <?php echo $i==0 ? '<ul>':''?>
                <li><?php echo Chtml::link(Chtml::encode($key['title']),$this->createurl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></li>
            <?php echo $i == 3 ? '</ul>' : '';?>
            <?php $i<3 ? ++$i : $i=0;?>
            <?php endforeach;?>
            <?php else:?>
            <p>暂无数据</p>
        <?php endif;?>
    </div>
</div>
<div class='sidebar'>
	<h2>热门推荐</h2>
    <?php foreach($right as $key):?>
    <?php echo Chtml::link(CHtml::image($key['min_thumb'],$key['title'],array('width'=>280,'height'=>120)),$this->createurl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?>
    <?php endforeach;?>
    <ul class="sidebar_list">
        <?php foreach($publicRecommond as $key):?>
        <li><?php echo CHtml::image($key['min_thumb'],$key['title'],array('width'=>138,'height'=>60));?><span><br /><?php echo Chtml::link(CHtml::encode($key['title']),$this->createurl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></span></li>
        <?php endforeach;?>
    </ul>
    
</div>
</div>
</div>
</div>
</div>
<style>
.sidebar_list li a{width: auto;height: auto;text-align: center;}
</style>