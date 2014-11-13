<?php
use \application\modules\usercenter\components\Controller;

class PersonalController extends Controller
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
                'actions'=>array('index'),
                        'users'=>array('@'),
                ),
                array('deny',
                        'users'=>array('*'),
                ),
        );
    }
    
    
    public function actionIndex()
    {  
        $uid = Yii::app()->user->id;
        $model = UserService::getUserProfile($uid);
        $this->render('index',array('model'=>$model));
    }
      
}
