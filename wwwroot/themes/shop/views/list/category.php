<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/base.css');?>
          <!--头部标签样式结束 -->  
    
       
    <div class="content">
        <div class="slide shopCo">
            <ul class="Slide-con">
                <?php foreach (Slide::getSlide('16', '179', '0', '1') as $key =>$val):?>
	<li id="box3_b<?php echo $key;?>">
                <a href="<?php echo $val['link']?>"><img src="<?php echo Storage::getImageBySize($val['track_id'],'slide','','thumb',array('width'=>1200,'height'=>400));?>" alt="<?php echo $val['name'];?>" /></a>
        </li>
    <?php endforeach;?>
    <?php foreach(Slide::getSlide('16', '179', '1', '4') as $key =>$val):?>
    <li id="box3_b<?php echo ++$key;?>" style="display:none">
                <a href="<?php echo $val['link']?>"><img src="<?php echo Storage::getImageBySize($val['track_id'],'slide','','thumb',array('width'=>1200,'height'=>400));?>" alt="<?php echo $val['name'];?>" /></a>
    </li>
    <?php endforeach;?>
           </ul>
            <ul class="Slide-nav" id="slidenav"> 
                <?php foreach (Slide::getSlide('16', '179', '0', '1') as $key =>$val):?>
                    <li class="on" id="box3_a0"  onmousemove="box3(0)">
                        <em class="globe_bg"><?php echo ++$key;?></em>
                    </li>
                 <?php endforeach;?>
                <?php foreach(Slide::getSlide('16', '179', '1', '4') as $key =>$val):?>
                    <li id="box3_a<?php echo ++$key;?>"  onmousemove="box3(<?php echo $key;?>);">
                        <em class="globe_bg"><?php echo ++$key;?></em>
                    </li>
                <?php endforeach;?>
 
            </ul>
        </div>
        <div class="floor">
            <div class="floorTop  al">
                <em><a href="/shop">更多>></a></em>
                <h3>所有品牌</h3>
            </div>
            <div class="shopCo ac">
                <div class="logolist">
                    <ul>
                        <?php foreach($data as $v):?>
                        <li><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($v['track_id'],'shop','4_3','thumb'),Helper::truncate_utf8($v['title'],10),array('width'=>154,'height'=>86)),$this->createUrl('/shop/list/view',array('id'=>$v['id'])),array('target'=>'_blank'));?><p><?php echo Helper::truncate_utf8(CHtml::encode($v['title']),10);?></p></li>
                        <?php endforeach;?>
                    </ul>
                </div>
                <div class="logolist">
                    <ul>
                        <?php foreach($datas as $v):?>
                       <li><?php echo CHtml::link(CHtml::image(Storage::getImageBySize($v['track_id'],'shop','4_3','thumb'),Helper::truncate_utf8($v['title'],10),array('width'=>154,'height'=>86)),$this->createUrl('/shop/list/view',array('id'=>$v['id'])),array('target'=>'_blank'));?><p><?php echo Helper::truncate_utf8(CHtml::encode($v['title']),10);?></p></li>
                        <?php endforeach;?>
                        <li class="specia"><p>会所品牌继续增加中</p><p>敬请期待……</p></li>
                        <li></li>
                        <li></li>
                        <li class="last"></li>
                    </ul>
                </div>
            </div>
        </div>

        
        
        <?php $i=1;?>
        <?php foreach($category as $val):?>
        <!--酒庄 -->
         <div class="floor">
            <div class="floorTop club">
                <h3><?php echo $val['name'];?></h3>
            </div>
            
            <div class="floorCo mt">
                    <div class="product floatRight">
                        <ul class="productList">
                             <?php $models = Shop::getList($val['id']);?>
                            <?php foreach($models as $key=>$v):?>
                             <?php if($key < 3 ):?>
                           <li>
                                <?php echo CHtml::link(CHtml::image(Storage::getImageBySize($v['track_id'],'shop','4_3','thumb'),Helper::truncate_utf8($v['title'],10),array('width'=>220,'height'=>220)),$this->createUrl('/shop/list/view',array('id'=>$v['id'])),array('target'=>'_blank'));?>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($v['title']),14),$this->createUrl('/shop/list/view',array('id'=>$v['id'])),array('title'=>$v['title'],'target'=>'_blank'));?></h3>
                                        <p><?php echo Helper::truncate_utf8(CHtml::encode($v['discription']),50);?></p>
                                    </div>  
                            </li>
                             <?php else:?>
                            <li class="last">
                               <?php echo CHtml::link(CHtml::image(Storage::getImageBySize($v['track_id'],'shop','4_3','thumb'),Helper::truncate_utf8($v['title'],10),array('width'=>220,'height'=>220)),$this->createUrl('/shop/list/view',array('id'=>$v['id'])),array('target'=>'_blank'));?>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                       <h3><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($v['title']),14),$this->createUrl('/shop/list/view',array('id'=>$v['id'])),array('title'=>$v['title'],'target'=>'_blank'));?></h3>
                                        <p><?php echo Helper::truncate_utf8(CHtml::encode($v['discription']),50);?></p>
                                    </div>
                            </li>
                             <?php endif;?>
                  <?php endforeach;?>
                            <?php $model = Shop::getRist($val['id']);?>
                            <?php foreach($model as $key=>$v):?>
                             <?php if($key < 3 ):?>
                           <li>
                                <?php echo CHtml::link(CHtml::image(Storage::getImageBySize($v['track_id'],'shop','4_3','thumb'),Helper::truncate_utf8($v['title'],10),array('width'=>220,'height'=>220)),$this->createUrl('/shop/list/view',array('id'=>$v['id'])),array('target'=>'_blank'));?>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                        <h3><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($v['title']),14),$this->createUrl('/shop/list/view',array('id'=>$v['id'])),array('title'=>$v['title'],'target'=>'_blank'));?></h3>
                                        <p><?php echo Helper::truncate_utf8(CHtml::encode($v['discription']),50);?></p>
                                    </div>  
                            </li>
                             <?php else:?>
                            <li class="last">
                               <?php echo CHtml::link(CHtml::image(Storage::getImageBySize($v['track_id'],'shop','4_3','thumb'),Helper::truncate_utf8($v['title'],10),array('width'=>220,'height'=>220)),$this->createUrl('/shop/list/view',array('id'=>$v['id'])),array('target'=>'_blank'));?>
                                    <div class="proDetails_bg"></div>
                                    <div class="proDetails">
                                       <h3><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($v['title']),14),$this->createUrl('/shop/list/view',array('id'=>$v['id'])),array('title'=>$v['title'],'target'=>'_blank'));?></h3>
                                        <p><?php echo Helper::truncate_utf8(CHtml::encode($v['discription']),50);?></p>
                                    </div>
                            </li>
                             <?php endif;?>
                  <?php endforeach;?> 
                        </ul>  
                    </div>
                <div class="sidebar">
                    <?php $arr = Category::getId($val['name'],$val['category_name']);?>
                    <?php $this->widget('ext.widgets.advertising.IAdvertisingWidget',array('app_id'=>BaseApp::SHOP,'res_id'=>$arr['id'],'type'=>1,'width'=>245,'height'=>460));?>
                </div>
            </div> 
        </div>
        <?php ++$i;?>
<?php endforeach;?>
        
<script>
function box3(i)
{for(j=0;j<10;j++)
{if(i==j){$("#box3_b"+j).css("display","");$("#box3_a"+j).attr("class","on");}
else
{$("#box3_b"+j).css("display","none");$("#box3_a"+j).attr("class","");}}}
$(function(){var len=$(".Slide-nav > li").length;var i=1;var adTimer;adTimer=setInterval(function(){box3(i)
i++;if(i==len){i=0;}},6000);});
</script>           
    </div>
    
   