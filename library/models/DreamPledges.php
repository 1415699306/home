<?php

/**
 * This is the model class for table "dream_pledges".
 *
 * The followings are the available columns in table 'dream_pledges':
 * @property string $id
 * @property string $dream_id
 * @property string $money
 * @property string $discription
 * @property string $places
 * @property integer $mailing
 * @property integer $free_shipping
 * @property string $payback_time
 * @property string $ctime
 * @property string $mtime
 */
class DreamPledges extends CActiveRecord
{
    public $thumb;
    public $places_button;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return DreamPledges the static model class
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
		return 'dream_pledges';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('dream_id, money, discription, mailing, free_shipping, payback_time, places_button', 'required'),
			array('mailing, free_shipping', 'numerical', 'integerOnly'=>true),
			array('dream_id, money, places, payback_time, ctime, mtime', 'length', 'max'=>11),
			array('discription', 'length', 'max'=>1024),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, dream_id, money, discription, places, mailing, free_shipping, payback_time, ctime, mtime', 'safe', 'on'=>'search'),
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
            'thumbs'=>array(self::HAS_MANY,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::DREAMPLEDGBES),
            'publicCount'=>array(self::HAS_ONE,'PublicCount','res_id','condition'=>'publicCount.app_id = '.BaseApp::DREAMPLEDGBES),
            'support'=>array(self::STAT,'PublicOrder','res_id','condition'=>'app_id = '.BaseApp::DREAM),
            'order'=>array(self::HAS_MANY,'PublicOrder','res_id','condition'=>'app_id = '.BaseApp::DREAM),
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
			'money' => '支持金额',
			'discription' => '回报内容',
            'thumb'=>'说明图片',
			'places_button' => '限定名额',
            'places'=>'限定名额',
			'mailing' => '是否邮寄',
			'free_shipping' => '是否包邮',
			'payback_time' => '回报时间',
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
		$criteria->compare('money',$this->money,true);
		$criteria->compare('discription',$this->discription,true);
		$criteria->compare('places',$this->places,true);
		$criteria->compare('mailing',$this->mailing);
		$criteria->compare('free_shipping',$this->free_shipping);
		$criteria->compare('payback_time',$this->payback_time,true);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function checkThumb($property)
    {
        if(empty($this->$property))
            $this->addError($property,'至少上传一张说明图片');
    }
    
    public function beforeSave() 
    {
        $time = time();
        $purifier= new CHtmlPurifier();
        if($this->isNewRecord){
            $this->discription = $purifier->purify($this->discription);
            $this->ctime = $time;
            if($this->places_button === 0)
                $this->places = 0;
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    public function afterSave() 
    {
        if(!empty($this->thumb) && $this->isNewRecord)
        {                    
            foreach ($this->thumb as $key)
            {
                Storage::saveByStorageAll(BaseApp::DREAMPLEDGBES, $this->id, $key);
            }
        }
        return parent::afterSave();
    }
    
    public function afterDelete()         
    {
        $thumbs = $this->getRelated('thumbs');
        if(!empty($thumbs))
        {
            foreach ($thumbs as $key)
            {
                Storage::deleteImageBySize('dream',$key->track_id,'thumb');
            }
        }
        return parent::afterDelete();
    }
}