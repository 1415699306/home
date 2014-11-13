<?php

/**
 * This is the model class for table "user_manger_assign".
 *
 * The followings are the available columns in table 'user_manger_assign':
 * @property string $id
 * @property string $user_id
 * @property string $role_id
 * @property string $ctime
 * @property string $mtime
 */
class UserMangerAssign extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return UserMangerAssign the static model class
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
		return 'user_manger_assign';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, role_id', 'required'),
			array('user_id, role_id, ctime, mtime', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, role_id, ctime, mtime', 'safe', 'on'=>'search'),
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
            'role'=>array(self::BELONGS_TO,'UserMangerRole','role_id'),
            'roles'=>array(self::HAS_MANY,'UserMangerRole','','on'=>'t.role_id = roles.id'),
            'authItems'=>array(self::HAS_MANY,'UserMangerAuthItems','','on'=>'t.role_id = authItems.role_id'),
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
			'role_id' => 'Role',
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
		$criteria->compare('role_id',$this->role_id,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave() {
        $time = time();
        if($this->isNewRecord)
            $this->ctime = $time;
        $this->mtime = $time;
        return parent::beforeSave();
    }
}