<?php $js = Yii::app()->clientScript;$js->registerCssFile('/css/common.css');?>
 <div class="top_nav">
    <div class="nav_list">
        <h3></h3>
        <div class="nav_demo">
           <ul class="nav_left">
               <li><b><?php echo CHtml::link('奢生活',$this->createUrl('/life'));?></b></li>
               <li><?php echo CHtml::link('座驾',$this->createUrl('/life/list/category',array('id'=>29)));?></li>
               <li><?php echo CHtml::link('珠宝',$this->createUrl('/life/list/category',array('id'=>28)));?></li>
               <li><b><?php echo CHtml::link('品牌购','http://shop.lfeel.com/',array('target'=>'_blank'));?></b></li>
               <li><?php echo CHtml::link('名品','http://shop.lfeel.com/index.php?act=famous&nav_id=11',array('target'=>'_blank'));?></li>
               <li><?php echo CHtml::link('荟团','http://shop.lfeel.com/index.php?act=show_groupbuy',array('target'=>'_blank'));?></li>
           </ul>
       </div>
       <em></em>
    </div>
    <div class="nav_list">
        <em></em>
         <h3 class="investment"></h3>
         <div class="nav_demo">
            <ul class="nav_left">
                <li><b><?php echo CHtml::link('政企通',$this->createUrl('/investment/list'));?></b></li>
                <li><?php echo CHtml::link('工业',$this->createUrl('/investment/list/category',array('id'=>21)));?></li>
                <li><?php echo CHtml::link('园区',$this->createUrl('/investment/list/category',array('id'=>25)));?></li>
                <li><b><?php echo CHtml::link('商机汇',$this->createUrl('/trade'));?></b></li>
                <li><?php echo CHtml::link('投资',$this->createUrl('/trade/list/category',array('id'=>65)));?></li>
                <li><?php echo CHtml::link('招商',$this->createUrl('/trade/list/category',array('id'=>64)));?></li>
            </ul>
        </div>               
   </div>
    <div class="nav_list">
        <em></em>
        <h3 class="celebrity"></h3>
        <div class="nav_demo">
           <ul class="nav_left">
               <li><b><?php echo CHtml::link('名人绘',$this->createUrl('/celebrity'));?></b></li>
               <li><?php echo CHtml::link('语录',$this->createUrl('/celebrity/list/category',array('id'=>59)));?></li>
               <li><?php echo CHtml::link('人物',$this->createUrl('/celebrity/list/category',array('id'=>57)));?></li>
               <li><b><?php echo CHtml::link('慧学习',$this->createUrl('/study'));?></b></li>               
			   <li><?php echo CHtml::link('课程',$this->createUrl('/study/list/category',array('id'=>87)));?></li>
               <li><?php echo CHtml::link('海外',$this->createUrl('/study/list/category',array('id'=>90)));?></li>
           </ul>
       </div>
    </div>
        <div class="nav_list">
            <em></em>
            <h3 class="interactive"></h3>
            <div class="nav_demo">
               <ul class="nav_left">
                   <li><b><a href="http://quanzi.lfeel.com/" target="_blank">乐荟圈</a></b></li>
                   <li><a href="http://quanzi.lfeel.com/" target="_blank">圈子</a></li>
                   <li><a href="http://quanzi.lfeel.com/" target="_blank">活动</a></li>
                   <li><b><?php echo CHtml::link('乐聚会',$this->createUrl('/meet'));?></b></li> 
                   <li><?php echo CHtml::link('交流',$this->createUrl('/meet/list/category',array('id'=>135)));?></li>
                   <li><?php echo CHtml::link('聚会',$this->createUrl('/meet/list/category',array('id'=>5)));?></li>
               </ul>
           </div>
        </div>
        <div class="nav_list">
            <em></em>
            <h3 class="transfer"></h3>
            <div class="nav_demo">
               <ul class="nav_left">
                   <li><b><?php echo CHtml::link('公益行',$this->createUrl('/community'));?></b></li>
                   <li><?php echo CHtml::link('资讯',$this->createUrl('/community/list/category',array('id'=>74)));?></li>
                   <li><?php echo CHtml::link('求助',$this->createUrl('/community/list/category',array('id'=>83)));?></li>
                   <li><b><?php echo CHtml::link('梦想秀',$this->createUrl('/dream'));?></b></li>
                   <li><a href="/site/login" target="_blank">科技</a></li>
                   <li><a href="/site/login" target="_blank">旅行</a></li>
               </ul>
           </div>
        </div>
        <div class="nav_list nav_right">
            <ul class="nav_left nav_right">
                <li><b><a href="http://quanzi.lfeel.com/" target="_blank">乐荟社</a></b></li><br />
                <li><b><a href="/site/login" target="_blank">手机版</a></b></li>
            </ul>
        </div>
</div>