<?php
$js = Yii::app()->getClientScript();
$js->registerCoreScript('jquery');
$js->registerScriptFile('/js/common.js');
$js->registerScriptFile('/js/jquery.wresize.js');
$js->registerScriptFile('/js/function.js');
?>
<div class="stick">
	<div class="wrap max-width">
    	<div class="wrap-right">   
            <?php if(Yii::app()->user->isGuest):?>
            <a href="http://quanzi.lfeel.com" id="login" class="login text-center font-while block login_top" target="_blank">登录</a>     
            <?php else:?>
            <?php echo CHtml::link('退出',$this->createUrl('/site/logout'),array('class'=>'login text-center font-while block login_to'));?>
            <?php endif;?>     
            <a href="http://quanzi.lfeel.com/member.php?mod=register" class="message iconpng" target="_blank"></a>
        </div>
    	<div class="wrap-left">
            <p style="color: #fff;height: 44px;line-height: 44px;font-size: 14px;font-family: 微软雅黑;">尊贵热线：400-840-6688</p>
        </div>
    </div>	
</div>

<div class="box max-width">
	<div class="head">
    	<div class="head-right">
            <?php echo CHtml::form('/search/index','GET',array('id'=>'search'));?>
        	<div class="search">
                <div class="mid iconpng">
                	<div class="icon iconpng"></div>

                    <input type="text" value="请输入关键词" id="search-input" name="q" class="search_btn" />

                </div>
                <div class="right iconpng"><?php echo CHtml::submitButton('搜索');?></div>
            </div>
            <?php echo CHtml::endForm();?>
            <div class="hot-search">
            	<h2>热门搜索：</h2>
                <ul class="list">
                    <?php foreach(Tags::getSearchHot('3') as $key):?>
                    <li><?php echo CHtml::link($key['name'],$this->createUrl('/search/index',array('q'=>$key['name'])));?></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    	<div class="head-left">
        	<div class="logo"><a href="#"></a></div>
        </div>
        
    </div>
    
    <?php if(Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index'):?>
        <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'site_nav');?>
    <?php else:?>
        <?php  $this->renderPartial(THEME_PATH.DIRECTORY_SEPARATOR.'public'.DIRECTORY_SEPARATOR.'public_nav');?>
    <?php endif;?>
        <!--二级导航-->
    <?php $this->widget('ext.widgets.navlevel.INavLevel');?>