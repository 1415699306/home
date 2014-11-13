<?php
namespace application\modules\dream\components;
use \Yii;
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
    
    public $category = 124;
    
    public $category_link = '/list/category';
    
    public function init() 
    {
        $this->pageTitle = '梦想秀_'.Yii::app()->name.'_中国领先的企业家门户网站';
//        Yii::app()->clientScript->registerMetaTag(Yii::app()->setting->base->keyword,'keywords');
//        Yii::app()->clientScript->registerMetaTag(Yii::app()->setting->base->discription,'description');
        $script=Yii::app()->clientScript;
        $js_file = 'all.js';
        $script->scriptMap=array(
				'common.js'=>"/js/{$js_file}",
                'function.js'=>"/js/{$js_file}",
                'showMsg.js'=>"/js/{$js_file}",
                'jquery.wresize.js'=>"/js/{$js_file}",
        );
    }
}
