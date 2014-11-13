<div class="LeftDiv">
    <div class="head"><img src="<?php echo User::getAvatar(Yii::app()->user->id);?>" alt="<?php echo Yii::app()->user->name;?>"></div>
    <div class="Text">
        <h3><?php echo CHtml::link('个人主页',$this->createUrl('/usercenter/default/index'));?></h3>
        <ul class="TextList">
            <li class="title"><em class="em_1"></em>梦想管理</li>
            <li><?php echo CHtml::link('发布梦想',$this->createUrl('/usercenter/projects/create'));?></li>
            <li><?php echo CHtml::link('我的梦想',$this->createUrl('/usercenter/projects/index'));?></li>
            <li><?php echo CHtml::link('关注中',$this->createUrl('/usercenter/projects/attention'));?></li>
            <li><?php echo CHtml::link('支持中',$this->createUrl('/usercenter/projects/support'));?></li>
            <li class="title"><em class="em_2"></em>信息管理</li>
            <!--
            <li><?php echo CHtml::link('我的私信',$this->createUrl('/usercenter/information/index'));?></li>
            -->
            <li><?php echo CHtml::link('我的评论',$this->createUrl('/usercenter/information/comment'));?></li>
            <!--
            <li><?php echo CHtml::link('站内通知',$this->createUrl('/usercenter/information/notice'));?></li>
            -->
            <li class="title"><em class="em_3"></em>资金管理</li>

            <li><?php echo CHtml::link('个人账户',$this->createUrl('/usercenter/account/index'));?></li>
            <!--
            <li><?php echo CHtml::link('账户充值',$this->createUrl('/usercenter/account/charge'));?></li>
            -->
            <li><?php echo CHtml::link('账户提现',$this->createUrl('/usercenter/account/draw'));?></li>
            <li class="title"><em class="em_4"></em>用户信息</li>
            <li><?php echo CHtml::link('个人信息',$this->createUrl('/usercenter/personal/index'));?></li>
        </ul>
    </div>
</div>