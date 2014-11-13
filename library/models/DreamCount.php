<?php

/**
 * This is the model class for table "dream_money_count".
 *
 * The followings are the available columns in table 'dream_money_count':
 * @property string $id
 * @property string $dream_id
 * @property string $money
 * @property string $count
 */
class DreamCount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DreamMoneyCount the static model class
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
		return 'dream_count';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dream_id, money, count', 'required'),
			array('dream_id, count', 'length', 'max'=>11),
			array('money', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, dream_id, money, count', 'safe', 'on'=>'search'),
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
            'dream'=>array(self::BELONGS_TO,'Dream','dream_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'dream_id' => 'Dream',
			'money' => 'Money',
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
		$criteria->compare('dream_id',$this->dream_id,true);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('count',$this->count,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
   public static function setCount($id,$money)
    {
        $count = Yii::app()->db->createCommand("select dream_id from `dream_count` where `dream_id` =:id")->bindValue(':id',$id)->queryRow();
        if($count === false)
            $sql = "insert into `dream_count` set `count`='1',`dream_id`=:id, `money`=:money";
        else
            $sql = "UPDATE `dream_count` SET  `count` = count+'1',`money`=money+:money WHERE `dream_id`=:id";
        return Yii::app()->db->createCommand($sql)->bindValues(array(':id'=>$id,':money'=>$money))->execute();
    }
}