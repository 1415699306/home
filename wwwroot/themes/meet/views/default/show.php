<!--[if IE 6]>
<script src="/js/belatedPNG/DD_belatedPNG-min.js"></script>
<script>
$(document).ready(function(){
    DD_belatedPNG.fix('.image_right i');
});
</script>
<![endif]-->
<div class="slide_top">
<?php $this->widget('ext.widgets.slide.ISlideWidget',array('app_id'=>BaseApp::MEET,'res_id'=>14,'type'=>0));?>  		
</div>
<div class="meet warp">
    <div class="meet_notice hadd">
        <h3><em></em></h3>
        <!--<div class="image_list">
            <?php if(empty($retRelations)):?>
            <p>暂无数据</p>
            <?php else:?>
            <ul>
            <?php foreach($retRelations as $key):?>
                <li><?php echo CHtml::image($key->eminentPerson->avatarImage->track_id,$key->eminentPerson->name,array('width'=>85,'height'=>85));?><span><?php echo Helper::truncate_utf8(Chtml::encode($key->eminentPerson->name),5);?></sapn></li>
            <?php endforeach;?>
            </ul>
            <?php endif;?>
        </div>-->
        <div class="image_right">
            <ul>
                <i>
                    <p>主题:<?php echo CHtml::encode($notice->title);?></p>
                    <p>时间:<?php echo date('Y-m-d H:i:s',$notice->start_time);?> - <?php echo date('Y-m-d H:i:s',$notice->off_time);?></p>
                    <p>地点:<?php echo CHtml::encode($notice->locale);?></p>
                </i>
                <li><?php echo CHtml::image(Storage::getImageBySize(!empty($notice->thumbs->track_id) ? $notice->thumbs->track_id : '','meet','16_9','thumb'),$notice->title,array('width'=>1250,'height'=>350));?></li>
                <span><?php echo CHtml::link('已入席名单',$this->createUrl('/meet/list/sign',array('id'=>$notice->id)));?><em>|</em><?php echo CHtml::link('了解参与资格',$this->createUrl('/meet/list/sign',array('id'=>$notice->id)));?></span>
            </ul>
        </div>

    </div> 
    <div class="meet_notice">
        <h3><em></em></h3>
        <div class="image_list_full">       
            <div class="list_content">
            <?php if(empty($full)):?><p>暂无数据</p><?php endif;?>
            <?php foreach($full as $key):?>
            <ul>
                <li><?php echo CHtml::image(Storage::getImageBySize($key->thumbs->track_id, 'meet','16_9','thumb'),$key->title,array('width'=>295,'height'=>220));?></li>
            <p><label>主题:</label><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($key->title),12),$this->createUrl('/meet/list/sign',array('id'=>$key->id)),array('target'=>'_blank'));?></p>
            <p><label>时间:</label><?php echo date('Y/m/d',$key->start_time);?> - <?php echo date('Y/m/d',$key->off_time);?></p>
            <p><label>地点:</label><?php echo Helper::truncate_utf8(CHtml::encode($key->locale),12);?></p>
            </ul>
            <?php endforeach;?>     
            </div>
        </div>
    </div>
    <div class="adv">
        <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::MEET,'res_id'=>10,'type'=>1));?>
    </div>
    <div class='image_list_past'>
        <h3><em></em></h3>
        <div class="image_list_full">       
            <div class="list_content">
            <?php if(empty($old)):?><p>暂无数据</p><?php endif;?>
            <?php foreach($old as $key):?>
            <ul>
            <li><?php echo CHtml::image($key->thumbs->track_id,$key->title,array('width'=>295,'height'=>220));?></li>
            <p><label>主题:</label><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($key->title),12),$this->createUrl('/meet/list/sign',array('id'=>$notice->id)),array('target'=>'_blank'));?></p>
            <p><label>时间:</label><?php echo date('Y/m/d',$key->start_time);?> - <?php echo date('Y/m/d',$key->off_time);?></p>
            <p><label>地点:</label><?php echo Helper::truncate_utf8(CHtml::encode($key->locale),12);?></p>
            <span><?php echo CHtml::link('查看详情 > ');?></span>
            </ul>
            <?php endforeach;?>     
            </div>
        </div>
        <?php $this->widget('CLinkPager', array(
            'pages' => $pages,
            'header'=>false,
        )) ?>
    </div>
