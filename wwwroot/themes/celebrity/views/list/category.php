<?php 
    $js = Yii::app()->getClientScript();
    $js->registerCssFile(Yii::app()->theme->baseUrl.'/css/category.css');
?>  
<div class="celebrity_warp">
    <div class="celebrity">
        <div class="left_content">
            <h3><em><?php echo Category::getTitleName(Yii::app()->request->getParam('id'));?></em></h3>
            <div class="list">
                <?php if(empty($model)):?>暂无数据<?php endif;?>
                <?php foreach ($model as $key):?>
                <ul class="personlist">
                    <li><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($key['track_id'],'celebrity','16_9','thumb'),$key['title'],array('width'=>200,'height'=>120)),$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></li>
                    <p><?php echo CHtml::link(Helper::truncate_utf8($key['title'],12),$this->createUrl('/celebrity/list/view',array('id'=>$key['id'])),array('title'=>$key['title'],'target'=>'_blank'));?></p>
                </ul>
                <?php endforeach;?>
                <?php $this->widget('CLinkPager', array(
                    'pages' => $pages,
                    'header'=>false,
                )) ?>
            </div>
        </div>
    </div>
</div>
