<?php

/**
 * This is the model class for table "public_payment".
 *
 * The followings are the available columns in table 'public_payment':
 * @property integer $id
 * @property integer $app_id
 * @property integer $res_id
 * @property integer $user_id
 * @property string $total_fee
 * @property integer $trade_status
 * @property integer $ctime
 * @property integer $mtime
 */
class PublicPayment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PublicPayment the static model class
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
		return 'public_payment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, app_id, res_id, user_id, total_fee, trade_status, ctime, mtime', 'required'),
			array('id, app_id, res_id, user_id, trade_status, ctime, mtime', 'numerical', 'integerOnly'=>true),
			array('total_fee', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, res_id, user_id, total_fee, trade_status, ctime, mtime', 'safe', 'on'=>'search'),
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
			'user_id' => 'User',
			'total_fee' => 'Total Fee',
			'trade_status' => 'Trade Status',
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
		$criteria->compare('app_id',$this->app_id);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('total_fee',$this->total_fee,true);
		$criteria->compare('trade_status',$this->trade_status);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('mtime',$this->mtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    
  
    
    public static function getPayment($res_id,$app_id)
    {
        $res = Yii::app()->db->createCommand("select sum(total_fee) from `public_payment` where app_id = :aid and res_id = :rid")->bindValues(array(':aid'=>$app_id,':rid'=>$res_id))->queryRow();   
        return !empty($res["sum(total_fee)"]) ? $res["sum(total_fee)"] : 0;
    }
}