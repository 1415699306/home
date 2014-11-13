<?php


class Category extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function behaviors()
        {
            return array(
            'TreeBehavior' => array(
                        'class' => 'ext.category.behaviors.TreeBehavior',
                        'id'=>'id',
                        'parent_id'=>'parent_id',
                    ),
                );
        }

	
	public function tableName()
	{
		return 'category';
	}

	
	public function rules()
	{
		
		return array(
			array('lft, rgt, level, parent_id', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>256),
			array('id, lft, rgt, level, parent_id, name', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		
		return array(
            'brother'=>array(self::HAS_ONE,'Category','parent_id'),
            'brothers'=>array(self::HAS_MANY,'Category','parent_id'),
            'parentName'=>array(self::BELONGS_TO,'Category','parent_id'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'level' => 'Level',
			'parent_id' => 'Parent',
			'name' => 'Name',
		);
	}

	
	public function search()
	{
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('lft',$this->lft);
		$criteria->compare('rgt',$this->rgt);
		$criteria->compare('level',$this->level);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getTitleName($id)
    {
        $model = self::model()->find('LOWER(id)=?',array($id));
        if($model === null)
            return '暂无数据';
        else
            return $model->name;
    } 
    
    public static function getGory($cid,$sid,$offset=0,$limit=1)
    {
        $sql = "select a.id,a.parent_id,a.name,a.system from `category` as a where a.parent_id=:cid and a.system=:sid order by id asc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':sid'=>(int)$sid))->queryAll();
        return $model;
    }
    
    public function getAll($cid)
    {
        $sql = "select id,name,parent_id from `category`  where id=:cid ";
        $model = Yii::app()->db->createCommand($sql)->bindValue(':cid',(int)$cid)->queryAll();
         return $model;
    }
    
    public function getCatTree($arr,$id = 0,$lev=0) {
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
    
    public static function getCat($key)
    {
        $data = array();
        $data[]['id']=$key;
        $sql = "select parent_id,id from `category` where parent_id =:pid ";
        $model = Yii::app()->db->createCommand($sql)->bindValue(':pid',(int)$key)->queryAll();
        $model = array_merge($data,$model);
        return $model;
    }
    
    public static function getName($name)
    {
        $sql = "select parent_id,id from `category` where category_name =:name ";
        $model = Yii::app()->db->createCommand($sql)->bindValue(':name',(string)$name)->queryAll();
        
    }
    
    /**
     * 取广告位id
     */
    public static function getId($name,$came)
    {
        $sql = "select id,parent_id,id from `category` where name=:name and category_name !=:came ";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':name'=>(string)$name,'came'=>(string)$came))->queryRow();
        return $model;
    }
    
    
    /**
     * 根据一级取二级分类
     */
     public static  function getPar($pid)
    {
         $sql = "select id,parent_id,name from `category` where parent_id=:pid";
         $model = Yii::app()->db->createCommand($sql)->bindValue(':pid', (int)$pid)->queryAll();
         return $model;
    }
    
    /**
     * 取出一级及子分类数据
     */
    public static function getSub($key)
    {
        $data  = Category::getCat($key);
        foreach($data as $val){
            $arr[] = $val['id'];
        }
        $arr  = implode(',', $arr);
        $sql = "select a.title,a.id,a.recommend,a.discription,b.track_id from `shop` as a ,`storage` as b where a.category_id in ($arr) and a.id = b.res_id and b.app_id = :aid  and recommend ='1'  order by id desc limit 0,4";
        $model = Yii::app()->db->createCommand($sql)->bindValue(':aid',BaseApp::SHOP)->queryAll();
        return $model;
    }
}