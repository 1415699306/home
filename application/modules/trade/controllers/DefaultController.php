<?php
use application\modules\trade\components\Controller;
class DefaultController extends Controller
{
    
    public function filters() {
        return array (
            array (
                'COutputCache + index',
                'duration' => 3600,
                'dependency' => array(
                'class'=>'CDbCacheDependency',
                'sql'=>'SELECT MAX(id) FROM trade',

                )
            )
        );
    }
    
	public function actionIndex()
	{
        $venture_img = $this->_getList('63','1');
        $venture_txt = $this->_getList('63','0');
        $merchants_img = $this->_getList('64','1');
        $merchants_txt = $this->_getList('64','0');
        $investment_img = $this->_getList('65','1');
        $investment_txt = $this->_getList('65','0');
        $commerce_img = $this->_getList('137','1');
        $commerce_txt = $this->_getList('137','0');
	$this->render('index',array(
            'venture_img'=>$venture_img,
            'venture_txt'=>$venture_txt,
            'merchants_img'=>$merchants_img,
            'merchants_txt'=>$merchants_txt,
            'investment_img'=>$investment_img,
            'investment_txt'=>$investment_txt,
            'commerce_img'=>$commerce_img,
            'commerce_txt'=>$commerce_txt,
        ));
	}
    
    private function _getList($id,$type)
    {
        $sql = "SELECT * FROM  `trade` where `category_id` =:cid and `type` =:type and `status` = '0' and `start_time` < :time and `stop_time` > :time ORDER BY `index` asc limit 10";
        $model = Trade::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$id,':type'=>(int)$type,':time'=>time()))->queryAll();
        return $model;
    }
}