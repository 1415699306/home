<?php
class Shop extends CActiveRecord
{
    public $thumb;
    public $tags;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'shop';
	}

	
	public function rules()
	{
		
		return array(
			array('title, discription', 'required'),
                        array('recommend,channel_recommand,index_recommand,status,tags,category_id,user_id,title,discription,ctime,mtime', 'safe'),
			array('id,app_id,status,channel_recommand,index_recommand,recommend,tags,category_id,user_id,title,discription,ctime,mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		return array(
             'shopContent'=>array(self::HAS_ONE,'ShopContent','shop_id'),
             'thumbs'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::SHOP),
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
                    'title' => '名称',
                    'status'=>'状态',
                    'thumb'=>'封面',
                    'channel_recommand'=>'频道推荐',
                    'index_recommand'=>'首页推荐',
                    'tags'=>'标签',
                    'recommend'=>'推荐',
                    'discription' => '简要',
                    'ctime' => '添加时间',
                    'mtime' => '更新时间',
		);
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('recommend', $this->recommend,true);
		$criteria->compare('channel_recommand', $this->channel_recommand,true);
		$criteria->compare('index_recommand', $this->index_recommand,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('discription',$this->discription,true);
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
            $this->status = 0;
            $this->user_id = Yii::app()->user->id;
            $this->app_id=  BaseApp::SHOP;
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
        $content = $this->getRelated('shopContent');      
        $thumbs = $this->getRelated('thumbs'); 
        if(!empty($thumbs))Storage::deleteImageBySize('shop', $this->thumbs->track_id,'thumb');
        ShopContent::model()->deleteAllByAttributes(array('shop_id'=>$this->id));
        if(!empty($content->content))ResourcesHelper::deleteContentImg($content->content);
        Tags::deleteByTags($this->tags, BaseApp::SHOP, $this->id);
        Yii::log('ID:'.Yii::app()->user->id.'用户删除了酒店,ID:'.$this->id,'info','system.backend.shop');
        return parent::afterDelete();
    }
    
    public function afterFind() 
    {
        $this->tags = Tags::getTags(BaseApp::SHOP,$this->id);
        return parent::afterFind();
    } 
    
    public static function getList($key)
    {
        $data  = Category::getCat($key);
        foreach($data as $val){
            $arr[] = $val['id'];
        }
        $arr  = implode(',', $arr);
        $sql = "select a.title,a.id,a.recommend,a.discription,b.track_id from `shop` as a ,`storage` as b where a.category_id in ($arr) and a.id = b.res_id and b.app_id = :aid  and recommend ='1'  order by id desc limit 0,4";
        $model = Yii::app()->db->createCommand($sql)->bindValue(':aid',BaseApp::SHOP)->queryAll();
        return $model;
    }
    
    public static function getRist($key)
    {
        $data  = Category::getCat($key);
        foreach($data as $val){
            $arr[] = $val['id'];
        }
        $arr  = implode(',', $arr);
        $sql = "select a.title,a.id,a.recommend,a.discription,b.track_id from `shop` as a ,`storage` as b where a.category_id in ($arr) and a.id = b.res_id and b.app_id = :aid  and recommend ='1'  order by id desc limit 5,4";
        $model = Yii::app()->db->createCommand($sql)->bindValue(':aid',BaseApp::SHOP)->queryAll();
        return $model;
    }
    
    public static function getOne($key,$limit=4)
    {
        $model = Yii::app()->redis->get('shop_index',BaseApp::SHOP,$key);
        if($model === false){
            $sql = "select a.title,a.id,a.recommend,a.discription,b.track_id from `shop` as a ,`storage` as b where a.category_id=:cid and a.id = b.res_id and b.app_id = :aid  and recommend ='1'  order by id desc limit :limit";
            $model = Yii::app()->db->createCommand($sql)->bindValues(array(':aid'=>BaseApp::SHOP,':cid'=>(int)$key,':limit'=>$limit))->queryAll();
            Yii::app()->redis->setex('shop_index',BaseApp::SHOP,$key,CJSON::encode($model),86400);
        }else{
            $model = CJSON::decode($model,true);
        }
        
        return $model;
    }
    
    
    
    
    
}