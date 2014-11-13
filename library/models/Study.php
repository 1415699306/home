<?php

class Study extends CActiveRecord
{
    public $thumb;
    public $tags;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'study';
	}

	
	public function rules()
	{
		
		return array(
			array('category_id recommand, tags, channel_recommand, index_recommand,source, title, discription', 'required'),
			array('country,app_id,scholl,video_url,suitable,course,cost,professor,ptime,status,author,press,pages,video,vidty, recommand,format, channel_recommand','safe'),
			array('category_id, user_id, ptime,ctime, mtime', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80),
			array('discription', 'length', 'max'=>255), 
            array('source','length','max'=>128),
            array('source,video_url','url'), 
            array('tags', 'match', 'pattern'=>'/^([\x{4e00}-\x{9fa5}A-Za-z0-9_],?)+$/u','message'=>'关键字格式不正确,请以半角逗号分开!'),
			array('id,app_id,source,ptime, channel_recommand, recommand,index_recommand, tags, category_id, user_id, title, discription, status, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
             'studyContent'=>array(self::HAS_ONE,'StudyContent','study_id'),
             'thumbs'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::STUDY),
             'category'=>array(self::BELONGS_TO,'Category','category_id'),
             'user'=>array(self::BELONGS_TO,'User','user_id'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => '分类',
			'user_id' => '用户',
            'app_id'=>'资源id',
			'title' => '标题',
            'author' => '作者',
            'press' => '出版社',
            'ptime'=>'出版时间',
            'pages'=>'页数',
            'tags'=>'标签',
            'country'=>'国家',
            'scholl'=>'学校',
            'course'=>'课程',
            'suitable'=>'适合岁数',
            'cost'=>'费用',
            'professor'=>'讲师',
            'video'=>'视频时长',
            'video_url'=>'视频地址',
            'vidty'=>'视频类型',
            'recommand'=>'通用推荐',
            'channel_recommand'=>'频道推荐',
            'index_recommand'=>'首页推荐',
			'discription' => '简要',
            'source'=>'来源',
			'status' => '状态',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
            'thumb'=>'缩略图',
		);
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
        $criteria->compare('recommand', $this->recommand);
        $criteria->compare('channel_recommand', $this->channel_recommand);
		$criteria->compare('category_id',$this->category_id,true);
        $criteria->compare('source', $this->source,true);
		$criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('discription',$this->discription,true);
        $criteria->compare('ptime',$this->ptime,true);
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
        if($this->isNewRecord){
            $this->ctime = $time;
            $this->status = 1;
            $this->user_id = Yii::app()->user->id;  
            $this->app_id=  BaseApp::STUDY;
        }
        $this->ptime = strtotime($this->ptime,$time);
        $this->mtime = time();
        return parent::beforeSave();
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
    
    public function afterDelete() 
    {
        $content = $this->getRelated('studyContent');      
        $thumbs = $this->getRelated('thumbs'); 
        if(!empty($thumbs))Storage::deleteImageBySize('study', $this->thumbs->track_id,'thumb');
        StudyContent::model()->deleteAllByAttributes(array('study_id'=>$this->id));
        if(!empty($content->content))ResourcesHelper::deleteContentImg($content->content);
        Tags::deleteByTags($this->tags, BaseApp::STUDY, $this->id);
        Yii::log('ID:'.Yii::app()->user->id.'用户删除了慧学习文章,ID:'.$this->id,'info','system.backend.life');
        return parent::afterDelete();
    }
    
    public function afterFind() 
    {
        $this->tags = Tags::getTags(BaseApp::STUDY,$this->id);
        return parent::afterFind();
    }
   
}