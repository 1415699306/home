<div class="mainhd">
    <div class="logo">LeFeel Control Panel</div>
        <div class="uinfo">
            <p>您好, <em><?php echo Yii::app()->user->name;?></em> [ <a href="/site/logout" target="_top">退出</a> ]</p>
          <p class="btnlink"><?php echo CHtml::link('网站首页',Yii::app()->homeUrl,array('target'=>'_blank'));?></p>
        </div>
        <div class="navbg"></div>
    <div class="nav">
	<?php $this->widget('zii.widgets.CMenu', array(
		'id'=>'topmenu',
		'items'=>UserMangerAuthItems::getMenuController(),
	));
	?>
      <div class="navbd"></div>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'htmlOptions'=>array('class'=>'top_nav'),
			'separator'=>'<span class="divider">/</span>',
            'homeLink'=>CHtml::link('后台首页',DIRECTORY_SEPARATOR.BACKEND_URL),
			'links'=>$this->breadcrumbs,            
			));
		?>
</div>
<?php echo $this->renderPartial('webroot.themes.backend.views.layouts.menu'); ?>