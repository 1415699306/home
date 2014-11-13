<?php
use application\modules\investment\components\Controller;

class ListController extends Controller{
   
     public function filters() {
        return array (
            array (
                'COutputCache + index, category',
                'duration' => 3600,
                'varyByParam' => array('id'),
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM investment',

                )
            )
        );
    }
    
    public function actionIndex()
    {
        $news = array();
        $criteria = new CDbCriteria();
        $criteria->condition = 'channel_recommand = :channel_recommand';
        $criteria->params = array(':channel_recommand'=>1);
        $criteria->order = 'id desc';
        $criteria->limit = 5;
        $top = Investment::model()->findAll($criteria);      
        $component = Yii::createComponent('CategoryComponent');
        $component->id = $this->category;
        $list = $component->getParent();
        $this->render('index',array(
            'top'=>$top,
            'list'=>$list,
        ));
    }
    
    public function actionCategory($id)
    {
        $category = Investment::model()->find('LOWER(category_id)=?',array($id));
        $criteria = new CDbCriteria();
        $criteria->condition = 'category_id = :cid';
        $criteria->addCondition('status = 0');
        $criteria->params = array(':cid'=>$id);
        $criteria->order = 'id desc';
        $count=Investment::model()->count($criteria);
        $pages=new CPagination($count);
        $pages->pageSize=15;
        $pages->applyLimit($criteria);
        $model = Investment::model()->findAll($criteria); 
        $this->render('category',array(
            'model'=>$model,
            'category'=>!empty($category->categorys->name)?$category->categorys->name:'暂无数据',
            'pages'=>$pages,
        ));
    }
}