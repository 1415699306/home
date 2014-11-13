<?php
use application\modules\study\components\Controller;

class DefaultController extends Controller
{
    
    public function filters() {
        return array (
            array (
                'COutputCache + index',
                'duration' => 3600,
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM study',

                )
            )
        );
    }
    
	public function actionIndex()
	{
        $consultancy = $this->getImgList('87','0','0','6');
        $overseas = $this->getImgList('90','0','0','6');
        $ceoread_1 = $this->getImgList('88','0','0','5');
        $ceoread_2 = $this->getImgList('88','0','5','5');
        $ceoread_3 = $this->getImgList('88','0','5','1');
        $ceoread_4 = $this->getImgList('88','0','10','1');
        $leftElite_1 = $this->getList('87','0','0','1');
        $leftElite_2 = $this->getList('87','0','2','1');
        $lefttitle_1  = $this->getList('87','0','5','7');
        $lefttitle_2  = $this->getList('87','0','10','7');
        $instructors = $this->getImgList('89','0','0','9');
        $ceoread_5 = $this->getImgList('88','0','17','1');
        $ceoread_6 = $this->getImgList('88','0','16','1');
        $this->render('index',array(
            'consultancy'=>$consultancy,
            'overseas'=>$overseas,
            'ceoread_1'=>$ceoread_1,
            'ceoread_2'=>$ceoread_2,
            'ceoread_3'=>$ceoread_3,
            'ceoread_4'=>$ceoread_4,
            'leftElite_1'=>$leftElite_1,
            'lefttitle_1'=>$lefttitle_1,
            'leftElite_2'=>$leftElite_2,
            'lefttitle_2'=>$lefttitle_2,
            'instructors'=>$instructors,
            'ceoread_5'=>$ceoread_5,
            'ceoread_6'=>$ceoread_6,
        ));
	}
    
    
    public function getImgList($cid,$history =0,$offset=0,$limit=1)
    {
        $sql = "select a.discription,a.vidty,a.scholl,a.country,a.course,a.suitable,a.cost,a.pages,a.author,a.press,a.ptime,a.video,a.professor,a.title,a.id,a.discription,b.track_id from `study` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.status=0  order by id desc limit {$offset},{$limit}";
        $model = Study::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::STUDY))->queryAll();
        return $model;
    }

     public function getList($cid,$history =0,$offset=0,$limit=1)
    {
        $sql = "select a.id,a.discription,a.vidty,a.scholl,a.recommand,a.country,a.course,a.suitable,a.cost,a.pages,a.author,a.press,a.ptime,a.video,a.professor,a.title,a.id,a.discription,b.track_id from `study` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.status=0 and a.recommand='1' order by a.id desc limit {$offset},{$limit}";
        $model = Study::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::STUDY))->queryAll();
        return $model;
    }
    
    
    
   
}