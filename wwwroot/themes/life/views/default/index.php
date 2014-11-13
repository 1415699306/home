<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/ssh.css');?>
<?php $this->breadcrumbs=array('奢生活');?>
<div class="slide_top">
<?php $this->widget('ext.widgets.slide.ISlideWidget',array('app_id'=>BaseApp::LIFE,'res_id'=>36,'type'=>0));?>  		
</div>
<div class="main">
    <?php $i=1;?>
    <?php foreach($category as $key=>$val):?>
    <?php if($i===3):?>
    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::LIFE,'res_id'=>97,'type'=>1,'width'=>1250));?>
    <?php endif;?>
    <?php if($i===6):?>
    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::LIFE,'res_id'=>98,'type'=>1,'width'=>1250));?>
    <?php endif;?>
    <?php if($i===9):?>
    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::LIFE,'res_id'=>99,'type'=>1,'width'=>1250));?>
    <?php endif;?>
    <div class="Jewelry">
        <h3><span><?php echo CHtml::link('查看全部',$this->createUrl('/life/list/category',array('id'=>$key)),array('target'=>'_blank'));?></span><?php echo $val;?></h3>
        <div class="content">
            <?php $models = Life::getList($key);?>
            <?php foreach($models as $v):?>
            <ul class="list">
                <li><strong><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($v['title']),14),$this->createUrl('/life/list/view',array('id'=>$v['id'])),array('title'=>$v['title'],'target'=>'_blank'));?></strong>               
                <span id="img_url" link_href="<?php echo $this->createUrl('/life/list/view',array('id'=>$v['id']));?>" img_title="<?php echo $v['title']?>" img_url="<?php echo Storage::getImageBySize($v['track_id'],'life','16_9','thumb');?>"></span>   
                <p><?php echo Helper::truncate_utf8(CHtml::encode($v['discription']),50);?></p>
                <?php echo CHtml::link('详细',$this->createUrl('/life/list/view',array('id'=>$v['id'])),array('title'=>$v['title'],'target'=>'_blank'));?>
                </li>              
            </ul>
            <?php endforeach;?>
        </div>
    </div>
    <?php ++$i;?>
    <?php endforeach;?>
</div>
<style>
.Jewelry{display: block;clear: both;overflow: hidden;padding-bottom: 15px;}ul.list li{height: 250px;}ul.list p{float: left;clear: both;overflow: hidden;display: block;margin: 10px 0 0 0;}ul.list li span a{width:250px;height:140px;}.content ul.list li a{padding: 0px 15px 15px 15px;}strong{padding:0;}strong a{width: 100%;padding:0;color:#000;font-size:14px;}.content ul.list li a {padding: 0;width: 100%;color:#444;}.content ul.list li a.btn{float:right;width: 30px;padding: 0 5px;color:#2d3646;}
</style>
<script>
jQuery(function($){
    new lazy($('ul.list li span#img_url'),'img_url','250','140');
});
</script>