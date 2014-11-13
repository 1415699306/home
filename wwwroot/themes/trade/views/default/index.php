<?php 
    $js = Yii::app()->getClientScript();
    $js->registerCssFile(Yii::app()->theme->baseUrl.'/css/sjh.css');
?>
<div class="z_banner"><?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::TRADE,'res_id'=>67,'type'=>1,'width'=>1250));?></div>
<div class="main">
  <div class="tr_recommend">
    	<h3><span><?php echo CHtml::link('更多',$this->createUrl('/trade/list/category',array('id'=>'65')),array('target'=>'_blank'));?></span>投资</h3>
       <div class="tr_content">
            <ul class="list">
                <?php if(empty($investment_img)):?><p>暂无数据</p><?php endif;?>
                <?php foreach($investment_img as $key):?>
                <li>
                    <span id="img_url" img_url="<?php echo $key['big_thumb'];?>" link_href="<?php echo $this->createUrl('/trade/list/view',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>"></span>
                    <p><?php echo CHtml::link($key['highlighted']==1 ? '<em style="color: red;font-weight: bold;">'.CHtml::encode($key['title']) : '<em style="font-weight:200;">'.CHtml::encode($key['title']).'</em>',$this->createUrl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></p>
                </li>
                <?php endforeach;?>
            </ul>
    	</div>
 </div>
<?php if(!empty($investment_txt)):?>
 <div class="nav_wrap">
 	<ul class="wrap_list">
        <?php foreach($investment_txt as $key):?>
        <li>
            <p><?php echo CHtml::link($key['highlighted']==1 ? '<i>'.CHtml::encode($key['title']).'</i>' :CHtml::encode($key['title']),$this->createUrl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></p>
        </li>
        <?php endforeach;?>
    </ul>
  </div>
<?php endif;?>
<div class="wrap_banner"><?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::TRADE,'res_id'=>68,'type'=>1,'width'=>1250));?></div>
<div class="tr_merchants">
    	<h3><span><?php echo CHtml::link('更多',$this->createUrl('/trade/list/category',array('id'=>'64')),array('target'=>'_blank'));?></span>招商</h3>
       <div class="tr_content">
         <ul class="list">
            <?php if(empty($merchants_img)):?><p>暂无数据</p><?php endif;?>
            <?php foreach($merchants_img as $key):?>
            <li>
                <span id="img_url" img_url="<?php echo $key['big_thumb'];?>" link_href="<?php echo $this->createUrl('/trade/list/view',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>"></span>
                <p><?php echo CHtml::link($key['highlighted']==1 ? '<em style="color: red;font-weight: bold;">'.CHtml::encode($key['title']) : '<em style="font-weight:200;">'.CHtml::encode($key['title']).'</em>',$this->createUrl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></p>
            </li>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<?php if(!empty($merchants_txt)):?>
 <div class="nav_wrap">
 	<ul class="wrap_list">
        <?php foreach($merchants_txt as $key):?>
        <li>
            <p><?php echo CHtml::link($key['highlighted']==1 ? '<i>'.CHtml::encode($key['title']).'</i>' :CHtml::encode($key['title']),$this->createUrl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></p>
        </li>
        <?php endforeach;?>
   </ul>
</div>
<?php endif;?>
<div class="tr_venture">
    	<h3><span><?php echo CHtml::link('更多',$this->createUrl('/trade/list/category',array('id'=>'63')),array('target'=>'_blank'));?></span>创业</h3>
       <div class="tr_content">
         <ul class="list">
            <?php if(empty($venture_img)):?><p>暂无数据</p><?php endif;?>
            <?php foreach($venture_img as $key):?>
            <li>
                <span id="img_url" img_url="<?php echo $key['big_thumb'];?>" link_href="<?php echo $this->createUrl('/trade/list/view',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>"></span>
                <p><?php echo CHtml::link($key['highlighted']==1 ? '<em style="color: red;font-weight: bold;">'.CHtml::encode($key['title']) : '<em style="font-weight:200;">'.CHtml::encode($key['title']).'</em>',$this->createUrl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></p>
            </li>
            <?php endforeach;?>
         </ul>
    </div>
</div>
<?php if(!empty($venture_txt)):?>
 <div class="nav_wrap">
 	<ul class="wrap_list">
        <?php foreach($venture_txt as $key):?>
        <li>
            <p><?php echo CHtml::link($key['highlighted']==1 ? '<i>'.CHtml::encode($key['title']).'</i>' :CHtml::encode($key['title']),$this->createUrl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></p>
        </li>
        <?php endforeach;?>
 	</ul>
  </div>
</div>
<?php endif;?>

<div class="tr_venture">
    	<h3><span><?php echo CHtml::link('更多',$this->createUrl('/trade/list/category',array('id'=>'137')),array('target'=>'_blank'));?></span>商会</h3>
       <div class="tr_content">
         <ul class="list">
            <?php if(empty($commerce_img)):?><p>暂无数据</p><?php endif;?>
            <?php foreach($commerce_img as $key):?>
            <li>
                <span id="img_url" img_url="<?php echo $key['big_thumb'];?>" link_href="<?php echo $this->createUrl('/trade/list/view',array('id'=>$key['id']));?>" img_title="<?php echo $key['title']?>"></span>
                <p><?php echo CHtml::link($key['highlighted']==1 ? '<em style="color: red;font-weight: bold;">'.CHtml::encode($key['title']) : '<em style="font-weight:200;">'.CHtml::encode($key['title']).'</em>',$this->createUrl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></p>
            </li>
            <?php endforeach;?>
         </ul>
    </div>
</div>
<?php if(!empty($commerce_txt)):?>
 <div class="nav_wrap">
 	<ul class="wrap_list">
        <?php foreach($commerce_txt as $key):?>
        <li>
            <p><?php echo CHtml::link($key['highlighted']==1 ? '<i>'.CHtml::encode($key['title']).'</i>' :CHtml::encode($key['title']),$this->createUrl('/trade/list/view',array('id'=>$key['id'])),array('target'=>'_blank'));?></p>
        </li>
        <?php endforeach;?>
 	</ul>
  </div>
</div>
<?php endif;?>
</div>
<style>
/*css样式重置*/
.footer {width: 100%;height: 150px;background: #333;float: left;margin-top: 10px;font-weight: normal;}.footer_x {width: 100%;font-weight: normal;}#goTop li.open{font-weight: normal;}
</style>
<script>
jQuery(function($){
    new lazy($('span#img_url'),'img_url','204','115');
});
</script>