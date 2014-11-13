<?php
use application\modules\dream\components\Controller;

class ProjectsController extends Controller{
    
    public function filters() {
        return array (
            array (
                'COutputCache + view',
                'duration' => 3600,
                'varyByParam' => array('id'),
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM dream',

    
    public function actionView($id)
    {
        $user = new UserService();
        $model = $this->loadModel($id);
        $criteria = new CDbCriteria();
        $criteria->condition = 'status > 1';
        $criteria->addCondition('recommand=1');
        $criteria->limit = 3;
        $criteria->order = 'id desc';
        $recommand  = Dream::model()->findAll($criteria);
        $this->render('view',array(
            'model'=>$model,
            'recommand'=>$recommand,
            'user'=>$user,
        ));
    }
    
    protected function loadModel($id)
    {
        $model = Dream::model()->findByPk($id);
        if($model === null)
            throw new CHttpException(404,'信息不存在!');
        elseif($model->status < 2 && $model->user_id != Yii::app()->user->id)
            throw new CHttpException(400,'项目审核中!');
        else
            return $model;
    }
}
