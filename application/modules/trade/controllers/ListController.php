<?php
use application\modules\trade\components\Controller;

class ListController extends Controller{
    
    public function filters() {
        return array (
            array (
                'COutputCache + category,view',
                'duration' => 3600,
                'varyByParam' => array('id','page'),
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM trade',

                )
            )
        );
    }
    
    public function actionCategory($id)
    {
        $model = null;
        $criteria = new CDbCriteria();
        $criteria->condition = 'category_id=:cid';
        $criteria->addCondition('status=:status');
		$criteria->addCondition('start_time < :time');
        $criteria->addCondition('stop_time > :time');
        $criteria->addCondition('channel_recommand = :channel_recommand');
        $criteria->addCondition('recommand = :recommand');
        $criteria->params = array(':cid'=>$id,':status'=>0,':time'=>time(),':channel_recommand'=>0,':recommand'=>0);
        $models = Trade::model()->findAll($criteria);
        $criteria->params = array(':cid'=>$id,':status'=>0,':time'=>time(),':channel_recommand'=>1,':recommand'=>0);
        $right = Trade::model()->findAll($criteria);
        $criteria->params = array(':cid'=>$id,':status'=>0,':time'=>time(),':channel_recommand'=>0,':recommand'=>1);
        $publicRecommond = Trade::model()->findAll($criteria);
        if(!empty($models))
        {
            foreach($models as $key=>$val)
            {
                if($val->type == 0)
                    $model['text'][$key] = $val->attributes;
                else
                    $model['image'][$key] = $val->attributes;
            }
        }
        $this->render('category',array(
                'model'=>$model,
                'right'=>$right,
                'publicRecommond'=>$publicRecommond,
            ));
    }
    
    public function actionView($id)
    {
        $criteria =  new CDbCriteria();
        $criteria->addCondition('start_time < :time');
        $criteria->addCondition('stop_time > :time');
        $criteria->addCondition('status=:status');
        $criteria->order = 'id desc';
        $criteria->limit = 10;
        $criteria->params = array(':status'=>0,':time'=>time());
        $right = Trade::model()->findAll($criteria); 
        $model = $this->loadModel($id);
        $this->render('view',array(
            'model'=>$model,
            'right'=>$right,
        ));
    }
          
    protected function loadModel($id)
    {
        $time = time();
        $model = Trade::model()->findByPk($id);
        if($model === null || $model->status === 1 || $model->start_time > $time || $model->stop_time < $time)
            throw new CHttpException(404,'信息不存在!');
        else
            return $model;
    }
}
