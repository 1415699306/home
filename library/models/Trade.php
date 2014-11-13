<?php


class Trade extends CActiveRecord
{
    public $tags;
    public $min_img;
    public $big_img;
	public $areas, $styles,$spaces,$appliances,$lifes,$sprices = array();
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'trade';
	}
        
        public function init(){
                //$this->stars = HotelPlace::model()->findAll();
                $this->areas = TradeArea::model()->findAll();
                $this->styles = TradeStyle::model()->findAll();
                $this->spaces = TradeSpace::model()->findAll();
                $this->appliances = TradeAppliance::model()->findAll();
                $this->lifes = TradeLife::model()->findAll();
                $this->sprices = TradeSprice::model()->findAll();
	}

	
	public function rules()
	{
		
		return array(
			array('type,recommand, channel_recommand,index_recommand,title,area,style,price,space,start_time,stop_time,num,code,discription', 'required'),
			array('type,app_id,highlighted, recommand, channel_recommand, status', 'numerical', 'integerOnly'=>true),
			array('category_id, user_id, index, text_index, ctime, mtime', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80),
                        array('big_thumb, min_thumb','length','max'=>1024),
                        array('big_img, min_img','file','types'=>'jpg,jpeg,png,gif','allowEmpty'=>true),
                        array('tags', 'match', 'pattern'=>'/^([\x{4e00}-\x{9fa5}A-Za-z0-9_],?)+$/u','message'=>'关键字格式不正确,请以半角逗号分开!'),
			array('id,app_id,category_id, recommand, channel_recommand,index_recommand, type, user_id, title, index, text_index, highlighted, status, start_time, stop_time, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		
		return array(
                    'tradeContent'=>array(self::HAS_ONE,'TradeContent','trade_id'),
                    'category'=>array(self::BELONGS_TO,'Category','category_id'),
                    'user'=>array(self::BELONGS_TO,'User','user_id'),
                    'areaName'=>array(self::BELONGS_TO,'TradeArea','area'),
                    //'starName'=>array(self::BELONGS_TO,'HotelPlace','star_id'),
                    'styleName'=>array(self::BELONGS_TO,'TradeStyle','style'),
                    'spaceName'=>array(self::BELONGS_TO,'TradeSpace','space'),
                    'lifeName'=>array(self::BELONGS_TO,'TradeLife','life'),
                    'applianceName'=>array(self::BELONGS_TO,'TradeAppliance','appliance'),
                    'spriceName'=>array(self::BELONGS_TO,'TradeSprice','sprice'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'category_id' => '分类',
			'type' => '类型',
			'user_id' => 'User',
                        'app_id' => '资源id',
			'title' => '标题',
			'index' => '索引',
                        'text_index'=>'文字索引',
                         'min_img'=>'细图',
                        'big_img'=>'大图',
			'highlighted' => '标题高亮',
			'status' => '状态',
                        'start_time'=>'启动时间',
                        'stop_time'=>'结束时间',
                        'tags'=>'标签',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
                        'recommand'=>'通用推荐',
                        'channel_recommand'=>'频道通荐',
                        'index_recommand'=>'首页推荐',
                        'content' => '内容',
                        'area' => '面积',
                        'style' => '风格',
                        'space' => '空间',
                        'sprice' => '价格管理',
                        'appliance' => '家电定制',
                        'life' => '生活定制',
                        'price'=>'价格',
                        'num'=>'件数',
                        'code'=>'编码',
                        'discription'=>'描述',
                        'population'=>'推荐人群',
		);
	}

	
	public function search()
	{
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('user_id',$this->user_id,true);
                $criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('index',$this->index,true);
                $criteria->compare('text_index',$this->index,true);
		$criteria->compare('highlighted',$this->highlighted);
                $criteria->compare('recommand',$this->recommand);
                $criteria->compare('channel_recommand',$this->channel_recommand);
                $criteria->compare('start_time',$this->start_time,true);
		$criteria->compare('stop_time',$this->stop_time,true);
                $criteria->compare('status',$this->status);
                $criteria->compare('area',$this->area);
                $criteria->compare('style',$this->style);
                $criteria->compare('price',$this->price);
                $criteria->compare('sprice',$this->sprice);
                $criteria->compare('num',$this->num);
                $criteria->compare('code',$this->code);
                $criteria->compare('discription',$this->discription);
                $criteria->compare('population', $this->population);
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
        $max = self::model()->getDbConnection()->createCommand("select max(id) from `trade`")->queryRow();
        if($this->isNewRecord)
        {
            $this->index = ($max["max(id)"]+1);
            $this->ctime = $time;
            $this->status = 1;
            $this->user_id = Yii::app()->user->id;
            $this->app_id=  BaseApp::TRADE;
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    public static function deleteFile($path)
    {
        if(is_file(WEB_PATH.$path))
        {
            unlink (WEB_PATH.$path);
        }
    }
    
    public function afterDelete() 
    {
        $content = $this->getRelated('tradeContent');      
        if(!empty($this->min_thumb))self::deleteFile ($this->min_thumb);
        if(!empty($this->big_thumb))self::deleteFile ($this->big_thumb);
        TradeContent::model()->deleteAllByAttributes(array('trade_id'=>$this->id));
        if(!empty($content->content))ResourcesHelper::deleteContentImg($content->content);
        Tags::deleteByTags($this->tags, BaseApp::TRADE, $this->id);
		PublicCount::model()->deleteAllByAttributes(array('app_id'=>BaseApp::TRADE,'res_id'=>$this->id));
		PublicComment::model()->deleteAllByAttributes(array('app_id'=>BaseApp::TRADE,'res_id'=>$this->id));
        Yii::log('ID:'.Yii::app()->user->id.'用户删除了文章,ID:'.$this->id,'info','system.backend.trade');
        return parent::afterDelete();
    }
    
    public function afterFind() 
    {
        $this->tags = Tags::getTags(BaseApp::TRADE,$this->id);
        return parent::afterFind();
    }
    
    
    public static function getBusiness($cid,$type,$offset=0,$limit=1)
    {
        $sql = "select channel_recommand,title,type,id,min_thumb,big_thumb,category_id,recommand from `trade`  where category_id=:cid and type=:type and  channel_recommand='1'  order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid,':type'=>(int)$type))->queryAll();
        return $model;
    }
}