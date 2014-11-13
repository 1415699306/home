<?php
use application\components\Controller;

class TagController extends Controller{
    
    public function actionList()
    {
        $id = array();
        $puifier = new CHtmlPurifier();
        $aid = Yii::app()->request->getParam('aid',0);
        $md5 = md5($puifier->purify(trim(Yii::app()->request->getParam('tag',null))));
        $modelName = BaseApp::getModelName($aid);
        if($modelName===null)throw new CHttpException(404,'页面不存在!');
        $criteria = new CDbCriteria();
        $criteria->with = 'tags';
        $criteria->condition = 'tags.md5=:md5';
        $criteria->addCondition('t.app_id=:aid');
        $criteria->params = array(':md5'=>$md5,':aid'=>$aid);
        $tags = TagsRelations::model()->together(false)->findAll($criteria);      
        foreach($tags as $key){
            $id[]=$key->res_id;
        }
        $model = new CDbCriteria();
        $model->addInCondition('id', $id);
        $model->addCondition('status=0');
        $count=$modelName::model()->count($model);
        $pages=new CPagination($count);
        $pages->pageSize=10;
        $pages->applyLimit($model);
        $models = $modelName::model()->findAll($model);
        $this->render('list',array(
            'models'=>$models,
            'pages' => $pages,
        ));
    }
}
