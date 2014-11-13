<?php

/**
 * This is the model class for table "public_delivery_address".
 *
 * The followings are the available columns in table 'public_delivery_address':
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property integer $phone
 * @property string $zip_code
 * @property string $address
 * @property string $ctime
 * @property string $mtime
 */
class PublicDeliveryAddress extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PublicDeliveryAddress the static model class
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
		return 'public_delivery_address';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('province, city, name, phone, zip_code, address', 'required'),
			array('phone', 'numerical', 'integerOnly'=>true),
			array('id, name', 'length', 'max'=>32),
			array('user_id, ctime, mtime', 'length', 'max'=>11),
			array('zip_code', 'length', 'max'=>6),
			array('address', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, province, city, user_id, name, phone, zip_code, address, ctime, mtime', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
            'province'=>'Ê¡',
            'city'=>'ÊĞ',
			'name' => 'Name',
			'phone' => 'Phone',
			'zip_code' => 'Zip Code',
			'address' => 'Address',
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
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('zip_code',$this->zip_code,true);
		$criteria->compare('address',$this->address,true);
        $criteria->compare('province', $this->province);
        $criteria->compare('city', $this->city);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave() {
        $time = time();
        if($this->isNewRecord){
            $this->ctime = $time;
        }
        $this->mtime = $time;
        $this->user_id = Yii::app()->user->id;
        return parent::beforeSave();
    }
}