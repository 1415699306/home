<?php
use application\modules\life\components\Controller;
class ListController extends Controller
{
    
  public function filters() {
        return array (
            array (
                'COutputCache + category,view',
                'duration' => 3600,
                'varyByParam' => array('id'),
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM life',

                )
            )
        );
    }
    
    public function actionCategory($id)
    {
        $this->layout = '//layouts/head';
        $this->render('category',array('id'=>$id));
    }
    
    public function actionView($id)
    {
        $model = $this->loadModel($id);
        $this->render('view',array(
            'model'=>$model,
        ));
    }
          
    protected function loadModel($id)
    {
        $model = Life::model()->findByPk($id);
        if($model === null || $model->status === 1)
            throw new CHttpException(404,'信息不存在!');
        else
            return $model;
    }
}