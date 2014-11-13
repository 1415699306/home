<?php

/**
 * This is the model class for table "public_order_address".
 *
 * The followings are the available columns in table 'public_order_address':
 * @property integer $id
 * @property integer $order_id
 * @property integer $user_id
 * @property integer $address_id
 * @property integer $ctime
 * @property integer $mtime
 */
class PublicOrderAddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PublicOrderAddress the static model class
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
		return 'public_order_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_id, user_id, address_id, ctime, mtime', 'required'),
			array('user_id, address_id, ctime, mtime', 'numerical', 'integerOnly'=>true),
			array('order_id', 'length', 'max'=>16),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, order_id, user_id, address_id, ctime, mtime', 'safe', 'on'=>'search'),
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
			'order_id' => 'Order',
			'user_id' => 'User',
			'address_id' => 'Address',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('order_id',$this->order_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('address_id',$this->address_id);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('mtime',$this->mtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}