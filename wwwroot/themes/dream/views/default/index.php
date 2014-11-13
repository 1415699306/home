<?php Yii::app()->getClientScript()->registerCssFile(Yii::app()->theme->baseUrl.'/css/index.css');?>
<div class='banner'>
	<div class='bannerLeft'>
        <?php $this->widget('ext.widgets.slide.ISlideWidget',array('app_id'=>BaseApp::DREAM,'res_id'=>144,'type'=>2,'width'=>978,'height'=>298));?> 
    </div>
    <div class='bannerRight'>
    	<img src="<?php echo Yii::app()->theme->baseUrl;?>/images/dream.jpg" alt="" />
    	<span class='bannerbtn'>
            <?php echo CHtml::link(CHtml::image( Yii::app()->theme->baseUrl.'/images/dream_14.gif'),$this->createUrl('/usercenter/projects/create'));?>
        </span>
    </div>
</div>
<div class='main'>
	<div class='titile'>
    	<ul class='titileList'>
        	<li class='selected'><?php echo CHtml::link('推荐项目',$this->createUrl('/dream/default/index'),array('count'=>$pages->pageCount,'class'=>Yii::app()->request->getParam('cat') === null && Yii::app()->request->getParam('status') === null ? 'checked' :''));?></li>
            <?php foreach($categorys as $key=>$val):?>
            <li><?php echo CHtml::link($val,$this->createUrl('/dream/default/index',array('rec'=>0,'cat'=>$key)),array('count'=>$pages->pageCount,'class'=>Yii::app()->request->getParam('cat') == $key ? 'checked' :'default'));?></li>
            <?php endforeach;?>
            <li><?php echo CHtml::link('已达成',$this->createUrl('/dream/default/index',array('status'=>1)),array('class'=>Yii::app()->request->getParam('cat') === null && Yii::app()->request->getParam('status') == 1 ? 'checked' :''));?></li>
        </ul>
    </div>
    <div class='content'>
    	<div class='contentInner'>
            <?php foreach($models as $model):?>
            <div class='listdiv'>
                <div class='listTop'></div>
                <div class='list'>
                    <div class='pic'><?php echo   CHtml::link(CHtml::image(Storage::getImageBySize(!empty($model->thumbs->track_id)?$model->thumbs->track_id:null,'dream',null,'thumb'),$model->title,array('width'=>265,'height'=>143)),$this->createUrl('/dream/projects/view',array('id'=>$model->id)),array('target'=>'_blank'));?><span class='float'><?php echo Dream::getStatus($model->status);?></span></div>
                    <div class='text'>
                        <h2><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($model->title),16),$this->createUrl('/dream/projects/view',array('id'=>$model->id)),array('title'=>$model->title));?></h2>
                        <p><?php echo Helper::truncate_utf8(CHtml::encode($model->discription),85)?></p>
                    </div>
                    <div class='view-bar'>
                        <?php $this->widget('zii.widgets.jui.CJuiProgressBar', array('value'=>$model->targetItems,'htmlOptions'=>array('style'=>'height:8px;'),));?>
                    </div>
                    <div class='textList'>
                        <ul class='complete'>
                            <li class='f_size'><?php echo $model->targetItems.'%';?></li>
                            <li><?php echo $model->status > 2 ? '达到' : '热度';?></li>
                        </ul>
                        <ul class='support'>
                            <li><?php echo $model->status > 2 ? '<span>¥</span><span class="f_size">'.$model->payment.'</span>':'<span class="f_size">'.PublicAttention::getCount($model->id,BaseApp::DREAM).'人</span>';?></li>
                            <li><?php echo $model->status > 2 ? '已获支持' : '关注人数';?></li>
                        </ul>
                        <ul class='date'>
                            <li  class='f_size'><span class='f_size'><?php echo $model->status > 2 ? $model->lastDays : $model->preparation;?></span>天</li>
                            <li><?php echo $model->status > 2 ? '剩余时间' : '已经预热';?></li>
                        </ul>
                 </div>
              </div>
                <div class='listBottom'></div>            
            </div> 
            <?php endforeach;?>
        </div> 
        <div class='more'>
            <?php if(1 < $pages->pageCount):?>
            <a href="javascript:void(0);" id="move" page="<?php echo $pages->currentPage+2;?>" count="<?php echo $pages->pageCount;?>">查看更多</a>
            <?php else:?>
                已到尽头啦!
            <?php endif;?>
        </div
    ></div>
