<?php
/**
 * Description of ICategory
 * 二级分类
 * @author martin
 */
class INavLevel extends CWidget{
    
    public $type = 0;
    
    public function run() 
    {
        $owner = $this->getOwner();
        if(!isset($owner->category) || !isset($owner->category_link))return;
        $category = Yii::app()->cache->get("global_category_{$owner->category}");
        if($category === false)
        {
            $component = Yii::createComponent('CategoryComponent');
            $component->id = $owner->category;
            $category = $component->getParent();
            Yii::app()->cache->add("global_category_{$owner->category}",$category,86400*30);
        }
        switch ($this->type){
            case 0 :
                $this->_Universal($category,$owner); 
                break;
            case 1 :
                $this->_Simple($category,$owner); 
                break;
        }          
    }
    
    private function _Universal($category,$owner)
    {
        $html = '<div class="nav_level"><i class="nav_left_i"></i>';
        static $i = 1;
        foreach($category as $key=>$val){
            $html.= CHtml::link($val,$owner->createUrl('/'.Yii::app()->controller->module->id.$owner->category_link,array('id'=>$key)),array('style'=>($i == count($category) ? 'border:none' : 'font-size: 12px;')));
            ++$i;
        }
        $html .= '<i class="nav_right_i"></i></div>';
        echo $html; 
    }
    
    private function _Simple($category,$owner)
    {
        static $i = 1;
        $html = '';
        foreach ($category as $key=>$val){
            $html .=CHtml::tag('li',array('class'=>($i == count($category) ? 'end' : 'none'))).CHtml::link($val,$owner->createUrl('/'.Yii::app()->controller->module->id.$owner->category_link,array('id'=>$key))).CHtml::closeTag('li');     
            ++$i;
        }
        echo $html;
    }
}
