<?php

class Dream extends CActiveRecord
{
    public $thumb;
    public $target = 7;
    public $targetItems=0;
    public $attention=0;
    public $preparation=0;
    public $support=0;
    public $userSupport = 0;
    public $userProject = 0;
    public $payment = 0;
    public $lastDays = 0;
    public $lastTime = 0;
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'dream';
	}

	
	public function rules()
	{
		
		return array(
			array('category_id, title, province, city, discription, money, day', 'required'),
            array('thumb','required','on'=>'create'),
			array('province','checkProvince'),
            array('money','checkMoney'),
            array('day', 'checkDay'),
            array('title','checkTitle'),
            array('discription','checkDiscription'),
			array('user_id, status_time, category_id, province, city, money, ctime, mtime', 'length', 'max'=>11),
			array('title', 'length', 'max'=>32),
			array('discription', 'length', 'max'=>255),
			array('video', 'length', 'max'=>1024),
            array('recommand','boolean'),
			
			array('id,app_id,user_id, recommand, category_id, title, status, status_time, province, city, discription, video, money, day, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		return array(
            'dreamContent'=>array(self::HAS_ONE,'DreamContent','dream_id'),
            'thumbs'=>array(self::HAS_ONE,'Storage','res_id','condition'=>'thumbs.app_id = '.BaseApp::DREAM),
            'category'=>array(self::BELONGS_TO,'Category','category_id'),
            'logs'=>array(self::HAS_MANY,'DreamLog','dream_id','order'=>'id desc'),
            'dreamPledges'=>array(self::HAS_MANY,'DreamPledges','dream_id'),
            'count'=>array(self::HAS_ONE,'DreamCount','dream_id'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '用户',
            'app_id' => '资源id',
			'category_id' => '分类',
			'title' => '项目名称',
			'province' => '省',
			'city' => '市',
			'discription' => '项目简介',
			'video' => '宣传视频',
			'money' => '筹集金额',
			'day' => '募集天数',
            'thumb'=>'缩略图',
            'status_time'=>'项目启动时间',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
            'recommand'=>'首页推荐',
            'status'=>'状态',
            'attention'=>'关注',
            'order'=>'订单',
            'moneycount','总金额',
		);
	}

	
	public function search()
	{
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('category_id',$this->category_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('discription',$this->discription,true);
		$criteria->compare('video',$this->video,true);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('day',$this->day);
        $criteria->compare('status',$this->status);
        $criteria->compare('status_time',$this->status_time);
        $criteria->compare('recommand',$this->recommand);
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
    
    public function checkProvince($attribute)
    {
        if($this->$attribute == '000000')
        {
            $param = $attribute == 'city' ? '城市' : '省份';
            $this->addError($attribute,'请选择'.$param);
        }
    }
    
    public function checkMoney($attribute)
    {
        if($this->$attribute < 500){
            $this->addError($attribute,'必须大于或等于 500');
        }elseif(!preg_match('/^\d+?\.?\d{2}$/i', $this->$attribute)){
             $this->addError($attribute,'不是价钱格式,请从新填写');
        }
    }

    public function checkDay($attribute)
    {
        if(!preg_match('/^(\d+)$/i', $this->$attribute) || preg_match('/^(\d+\-\d+天)/i',$this->$attribute))
        {      
            $this->addError($attribute,'不是纯数字');
        }
        elseif($this->$attribute < 15)
        {
            $this->addError($attribute,'募集天数大于或等于15');
        }
    }
    
    public function checkTitle($attribute)
    {
        if(preg_match('/^(不超过\d+个字)/i', $this->$attribute))
        {
            $this->addError($attribute,'请填写标题');
        }
    }
    
    public function checkDiscription($attribute)
    {
        if(preg_match('/^(不超过\d+个字!)/i', $this->$attribute))
        {
            $this->addError($attribute,'请填写简介');
        }
    }
    
    public function beforeSave() 
    {
        $time = time();
        $purifier = new CHtmlPurifier();
        $this->title = $purifier->purify($this->title);
        $this->discription = $purifier->purify($this->discription);
        if($this->isNewRecord)
        {
            $this->user_id = Yii::app()->user->id;
            $this->ctime = $time;
            $this->app_id=  BaseApp::DREAM;
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    public function afterDelete() 
    {
        $thumbs = $this->getRelated('thumbs');
        $content = $this->getRelated('dreamContent');
        $dreamPledges = $this->getRelated('dreamPledges');
        if(!empty($thumbs))Storage::deleteImageBySize('dream', $this->thumbs->track_id,'thumb');
        if(!empty($content->content))
        {
            ResourcesHelper::deleteContentImg($content->content);
            $content->delete();
        }
        foreach ($dreamPledges as $pledge)
        {
            if(!empty($pledge->thumbs))
            {
                foreach ($pledge->thumbs as $key)
                {
                    Storage::deleteImageBySize('dream', $key->track_id,'thumb');
                }
            }
            $order = PublicOrder::model()->findByAttributes(array('app_id'=>BaseApp::DREAM,'res_id'=>$pledge->id));
            PublicOrderAddress::model()->deleteAllByAttributes(array('order_id'=>$order->order_id));
        }        
        DreamPledges::model()->deleteAllByAttributes(array('dream_id'=>$this->id));
        DreamLog::model()->deleteAllByAttributes(array('dream_id'=>$this->id));
        PublicCount::model()->deleteAllByAttributes(array('app_id'=>BaseApp::DREAM,'res_id'=>$this->id));
		PublicComment::model()->deleteAllByAttributes(array('app_id'=>BaseApp::DREAM,'res_id'=>$this->id));
        DreamCount::model()->deleteAllByAttributes(array('dream_id'=>$this->id));
        DreamSubmit::model()->deleteAllByAttributes(array('dream_id'=>$this->id));
        Yii::log('ID:'.Yii::app()->user->id.'用户删除梦想秀','info','system.site.dream');
        return parent::afterDelete();
    }
    
    public static function getStatus($key)
    {
        $params = array(
            '-3'=>'未达成',
            '-2'=>'撤回下线',
            '-1'=>'审核撤回',
            '0'=>'准备中',
            '1'=>'审核中',
            '2'=>'预热中',
            '3'=>'筹资中',
            '4'=>'目标达成',
        );
        return array_key_exists($key, $params) ? $params[$key] : null;
    }
    
    public function afterFind() 
    {
        $payment = $this->getRelated('count');
        $count = PublicAttention::getCount($this->id,BaseApp::DREAM);
        $this->attention = $count;
        $this->preparation = date('d',(strtotime(date("Y-m-d"))-strtotime(date("Y-m-d",$this->status_time)))/86400);
        $this->payment = !empty($payment->money) ? $payment->money : $this->payment;
        $this->support = !empty($payment->count) ? $payment->count : $this->support;
        if($this->money > 500){
            $this->target = floor($this->money*0.015);
        }
        if($this->status == 2){
            $this->targetItems = round(($count/$this->target)*100,2);
        }elseif($this->status == 3){
            if(!empty($payment->money)){
                $this->targetItems  = round(($payment->money/$this->money)*100,2);
            }
            $statusTime = date("Y-m-d H:i:s",$this->status_time);
            $this->lastDays = date('d',strtotime(date('Y-m-d H:i:s',strtotime($statusTime.'+'.$this->day.' day')))-$this->status_time);
            $this->lastTime = date('Y-m-d H:i:s',strtotime($statusTime.'+'.$this->day.' day'));
        }
        $this->userProject = self::getCountByUser($this->user_id);
        return parent::afterFind();
    }
    
    
    public static function getCountByUser($user_id)
    {
        return self::model()->countByAttributes(array('user_id'=>$user_id));
    }
    
    
    public function getDream($res_id)
    {
        $res_id = (int)Yii::app()->request->getParam('res_id',$res_id);
        $sql = "select *,id,title,discription from dream where id = '{$res_id}'";
        $model = Yii::app()->db->createCommand($sql)->queryAll();
        return $model;
    }
    
    
    public static function getImage($id)
    {
        $id = (int)Yii::app()->request->getParam('id',$id);
        $sql = "select a.title,a.id,b.track_id from `dream` as a,`storage` as b where b.res_id=:id and b.app_id=:app_id order by id desc limit 1";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':id'=>(int)$id,':app_id'=>BaseApp::DREAM))->queryAll();
        return $model;
    }
}