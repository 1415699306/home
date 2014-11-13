<?php

/**
 * This is the model class for table "public_count".
 *
 * The followings are the available columns in table 'public_count':
 * @property string $id
 * @property integer $app_id
 * @property integer $res_id
 * @property integer $count
 */
class PublicCount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PublicCount the static model class
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
		return 'public_count';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, res_id, count', 'required'),
			array('app_id, res_id, count', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, res_id, count', 'safe', 'on'=>'search'),
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
			'app_id' => 'App',
			'res_id' => 'Res',
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
		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('count',$this->count);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function getCountByPercentage($app_id)
    {
        $count = self::model()->countByAttributes(array('app_id'=>$app_id));
        $total = self::model()->count();
        return ceil($count/$total*100);
    }
    
    public static function getCount($res_id,$app_id){
        $count = Yii::app()->redis->get('public_count',$app_id,$res_id);
        if($count === false){
            $res = self::model()->findByAttributes(array('res_id'=>$res_id,'app_id'=>$app_id));
            $count = !empty($res->count) ? $res->count : '0';
            Yii::app()->redis->set('public_count',$app_id,$res_id,$count,3600);
        }
        return $count;
    }
    
    public static function getCountByApp($app_id)
    {
        return self::model()->countByAttributes(array('app_id'=>$app_id));
    }
    
    public static function getTopOne($app_id)
    {
        $criteria = new CDbCriteria();
        $criteria->condition = 'app_id = :aid';
        $criteria->params = array(':aid'=>$app_id);
        $criteria->order = 'count desc';
        $criteria->limit = 1;
        $model = self::model()->find($criteria);
        if($model===null)
            return 0;
        else
            return $model->res_id;
    }
    
    public static function setCount($app_id,$res_id)
    {
        $count = Yii::app()->db->createCommand("select app_id,res_id from `public_count` where `app_id` =:app_id and `res_id`=:res_id")->bindValues(array(':app_id'=>$app_id,':res_id'=>$res_id))->queryRow();
        if($count === false)
            $sql = "insert into `public_count` set `count`=1,`app_id`=:app_id, `res_id`=:res_id";
        else
            $sql = "UPDATE `public_count` SET  `count` = count+'1' WHERE app_id=:app_id and res_id=:res_id";
        return Yii::app()->db->createCommand($sql)->bindValues(array(':app_id'=>$app_id,':res_id'=>$res_id))->execute();
    }
    
    public function getCountBySum($app_id,$res_id)
    {
        $sql="SELECT SUM( count ) FROM  `public_count` WHERE  `app_id`=:aid AND `res_id`=:rid limit 1";
        $res = Yii::app()->db->createCommand($sql)->bindValues(array(':aid'=>$app_id,':rid'=>$res_id))->queryRow();
        return (0 < $res["SUM( count )"] ? $res["SUM( count )"] : 0);
    }
}