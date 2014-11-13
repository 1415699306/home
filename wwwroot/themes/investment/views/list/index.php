<?php 
$this->breadcrumbs=array('政企通');
$js = Yii::app()->getClientScript();
$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/list.css');
?>
<?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::INVESTMENT,'res_id'=>19,'type'=>1));?>
    <div class="recommend">
        <h3><span>Headline Recommendation</span>项目推荐</h3>
        <ul>
        <?php static $i=0;?>
        <?php foreach ($top as $key=>$val):?>
        <li <?php echo $i==4 ?  'style="margin-right:0;"':'';?>>
            <?php echo CHtml::link(CHtml::image(!empty($val->thumb) ? Storage::getImageBySize($val->thumb,'investment','16_9','thumb'):'',$val->title,array('width'=>200,'height'=>155)),$this->createUrl('/investment/default',array('id'=>$val->id)),array('target'=>'_blank'));?>
            <em><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($val->title),10),$this->createUrl('/investment/default',array('id'=>$val->id)),array('title'=>$val->title,'target'=>'_blank'));?></em>
            <p class="discription"><?php echo Helper::truncate_utf8(CHtml::encode($val->discription),120);?></p>
            <p><?php echo CHtml::link('点击查看全部»',$this->createUrl('/investment/default',array('id'=>$val->id)));?></p>
        </li>
        <?php ++$i;?> 
        <?php endforeach;?>
        </ul>
    </div>
    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::INVESTMENT,'res_id'=>100,'type'=>1,'width'=>1230));?>
    <?php foreach($list as $key=>$c):?>
    
    <div class="project_view">
    <div class="list-view">
        <h3><?php echo CHtml::image("/themes/investment/images/list_{$key}.jpg");?><?php echo CHtml::link('查看更多项目',$this->createUrl('/investment/list/category',array('id'=>$key)));?></h3>
        <ul>
        <?php foreach(Investment::getDataByCategory($key,4) as $v):?>
        <li>
            <?php echo CHtml::link(CHtml::image(!empty($v['thumb']) ? Storage::getImageBySize($v['thumb'],'investment','16_9','thumb'):'',$v['title'],array('width'=>200,'height'=>155)),$this->createUrl('/investment/default',array('id'=>$v['id'])),array('target'=>'_blank'));?>
            <p><?php echo Helper::truncate_utf8(CHtml::encode($v['discription']),80);?></p>
        </li>
        <?php endforeach;?>
        </ul>
    </div>
    </div>
    <?php ++$i;?>
    <?php endforeach;?>
    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::INVESTMENT,'res_id'=>101,'type'=>1,'width'=>1230));?>

