<?php

/**
 * This is the model class for table "celebrity_painted".
 *
 * The followings are the available columns in table 'celebrity_painted':
 * @property string $id
 * @property string $category_id
 * @property string $user_id
 * @property string $title
 * @property string $discription
 * @property string $source
 * @property string $video
 * @property integer $recommand
 * @property integer $status
 * @property string $ctime
 * @property string $mtime
 */
class CelebrityPainted extends CActiveRecord
{
    public $thumb;
    public $tags;
    /**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return CelebrityPainted the static model class
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
		return 'celebrity_painted';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('category_id, title, tags, interview_time, discription, source, video, channel_recommand, recommand,index_recommand, interview_recommand', 'required'),
			array('recommand, channel_recommand, interview_recommand, status', 'numerical', 'integerOnly'=>true),
			array('category_id, user_id, interview_time, ctime, mtime', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80),
			array('discription, guests', 'length', 'max'=>255),
			array('source', 'length', 'max'=>128),
			array('video, thumb', 'length', 'max'=>1024),
            array('source, video','url'),
            array('tags', 'match', 'pattern'=>'/^([\x{4e00}-\x{9fa5}A-Za-z0-9_],?)+$/u','message'=>'关键字格式不正确,请以半角逗号分开!'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, interview_time, guests, category_id, user_id, title, discription, source, video, index_recommand,recommand, channel_recommand, interview_recommand, status, ctime, mtime', 'safe', 'on'=>'search'),
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
            'celebrityContent'=>array(self::HAS_ONE,'CelebrityPaintedContent','celebrity_id'),
            'categorys'=>array(self::BELONGS_TO,'Category','category_id'),
            'thumbs'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::CELEBRITY),
            'user'=>array(self::BELONGS_TO,'User','user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => '分类',
            'guests'=>'嘉宾',
            'interview_time'=>'访谈时间',
			'user_id' => '发布用户',
			'title' => '标题',
			'discription' => '简要',
			'source' => '来源',
			'video' => '视频',
			'recommand' => '列表推荐',
            'channel_recommand'=>'频道推荐',
            'interview_recommand'=>'频道访谈推荐',
            'index_recommand'=>'首页推荐',
			'status' => '状态',
            'thumb'=>'缩略图',
            'tags'=>'标签',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
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
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('discription',$this->discription,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('video',$this->video,true);
        $criteria->compare('interview_time',$this->interview_time,true);
        $criteria->compare('guests',$this->guests,true);
		$criteria->compare('recommand',$this->recommand);
        $criteria->compare('channel_recommand',$this->channel_recommand);
        $criteria->compare('interview_recommand',$this->interview_recommand);
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
    
    public function beforeSave() 
    {
        $time = time();
        if($this->isNewRecord)
        {
            $this->user_id = Yii::app()->user->id;
            $this->ctime = $time;
            $this->status = 1;
        }
        if( preg_match("/^\d{4,}\-\d{1,2}\-\d{1,2}$/i",$this->interview_time)){
            $this->interview_time = strtotime($this->interview_time,$time);
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    public function afterDelete() 
    {
        $content = $this->getRelated('celebrityContent');      
        $thumbs = $this->getRelated('thumbs'); 
        /*如果存在附件就删除附件*/
        if(!empty($thumbs))Storage::deleteImageBySize('celebrity', $this->thumbs->track_id,'thumb');
        /*删除文章内容附加表*/
        CelebrityPaintedContent::model()->deleteAllByAttributes(array('celebrity_id'=>$this->id));
        /*请除文章内容附加表的文件*/
        if(!empty($content->content))ResourcesHelper::deleteContentImg($content->content);
        /*删除标签*/
        Tags::deleteByTags($this->tags, BaseApp::CELEBRITY, $this->id);
        /*记录用户操作日志*/
        Yii::log('ID:'.Yii::app()->user->id.'用户删除了文章,ID:'.$this->id,'info','system.backend.celebrity');
        return parent::afterDelete();
    }
    
    public function afterFind() 
    {
        $this->tags = Tags::getTags(BaseApp::CELEBRITY,$this->id);
        return parent::afterFind();
    }
    
    public function behaviors()
    {
        return array(
            'CSafeContentBehavor' => array(
                'class' => 'ext.behaviors.CSafeContentBehavior',
                'attributes' => array('title','discription'),
            ),
        );
    }
    
    public static function getCele($cid,$offset=0,$limit=1)
    {
        $sql = "select a.guests,a.index_recommand,a.channel_recommand,a.discription,a.title,a.id,b.track_id from `celebrity_painted` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.index_recommand = '1'  limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::CELEBRITY))->queryAll();
        return $model;
    }
    
}