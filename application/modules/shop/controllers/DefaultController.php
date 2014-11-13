<?php
use application\modules\shop\components\Controller;

class DefaultController extends Controller
{
	  
       public function actionIndex()
       {   
           $category = Category::getPar('138');//获取分类数组
           $this->render('index',array('category'=>$category));
       }
}