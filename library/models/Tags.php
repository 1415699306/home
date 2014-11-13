<?php

/**
 * This is the model class for table "tags".
 *
 * The followings are the available columns in table 'tags':
 * @property string $id
 * @property string $name
 * @property string $md5
 * @property string $count
 */
class Tags extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Tags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, md5, count', 'required'),
			array('name', 'length', 'max'=>128),
			array('md5', 'length', 'max'=>32),
			array('count', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, md5, count', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'md5' => 'Md5',
			'count' => 'Count',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('md5',$this->md5,true);
		$criteria->compare('count',$this->count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     * 保存标签
     * 
     * @param string $tags
     * @param int $app_id 应用ID
     * @param int $res_id 资源ID
     */
    public static function saveByTags($tags,$app_id,$res_id)
    {
        $app_id = (int)$app_id;
        $res_id = (int)$res_id;
        $tags = !is_array($tags) ? self::string2array($tags) : $tags;
        if(is_array($tags) && !empty($tags))
        {
            foreach ($tags as $key)
            {
                $md5 = md5($key);
                $model = self::model()->find('LOWER(md5)=?',array($md5));
                if($model === null)
                {
                    $model = new Tags();
                    $model->name = $key;
                    $model->md5 = $md5;
                    $model->count = 1;
                    if($model->save())
                        self::_saveTagsRelations($model->id,$app_id,$res_id);
                }
                else
                {
                    $model->count = $model->count+1;
                    if($model->save())
                        self::_saveTagsRelations($model->id,$app_id,$res_id);
                }
            }
        }
    }
    
    /**
     * 更新TAGS
     * 
     * @param string $tags
     * @param int $app_id 应用ID
     * @param int $res_id 资源ID
     */
    public static function updateByTags($tags,$app_id,$res_id)
    {
        $app_id = (int)$app_id;
        $res_id = (int)$res_id;
        $tags = self::string2array($tags);
        $old = self::_loadRelations($app_id,$res_id);
        $oldTags = array();           
        if($old === null)
            self::saveByTags ($tags, $app_id, $res_id);
        else
        {
            foreach ($old as $key)
            {
                $oldTags[] = $key->tags->name;
            }
            self::saveByTags(array_diff($tags,$oldTags), $app_id, $res_id);
            self::_deleteTags(array_diff($oldTags,$tags),$app_id,$res_id);
        }
    }
    
    /**
     * 删除TAGS
     * 
     * @param string $tags
     * @param int $app_id
     * @param int $res_id
     */
    public static function deleteByTags($tags,$app_id,$res_id)
    {
        $app_id = (int)$app_id;
        $res_id = (int)$res_id;
        $foregone = self::string2array($tags);
        return self::_deleteTags($foregone, $app_id, $res_id);
    }


    /**
     * 读取TAGS
     * 
     * @param int $app_id 应用ID
     * @param int $res_id 资源ID
     */
    public static function getTags($app_id,$res_id)
    {
        $tags = array();
        $app_id = (int)$app_id;
        $res_id = (int)$res_id;
        if(0 < $res_id)
        {
            $model = self::_loadRelations($app_id,$res_id);
            if($model === null)
                return null;
            else 
            {
                foreach ($model as $key)
                {
                    $tags[] = $key->tags->name;
                }
            }
            return self::array2string($tags);
        }
        else
            return;
    }  

    /**
     * 数组转字符串
     * 
     * @param array $tags
     * @return string
     */
    public static function array2string($tags)
	{
		return implode(',',$tags);
	}
	
    /**
     * 字符串转数组
     * 
     * @param string $tags
     * @return array
     */
	public static function string2array($tags)
	{
		return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}
    
    /**
     * this is a load TagsRelations by model
     * 
     * @param int $app_id 应用ID
     * @param int $res_id 资源ID
     * @return object
     */
    private static function _loadRelations($app_id,$res_id)
    {
        return TagsRelations::model()->findAllByAttributes(array('app_id'=>$app_id,'res_id'=>$res_id));
    }
    
    /**
     * 入关系库
     * 
     * @param int $id
     * @param int $app_id 应用ID
     * @param int $res_id 资源ID
     */
    private static function _saveTagsRelations($id,$app_id,$res_id)
    {
        $model = new TagsRelations();
        $model->app_id = $app_id;
        $model->res_id = $res_id;
        $model->tag_id = $id;
        return $model->save();
    }
    
    /**
     * 删除过去的TAGS
     * 
     * @param array $foregone 需要删除的TAGS
     * @param int $app_id 应用ID
     * @param int $res_id 资源ID
     * @param array delete or update count boolean
     */
    private static  function _deleteTags($foregone,$app_id,$res_id)
    {
        $return = array();
        foreach($foregone as $key)
        {
            $model = self::model()->find('LOWER(md5)=?',array(md5($key)));
            if(!empty($model))
            {
                $res = TagsRelations::model()->deleteAllByAttributes(array('tag_id'=>$model->id,'app_id'=>$app_id,'res_id'=>$res_id));
                if(0 < $res)
                {
                    $count = $model->count - $res;
                    if($count < 1)
                        $return[$model->id]['delete'] = $model->delete();
                    else 
                    {
                        $model->count = $count;
                        $return[$model->id]['save'] = $model->save();
                    }
                }
            }
        }
        return $return;
    }
    
    public static function getSearchHot()
    {
      
            $sql = 'SELECT b.name,a.id AS aid,COUNT(DISTINCT(md5)) FROM `tags_relations` AS a,`tags` AS b WHERE a.tag_id = b.id GROUP BY b.md5 ORDER BY RAND() LIMIT 4';
            $hot = Yii::app()->db->createCommand($sql)->queryAll();

            //$hot = CJSON::decode($hot,true);
            return $hot;
    }
}