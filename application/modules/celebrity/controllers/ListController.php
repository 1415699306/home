<?php
use application\modules\celebrity\components\Controller;

class ListController extends Controller{
     public function filters() {
        return array (
            array (
                'COutputCache + category,view',
                'duration' => 3600,
                'varyByParam' => array('id','page'),
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM celebrity',

                )
            )
        );
    }
    
    public function actionCategory($id)
    {
        $count= Yii::app()->db->createCommand("select count(a.id) from `celebrity` as a,`storage` as b where a.id = b.res_id and a.category_id =:cid and b.app_id = :aid  and a.status = '0' order by a.id desc")->bindValues(array(':aid'=> BaseApp::CELEBRITY,':cid'=>(int)$id))->queryRow();
        $pages=new CPagination($count["count(a.id)"]);
        $pages->pageSize=20;
        $sql = "select a.title,a.id,a.status,b.res_id,b.app_id,b.track_id from `celebrity` as a,`storage` as b where a.id = b.res_id and a.category_id =:cid and b.app_id = :aid  and a.status = '0' order by a.id desc limit :offset,:limit";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':aid'=> BaseApp::CELEBRITY,':cid'=>(int)$id,':offset'=>$pages->getOffset(),':limit'=>$pages->getLimit()))->queryAll();
        $this->render('category',array(
            'model'=>$model,
            'pages'=>$pages,
        ));
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
        $model = Celebrity::model()->findByPk($id);
        if($model === null || $model->status === 1)
            throw new CHttpException(404,'信息不存在!');
        else
            return $model;
    }
}
