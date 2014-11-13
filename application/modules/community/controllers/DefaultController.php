<?php
use application\modules\community\components\Controller;
class DefaultController extends Controller
{
    
     public function filters() {
        return array (
            array (
                'COutputCache + index',
                'duration' => 3600,
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM community',

                )
            )
        );
    }
    
	public function actionIndex()
	{
        $consultancy = $this->getImgList('74','0','0','5');
        $SeekHelpImage = $this->getImgList('83','0','0','10');
        $SeekHelpText = $this->getImgList('83','0','4','14');
        $Character = $this->getImgList('76','0','0','20');
        $Notice = $this->getImgList('73','0','0','5');
        $history = $this->getHistory();
		$this->render('index',array(
            'consultancy'=>$consultancy,
            'SeekHelpImage'=>$SeekHelpImage,
            'SeekHelpText'=>$SeekHelpText,
            'Character'=>$Character,
            'Notice'=>$Notice,
            'history'=>$history,
        ));
	}
    
    public function getImgList($cid,$history =0,$offset=0,$limit=10)
    {
        $sql = "select a.title,a.id,a.discription,b.track_id from `community` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.status=0 and a.history = '{$history}' order by id desc limit {$offset},{$limit}";
        $model = Community::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::COMMUNITY))->queryAll();
        if($model === null)
            return array();
        else
            return $model;
    }
    
    public function getHistory()
    {
        $sql = "select a.title,a.id,a.discription,b.track_id from `community` as a,`storage` as b where  a.id=b.res_id and b.app_id=:app_id and a.status=0 and a.history = '1' order by id desc limit 10";
        $model = Community::model()->getDbConnection()->createCommand($sql)->bindValues(array(':app_id'=>BaseApp::COMMUNITY))->queryAll();
        if($model === null)
            return array();
        else
            return $model;
    }
}