<?php 
$js=Yii::app()->getClientScript();$js->registerCssFile(Yii::app()->theme->baseUrl.'/css/view.css');$js->registerScriptFile('/js/fancy/jquery.fancybox.js');$js->registerCssFile('/js/fancy/jquery.fancybox.css');
$this->pageTitle='梦想秀_'.$model->title.'_乐荟网';
$this->breadcrumbs=array(
    '梦想秀'=>DIRECTORY_SEPARATOR.$this->module->id,
    $model->title,
);
?>
<div class='main'>
  <div class="news_left">
	<div class="news_top">
    	<div class="title">
        
        	<h1><?php echo $model->title;?></h1>
            <em>来自:<?php echo Params::getProvince($model->province);?> - <?php echo Params::getCity($model->city);?></em>
            <div class="pic">
                <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'public_top_list');?>
            </div>
            </div>
            <div class="new_content" style="clear:both;">
                <div class="video"><?php echo $model->video;?></div>
                <?php echo $model->dreamContent->content;?>
            </div>
             <?php $this->widget('ext.widgets.listpage.IListPage',array('model'=>$model,'status'=>'1'));?>
        </div>
      <?php foreach($recommand as $key=>$val):?>
      <div class='desgin_list <?php echo $key==2? 'end':'';?>'>
        <?php echo CHtml::image(Storage::getImageBySize(!empty($val->thumbs->track_id)?$val->thumbs->track_id:null,'dream',null,'thumb'),$val->title,array('width'=>265,'height'=>143));?>
        <div class='desgin_title'><span><?php echo Dream::getStatus($val->status);?></span><strong>话题：98　　　　支持：<?php echo $val->support;?></strong></div>
        <div class='desgin_w'>
            <h2><?php echo CHtml::link(Helper::truncate_utf8(CHtml::encode($val->title),18),$this->createUrl('/dream/projects/view',array('id'=>$val->id)),array('title'=>$val->title));?></h2>
        <p><?php echo Helper::truncate_utf8(CHtml::encode($val->discription),85);?><?php echo CHtml::link('[详情进入]',$this->createUrl('/dream/projects/view',array('id'=>$val->id)));?></p>
    </div>         
    <div class='desgin_wrap'>
        <?php $this->widget('zii.widgets.jui.CJuiProgressBar', array('value'=>$val->targetItems,'htmlOptions'=>array('style'=>'height:8px;'),));?>
    </div>
    <ul class='desgin_active'>
        <li class="complete">
            <p><strong><?php echo $val->targetItems.'%';?></strong></p>
            <p><?php echo $val->status > 2 ? '达到' : '热度';?></p>
        </li>
        <li class="buttress">
            <p><?php echo $val->status > 2 ? '<strong>￥'.$val->payment.'</strong>':'<span class="f_size">'.PublicAttention::getCount($val->id,BaseApp::DREAM).'人</span>';?></p>
            <p><?php echo $val->status > 2 ? '已获支持' : '关注人数';?></p>
        </li>
        <li class="date">
            <p><strong><?php echo $val->status > 2 ? $val->lastDays : $val->preparation;?>天</strong></p>
            <p><?php echo $val->status > 2 ? '剩余时间' : '已预热';?></p>
        </li>
    </ul>
    </div>
      <?php endforeach;?>
<div class="Comment">
    <div class="Comment_title"><span></span>网友评论：<i><?php echo PublicComment::getCommantCount(Yii::app()->request->getParam('id'),BaseApp::DREAM);?></i> 人参与评论</div>
    <?php $this->widget('ext.widgets.publicComment.IPbulicCommant',array('id'=>$model->id,'app_id'=>BaseApp::DREAM));?>
 </div>       

