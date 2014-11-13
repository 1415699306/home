<?php
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
    
    public function getPrimary()
    {
        $model = Category::model()->findByPk($this->id);
        if($model === null)
            return null;
        else
            return $model->parent_id;
    }
    
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
}
