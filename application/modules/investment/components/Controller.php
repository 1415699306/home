<?php
namespace application\modules\investment\components;
use \Yii;
use \ResourcesHelper;
use \Helper;
class Controller extends \CController{

	public $layout='//layouts/column1'; 
	public $menu=array();
	public $breadcrumbs=array();   
    public $category;  
    public $category_link;
    public $category_menu = array(
        '招商直播室'=>'http://quanzi.lfeel.com/live.php',
        '地区招商'=>'/investment/default/regional', 
    );
    public function init() 
    {
        $category = Helper::getCategoryParem('investment');
        if(isset($category->id))$this->category = $category->id;
        if(isset($category->link))$this->category_link = $category->link;
        if(isset($category->title))$this->pageTitle = $category->title;
        if(isset($category->keyword))Yii::app()->clientScript->registerMetaTag($category->keyword,'keywords');
        if(isset($category->discription))Yii::app()->clientScript->registerMetaTag($category->discription,'description');
        ResourcesHelper::setAllSource();
    }
}
