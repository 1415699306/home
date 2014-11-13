<?php
use application\modules\usercenter\components\Controller;

class DefaultController extends Controller
{
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
                'actions'=>array('profile','index','password','avatar','flashUploadAvatar','projects'),
                        'users'=>array('@'),
                ),
                array('deny',
                        'users'=>array('*'),
                ),
        );
    }
    
    /**
     * 用户中心首页
     */
    public function actionIndex($cid = 0)
    {
        $uid = Yii::app()->user->id;
        $criteria = new CDbCriteria();
        $criteria->condition = 'user_id = :uid';
        $criteria->order = 'id desc';
        $criteria->params = array(':uid'=>$uid);
        $dreams = Dream::model()->findAll($criteria);
        $criteria->addCondition('app_id='.BaseApp::DREAM);
        $supports = PublicOrder::model()->findAll($criteria);
        $render = $supports = array();
        if(empty($supports)){
              $render = array('dreams'=>$dreams,'supports'=>$supports);
        }
        if(empty($dreams) && empty($supports)){
            $discoverys = array('discoverys'=>$this->_loadRand($cid));
            $render = array_merge($discoverys,$render);
        }
        $this->render('index',$render);
    }
    
    /**
     * 修改用户头像
     */
    public function actionAvatar()
    {
        $this->render('avatar');
    }
    
    /**
     * 修改用户密码
     */
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
    
    /*用户扩展资料修改*/
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
    
    
     
    private function _loadRand($cid)
    {       
        $criteria = new CDbCriteria();
        $criteria->condition = 'status > 2';
        if(0 < $cid)
        {
            $criteria->addCondition('category_id=:cid');
        }
        $criteria->params = array(':cid'=>$cid);
        $criteria->limit = 3;
        $criteria->order = 'rand()';
        return  Dream::model()->findAll($criteria);
    }
    
}