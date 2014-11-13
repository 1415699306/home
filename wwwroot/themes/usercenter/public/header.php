<div class='TopNav'>
<div class='TopNavInner'>
    <div class='logo'></div>
    <div class='minNav'>
        <?php echo CHtml::link('首页',$this->createUrl('/site'));?><em>|</em>
        <?php echo CHtml::link('奢生活',$this->createUrl('/life'));?><em>|</em>
        <?php echo CHtml::link('政企通',$this->createUrl('/investment/list'));?><em>|</em>
        <?php echo CHtml::link('乐聚会',$this->createUrl('/meet'));?><em>|</em>
        <?php echo CHtml::link('品牌购','http://shop.lfeel.com/');?><em>|</em>
        <?php echo CHtml::link('乐荟圈','http://quanzi.lfeel.com');?><em>|</em>
        <?php echo CHtml::link('商机汇',$this->createUrl('/trade'));?><em>|</em>
        <?php echo CHtml::link('慧学习',$this->createUrl('/study'));?><em>|</em>
        <?php echo CHtml::link('名人绘',$this->createUrl('/celebrity'));?><em>|</em>
        <?php echo CHtml::link('公益行',$this->createUrl('/community'));?><em>|</em>
        <?php echo CHtml::link('梦想秀',$this->createUrl('/dream'));?><em>|</em>
        <?php echo CHtml::link('乐荟社',$this->createUrl('http://quanzi.lfeel.com'));?>

       
    </div>
    <div class='TopNavRight'>
        <div class='usename'><?php echo CHtml::link(Yii::app()->user->name,$this->createUrl('/usercenter/personal/index'));?></div>
        <div class='E-mial'><a href="#"></a></div>
        <div class='message'><a href="#"></a></div>
    </div>
</div>
</div>