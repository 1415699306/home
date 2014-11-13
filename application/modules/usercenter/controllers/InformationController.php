<?php
use application\modules\usercenter\components\Controller;

class InformationController extends Controller
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
                'actions'=>array('index','comment','notice'),
                        'users'=>array('@'),
                ),
                array('deny',
                        'users'=>array('*'),
                ),
        );
    }
    
    
    public function actionIndex()
    {
        $this->render('index');
    }
    
    public function actionComment()
    {
        $uid = Yii::app()->user->id;
        $sql1 = "select username,content,id,parent_id,ctime from `public_comment` where user_id=:id";
        $list = Yii::app()->db->createCommand($sql1)->bindValues(array(':id'=>(int)$uid))->queryRow();
        $sql2 = "select username,content,id,parent_id,ctime from `public_comment` where parent_id=:id";
        $lists = Yii::app()->db->createCommand($sql2)->bindValues(array(':id'=>(int)$list['id']))->queryAll();
        $this->render('comment',array('list'=>$list,'lists'=>$lists));
    }
    
    
    public function actionNotice()
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'status=0';
        $criteria->order = 'id desc';
        $comment = PublicComment::model()->findAll($criteria);
        $this->render('notice',array('comment'=>$comment));
    }
}

