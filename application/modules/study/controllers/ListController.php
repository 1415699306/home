<?php
use application\modules\study\components\Controller;

class ListController extends Controller{
    
    public function filters() {
        return array (
            array (
                'COutputCache + category,view',
                'duration' => 3600,
                'varyByParam' => array('id','page'),
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM study',

                )
            )
        );
    }
    
    public function actionCategory($id)
    {
        $category = (int)Yii::app()->request->getParam('category_id',$id);
        if($category == 87){
            $count= $this->_getCount($id);
            $pages=new CPagination($count["count(a.id)"]);
            $pages->pageSize=8;
            $sql = "select a.vidty, a.title,a.category_id,a.professor,a.vidty,a.format,a.id,a.status,a.ctime,a.discription,b.res_id,b.app_id,b.track_id from `study` as a,`storage` as b where b.res_id = a.id and a.category_id =:cid and b.app_id = :aid  and a.status = '0' order by a.id desc limit :offset,:limit";
            $model =  Yii::app()->db->createCommand($sql)->bindValues(array(':aid'=> BaseApp::STUDY,':cid'=>(int)$id,':offset'=>$pages->getOffset(),':limit'=>$pages->getLimit()))->queryAll(); 
            $recommend1 = $this->getImgList('88','0','6'); 
            $recommend2 = $this->getRecom('87','0','6');
            $expert = $this->getImgList('89','0','6');
            $this->render('category',array(
                'model'=>$model,
                'pages'=>$pages, 
                'recommend1'=>$recommend1,
                'recommend2'=>$recommend2,
                'expert'=>$expert,
            ));
       }elseif($category == 88){
            $count= $this->_getCount($id);
            $pages=new CPagination($count["count(a.id)"]);
            $pages->pageSize=8;
            $sql = "select  a.author,a.press,a.ptime,a.pages,a.title,a.category_id,a.professor,a.vidty,a.format,a.id,a.status,a.ctime,a.discription,b.res_id,b.app_id,b.track_id from `study` as a,`storage` as b where b.res_id = a.id and a.category_id =:cid and b.app_id = :aid  and a.status = '0' order by a.id desc limit :offset,:limit";
            $model = Yii::app()->db->createCommand($sql)->bindValues(array(':aid'=> BaseApp::STUDY,':cid'=>(int)$id,':offset'=>$pages->getOffset(),':limit'=>$pages->getLimit()))->queryAll(); 
            $recommend1 = $this->getImgList('90','1','6'); 
            $recommend2 = $this->getRecom('88','0','6');  
            $expert = $this->getImgList('89','0','6');
            $this->render('category_ceo',array(
                'model'=>$model,
                'pages'=>$pages, 
                'recommend1'=>$recommend1,
                'recommend2'=>$recommend2,
                'expert'=>$expert,
            ));
       }elseif($category == 89) {
            $count= $this->_getCount($id);
            $pages=new CPagination($count["count(a.id)"]);
            $pages->pageSize=8;
            $sql = "select  a.video,a.title,a.category_id,a.professor,a.vidty,a.format,a.id,a.status,a.ctime,a.discription,b.res_id,b.app_id,b.track_id from `study` as a,`storage` as b where b.res_id = a.id and a.category_id =:cid and b.app_id = :aid  and a.status = '0' order by a.id desc limit :offset,:limit";
            $model = Yii::app()->db->createCommand($sql)->bindValues(array(':aid'=> BaseApp::STUDY,':cid'=>(int)$id,':offset'=>$pages->getOffset(),':limit'=>$pages->getLimit()))->queryAll(); 
            $recommend1 = $this->getImgList('87','2','6'); 
            $recommend2 = $this->getRecom('89','0','6');
            $expert = $this->getImgList('89','0','6');
            $this->render('category_expert',array(
                'model'=>$model,
                'pages'=>$pages, 
                'recommend1'=>$recommend1,
                'recommend2'=>$recommend2,     
                'expert'=>$expert,
            ));
       }elseif($category == 90) {
            $count= $this->_getCount($id);
            $pages=new CPagination($count["count(a.id)"]);
            $pages->pageSize=8;
            $sql = "select a.country,a.course,a.cost,a.scholl,a.suitable,  a.title,a.category_id,a.professor,a.vidty,a.format,a.id,a.status,a.ctime,a.discription,b.res_id,b.app_id,b.track_id from `study` as a,`storage` as b where b.res_id = a.id and a.category_id =:cid and b.app_id = :aid  and a.status = '0' order by a.id desc limit :offset,:limit";
            $model = Yii::app()->db->createCommand($sql)->bindValues(array(':aid'=> BaseApp::STUDY,':cid'=>(int)$id,':offset'=>$pages->getOffset(),':limit'=>$pages->getLimit()))->queryAll();  
            $recommend1 = $this->getImgList('87','0','6'); 
            $recommend2 = $this->getRecom('90','0','6');       
            $expert = $this->getImgList('89','0','6');
            $this->render('category_oversea',array(
                'model'=>$model,
                'pages'=>$pages, 
                'recommend1'=>$recommend1,
                'recommend2'=>$recommend2,
                'expert'=>$expert,
            ));
        }             
    }
   
    private function _getCount($id)
    {
        return Yii::app()->db->createCommand("select count(a.id) from  `study` as a,`storage` as b where b.res_id = a.id and a.category_id =:cid and b.app_id = :aid  and a.status = '0' order by a.id desc")->bindValues(array(':aid'=> BaseApp::STUDY,':cid'=>(int)$id))->queryRow();
    }

    public function actionView($id)
    {
        $category = (int)Yii::app()->request->getParam('category_id',$id);
        $cate = Study::model()->findByPk($id)->category_id;
        if($cate == 87)
        {
			$model = $this->loadModel($id);
			$related = $this->getList('87','0','4');
			$recommend = $this->getList('87','0','6');
			$expert =  $this->getList('89','0','6');
			$this->render('view',array(
			   'model'=>$model,
			   'related'=>$related,
			   'recommend'=>$recommend,
			   'expert'=>$expert,
			));
         }elseif($cate == 88) {
               $model = $this->loadModel($id);
               $related = $this->getList('87','0','4');
               $recommend = $this->getList('88','0','6');
               $expert =  $this->getList('89','0','6');
               $this->render('view_ceo',array(
                   'model'=>$model,
                   'related'=>$related,
                   'recommend'=>$recommend,
                   'expert'=>$expert,
               ));
        }elseif($cate == 89){
			$model = $this->loadModel($id);
			$related = $this->getList('87','0','4');
			$recommend = $this->getList('89','0','6');
			$expert =  $this->getList('89','0','6');
			$this->render('view_expert',array(
			   'model'=>$model,
			   'related'=>$related,
			   'recommend'=>$recommend,
			   'expert'=>$expert,
			));
        }elseif($cate == 90){
			$model = $this->loadModel($id);
			$related = $this->getList('87','0','4');
			$recommend = $this->getList('90','0','6');
			$expert =  $this->getList('89','0','6');
			$this->render('view_oversea',array(
			   'model'=>$model,
			   'related'=>$related,
			   'recommend'=>$recommend,
			   'expert'=>$expert,
			));
        }                 
    }
          
    protected function loadModel($id)
    {
        $model = Study::model()->findByPk($id);
        if($model === null || $model->status === 1)
            throw new CHttpException(404,'信息不存�?');
        else
            return $model;
    }
        
    public function getImgList($cid,$offset=0,$limit=3)
    {
        $sql = "select a.vidty,a.discription, a.scholl,a.country,a.course,a.suitable,a.cost,a.pages,a.author,a.press,a.ptime, a.video,a.professor,a.format, a.title,a.id,a.discription,b.track_id from `study` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommand = '1'   limit {$offset},{$limit}";
        $model = Study::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::STUDY))->queryAll();
        return $model;
    }
    
     public function getList($cid,$offset=0,$limit=3)
    {
        $sql = "select a.discription,a.vidty,a.scholl,a.country,a.course,a.suitable,a.cost,a.pages,a.author,a.press,a.ptime, a.video,a.country,a.professor,a.author,a.vidty,a.format,a.title,a.id,a.discription,b.track_id from `study` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommand = '1' order by id desc limit {$offset},{$limit}";
        $model = Study::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::STUDY))->queryAll();
        return $model;
    }

    public function getRecom($cid,$offset=0,$limit=3)
    {
        $sql = "select a.discription,a.vidty,a.scholl,a.channel_recommand,a.country,a.course,a.suitable,a.cost,a.pages,a.author,a.press,a.ptime, a.video,a.country,a.professor,a.author,a.vidty,a.format,a.title,a.id,a.discription,b.track_id from `study` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.channel_recommand = '1'  limit {$offset},{$limit}";
        $model = Study::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::STUDY))->queryAll();
        return $model;
    }
    
   
   
    
    
  
    
}
