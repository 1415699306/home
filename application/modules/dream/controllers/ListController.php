<?php
use application\modules\dream\components\Controller;

class ListController extends Controller
{
    public function filters() {
        return array (
            array (
                'COutputCache + category',
                'duration' => 3600,
                'varyByParam' => array('id','page'),
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM dream',

                )
            )
        );
    }
    
    
    public function actionCategory($id)
    {
        $data = array();     
        $criteria = new CDbCriteria();
        $criteria->condition = 'status>1';    
        $criteria->addCondition("category_id='{$id}'");
        $criteria->order = 'id desc';
        $count=Dream::model()->count($criteria);
        $pages=new CPagination($count);
        $pages->pageSize=16;
        $pages->applyLimit($criteria);
        $models = Dream::model()->findAll($criteria);
        if(Yii::app()->request->isAjaxRequest)
        {
            foreach($models as $key=>$val)
            {
                $data[$key]['id']=$val->id;
                $data[$key]['url']=$this->createUrl('/dream/projects/view',array('id'=>$val->id));
                $data[$key]['title']=Helper::truncate_utf8($val->title, 16);
                $data[$key]['discription'] = Helper::truncate_utf8($val->discription,85);
                $data[$key]['status']=$val->status;
                $data[$key]['thumb']=Storage::getImageBySize(!empty($val->thumbs->track_id)?$val->thumbs->track_id:null,'dream',null,'thumb');
                $data[$key]['widget'] = $val->targetItems;
                $data[$key]['getStatus'] = Dream::getStatus($val->status);
                $data[$key]['lastDays'] = $val->lastDays;
                $data[$key]['preparation'] = $val->preparation;
                $data[$key]['payment'] = $val->payment;
                $data[$key]['attention'] =  PublicAttention::getCount($val->id,BaseApp::DREAM);
            }
            Yii::app()->end(CJSON::encode(array('page'=>$pages->currentPage+2,'data'=>$data)));
        }
        $this->render('category',array(
            'models'=>$models,
            'pages'=>$pages,
        ));
    }
}
