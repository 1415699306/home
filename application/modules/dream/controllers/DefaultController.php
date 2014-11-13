<?php
use application\modules\dream\components\Controller;

class DefaultController extends Controller
{
    
      public function filters() {
        return array (
            array (
                'COutputCache + index',
                'duration' => 3600,
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM dream',

                )
            )
        );
    }
    
    public function actionIndex($rec=1,$cat=0)
    {
        $component = Yii::createComponent('CategoryComponent');        
        $component->id = 124;
        $criteria = new CDbCriteria();
        $status = Yii::app()->request->getParam('status',0);
        if(0 < $status)
        {
            $criteria->condition = 'status=4';    
        }
        else
        {
            $criteria->condition = 'status>1';    
            if(0 < $cat){
                $criteria->addCondition("category_id='{$cat}'");
            }else{
                $criteria->addCondition('recommand=:r');
                $criteria->params = array(':r'=>$rec);
            }   
        }

        $criteria->order = 'id desc';
        $count=Dream::model()->count($criteria);
        $pages=new CPagination($count);
        $pages->pageSize=16;
        $pages->applyLimit($criteria);
        $models = Dream::model()->findAll($criteria);
        if(Yii::app()->request->isAjaxRequest)
        {
            $this->_setAjaxRequest($models, $pages);
        }
        $this->render('index',array(
            'models'=>$models,
            'pages'=>$pages,
            'categorys'=>$component->getParent(),
        ));
    }   
    
    private function _setAjaxRequest($models,$pages)
    {
        $data = array();
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
}
