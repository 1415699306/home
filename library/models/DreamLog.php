<?php

/**
 * This is the model class for table "dream_log".
 *
 * The followings are the available columns in table 'dream_log':
 * @property integer $id
 * @property integer $log_id
 * @property integer $user_id
 * @property integer $ctime
 * @property integer $mtime
 */
class DreamLog extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DreamLog the static model class
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
		return 'dream_log';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('log_id, dream_id', 'required'),
			array('log_id, user_id, dream_id, ctime, mtime', 'numerical', 'integerOnly'=>true),
            array('reason','length','max'=>'1024'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, log_id, dream_id, user_id, ctime, mtime', 'safe', 'on'=>'search'),
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
			'log_id' => 'Log',
			'user_id' => 'User',
            'reason'=>'审核理由',
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
        $criteria->compare('dream_id',$this->dream_id);
		$criteria->compare('log_id',$this->log_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('mtime',$this->mtime);

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
    
    public static function setLog($dream_id,$log_id,$reason=null)
    {
        $model = new self;
        $model->dream_id = $dream_id;
        $model->log_id = $log_id;
        $model->reason = $reason;
        $model->user_id = Yii::app()->user->id;
        return $model->save();
    }
    
    public static function getLog($key)
    {
        $params = array(
            '-3'=>'项目未达成目标,被撤回下线',
            '-2'=>'项目被下线',
            '-1'=>'审核驳回',
            '0'=>'项目创建',
            '1'=>'提交审核',
            '2'=>'撤回审核',
            '3'=>'通过审核',
            '4'=>'项目已达成目标',
            
        );
        return array_key_exists($key, $params) ? $params[$key] : null;
    }
}