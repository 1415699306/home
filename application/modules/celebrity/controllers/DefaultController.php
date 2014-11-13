<?php
use application\modules\celebrity\components\Controller;

class DefaultController extends Controller
{
     public function filters() {
        return array (
            array (
                'COutputCache + index,entre',
                'duration' => 3600,
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM celebrity',

                )
            )
        );
    }
    
    
	public function actionIndex()
	{
        $interview = $this->_getInterview();
        $leftList = $this->_getLeftList();
        $leftElite = $this->_getLeftBigList('49');
        $leftScholar = $this->_getLeftBigList('50');
        $interviewRecommand = $this->_getInterviewRecommand();
		$this->render('index',array(
            'interview'=>$interview,
            'leftList'=>$leftList,
            'leftElite'=>$leftElite,
            'leftScholar'=>$leftScholar,
            'interviewRecommand'=>$interviewRecommand,
        ));
	}
    
    
    private function _getInterview()
    {
        $sql = "select a.id,a.title,a.status,a.category_id,a.channel_recommand,b.track_id,b.app_id,b.res_id from `celebrity` as a, `storage` as b where a.id = b.res_id and b.app_id = :aid and a.channel_recommand = '1' and a.status = '0' order by a.id desc limit 4";
        $model = Celebrity::model()->getDbConnection()->createCommand($sql)->bindValue(':aid',BaseApp::CELEBRITY)->queryAll();
        return $model;
    }
    
  
    
    private function _getLeftList()
    {
        $sql = "select id,title from `celebrity` where channel_recommand = '0' and status = '0' order by id desc limit 12";
        $model = Celebrity::model()->getDbConnection()->createCommand($sql)->queryAll();
        return $model;
    }
    
   
    private function _getLeftBigList($id)
    {
        $sql = "select a.id,a.title,a.status,a.discription,a.category_id,a.channel_recommand,b.track_id,b.app_id,b.res_id from `celebrity` as a, `storage` as b where a.id = b.res_id and b.app_id = :aid and a.channel_recommand = '0' and a.status = '0' and a.category_id = :cid order by a.id desc limit 3";
        $model = Celebrity::model()->getDbConnection()->createCommand($sql)->bindValues(array(':aid'=>BaseApp::CELEBRITY,':cid'=>$id))->queryAll();
        return $model;      
    }
    
    
    private function _getInterviewRecommand()
    {
        $sql = "select *,b.id as bid,a.id as aid from `celebrity` as a, `storage` as b where a.interview_recommand = '1' and a.id = b.res_id and b.app_id = :aid order by a.id desc limit 1";
        $model = Celebrity::model()->getDbConnection()->createCommand($sql)->bindValue(':aid',BaseApp::CELEBRITY)->queryRow();
        return $model;
    }
    
    public function actionEntre()
    {
        $this->layout = '//layouts/entre';
        $this->render('entre');
    }
}