</div>
<style>
.slide_top{margin-top:10px;}
ul.yiiPager {font-size: 11px;border: 0;margin: 10px auto;padding: 0;line-height: 100%;display: inline;display: block;width: 395px;}
.top_slide{margin-top: 10px;}
.meet .hadd{height: 470px;}
.meet .meet_notice, .image_list_past{margin-top: 10px;clear: both;overflow: hidden;background: #fff;color: #3e3a39;}
.meet .meet_notice h3, .image_list_past h3{background: url(/themes/meet/images/meet.gif) 0 -52px repeat-x;height: 38px;width: 100%;}
.meet .meet_notice h3 em, .image_list_past h3 em{color: #fff;width: 140px;height: 38px;float: left;text-align: center;line-height: 38px;font-size: 16px;}
.meet .meet_notice h3 em{background: url(/themes/meet/images/meet.gif) no-repeat;}
.image_list_past h3 em{background: url(/themes/meet/images/meet.gif) 0 -98px no-repeat;}
.meet .meet_notice .image_list{width:650px;height: 390px;float: left;}
.meet .meet_notice  .image_list ul{margin:30px 0 0 0;}
.meet .meet_notice  .image_list ul li{float: left;width: 85px;text-align: center;margin: 0 0 10px 20px;display: block;}
.meet .meet_notice  .image_list ul li img{border: 1px solid #ccc;margin-bottom: 10px;}
.meet .meet_notice  .image_right ul  span{float: right;margin-top: 8px; font-weight: 600;}
.meet .meet_notice  .image_right ul  span a{padding:8px 8px 0 8px;}
.meet .meet_notice .image_right{height: 430px;float: left;}
.meet .meet_notice .image_right ul{background: #ececec;margin-top: 20px;position: relative;z-index: 350;}
.meet .meet_notice .image_right i{position: absolute;z-index: 400;top:58%;right:20px;background: url(/themes/meet/images/suibian.png) no-repeat;width: 383px;height: 109px;}
.meet .meet_notice .image_right i p{font-size: 14px;margin: 15px 0px 15px 10px; font-weight: bold;color: #000;}
.meet .meet_notice .image_list_full, .meet .meet_notice .image_list_full .list_content, .meet .image_list_past, .image_list_past .list_content{clear: both;overflow: hidden;}
.meet .meet_notice .image_list_full .list_content{padding: 20px 20px 0 15px!important;padding: 20px 0px 0 15px; height: 660px; width: 1250px!important;width:1237px;}
.meet .meet_notice .image_list_full ul{float: left;width:295px;margin: 0 11px 10px 0;padding:1px;background: #ececec;height:300px!important;height: 310px;}
.meet .meet_notice .image_list_full ul p, .meet .meet_notice .image_list_full ul p label, .meet .image_list_past .list_content ul p, .meet .image_list_past .list_content ul p label{margin: 5px;font-size: 14px;}
.meet .meet_notice .image_list_full ul p label, .meet .image_list_past .list_content ul p label{font-weight: 600;color: #666465;}
.meet .image_list_past .list_content ul{width: 49%;float: left;background: #ececec;margin-right: 10px;margin-bottom: 10px;}
.meet .image_list_past .list_content{padding: 20px 0px 20px 12px;}
.meet .image_list_past{margin-bottom: 10px;}
.meet .image_list_past .list_content ul{position: relative;z-index: 800;}
.meet .image_list_past .list_content ul li{float: left;height: 220px;}
.meet .image_list_past .list_content ul span{position: absolute;top:90%;right: 15px;z-index: 900;}
.meet .image_list_past .list_content ul span a{color: red;}
.meet .image_list_past{_padding-bottom: 10px;}
.meet .adv{margin-top: 10px;}
</style>