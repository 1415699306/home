<?php


class BaseApp {
    
    
    const ARTICLE = 0;
    
    const INVESTMENT = 1;
    
    const MEET = 2;
    
    const EMINENTPERSON =3; 
    
    const ADVERTISING = 4; 
    
    const SLIDE = 5;
    
    const BASE = 6; 
    
    const LIFE = 7; 
   
    const CELEBRITY = 8;	

	const STUDY = 9;
   
    const TRADE = 10;
   
    const COMMUNITY = 11;  
  
    const MATION = 12;
    
    const DREAM = 13;
    
    const DREAMPLEDGBES = 14;
    
    const NEWS = 15;
    
    const SHOP = 16;
    
    public static function getModel($model)
    {
        $key = strtoupper($model);
        $const = new ReflectionClass('BaseApp'); 
        $res = array_flip($const->getConstants());       
        if(array_key_exists($key, $res))
            return ucfirst(strtolower($res[$key]));
        else
            throw new CHttpException(400,'用户信息有误');
    } 

    
    public function getConst()
    {
        $const = new ReflectionClass('BaseApp'); 
        return $const->getConstants();
    }
    
    public static function getModelName($key,$reversion=false)
    {
        $params = array(
            '0'=>'Article',
            '1'=> 'Investment',
            '2'=>'Meet',
            '3'=>'EminentPerson',
            '4'=>'Advertising',
            '5'=>'Slide',
            '6'=>'Base',
            '7'=>'Life',
            '8'=>'Celebrity',
            '9'=>'Study',
            '10'=>'Trade',
            '11'=>'Community',
            '12'=>'Mation',
            '13'=>'Dream',
            '14'=>'News',
            '15'=>'Shop',
        );
        if($reversion){
            $params = array_flip($params);
        }
        return array_key_exists($key,$params) ? $params[$key] : null;
    }

   
    public static function pageByContent($content,$count)
    {
        $count = $count+1;
        $id = (int)Yii::app()->request->getParam('id');
        $pages = (int)Yii::app()->request->getParam('page',1);
        if($content === null)return null;
        $array_content = explode('#pages#',$content);
        if(!is_array($array_content) || $count < 2)return preg_replace('/\s(?=\s)|(　+){2,10}|(&nbsp;)/','',$content);
        $page = $pages > 1 ? ($pages > $count ? $count-1 : $pages) : 1;
        $controller = Yii::app()->controller;
        $action = '/'.$controller->module->id.'/'.$controller->id.'/'.$controller->action->id;
        $link = CHtml::tag('div',array('id'=>'content_page'));
        $link .= $page > 1 ? CHtml::link('上一页',Yii::app()->createUrl($action,array('id'=>$id,'page'=>$page-1)),array('class'=>'link page_prev')) : '<span class="page_text page_prev">上一页</span>';
        for($i=0;$i<$count;++$i){
            $link .= $page != ($i+1) ? CHtml::link($i+1,Yii::app()->createUrl($action,array('id'=>$id,'page'=>$i+1))):"<span class='hover'>".($i+1)."</span>";
        }
        $link .= $page < $count ? CHtml::link('下一页',Yii::app()->createUrl($action,array('id'=>$id,'page'=>$page+1)),array('class'=>'link page_next')) : '<span class="page_text page_next">下一页</span>';
        $link .= '</div>';
        if(0 < $count)
            return preg_replace('/\s(?=\s)|(　+){2,10}|(&nbsp;)/','',$array_content[$page-1].$link);
        else
            return preg_replace('/\s(?=\s)|(　+){2,10}|(&nbsp;)/','',$content);
    }
    
   
    public static function getMenuController()
    {
        $menu = array();
        $manger = new CuserManger();
        $params = self::getModuleNameByMenu();
        $path = array_keys($params);
        
        foreach($path as $key)
        {
            $menu[] = array('template'=>"<em><a href='/{$key}/index' id='{$key}'>{$params[$key]['controllerName']}</a></em>",'visible'=>Yii::app()->user->name === Yii::app()->params['adminName'] ? true : $manger->checkController($key));
        }
        return $menu; 
    }
    
   
    public  static function getModuleNameByMenu($controller=null)
    {
        $params =  array(
                'site'=>array('controllerName'=>'首页','actions'=>array('index'=>'后台首页','news'=>'信息管理')),
                'global'=>array('controllerName'=>'基本设置','actions'=>array('index'=>'基本设置首页','announcement'=>'系统公告','slide'=>'幻灯片','log'=>'系统日志','apc'=>'APC缓存','memcache'=>'memcache','channel'=>'频道设置','cache'=>'清除缓存')),
                'article'=>array('controllerName'=>'资讯','actions'=>array('index'=>'资讯首页','advertising'=>'广告管理','slide'=>'幻灯片')), 
                'user'=>array('controllerName'=>'用户管理','actions'=>array('index'=>'用户管理首页','competence'=>'用户角色管理','userauthitem'=>'用户授权')),
                //'investment'=>array('controllerName'=>'政企通','actions'=>array('index'=>'政企通管理首页','advisory'=>'政企通留言','advertising'=>'广告管理')),
                //'meet'=>array('controllerName'=>'乐聚会','actions'=>array('index'=>'乐聚会首页','eminent'=>'名人管理','advertising'=>'广告管理','slide'=>'幻灯片管理','sign'=>'报名管理','email'=>'邮件管理')),
                //'life'=>array('controllerName'=>'奢生活','actions'=>array('index'=>'奢生活首页','advertising'=>'广告管理','slide'=>'幻灯片管理')),
                //'celebrity'=>array('controllerName'=>'名人绘','actions'=>array('index'=>'名人绘首页','advertising'=>'广告管理','slide'=>'幻灯片管理')),
                'trade'=>array('controllerName'=>'家居管理','actions'=>array('index'=>'家居首页','advertising'=>'广告管理','area'=>'面积管理','price'=>'价格管理','style'=>'风格管理','space'=>'空间管理','appliance'=>'家电定制管理','life'=>'生活定制管理')),
                //'community'=>array('controllerName'=>'公益行','actions'=>array('index'=>'公益行首页','slide'=>'幻灯片管理','advertising'=>'广告管理')),
                //'study'=>array('controllerName'=>'慧学习','actions'=>array('index'=>'慧学习首页','slide'=>'幻灯片管理','advertising'=>'广告管理')),
                //'audit'=>array('controllerName'=>'内容审核','actions'=>array('index'=>'资讯','investment'=>'政企通','meet'=>'乐聚会','life'=>'奢生活','celebrity'=>'名人绘','trade'=>'商机汇','community'=>'公益行','study'=>'慧学习')),
                //'cache'=>array('controllerName'=>'清除缓存','actions'=>array('index'=>'设置')),
               // 'dream'=>array('controllerName'=>'梦想秀','actions'=>array('index'=>'梦想秀管理','slide'=>'幻灯片管理','advertising'=>'广告管理')),
                'shop'=>array('controllerName'=>'商品','actions'=>array('index'=>'商品首页','slide'=>'幻灯片管理','advertising'=>'广告管理')),

            );
        if($controller===null)
            return $params;
        else
            return array_key_exists($controller, $params) ? $params : array();
    }
    
   
    public static function getMemu()
    {
        $menu = '';
        $controller = Yii::app()->controller->id;
        $params = self::getModuleNameByMenu($controller);
        $title = self::getModuleNameByMenu();
        if(empty($params))return null;
        $menu .= CHtml::tag('ul',array('id'=>$controller));
        $check = false;
        $menu .= CHtml::tag('li',array('class'=>'menu_title')).CHtml::tag('span').$title[$controller]['controllerName'].'管理'.CHtml::closeTag('span').CHtml::closeTag('li');
        foreach($params[Yii::app()->controller->id]['actions'] as $key=>$val)
        {
            if(Yii::app()->user->name != Yii::app()->params['adminName'])
                $check = self::checkAction($controller, $key);          
            if($check===false)
                $menu .= CHtml::tag('li').Chtml::link($val,Yii::app()->createUrl("/{$controller}/{$key}"),array('class'=>$key === Yii::app()->controller->action->id ? 'tabon' : 'remove')).CHtml::closeTag('li');
        }
        $menu .= CHtml::closeTag('ul');
        return $menu;
    }
    
   
    public static function checkAction($controller,$action)
    {
        (object)$con = $act = null;
        $con->id = strtolower($controller);
        $act->id = strtolower($action);
        $userManger = new CuserManger();
        if($userManger->checkRole($con, $act))
            return false;
        else
            return true;
    }
}