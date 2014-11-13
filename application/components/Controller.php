<?php
namespace application\components;
use \Yii;
use \ResourcesHelper;


class Controller extends \CController{

	public $layout='//layouts/column1';
	public $menu=array();
	public $breadcrumbs=array();   
        const STATUS = 1;
        const LOGIN = 0;
        const FILTER = -1;
    
        public function init()
        {

            /*Yii::app()->clientScript->registerMetaTag(Yii::app()->setting->base->keyword,'keywords');
            Yii::app()->clientScript->registerMetaTag(Yii::app()->setting->base->discription,'description');
            $this->pageTitle = '中国领先的企业家门户平台';
            if(Yii::app()->setting->base->system_status == self::STATUS)throw new CHttpException(403,'网站正在努力维护中...');
                    ResourcesHelper::setAllSource();*/
        }
    
}