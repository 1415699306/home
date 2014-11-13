<?php
$this->breadcrumbs=array(
    '商机汇竞价排名',
);
?>
<div class="inner"> 
<?php if(Yii::app()->user->hasFlash('trade_list')):?>  
<?php $this->renderPartial('ext.toastMessage.views.toastView',array('message'=>Yii::app()->user->getFlash('trade_list'),'type'=>'success', 'options'=>array('sticky'=>false, 'position'=>'top-right', 'stayTime'=>2000)),false,false);?>
<?php endif;?>
    <?php if($model === null):?>
        <h3>选择要修改的分类数据</h3>
        <?php echo CHtml::form();?>
        <?php echo CHtml::dropDownList('category',0, $category);?>
        <?php echo CHtml::submitButton('提交');?>
        <?php echo CHtml::endForm();?>
    <?php elseif(is_array($model)):?>
        <?php $this->renderPartial('form/_listform',array('model'=>$model));?>
    <?php else:?>
        <p>暂无数据</p> - <?php echo CHtml::link('返回',$this->createUrl('/backend/trade/list'));?>
    <?php endif;?>
</div>