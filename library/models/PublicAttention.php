<?php

/**
 * This is the model class for table "public_attention".
 *
 * The followings are the available columns in table 'public_attention':
 * @property string $id
 * @property string $app_id
 * @property string $res_id
 * @property string $user_id
 * @property string $ctime
 * @property string $mtime
 */
class PublicAttention extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PublicAttention the static model class
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
		return 'public_attention';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, res_id, user_id', 'required'),
			array('app_id, res_id, user_id, ctime, mtime', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, res_id, user_id, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()         
	{
		return array(
             'dream'=>array(self::BELONGS_TO,'Dream','','on'=>'t.app_id = 13 and t.res_id = dream.id'),
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
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('res_id',$this->res_id,true);
		$criteria->compare('user_id',$this->user_id,true);
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
            $this->user_id = Yii::app()->user->id;
            $this->ctime = $time;
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    public static function getCount($res_id,$app_id)
    {
        return self::model()->countByAttributes(array('res_id'=>$res_id,'app_id'=>$app_id));
    }
    
    public static function getCountByUser($res_id,$app_id,$user_id)
    {
        return self::model()->countByAttributes(array('res_id'=>$res_id,'app_id'=>$app_id,'user_id'=>$user_id));
    }
    
    
}