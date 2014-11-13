<?php


class Article extends CActiveRecord
{
    public $thumb;
    public $tags;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'article';
	}

	
	public function rules()
	{
		
		return array(
			array('category_id, recommend, title, discription', 'required'),
            array('id,source,app_id,professor,recommend,subtitle,money,cooperation,project,address,tags,category_id,user_id,title,discription,status,ctime,mtime', 'safe'),
			array('status, recommend', 'numerical', 'integerOnly'=>true),
			array('category_id, user_id, ctime, mtime,money', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80),
			array('discription', 'length', 'max'=>255), 
            array('money', 'length', 'max'=>11),
            array('source','length','max'=>128),
            array('thumb','file','types'=>'jpg,jpeg,png,gif,bmp','allowEmpty'=>true),
            array('tags', 'match', 'pattern'=>'/^([\x{4e00}-\x{9fa5}A-Za-z0-9_],?)+$/u','message'=>'关键字格式不正确,请以半角逗号分开!'),
			array('id,source,app_id,professor,recommend,money,cooperation,project,address,tags,category_id,user_id,title,discription,status,ctime,mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		return array(
             'articleContent'=>array(self::HAS_ONE,'ArticleContent','article_id'),
             'thumbs'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::ARTICLE),
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
            'app_id' => '资源id',
			'title' => '标题',
            'subtitle' => '小标题',
            'professor'=>'讲师',
            'money'=>'总投资',
            'cooperation'=>'合作方式',
            'project'=>'项目责任主体',
            'address'=>'建设地点',
            'thumb'=>'封面',
            'tags'=>'标签',
            'recommend'=>'推荐',
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
        $criteria->compare('recommend', $this->recommend);
		$criteria->compare('category_id',$this->category_id,true);
        $criteria->compare('source', $this->source,true);
		$criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('title',$this->title,true);
        $criteria->compare('professor',$this->professor,true);
        $criteria->compare('money',$this->money);
        $criteria->compare('cooperation',$this->cooperation,true);
        $criteria->compare('address',$this->address,true);
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
            $this->app_id=  BaseApp::ARTICLE;
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
    
    public function afterDelete() 
    {
        $content = $this->getRelated('articleContent');      
        $thumbs = $this->getRelated('thumbs'); 
        if(!empty($thumbs))Storage::deleteImageBySize('article', $this->thumbs->track_id,'thumb');
        ArticleContent::model()->deleteAllByAttributes(array('article_id'=>$this->id));
        if(!empty($content->content))ResourcesHelper::deleteContentImg($content->content);
        Tags::deleteByTags($this->tags, BaseApp::ARTICLE, $this->id);
        Yii::log('ID:'.Yii::app()->user->id.'用户删除了文章,ID:'.$this->id,'info','system.backend.article');
        return parent::afterDelete();
    }
    
    public function afterFind() 
    {
        $this->tags = Tags::getTags(BaseApp::ARTICLE,$this->id);
        return parent::afterFind();
    }
    
    
    public function getArticle($id,$key)
    {
        $key = (int)Yii::app()->request->getParam('key',$key);
        if($key == 1)
        {
            $sql = "select a.recommend,a.discription,a.title,a.ctime,a.mtime,a.id,b.track_id from `article` as a,`storage` as b where a.category_id=:cid and a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommend='1' order by id desc limit 4,2";
            $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$id,':app_id'=>BaseApp::ARTICLE))->queryAll();
            return $model;
        }elseif($key == 2){
            $sql = "select a.recommend,a.discription,a.title,a.ctime,a.mtime,a.id,b.track_id from `article` as a,`storage` as b where a.category_id=:cid and a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommend='1' order by id desc limit 6,2";
            $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$id,':app_id'=>BaseApp::ARTICLE))->queryAll();
            return $model;
        }elseif ($key == 3) {
            $sql = "select a.recommend,a.discription,a.title,a.ctime,a.mtime,a.id,b.track_id from `article` as a,`storage` as b where a.category_id=:cid and a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommend='1' order by id desc limit 8,2";
            $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$id,':app_id'=>BaseApp::ARTICLE))->queryAll();
            return $model;
        }
           
    }
    
    public static function getByCategory($id,$limit)
    {
        $sql = "select a.subtitle,a.recommend,a.title,a.id,b.track_id from `article` as a,`storage` as b where a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommend = '1' order by id desc  limit {$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$id,':app_id'=>BaseApp::ARTICLE))->queryAll();
        return $model;
    }
    
    
    public static function getAri($cid,$offset=0,$limit=1)
    {
        $sql = "select a.subtitle,a.professor,a.money,a.project,a.cooperation,a.address,a.recommend,a.discription,a.title,a.ctime,a.mtime,a.id,b.track_id from `article` as a,`storage` as b where a.category_id=:cid and a.category_id=:cid and a.id=b.res_id and b.app_id=:app_id and a.recommend=1 order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':app_id'=>BaseApp::ARTICLE))->queryAll();
        return $model;
    }
}