<?php
$this->pageTitle='政企通_'.$model->title.'_乐荟网';
$js = Yii::app()->getClientScript();
Yii::app()->clientScript->registerMetaTag($model->seo_keyword,'Keywords');
Yii::app()->clientScript->registerMetaTag($model->seo_discription,'Description');
$js->registerScriptFile('/js/date/WdatePicker.js');
$js->registerScriptFile('/js/common.js');
$js->registerScriptFile('/js/globals.js');
?>
<div class="topbar">
    <?php echo CHtml::image(Investment::getTopBar($model->top_bar),$model->title);?>
</div>
<?php if(!empty($params)):?>
    <?php $index=InvestmentMod::getModIndex();?>
    <?php foreach ($index as $k):?>
        <?php foreach ($params as $v):?>
            <?php if(isset($v[$k])):?>
            <?php $this->renderPartial(InvestmentMod::getTemplate($v[$k]['template_id'],$v[$k]['template_name']),array('model'=>$v[$k]));?>
            <?php endif;?>
        <?php endforeach;?>
    <?php endforeach;?>
<?php endif;?>
<?php $this->renderPartial('_form',array('model'=>$model,'advisory'=>$advisory));?>
<?php if(!empty($params)):?>
 <div class='showbox'>
    <ul>
       <?php $index=InvestmentMod::getModIndex();?>
       <?php foreach ($index as $k):?>
           <?php foreach ($params as $v):?>
               <?php if(isset($v[$k])):?>
        <li><a href='#<?php echo $v[$k]['template_name'];?>'><?php echo InvestmentMod::getModName($v[$k]['template_name']);?></a></li>
               <?php endif;?>
           <?php endforeach;?>
       <?php endforeach;?>
        <li><a href='#message'>联系方式</a></li>
    </ul>
     <p>回到顶部</p>
</div>
<?php endif;?>
<style>
.box .head .head-right .search{border: 1px solid #cacaca;display: inline-block;height: 31px;overflow: hidden;/*_width:468px;*/}
.investment .warp{margin-bottom: 20px;}
.stick .wrap .wrap-left{ width:165px;float:left;}
.nav_level{margin-left:-1px;}


#goTop{background: #e5e3e6;
top: 270px;
right: 0;
position: fixed!important;
position: absolute;
visibility: visible;
z-index: 99999;
padding: 5px;
display: block;
clear: both;
overflow: hidden;
}
.footer_x .x_top .pic_list li{margin:0 10px;}
.footer_x .bottom_right{ text-align:left;}
</style>
<script>
    $(function(){
        $("a.grouped_elements").fancybox({ 
            'zoomSpeedIn': 300, 
            'zoomSpeedOut': 300, 
            'overlayShow': false 
        });
    });
    </script>