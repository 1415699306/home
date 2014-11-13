<?php
use application\modules\life\components\Controller;

class DefaultController extends Controller
{
    
     public function filters() {
        return array (
            array (
                'COutputCache + index',
                'duration' => 3600,
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM life',

                )
            )
        );
    }
    
	public function actionIndex()
	{
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 27;//设置父亲ID
        $category = $component->getParent();//获取分类数组
		$this->render('index',array(
            'category'=>$category,
        ));
	}
    
    public function actionArticle()
    {
        $cid = (int)Yii::app()->request->getParam('cid',0);
        $img = $ads = array();
        $page = (int)Yii::app()->request->getParam('Life_page',1);             
        $criteria = new CDbCriteria();
        $criteria->with = 'thumbs';
        $criteria->condition = 'category_id =:cid';
        $criteria->addCondition('status=0');
        $criteria->params = array(':cid'=>$cid);
        $criteria->order = 't.id desc';    
        $criteria->limit = 20;
        $count = Life::model()->count($criteria);
        $criteria->offset = $page == 1 ? 0 : ($page-1)*20+1;
        $model = Life::model()->findAll($criteria); 
        if(empty($model))Yii::app()->end('dealWithJSONPData({"stat":"stop"})');
        foreach($model as $key=>$val)
        {
            if(!empty($val->thumbs->track_id))
            {
                $height = '190';
                $width = '320';
                $new = '/'.RESOURCE.'/life/thumb/life_'.$val->thumbs->track_id;
                
                $path = RESOURCE_PATH.DIRECTORY_SEPARATOR.'life'.DIRECTORY_SEPARATOR.'thumb';
                $file = $path.DIRECTORY_SEPARATOR.'life_'.$val->thumbs->track_id;
                $target = $path.DIRECTORY_SEPARATOR.'life_'.$val->thumbs->track_id;  
                if(!is_file($file))
                {                                                                                               
                    $new = Storage::getImageBySize($val->thumbs->track_id,'life','16_9','thumb');                 
                }
                else
                {
                    $size = getimagesize($target);
                    if(!empty($size))
                    {
                        $width = $size[0];
                        $height = $size[1];
                    }
                }
                $img[$key]['width'] = $width;
                $img[$key]['heights'] = $height;
                $img[$key]['src'] = $new;
                $img[$key]['title'] = Helper::truncate_utf8($val->title,12);
                $img[$key]['link'] = $this->createUrl('/life/list/view',array('id'=>$val->id));
                $img[$key]['discription'] = $val->discription;
            }
        }     
        Yii::app()->end('dealWithJSONPData({"photos":{"page":'.$page.',"count":'.$count.',"photo":'.CJSON::encode($img).'},"cid":'.$cid.',"stat":"ok"})');
    }
    
    
    public function actionCode()
    {
        $this->render("code");
    }
}