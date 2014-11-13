<?php


class Community extends CActiveRecord
{
    public $tags;
    public $thumb;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'community';
	}

	
	public function rules()
	{
		
		return array(
			array('category_id, tags, title, discription, source, recommand, channel_recommand,index_recommand', 'required'),
			array('recommand,app_id,channel_recommand, status, history', 'numerical', 'integerOnly'=>true),
			array('category_id, user_id, ctime, mtime', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80),
			array('discription', 'length', 'max'=>255),
			array('source', 'length', 'max'=>128),
            array('tags', 'match', 'pattern'=>'/^([\x{4e00}-\x{9fa5}A-Za-z0-9_],?)+$/u','message'=>'关键字格式不正确,请以半角逗号分开!'),
		
			array('id,app_id,category_id, user_id, title, discription, source, recommand, channel_recommand,index_recommand, history, status, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		
		return array(
            'communityContent'=>array(self::HAS_ONE,'CommunityContent','community_id'),
            'thumbs'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::COMMUNITY),
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
			'discription' => '简要',
			'source' => '来源',
			'recommand' => '通用推荐',
			'channel_recommand' => '频道推荐',
            'index_recommand'=>'首页推荐',
			'status' => '状态',
            'history'=>'历史',
            'tags'=>'云标签',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
		);
	}

	
	public function search()
	{
		

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('discription',$this->discription,true);
		$criteria->compare('source',$this->source,true);
		$criteria->compare('recommand',$this->recommand);
		$criteria->compare('channel_recommand',$this->channel_recommand);
        $criteria->compare('index_recommand',$this->index_recommand);
		$criteria->compare('status',$this->status);
        $criteria->compare('history',$this->history);
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
            $this->app_id=  BaseApp::COMMUNITY;
        }
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
    
    public function afterFind() 
    {
        $this->tags = Tags::getTags(BaseApp::COMMUNITY,$this->id);
        return parent::afterFind();
    }
    
     public function afterDelete() 
    {
        $content = $this->getRelated('communityContent');      
        $thumbs = $this->getRelated('thumbs'); 
        if(!empty($thumbs))Storage::deleteImageBySize('community', $this->thumbs->track_id,'thumb');
        CommunityContent::model()->deleteAllByAttributes(array('community_id'=>$this->id));
        if(!empty($content->content))ResourcesHelper::deleteContentImg($content->content);
        Tags::deleteByTags($this->tags, BaseApp::COMMUNITY, $this->id);
		PublicCount::model()->deleteAllByAttributes(array('app_id'=>BaseApp::COMMUNITY,'res_id'=>$this->id));
		PublicComment::model()->deleteAllByAttributes(array('app_id'=>BaseApp::COMMUNITY,'res_id'=>$this->id));
        Yii::log('ID:'.Yii::app()->user->id.'用户删除了奢生活文章,ID:'.$this->id,'info','system.backend.community');
        return parent::afterDelete();
    }
    
    
     public static function getCommunity($cid,$offset=0,$limit=1)
    {
        $sql = "select a.title,a.id,a.discription,b.track_id from `community` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.index_recommand=1  order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::COMMUNITY))->queryAll();
        return $model;
    }
}