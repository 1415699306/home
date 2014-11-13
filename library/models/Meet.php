<?php
class Meet extends CActiveRecord
{
    public $thumb; 
    public $tags;
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'meet';
	}

   
	public function rules()
	{
		return array(
			array('title,discription,category_id,fee,start_time,off_time,trailer_time,locale,', 'required'),
			array('user_id,app_id,recommand, channel_recommand,index_recommand', 'numerical', 'integerOnly'=>true),
            array('fee,type,top_bar,status,province,city,organizer,status,mode', 'safe'),  
			array('title, theme_name', 'length', 'max'=>128),
			array('discription', 'length', 'max'=>255),
			array('category_id, user_id, start_time, off_time, ctime, mtime', 'length', 'max'=>11),
			array('locale', 'length', 'max'=>1024),
            array('tags', 'match', 'pattern'=>'/^([\x{4e00}-\x{9fa5}A-Za-z0-9_],?)+$/u','message'=>'关键字格式不正确,请以半角逗号分开!'),
			array('id,app_id,title,trailer_time,user_id,province,mode,top_bar,organizer,fee,city,type,province, city,tags,state, people_number, recommand, channel_recommand, index_recommand,discription, category_id, theme_name, start_time, off_time, locale, status, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		return array(
            'meetContent'=>array(self::HAS_ONE,'MeetContent','meet_id'),
            'thumbs'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::MEET),
            'categorys'=>array(self::BELONGS_TO,'Category','category_id'),
            'eminentRelation'=>array(self::HAS_ONE,'EminentRelation','res_id','condition'=>'eminentRelation.app_id='.BaseApp::MEET),
            'eminentRelations'=>array(self::HAS_MANY,'EminentRelation','','on'=>'t.id = eminentRelations.res_id and eminentRelations.app_id = '.BaseApp::MEET),
             'user'=>array(self::BELONGS_TO,'User','user_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'title' => '聚会标题',
            'app_id'=>'资源id',
			'discription' => '聚会简要',
			'category_id' => '分类',
			'theme_name' => '聚会主题',
			'start_time' => '开始时间',
			'off_time' => '结束时间',
			'locale' => '地点',
             'province'=>'',
            'city'=>'',
            'tags'=>'标签',
            'state'=>'',
            'trailer_time'=>'时间',
            'mode'=>'状态',
            'top_bar'=>'右侧图',
            'organizer'=>'主办方',
            'fee'=>'收费',
			'status' => '状态',
            'thumb'=> '缩略图',
            'recommand'=>'列表推荐',
            'index_recommand'=>'首页推荐',
            'channel_recommand'=>'频道推荐',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
            'people_number'=>'人数上限',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('title',$this->title,true);
        $criteria->compare('user_id',$this->user_id);
        $criteria->compare('app_id',$this->app_id);
		$criteria->compare('discription',$this->discription,true);
        $criteria->compare('organizer',$this->organizer,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('theme_name',$this->theme_name,true);
		$criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('off_time',$this->off_time,true);
        $criteria->compare('trailer_time',$this->trailer_time,true);
		$criteria->compare('locale',$this->locale,true);
        $criteria->compare('top_bar',$this->top_bar,true);
		$criteria->compare('status',$this->status);
        $criteria->compare('fee',$this->fee);
        $criteria->compare('mode',$this->mode);
        $criteria->compare('state',$this->state);
        $criteria->compare('recommand',$this->recommand);
        $criteria->compare('channel_recommand',$this->channel_recommand);
        $criteria->compare('index_recommand',$this->index_recommand);
        $criteria->compare('people_number',$this->people_number);
        $criteria->compare('province', $this->province);
        $criteria->compare('city', $this->city);
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
            $this->status =  0;
            $this->app_id =  BaseApp::MEET;
        }
        $this->start_time = strtotime($this->start_time,time());
        $this->off_time = strtotime($this->off_time,time());
        $this->trailer_time = strtotime($this->trailer_time,time());
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    public function afterDelete() 
    {
        $content = $this->getRelated('meetContent');      
        $thumbs = $this->getRelated('thumbs');
        if(!empty($thumbs))Storage::deleteImageBySize('meet', $this->thumbs->track_id,'thumb');
        MeetContent::model()->deleteAllByAttributes(array('meet_id'=>$this->id));
        EminentRelation::model()->deleteAllByAttributes(array('app_id'=>BaseApp::MEET,'res_id'=>$this->id));
        Tags::deleteByTags($this->tags, BaseApp::MEET, $this->id);
        if(!empty($content->content))ResourcesHelper::deleteContentImg($content->content);    
        return parent::afterDelete();
    }
    
    public function afterFind() 
    {
        $this->tags = Tags::getTags(BaseApp::MEET,$this->id);
        return parent::afterFind();
    }
    
    public static function getRelations($app_id,$res_id,$limit)
    {
        $criteria = new CDbCriteria();
        $criteria->with = array('eminentPerson','eminentPerson.avatarImage');
        $criteria->condition = 't.app_id=:aid';
        $criteria->addCondition('t.res_id=:rid');
        $criteria->params = array(':aid'=>(int)$app_id,':rid'=>(int)$res_id);
        $criteria->limit = (int)$limit;
        return EminentRelation::model()->findAll($criteria);
    }
    
    
    
    public static function getTopBar($id)
    {
        if(is_file(RESOURCE_PATH.DIRECTORY_SEPARATOR.'meet'.DIRECTORY_SEPARATOR.'topbar'.DIRECTORY_SEPARATOR.$id))
            return DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.'meet'.DIRECTORY_SEPARATOR.'topbar'.DIRECTORY_SEPARATOR.$id;
    }
    
    public static function getStatus($key)
    {   
        $params = array(
            '0'=>'<em></em>',
            '1'=>'<em class="apply"></em>',
            '2'=>'<em class="end"></em>',
        );
        return array_key_exists($key, $params) ? $params[$key] : null;
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
    
    public static function getSta($id)
    {   
        $model = Meet::model()->findByPk($id);
        if($model->off_time > time()){
            if($model->mode==0){
               if(($model->start_time<time()) && ($model->off_time > time())){
                   $key = 1;
               }else{
                   $key = 0;
               }
            }elseif($model->mode==1){
                $key=1;
            }
        }else{
            $key = 2;
        }
        $params = array(
            '0'=>'<em></em>',
            '1'=>'<em class="apply"></em>',
            '2'=>'<em class="end"></em>',
            );
        return array_key_exists($key, $params) ? $params[$key] : null;
    }
    
}
