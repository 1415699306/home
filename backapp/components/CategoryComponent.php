<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryComponent
 *
 * @author martin
 */
class CategoryComponent extends CComponent{
    
    public $id;
    public $parentId;
    public $system;
    
    public function setId($value)
    {
        $this->id = $value;
    }
    
    public function setParentId($value){
        $this->parentId = $value;
    }
    
    public function getParent()
    {
        $res = array();
        if(is_null($this->id))throw new CHttpException(500,'param error');
        $parent = Category::model()->findByPk($this->id);
        if(empty($parent))return null;       
        $criteria = new CDbCriteria();
        $criteria->condition = 'lft BETWEEN :left AND :right';
        $criteria->params = array(':left'=>$parent->lft,':right'=>$parent->rgt);
        $criteria->addCondition("id != {$this->id}");
        $criteria->order='id asc';
        $model = Category::model()->findAll($criteria);
        if($model === null){
            return null;
        }else{
            $i = 0;
            foreach($model as $key){
                $res[$key->id] = $key->name;
            }
            return $res;
        }
    }
    
    public function getCategory()
    {
         $criteria = new CDbCriteria();
         $criteria->condition ='parent_id = :pid';
         $criteria->params = array(':pid'=>0);
         return Category::model()->findAll($criteria);            
    }  
    
	/**
	 * 通过主键获取
	 */
    public function getPrimary()
    {
        $model = Category::model()->findByPk($this->id);
        if($model === null)
            return null;
        else
            return $model->parent_id;
    }
    
	/**
	 * 通过父ID获取子类
	 */
    public function getBrothersById()
    {
        $res = array();
        if(is_null($this->parentId))throw new CHttpException(500,'param error');
        $model = Category::model()->findAllByAttributes(array('parent_id'=>$this->parentId));
        if($model === null){
            return null;
        }else{
            foreach($model as $key){
                $res[] = $key->id;
            }
        }
        return $res;
    }
    
	/**
	 * 获取系统文章分类
	 */
	public function getArticle()
	{
        $res = array();
		$model =  Category::model()->findAllByAttributes(array('system'=>0));
        if($model === null){
            return null;
        }else{
            $i = 0;
            foreach($model as $key){
                $res[$key->id] = $key->name;
            }
            return $res;
        }
	}
        
    public function getCatTree($arr,$id,$lev=0) {
        $tree = array();

        foreach($arr as $v) {
            if($v['parent_id'] == $id) {
                $v['lev'] = $lev;
                $tree[] = $v;

                $tree = array_merge($tree,$this->getCatTree($arr,$v['id'],$lev+1));
            }
        }

        return $tree;
    }
    
    public function getPar()
    {
        $res = array();
        if(is_null($this->id))throw new CHttpException(500,'param error');
        $parent = Category::model()->findByPk($this->id);
        if(empty($parent))return null;       
        $criteria = new CDbCriteria();
        $criteria->condition = 'lft BETWEEN :left AND :right';
        $criteria->params = array(':left'=>$parent->lft,':right'=>$parent->rgt);
        $criteria->addCondition("id != {$this->id}");
        $criteria->order='id asc';
        $model = Category::model()->findAll($criteria);
        if($model === null){
            return null;
        }else{
            $i = 0;
            foreach($model as $key){
                $res[$i]['name'] = $key->name;
                $res[$i]['id'] = $key->id;
                $res[$i]['parent_id'] = $key->parent_id;
                ++$i;
            }
            return $res;
        }
    }
}
