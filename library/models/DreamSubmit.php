<?php

/**
 * This is the model class for table "dream_submit".
 *
 * The followings are the available columns in table 'dream_submit':
 * @property string $id
 * @property string $dream_id
 * @property string $name
 * @property integer $age
 * @property string $phone
 * @property string $qq
 * @property string $ctime
 * @property string $mtime
 */
class DreamSubmit extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DreamSubmit the static model class
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
		return 'dream_submit';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, age, phone, qq', 'required'),
			array('age', 'numerical', 'integerOnly'=>true),
			array('dream_id, ctime, mtime', 'length', 'max'=>11),
			array('name', 'length', 'max'=>32),
			array('phone', 'length', 'max'=>16),
			array('qq', 'length', 'max'=>15),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, dream_id, name, age, phone, qq, ctime, mtime', 'safe', 'on'=>'search'),
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
			'name' => '真实姓名',
			'age' => '性别',
			'phone' => '手机号码',
			'qq' => 'QQ号码',
			'ctime' => 'Ctime',
			'mtime' => 'Mtime',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('age',$this->age);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave() 
    {
        $time = time();
        if($this->isNewRecord)
        {
            $this->dream_id = Yii::app()->request->getParam('id');
            $this->ctime = $time;
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
}