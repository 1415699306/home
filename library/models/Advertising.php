<?php

/**
 * This is the model class for table "advertising".
 *
 * The followings are the available columns in table 'advertising':
 * @property string $id
 * @property string $name
 * @property string $discription
 * @property string $link
 * @property string $start_time
 * @property string $off_time
 * @property string $app_id
 * @property integer $res_id
 * @property integer $type
 * @property string $ctime
 * @property string $mtime
 */
class Advertising extends CActiveRecord
{
    public $thumb;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Advertising the static model class
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
		return 'advertising';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, discription, link, start_time, off_time, app_id, res_id, type, status', 'required'),
			array('res_id, type, status', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>80),
			array('link', 'length', 'max'=>1024),
            array('discription', 'length', 'max'=>255),
            array('thumb','file','types'=>'jpg,jpeg,png,gif,bmp','allowEmpty'=>true),
			array('start_time, off_time, app_id, ctime, mtime', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, name, discription, link, start_time, off_time, app_id, res_id, type, ctime, mtime', 'safe', 'on'=>'search'),
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
            'categorys'=>array(self::BELONGS_TO,'Category','res_id'),
            //'advertisingContent'=>array(self::HAS_ONE,'AdvertisingContent','adv_id'),
            'thumbs'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::ADVERTISING),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '广告名称',
			'discription' => '广告简要',
			'link' => '连接',
			'start_time' => '开始时间',
			'off_time' => '结束时间',
			'app_id' => '应用ID',
			'res_id' => '广告位置',
			'type' => '类型',
            'status'=>'状态',
            'thumb'=>'缩略图',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($app_id)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->condition = 'app_id =:aid';
        $criteria->params = array(':aid'=>$app_id);
		$criteria->compare('id',$this->id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('discription',$this->discription,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('off_time',$this->off_time,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('res_id',$this->res_id);
		$criteria->compare('type',$this->type);
        $criteria->compare('status',$this->status);
		$criteria->compare('ctime',$this->ctime,true);
		$criteria->compare('mtime',$this->mtime,true);

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
    
    public static function getViewPath()
    {
        return THEME_PATH.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'advertising';
    }
    
    public function beforeSave() 
    {
        $time = time();
        if($this->isNewRecord)
        {
            $this->ctime = $time;
        }
        $this->mtime = $time;
        $this->start_time = strtotime($this->start_time,$time);
        $this->off_time = strtotime($this->off_time,$time);
        return parent::beforeSave();
    }
    
    public function afterDelete() 
    {
        //$content = $this->getRelated('advertisingContent');      
        $thumbs = $this->getRelated('thumbs'); 
        /*如果存在附件就删除附件*/
        if(!empty($thumbs))Storage::deleteImageBySize('advertising', $this->thumbs->track_id,'thumb');
        /*删除文章内容附加表*/
        //AdvertisingContent::model()->deleteAllByAttributes(array('adv_id'=>$this->id));
        /*请除文章内容附加表的文件*/
        //if(!empty($content->content))ResourcesHelper::deleteContentImg($content->content);
        /*记录用户操作日志*/
        Yii::log('ID:'.Yii::app()->user->id.'用户删除了广告,ID:'.$this->id,'info','system.backend.advertising');
        return parent::afterDelete();
    }
}