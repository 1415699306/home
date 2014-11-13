<?php
namespace application\modules\usercenter\components;
use \Yii;
use \ResourcesHelper;
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TradeBaseController
 *
 * @author Administrator
 */
class Controller extends \CController{
    /**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1'; 
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
    
    
    public function init() 
    {
		$this->pageTitle = '用户中心_'.Yii::app()->name.'_中国领先的企业家门户网站';
		Yii::app()->clientScript->registerMetaTag(Yii::app()->setting->base->keyword,'keywords');
        Yii::app()->clientScript->registerMetaTag(Yii::app()->setting->base->discription,'description');
        ResourcesHelper::setAllSource();
    }
}

