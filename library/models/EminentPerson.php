<?php

/**
 * This is the model class for table "eminent_person".
 *
 * The followings are the available columns in table 'eminent_person':
 * @property string $id
 * @property string $name
 */
class EminentPerson extends CActiveRecord
{
    public $avatar;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EminentPerson the static model class
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
		return 'eminent_person';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
            array('avatar','file','types'=>'jpg,jpeg,png,gif,bmp','on'=>'create'),
            array('avatar','file','types'=>'jpg,jpeg,png,gif,bmp','allowEmpty'=>true),
			array('name', 'length', 'max'=>32),
            array('name','checkName'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name', 'safe', 'on'=>'search'),
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
            'avatarImage'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'avatarImage.app_id = '.BaseApp::EMINENTPERSON),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '名人姓名',
			'avatar' => '名人头像',
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
                'defaultOrder'=>'id desc',
            ),
            'pagination'=>array(
                'pageSize'=>20,
            ),
		));
	}
    
    public function afterDelete() 
    {
        Storage::deleteByFile(BaseApp::EMINENTPERSON,$this->id,$this->avatarImage->track_id);
        return parent::afterDelete();
    }
    
    public function checkName($name)
    {      
        if($this->isNewRecord)
        {
            $model = self::model()->find('LOWER(name)=?',array($this->name));
            if(!empty($model))
                $this->addError ($name,'名称已存在!不能重复添加!');
        }
        else
        {
            $model = self::model()->getDbConnection()->createCommand('SELECT count(id) FROM  `eminent_person` WHERE  `id`!=:id AND `name`=:name')->bindValues(array(':id'=>$this->id,':name'=>$this->name))->queryRow();
            if(0 < $model["count(id)"])
                $this->addError ($name,'名称已存在!不能重复添加!');
        }
    }
}