</div>
<div class="news_right">
	<div class='target'>
    <span><?php echo Dream::getStatus($model->status);?></span>
    	<h4>目标<?php echo $model->status > 2 ? '¥'.$model->money : $model->target.'人关注';?>/已达</h4>
        <strong><?php echo $model->status > 2 ? '<i>¥</i>'.$model->payment : $model->attention.'人';?></strong>
        <div class='desgin_wrap right_top color'>
            <?php $this->widget('ext.yiiwidget.XCJuiProgressBar', array('value'=>$model->targetItems,'htmlOptions'=>array('style'=>'height:18px;'),));?>
        </div>
	<ul class='desgin_active right_top'>
    	<li class="complete"><p>支持人数</p><p><em><?php echo $model->support;?></em>人</p></li>
        <li class="buttress"><p>浏览人数</p><p><em><?php echo PublicCount::getCount(BaseApp::DREAM,$model->id);?></em>人</p></li>
        <li class="date"><?php echo $model->status > 2 ? '<p>剩余时间</p><p><em>'.$model->lastDays.'</em>天</p>' : '<p>已预热</p><p><em>'.$model->preparation.'</em>天</p>'?></li>
    </ul>
    </div>
	<div class='Sponsor'>
    	<h3>项目发起人</h3>
        <img src="<?php echo $user->getAvatar($model->user_id,'middle');?>" width="100" height="100">
        <p><strong style="color:#0b6290;"><?php echo $user->getUserName($model->user_id);?></strong></p>
        <p>上次登录时间：<?php echo UserLoginTime::getLoginTime($model->user_id);?></p>
        <p>支持的项目:<?php echo $model->userSupport;?></p>
        <p>发起的项目:<?php echo $model->userProject;?></p>
    </div>
    <?php foreach($model->dreamPledges as $key):?>
    <div class='support'>
        <p><strong>支持<span>¥<?php echo $key->money;?></span></strong>（<?php echo !empty($key->publicCount)?$key->publicCount->count:'0'?> 位支持者）</p>
        <?php if(0 < $key->places):?><p class="per">限额: <?php echo $key->places;?> 位 剩余 <?php echo ($key->places-$key->support);?> 位</p><?php endif;?>
        <?php echo CHtml::encode($key->discription);?>   
        <p>是否包邮: <?php echo $key->free_shipping == 0 ? '否' : '包邮（大陆地区）'?></p>
        <p>预计回报发放时间：项目成功结束后<?php echo $key->payback_time;?>天内</p>
        <p>
        

        <div id="pic">
            <?php foreach($key->thumbs as $thumb):?>
            <div>
                <?php echo CHtml::link(CHtml::image(Storage::getImageBySize($thumb->track_id, 'dream',null,'thumb'),$model->title,array('width'=>'65','height'=>'65')),Storage::getImageBySize($thumb->track_id, 'dream',null,'thumb'),array('class'=>'grouped_elements','title'=>$model->title));?>
            </div>
            <?php endforeach;?>
        </div>
        </p>
                <?php if($model->status < 4):?>
            <?php if(PublicAttention::getCountByUser($model->id,BaseApp::DREAM,Yii::app()->user->id)=='0' && $model->status > 1 && $model->user_id != Yii::app()->user->id):?>
            
                <span id="<?php echo $model->status < 3 ? 'attention' : 'pay'?>">
                    <?php if($model->status < 3):?>
                    支持¥<?php echo $key->money;?>
                    <?php else:?>
                        <?php if($key->places === '0'):?>
                            <em><?php echo CHtml::link("支持¥{$key->money}",$this->createUrl('/usercenter/payment/dream',array('id'=>$model->id,'pledge'=>$key->id)));?></em>
                        <?php else:?>                        
                            <?php if($key->places > $key->support):?>
                                <em><?php echo CHtml::link("支持¥{$key->money}",$this->createUrl('/usercenter/payment/dream',array('id'=>$model->id,'pledge'=>$key->id)));?></em>
                            <?php else:?>
                                <em style="color:#fff;">名额已满</em>
                            <?php endif;?>
                        <?php endif;?>
                    <?php endif;?>
                </span> 
            <?php else:?>
                <span><?php echo Dream::getStatus($model->status);?></span>
            <?php endif;?>
        <?php else:?>
            <span><?php echo Dream::getStatus($model->status);?></span>
        <?php endif;?>
    </div>
    <?php endforeach;?>
    <div class='righ_about'>
        <?php if($model->status == '2'):?>
            <p>关于预热项目：</p><br />
            <p>预热项目是筹资前的一个热身，目的是希望更多的朋友能关注项目，给项目提意见，帮助发起人完善项目的各项内容。</p>
            <p>当项目成熟时，发起人可以随时提交审核开始筹资。</p>
        <?php elseif($model->status == '3'):?>
            <p>关于付款与退款：</p><br />
            <p>这个项目必须在<?php echo $model->lastTime;?>之前达到<span>¥<?php echo $model->money;?></span>的目标才算成功，否则已经支持的订单将取消。</p>
            <p>订单取消时，您的支持金额将自动退款至<?php echo CHtml::link('【余额】',$this->createUrl('/usercenter/account/draw'));?>中。您可以支持其他项目，或在此<?php echo CHtml::link('【申请取现】',$this->createUrl('/usercenter/account/draw'));?>至您的支付宝或其他原付款账户。</p>
        <?php elseif($model->status == '4'):?>
            <p>项目已达成筹资目标</p>
        <?php endif;?>
    </div>
</div>

</div>
<?php $this->widget('ext.widgets.countupload.ICountUpload',array('app_id'=>BaseApp::DREAM,'res_id'=>$model['id']));?>
<style>.ui-widget-header{background: #38a3db;}span#attention,span#pay a{color:#fff;}</style>
<script>
jQuery(function($){  
    $('#attention').live('click',function(){
        var p = new showMsg.Person('showMsg','项目正在预热中，目前还不能进行现金支持！','400','auto','null','+关注此项目');
        showMsg.Person.prototype.callBack = function(){
            var att = new attention('<?php echo $model->id?>','<?php echo BaseApp::DREAM?>','<?php echo Yii::app()->request->getCsrfToken();?>');
            att.postData(function e(){
                $('.support').each(function(){
                    $(this).find('#attention').html('预热中').removeAttr('id');
                });
            });
        };
        p.beforce('commantEsay','预热是筹资前的一个热身，目的是希望更多的朋友能关注项目，给项目提意见，帮助发起人完善项目的各项内容，最终能够成功完成筹资。<br \><br \>别错过了项目的最新动态！请立即关注此项目');
    });
    $('#pay').live('click',function(){
        var check = '<?php echo Yii::app()->user->id;?>';
        if(check === '0'){
            var login = new showMsg.Person('showMsg','登录','540','200',<?php echo CJavaScript::encode(Yii::app()->request->getCsrfToken());?>);
            login.beforce('loginForm','登录!');
            return false;
        }
    });
    $("a.grouped_elements").fancybox();
});
</script>