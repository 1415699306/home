<?php
namespace application\modules\meet\components;
use \Yii;
use \ResourcesHelper;
use \Helper;
class Controller extends \CController{

	public $layout='//layouts/column1'; 
	public $menu=array();
	public $breadcrumbs=array();
    public $category;   
    public $category_link;

    public function init() 
    {
        //if(Yii::app()->user->isGuest)  header('location:http://quanzi.lfeel.com/');
        $category = Helper::getCategoryParem('meet');
        if(isset($category->id))$this->category = $category->id;
        if(isset($category->link))$this->category_link = $category->link;
        if(isset($category->title))$this->pageTitle = $category->title;
        if(isset($category->keyword))Yii::app()->clientScript->registerMetaTag($category->keyword,'keywords');
        if(isset($category->discription))Yii::app()->clientScript->registerMetaTag($category->discription,'description');
        ResourcesHelper::setAllSource();
    }
}
