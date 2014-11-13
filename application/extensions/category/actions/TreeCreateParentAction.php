<?php
include(dirname(__FILE__).DIRECTORY_SEPARATOR.'TreeBaseAction.php');
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TreeCreateParentAction
 *
 * @author martin
 */
class TreeCreateParentAction extends TreeBaseAction{
    
    const LEFT = 1;
    const RIGHT = 2;
    const LEVEL = 0;
    
    public function run(){
        if((int)Yii::app()->getRequest()->getParam('parent_id') == 0)
        {
            $right = Yii::app()->db->createCommand()->select('rgt')->from(strtolower($this->getModelName()))->where('parent_id=:parent_id', array(':parent_id'=>0))->order('id desc')->limit('1')->queryRow();
            if(0 < $right['rgt'])
           $create = Yii::app()->db->createCommand("INSERT INTO `category` (`id`,`parent_id` ,`lft`,`rgt`,`level`,`name`,category_name) VALUES (null,'0','".$right['rgt']."'+1,'".$right['rgt']."'+2,'0','".Yii::app()->getRequest()->getParam('name')."','".Yii::app()->getRequest()->getParam('category_name')."')")            
                    ->execute();
            if($create)
                echo '保存成功!';
            else
                echo '保存失败!';
        }
        else
            echo '不能对已存在的分类进行根操作!';
    }
}

?>
