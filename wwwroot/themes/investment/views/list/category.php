<?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::INVESTMENT,'res_id'=>19,'type'=>1));?>
<div class="warp">
    <div class="list">
        <div class="recommend">
            <h3><span>Category</span><?php echo $category;?></h3>
            <?php foreach($model as $key):?>
                <?php static $i=0;?>
                <ul <?php echo $i==4 ?  'style="margin-right:0;"':'';?>>
                    <li><?php echo CHtml::link(CHtml::image( Storage::getImageBySize($key->thumb,'investment','16_9','thumb'),$key->title,array('width'=>200,'height'=>155)),$this->createUrl('/investment/default',array('id'=>$key->id)),array('target'=>'_blank'));?></li>
                    <em><?php echo CHtml::encode($key->title);?></em>
                    <p class="discription"><?php echo Helper::truncate_utf8(CHtml::encode($key->discription),120);?></p>
                    <p><?php echo CHtml::link('点击查看全部»',$this->createUrl('/investment/default',array('id'=>$key->id)));?></p>
                </ul>
                <?php ++$i;?>
            <?php endforeach; ?>
        </div>
    </div>
    <?php $this->widget('CLinkPager', array(
        'pages' => $pages,
        'header'=>false,
    )) ?> 
</div>
<style>
#advertising{margin: 0;padding: 0;height: 230px;}
.investment .warp{width: 1250px;margin-bottom: 10px;overflow: hidden;}
.investment .list{padding:10px;overflow: hidden;clear: both;}
.investment .list .recommend, .investment .list .listview{clear: both;overflow: hidden;}
.investment .list .recommend{margin-bottom: 10px;}
.investment .list .list-view{margin-bottom: 15px;}
.investment .list .recommend h3{color:#232b38;border-bottom: 5px solid #232b38;font-size: 24px;font-weight: bold;letter-spacing: -1px;}
.investment .list .recommend h3 span{float:right;color:#ccc; font-weight: 200;}
.investment .list .recommend ul,
.investment .list .list-view ul
{margin: 10px 12.2px 10px 0;float: left;background: #f2f2f2;width: 196px;height: 360px;padding:10px 20px;}
.investment .list .list-view ul{margin:10px 0px 10px 8px!important;margin: 10px 0px 10px 4px;}
.investment .list .recommend ul img,
.investment .list .list-view ul
{width: 196px;}
.investment .list .recommend ul em,
.investment .list .list-view ul em
{text-align: center;font-size: 14px;font-weight: bold;margin: 5px 0;float: left;width: 100%; height:21px; overflow:hidden;}
.investment .list .recommend ul p, 
.investment .list .recommend ul em,
.investment .list .list-view ul p,
.investment .list .list-view ul em
{width: 196px;}
.investment .list .list-view ul{height: 265px;}
.investment .list .recommend ul p a{float: right;color: #0d5b81;}
.investment .list .recommend ul p.discription{height: 160px;overflow: hidden;}
.investment .list .list-view{height: 306px;border-top: 1px solid #ccc;border-bottom: 1px solid #ccc;background: #f3f3f3;float: left;width:100%!important;width: 98.5%;}
.investment .list .list-view h3{margin-right: 15px;width: 236px;height: 306px;float: left; position:relative;}
.investment .list .list-view h3 a{color: #0d5b81;font-weight: 200;float: right;position: absolute;top:30px; right: 15px;}
.investment .list .list-view h3 img{width:236px;height: 306px!important;height: 304px;border:0;}
.box .head .head-right .search{border: 1px solid #cacaca;
display: inline-block;
height: 31px;
overflow: hidden;
/*_width:468px;*/}
body{ background:url(/images/bg.jpg);}
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