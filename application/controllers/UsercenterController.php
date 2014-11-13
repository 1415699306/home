<?php
use application\components\Controller;

class UsercenterController extends Controller{
    
    public function actions()
    {
        return array(
            'flashUploadAvatar'=>array(
                'class'=>'ext.widgets.avatar.uploadCreate',
            ),
        );
    }
    
    public function filters()
    {
        return array(
                'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
                array(
                'allow',
                'actions'=>array('profile','index','password','avatar','flashUploadAvatar'),
                        'users'=>array('@'),
                ),
                array('deny',
                        'users'=>array('*'),
                ),
        );
    }
    
    public function actionIndex()
    {
        $model = User::model()->findByPk(Yii::app()->user->id);
        $this->render('index',array(
            'model'=>$model,
        ));
    }
    
    public function actionAvatar()
    {
        $this->render('avatar');
    }

    public function actionPassword()
    {
        $model = new PasswordForm();
        $this->performAjaxValidationPassword($model);
        if(isset($_POST['PasswordForm'])){
            $user = User::model()->findByPk(Yii::app()->user->id);
            $user->password = hash('sha256',Yii::app()->params['loginCodeKey'].$_POST['PasswordForm']['password']);
            if($user->save())
                Yii::app()->user->setFlash('register','修改密码成功!');
            else
                Yii::app()->user->setFlash('register','修改密码失败!');
        }
        $this->render('password',array(
            'model'=>$model,
        ));
    }

    public function actionProfile()
    {
        $model = UserProfile::model()->with('user')->find('LOWER(user_id)=?',array(Yii::app()->user->id));
        $this->performAjaxValidation($model);
        if(isset($_POST['UserProfile']))
        {
            $model->attributes = $_POST['UserProfile'];
            if($model->save())
            {
                $model->user->email = $_POST['UserProfile']['email'];
                $model->user->mtime = time();
                $model->user->save();
                Yii::app()->user->setFlash('register','修改资料成功!');
            }
        }
        $this->render('profile',array(
            'model'=>$model,
        ));    
    }
    
    protected function performAjaxValidation($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='profile-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
    
    protected function performAjaxValidationPassword($model)
    {
        if(isset($_POST['ajax']) && $_POST['ajax']==='password-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }
}

