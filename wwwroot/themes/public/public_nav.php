<div class="nav">
    	<div class="left iconpng"></div>
        <div class="mid">
            <?php $module = !empty(Yii::app()->controller->module->id) ? Yii::app()->controller->module->id : null ;?>
			<!--<a href="/site" style="border-right:none; width:110px;"><div class="home"><!--<img src="images/home.png" style="position:relative; left:-3px; top:-2px;" />首页</div></a>-->
			<?php echo CHtml::link('<div class="home">首页</div>',$this->createUrl('/site'),array('style'=>'border-right:none; width:110px;','class'=>Yii::app()->controller->id == 'site' ? 'hover' : ''));?>
            <?php echo CHtml::link('奢生活',$this->createUrl('/life'),array('class'=>$module == 'life' ? 'hover' : ''));?>
            <?php echo CHtml::link('政企通',$this->createUrl('/investment/list'),array('class'=>$module == 'investment' ? 'hover' : ''));?>
            <?php echo CHtml::link('乐聚会',$this->createUrl('/meet'),array('class'=>$module == 'meet' ? 'hover' : ''));?>
             <a href="http://shop.lfeel.com">品牌购</a> 
             <a href="http://quanzi.lfeel.com/">乐荟圈</a>    
                   
            <?php echo CHtml::link('商机汇',$this->createUrl('/trade'),array('class'=>$module == 'trade' ? 'hover' : ''));?>
            <?php echo CHtml::link('慧学习',$this->createUrl('/study'),array('class'=>$module == 'study' ? 'hover' : ''));?>
            <?php echo CHtml::link('名人绘',$this->createUrl('/celebrity'),array('class'=>$module == 'celebrity' ? 'hover' : ''));?>
            <?php echo CHtml::link('公益行',$this->createUrl('/community'),array('class'=>$module == 'community' ? 'hover' : ''));?>
             <?php echo CHtml::link('梦想秀',$this->createUrl('/dream'),array('class'=>$module == 'dream' ? 'hover' : ''));?>
            <a href="http://quanzi.lfeel.com/" style="border-right:none;">乐荟社</a>
        </div> 
        <div class="right iconpng"></div>
    </div>