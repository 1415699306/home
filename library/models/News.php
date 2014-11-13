<?php

/**
 * This is the model class for table "article".
 *
 * The followings are the available columns in table 'article':
 * @property string $id
 * @property string $category_id
 * @property string $user_id
 * @property string $title
 * @property string $discription
 * @property string $source
 * @property integer $recommend
 * @property integer $status
 * @property string $ctime
 * @property string $mtime
 */
class News extends CActiveRecord
{
    public $thumb;
    public $tags;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
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
		return 'news';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('recommend,aip,title', 'required'),
            array('id,link,category_id,unit,maney,contacts,address,professor,discription,res_id,aip,user_id,title,ctime,mtime', 'safe'),
			array('user_id, ctime, mtime', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80),
            array('thumb','file','types'=>'jpg,jpeg,png,gif,bmp','allowEmpty'=>true),
			array('id,user_id,title,ctime,mtime', 'safe', 'on'=>'search'),
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
             'thumbs'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::NEWS),
             'user'=>array(self::BELONGS_TO,'User','user_id'),
             'category'=>array(self::BELONGS_TO,'Category','category_id'),   
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '用户',
			'title' => '标题',
            'category_id'=>'分类',
            'link' => '链接',
            'aip' => '模块名',
            'thumb'=>'封面',
            'recommend'=>'推荐',
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
        $criteria->compare('aip',$this->aip,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('title',$this->title,true); 
        $criteria->compare('link',$this->link,true);
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
        if($this->isNewRecord){
            $this->ctime = $time;
            $this->user_id = Yii::app()->user->id;
        }
        $this->mtime = time();
        return parent::beforeSave();
    }
    
    public function behaviors()
    {
        return array(
            'CSafeContentBehavor' => array(
                'class' => 'ext.behaviors.CSafeContentBehavior',
                'attributes' => array('title'),
            ),
        );
    }
    
    public function afterDelete() 
    {
        $thumbs = $this->getRelated('thumbs'); 
        /*如果存在附件就删除附件*/
        if(!empty($thumbs))Storage::deleteImageBySize('news', $this->thumbs->track_id,'thumb');
        /*删除标签*/
        Tags::deleteByTags($this->tags, BaseApp::NEWS, $this->id);
        /*记录用户操作日志*/
        Yii::log('ID:'.Yii::app()->user->id.'用户删除了文章,ID:'.$this->id,'info','system.backend.news');
        return parent::afterDelete();
    }
    
    public function afterFind() 
    {
        $this->tags = Tags::getTags(BaseApp::NEWS,$this->id);
        return parent::afterFind();
    }
    
    public static function getByCategory($id,$limit)
    {
        $sql = "select a.title,a.link,a.recommend,a.title,a.id,b.track_id from `news` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommend = '1' order by id desc  limit {$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$id,':app_id'=>BaseApp::NEWS))->queryAll();
        return $model;
    }
    
    public static  function getNew($cid,$offset=0,$limit=1)
    {
        $sql = "select a.id,a.link,a.maney,a.contacts,a.address,a.professor,a.discription,a.recommend,a.title,a.category_id,a.res_id,b.track_id  from `news` as a,`storage` as b  where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommend = '1'order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::NEWS))->queryAll(); 
        return $model;
    }
    
    public static function getGove($aip,$offset=0,$limit=1)
    {
        $sql = "select a.id,a.link,a.maney,a.contacts,a.address,a.professor,a.discription,a.recommend,a.title,a.aip,a.res_id,b.track_id  from `news` as a,`storage` as b  where a.aip=:aip and a.id=b.res_id and b.app_id=:app_id and a.recommend = '1'order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':aip'=>(int)$aip,':app_id'=>BaseApp::NEWS))->queryAll(); 
        return $model;
    }
    
}