</div>
<script>
jQuery(function($){
    $('#move').live('click',function(){
        var page = $(this).attr('page');
        var count = $(this).attr('count');
        $.ajax({
            type: "GET",
            url: "/dream/default/index",
            dataType: "json",
            sync:true,
            data:'page='+page,
            beforeSend:function(){
                $('.more').html('请等待!');
            },
            success:function(xhr){
               $(this).setData(xhr,count,1);
            }
          });       
        return false;
    });
    
    /*$('ul.titileList a').live('click',function(){
        var count = $(this).attr('count');  
        $(this).addClass('checked');
        $(this).parent('li').nextAll().find('a').removeClass('checked');
        $(this).parent('li').prevAll().find('a').removeClass('checked');
        $.ajax({
            type: "GET",
            url: $(this).attr('href'),
            dataType: "json",
            sync:true,
            beforeSend:function(){
                $('.more').html('请等待!');
            },
            success:function(xhr){
               $(this).setData(xhr,count,0);
            }
          });       
        return false;
    });*/
    
    $.fn.setData = function(xhr,count,fn){
        var len = xhr.data.length;
        var html = '';
        for(var i=0;i<len;++i){
           html +='<div class="listdiv"><div class="listTop"></div><div class="list"><div class="pic"><img src="'+xhr.data[i].thumb+'" alt="'+xhr.data[i].title+'" width="265" height="143"><span class="float">'+xhr.data[i].getStatus+'</span></div>';
           html +='<div class="text"><h2><a title="'+xhr.data[i].title+'" href="'+xhr.data[i].url+'">'+xhr.data[i].title+'</a></h2><p>'+xhr.data[i].discription+'</p></div>';
           html +='<div class="view-bar"><div style="height:8px;" id="yw15" class="ui-progressbar ui-widget ui-widget-content ui-corner-all" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="'+xhr.data[i].widget+'"><div class="ui-progressbar-value ui-widget-header ui-corner-left" style="width: '+xhr.data[i].widget+'%;"></div></div></div>';
           html +='<div class="textList"><ul class="complete"><li class="f_size">'+xhr.data[i].widget+'%</li><li>达到</li></ul>';
           if(xhr.data[i].status === '2'){
               html +='<ul class="support"><li><span class="f_size">'+xhr.data[i].attention+'</span></li><li>关注人数</li></ul><ul class="date"><li  class="f_size"><span class="f_size">'+xhr.data[i].preparation+'</span>天</li><li>已经预热</li></ul>';
           }else{
                html +='<ul class="support"><li><span>¥</span><span class="f_size">'+xhr.data[i].payment+'</span></li><li>已获支持</li></ul><ul class="date"><li  class="f_size"><span class="f_size">'+xhr.data[i].lastDays+'</span>天</li><li>剩余时间</li></ul>';
           }
           html +='</div>';
           html +='</div><div class="listBottom"></div></div>';
        }            
        if(fn === 1){
            $('.contentInner').append($(html).fadeIn(500));
        }else{
            $('.contentInner').html($(html).fadeIn(500));
        }
        if(xhr.page < count){
           $('.more').html('<a href="javascript:void(0);" id="move" page="'+xhr.page+'" count="'+count+'">查看更多</a>');
        }else{
           $('.more').html('已到尽头啦!');
        }
        if(len === 0){
            $('.contentInner').html('<div style="text-align:center;">抱歉!暂无数据!</div>');
        }
    };
});
</script>
<style>
.ui-widget-header{background: #38a3db;}
.titile ul.titileList li a{ height:39px; line-height:39px; width:100px;}
.slideBox{ border:none;}
</style>