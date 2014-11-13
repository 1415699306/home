<?php
use application\modules\shop\components\Controller;
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
                'sql'=>'SELECT MAX(id) FROM shop',

                )
            )
        );
    }

       public function actionCategory($id)
       {
           $category=$this->getPar($id);
           $sql = "select a.title,a.ctime,a.id,a.category_id,a.discription,b.res_id,b.app_id,b.track_id from `shop` as a,`storage` as b where  a.id = b.res_id  and b.app_id = :aid  and a.recommend = '1' order by a.id desc limit 6";
           $data = Yii::app()->db->createCommand($sql)->bindValue(':aid', BaseApp::SHOP)->queryAll();
           $sqls = "select a.title,a.ctime,a.id,a.category_id,a.discription,b.res_id,b.app_id,b.track_id from `shop` as a,`storage` as b where  a.id = b.res_id  and b.app_id = :aid  and a.recommend = '1' order by a.id asc limit 7,5";
           $datas = Yii::app()->db->createCommand($sqls)->bindValue(':aid', BaseApp::SHOP)->queryAll();
           $this->render('category',array('category'=>$category,'data'=>$data,'datas'=>$datas));
       }
       
        private function getPar($pid)
        {
             $sql = "select id,parent_id,name,category_name from `category` where parent_id=:pid";
             $model = Yii::app()->db->createCommand($sql)->bindValue(':pid', (int)$pid)->queryAll();
             return $model;
        }
    	 
        public function actionView($id)
        {
            $this->layout='//layouts/show'; 
            $criteria =  new CDbCriteria();
            $criteria->order = 'id desc';
            $criteria->limit = 10;
            $right = Shop::model()->findAll($criteria); 
            $model = $this->loadModel($id);
            $this->render('view',array(
                'model'=>$model,
                'right'=>$right,
            ));
        }
          
        protected function loadModel($id)
        {
            $model = Shop::model()->findByPk($id);
            if($model === null)
                throw new CHttpException(404,'信息不存在!');
            else
                return $model;
        }
        
        public function actionDetail($id)
        {
            $this->layout='//layouts/show'; 
            $criteria =  new CDbCriteria();
            $criteria->order = 'id desc';
            $criteria->limit = 10;
            $right = Shop::model()->findAll($criteria); 
            $model = Announcement::model()->findByPk($id);
            if($model === null) throw new CHttpException(404,'信息不存在!');
            $this->render('detail',
            array(
                'model'=>$model,
                'right'=>$right,
            ));
        }
    
}