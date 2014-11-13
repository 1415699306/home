<?php


class Life extends CActiveRecord
{
    public $thumb;
    public $tags;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'life';
	}

	
	public function rules()
	{
		
		return array(
			array('category_id, recommand,channel_recommand,index_recommand, source, title, discription', 'required'),
			array('status, recommand, channel_recommand,app_id', 'numerical', 'integerOnly'=>true),
			array('category_id, user_id, ctime, mtime', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80),
			array('discription', 'length', 'max'=>255), 
                        array('source','length','max'=>128),
                        array('source','url'),
                        array('tags', 'match', 'pattern'=>'/^([\x{4e00}-\x{9fa5}A-Za-z0-9_],?)+$/u','message'=>'关键字格式不正确,请以半角逗号分开!'),
			
			array('id, source, channel_recommand, app_id,recommand,index_recommand, tags, category_id, user_id, title, discription, status, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		
		return array(
             'lifeContent'=>array(self::HAS_ONE,'LifeContent','life_id'),
             'thumbs'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::LIFE),
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
            'thumb'=>'封面',
            'tags'=>'标签',
            'recommand'=>'通用推荐',
            'channel_recommand'=>'频道推荐',
            'index_recommand'=>'首页推荐',
			'discription' => '简要',
            'source'=>'来源',
			'status' => '状态',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
		);
	}

	
	public function search()
	{
		

		$criteria=new CDbCriteria;
                $criteria->compare('id',$this->id,true);
                $criteria->compare('recommand', $this->recommand);
                $criteria->compare('channel_recommand', $this->channel_recommand);
                $criteria->compare('index_recommand', $this->index_recommand);
		$criteria->compare('category_id',$this->category_id,true);
                $criteria->compare('source', $this->source,true);
		$criteria->compare('user_id',$this->user_id,true);
                $criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('discription',$this->discription,true);
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
            $this->app_id=  BaseApp::LIFE;
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
    
    public function afterSave() 
    {
        Yii::app()->redis->delete('life_index_'.BaseApp::LIFE.'_'.$this->category_id);
        return parent::afterSave();
    }
    
    public function afterDelete() 
    {
        Yii::app()->redis->delete('life_index_'.BaseApp::LIFE.'_'.$this->category_id);
        $content = $this->getRelated('lifeContent');      
        $thumbs = $this->getRelated('thumbs'); 
        if(!empty($thumbs))Storage::deleteImageBySize('life', $this->thumbs->track_id,'thumb');
        LifeContent::model()->deleteAllByAttributes(array('life_id'=>$this->id));
        if(!empty($content->content))ResourcesHelper::deleteContentImg($content->content);
        Tags::deleteByTags($this->tags, BaseApp::LIFE, $this->id);
		PublicCount::model()->deleteAllByAttributes(array('app_id'=>BaseApp::LIFE,'res_id'=>$this->id));
		PublicComment::model()->deleteAllByAttributes(array('app_id'=>BaseApp::LIFE,'res_id'=>$this->id));	
        Yii::log('ID:'.Yii::app()->user->id.'用户删除了奢生活文章,ID:'.$this->id,'info','system.backend.life');
        return parent::afterDelete();
    }
    
    public function afterFind() 
    {
        $this->tags = Tags::getTags(BaseApp::LIFE,$this->id);
        return parent::afterFind();
    }
    
    public function getList($key,$limit=4)
    {
        $model = Yii::app()->redis->get('life_index',BaseApp::LIFE,$key);
        if($model === false){
            $sql = "select a.title,a.id,a.status,a.channel_recommand,a.discription,b.track_id from `life` as a,`storage` as b where a.id = b.res_id and b.app_id = :aid and a.category_id =:cid and a.status = '0'and channel_recommand ='1' order by id desc limit :limit";
            $model = Yii::app()->db->createCommand($sql)->bindValues(array(':aid'=>BaseApp::LIFE,':cid'=>$key,':limit'=>$limit))->queryAll();
            Yii::app()->redis->setex('life_index',BaseApp::LIFE,$key,CJSON::encode($model),86400);
        }else{
            $model = CJSON::decode($model,true);
        }
        return $model;
    }
}