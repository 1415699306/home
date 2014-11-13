<?php

/**
 * This is the model class for table "advertising_content".
 *
 * The followings are the available columns in table 'advertising_content':
 * @property integer $id
 * @property integer $adv_id
 * @property string $content
 */
class AdvertisingContent extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return AdvertisingContent the static model class
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
		return 'advertising_content';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('adv_id', 'required'),
			array('adv_id', 'numerical', 'integerOnly'=>true),
            array('content','safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, adv_id, content', 'safe', 'on'=>'search'),
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
            'advertising'=>array(self::BELONGS_TO,'Advertising','adv_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'adv_id' => 'Adv',
			'content' => '内容',
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
		$criteria->compare('adv_id',$this->adv_id);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function behaviors(){
        return array(
            'CSafeContentBehavor' => array(
                'class' => 'ext.behaviors.CSafeContentBehavior',
                'attributes' => array('content'),
            ),
        );
    }  
    
    public function beforeSave()
    {
        $arr = explode('#pages#',$this->content);
        $this->pages = count($arr)-1;
        return parent::beforeSave();
    }
    
    public function afterFind() 
    {
        if(Yii::app()->controller->module->id !='backend'){
            $this->content = BaseApp::pageByContent($this->content,$this->pages);
            return parent::afterFind();
        }
    }
}