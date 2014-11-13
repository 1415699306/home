<?php
use application\modules\article\components\Controller;

class ListController extends Controller{
    
  
    public function filters() {
        return array (
            array (
                'COutputCache + view',
                'duration' => 3600,
                'varyByParam' => array('id'),
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM article',

                )
            )
        );
    }
    
    public function actionView($id)
    {
        $criteria =  new CDbCriteria(); 
        $criteria->order = 'mtime desc';
        $criteria->limit = 10;
        $right = Article::model()->findAll($criteria);
        $model = $this->loadModel($id);
        $this->render('view',array(
            'model'=>$model,
            'right'=>$right,
        ));
    }
          
    protected function loadModel($id)
    {
        $model = Article::model()->findByPk($id);
        if($model === null || $model->status === 1)
            throw new CHttpException(404,'信息不存在!');
        else
            return $model;
    }
    
 
}
