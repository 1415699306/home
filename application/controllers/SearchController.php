<?php
use application\components\Controller;
class SearchController extends Controller
{ 
    public function init()
    {
        $this->layout = 'none';
       
    }
            
    public function actionIndex()
    {
        $i = $count = 0;     
        $limit = 20;
        $res = array();
        $keyword = Yii::app()->request->getParam('q',null);
        $hot = Yii::app()->redis->get('search_hot_recommand',1,1);
        if($hot === false)
        {
            $sql = 'SELECT b.name,a.id AS aid,COUNT(DISTINCT(md5)) FROM `tags_relations` AS a,`tags` AS b WHERE a.tag_id = b.id GROUP BY b.md5 ORDER BY RAND() LIMIT 5';
            $hot = Yii::app()->db->createCommand($sql)->queryAll();
            Yii::app()->redis->setex('search_hot_recommand',1,1,  CJSON::encode($hot),86400);
        }else{
            $hot = CJSON::decode($hot,true);
        }
        if(!empty($keyword))
        {
             $limit = 20;
             $offset = isset($_GET['page'])? ($_GET['page']-1)*$limit : 0;
             $search = new SphinxService();
             $search->setLimits($offset,$limit);
             $query = $search->query($keyword); 
             $count = $search->getTotal();
             if(0 < $count)
             {
                  foreach($query as $key=>$val)
                  {
                      $criteria = new CDbCriteria();
                      $criteria->addInCondition('id', $val["id"]);
                      $modelName = $key;          
                      $models = $modelName::model()->findAll($criteria);
                      foreach($models as $model)
                      {
                          $res[$i]['title_replace'] = str_replace($keyword,"<span class='news'>{$keyword}</span>", $model->title);
                          $res[$i]['title'] = $model->title;
                          $res[$i]['id'] = $model->id;
                          $res[$i]['category_id'] = $model->category_id;
                          $res[$i]['category_name'] = $model->category->name;
                          $res[$i]['url'] = strtolower($modelName);
                          $res[$i]['discription'] = str_replace($keyword,"<span class='news'>{$keyword}</span>", $model->discription);
                          $res[$i]['source'] = !empty($model->source)?$model->source:null;
                          $res[$i]['ctime'] = $model->ctime;
                          ++$i;
                      }
                  }
             }      
        }
        $pages=new CPagination($count);
        $pages->pageSize=$limit;
        $this->render('index',array('res'=>$res,'pages'=>$pages,'count'=>$count,'hot'=>$hot));
    }

}

