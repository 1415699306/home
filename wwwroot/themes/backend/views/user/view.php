<?php
$this->breadcrumbs=array(
    '用户管理'=>DIRECTORY_SEPARATOR.BACKEND_URL.DIRECTORY_SEPARATOR.'user',
    '查看用户信息 - '.$model->username
);
?>
<div class="inner"> 
    <?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'username',
        'avatar'=>array(
            'name'=>$model->userProfile->getAttributeLabel('avatar'),
            'value'=>!empty($model->userProfile->avatar) ? CHtml::image($model->userProfile->avatar,$model->username,array('width'=>'50','height'=>'50')) : '未设置',
            'type'=>'RAW',
        ),
        'status'=>array(
            'name'=>'status',
            'value'=>$model->status == '0' ? '审核中' : ($model->status == '-1' ? '黑名单' : '正常'),
        ),
        'email',
        'gender'=>array(
            'name'=>$model->userProfile->getAttributeLabel('gender'),
            'value'=>$model->userProfile->gender == '0' ? '男' : '女',
        ),
        'birthday'=>array(
            'name'=>$model->userProfile->getAttributeLabel('birthday'),
            'value'=>$model->userProfile->birthday > 0  ? date("Y-m-d",$model->userProfile->birthday) : '未设置',
        ),
        'phone'=>array(
            'name'=>$model->userProfile->getAttributeLabel('phone'),
            'value'=>$model->userProfile->phone > 0  ? $model->userProfile->phone : '未设置',
        ),
        'qq'=>array(
            'name'=>$model->userProfile->getAttributeLabel('qq'),
            'value'=>$model->userProfile->qq > 0  ? $model->userProfile->qq : '未设置',
        ),
        'company'=>array(
            'name'=>$model->userProfile->getAttributeLabel('company'),
            'value'=>!empty($model->userProfile->company)  ? $model->userProfile->company : '未设置',
        ),
        'duties'=>array(
            'name'=>$model->userProfile->getAttributeLabel('duties'),
            'value'=>!empty($model->userProfile->duties)  ? $model->userProfile->duties : '未设置',
        ),
        'sername'=>array(
            'name'=>$model->userProfile->getAttributeLabel('sername'),
            'value'=>!empty($model->userProfile->sername)  ? $model->userProfile->sername : '未设置',
        ),
        'city'=>array(
            'name'=>'城市',
            'value'=>Params::getProvince($model->userProfile->province).' - '.Params::getCity($model->userProfile->city),
        ),
        'profile'=>array(
            'name'=>$model->userProfile->getAttributeLabel('profile'),
            'value'=>!empty($model->userProfile->profile)  ? $model->userProfile->profile : '未设置',
        ),
        'register_time'=>array(
            'name'=>'register_time',
            'value'=>date("Y-m-d H:i:s",$model->register_time),
        ),
        'logintime'=>array(
            'name'=>$model->userProfile->getAttributeLabel('logintime'),
            'value'=>date("Y-m-d H:i:s",$model->userProfile->logintime),
        ),
    ),
));
?>
</div>
