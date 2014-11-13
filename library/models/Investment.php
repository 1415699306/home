<?php


class Investment extends CActiveRecord
{
	public $top_bar;
    const APPID = 1;
   
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'investment';
	}

	public function rules()
	{
		
		return array(
			array('title, tel, category_id, unit, maney, channel_recommand, recommand,status,index_recommand, message, email, website, address, discription, contacts, deadline, seo_keyword, seo_discription', 'required'),
			array('id, type,app_id,user_id, category_id, channel_recommand, recommand, message, ctime, mtime', 'numerical', 'integerOnly'=>true),
			array('title, seo_keyword, email, website', 'length', 'max'=>128),
            array('address', 'length', 'max'=>128),
            array('contacts, unit', 'length', 'max'=>32),
            array('email','email'),
            array('website','url'),
            array('maney', 'length', 'max'=>11),
            array('tel','MPhoneValidator','message'=>'请正确填写电话号码'),
			array('discription,top_bar,thumb', 'length', 'max'=>1024),
			array('seo_discription', 'length', 'max'=>255),
            array('seo_keyword', 'match', 'pattern'=>'/^([\x{4e00}-\x{9fa5}A-Za-z0-9_],?)+$/u','message'=>'关键字格式不正确,请以半角逗号分开!'),
			array('top_bar, thumb','safe'),
			array('id, type,app_id,unit, maney, top_bar, channel_recommand, recommand,index_recommand, category_id, user_id, tel, title, discription, deadline, seo_keyword, seo_discription, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		
		return array(
            'investmentMod'=>array(self::HAS_MANY,'InvestmentMod','investment_id'),
            'categorys'=>array(self::BELONGS_TO,'Category','category_id'),
            'user'=>array(self::BELONGS_TO,'User','user_id'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
            'category_id'=>'项目分类',
			'type' => '模板类型',
			'user_id' => 'User',
            'app_id'=>'资源id',
			'title' => '项目名称',
			'discription' => '项目简介',
            'contacts'=>'联系人',
            'tel'=>'联系热线',
            'address'=>'联系地址',
            'email'=>'电子邮箱',
            'website'=>'公司网址',
            'message'=>'留言模块',
			'deadline' => '过期时间',
			'top_bar' => '顶部图片',
			'seo_keyword' => '关键字',
			'seo_discription' => '头部简介',
            'status'=>'项目状态',
            'recommand'=>'列表推荐',
            'channel_recommand'=>'频道推荐',
            'index_recommand'=>'首页推荐',
            'thumb'=>'缩略图',
            'maney'=>'金额',
            'unit'=>'建设单位',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
		);
	}

	
	public function search()
	{
		

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
        $criteria->compare('unit',$this->unit);
        $criteria->compare('maney',$this->maney);
		$criteria->compare('type',$this->type);
		$criteria->compare('user_id',$this->user_id);
        $criteria->compare('app_id',$this->app_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('discription',$this->discription,true);
		$criteria->compare('deadline',$this->deadline);
		$criteria->compare('seo_keyword',$this->seo_keyword,true);
		$criteria->compare('seo_discription',$this->seo_discription,true);
        $criteria->compare('recommand',$this->recommand,true);
        $criteria->compare('channel_recommand',$this->channel_recommand,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('mtime',$this->mtime);

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
	
	public function searchBackend()
    {
        $criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
        $criteria->compare('unit',$this->unit);
        $criteria->compare('maney',$this->maney);
		$criteria->compare('type',$this->type);
		$criteria->compare('user_id',$this->user_id);
        $criteria->compare('app_id',$this->app_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('discription',$this->discription,true);
		$criteria->compare('deadline',$this->deadline);
		$criteria->compare('seo_keyword',$this->seo_keyword,true);
		$criteria->compare('seo_discription',$this->seo_discription,true);
        $criteria->compare('recommand',$this->recommand,true);
        $criteria->compare('channel_recommand',$this->channel_recommand,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('mtime',$this->mtime);

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
            $this->index_recommand = 0;
            $this->user_id = Yii::app()->user->id;
            $this->app_id=  BaseApp::INVESTMENT;
        }
        $this->deadline = strtotime($this->deadline,time());
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    public static function array2string($tags)
	{
		return implode(',',$tags);
	}
	
	public static function string2array($tags)
	{
		return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}
    
    public function afterDelete() 
    {
        $path = RESOURCE_PATH.DIRECTORY_SEPARATOR.'investment';
        if($this->type == 0){
            foreach($this->investmentMod as $key){
                $params = CJSON::decode($key->mod);
                foreach($params as $k=>$v){
                    $property = Investment::getImageProperty($k);
                    foreach($property as $s){
                        if(array_key_exists($s, $v))
                        {
                            foreach ($v[$s] as $del){
                                $title = array();
                                preg_match('/(.*?)\.(\w+)$/iU',$del,$title);
                                $image = $path.DIRECTORY_SEPARATOR.$del;
                                if(2 < count($title)){
                                    $thumb = $path.DIRECTORY_SEPARATOR.$title[1].'_thumb.'.$title[2];
                                    if(is_file($thumb))
                                         unlink($thumb);
                                }
                                if(is_file($image))
                                    unlink($image);                           
                            }
                        }
                    }
                }
            }
            InvestmentMod::model()->deleteAllByAttributes(array('investment_id'=>$this->id));
        }
        $topBar = $path.DIRECTORY_SEPARATOR.'topbar'.DIRECTORY_SEPARATOR.$this->top_bar;
        if(is_file($topBar)){
            unlink($topBar);
        }
        Storage::deleteImageBySize('investment', $this->thumb,'thumb');
		PublicCount::model()->deleteAllByAttributes(array('app_id'=>BaseApp::INVESTMENT,'res_id'=>$this->id));
		PublicComment::model()->deleteAllByAttributes(array('app_id'=>BaseApp::INVESTMENT,'res_id'=>$this->id));
        return parent::afterDelete();
    }
    
    
    public static function getTemplateName($key,$id=false)
    {
        $params = array(
            '1'=>array('title'=>'开发模式','id'=>'default'),
            '2'=>array('title'=>'默认模板','id'=>'t1'),
        );
        return array_key_exists($key, $params) ? ($id == false ? $params[$key]['title'] : $params[$key]['id']) : null;
    }
    
   
    public static function getTopBar($id)
    {
        if(is_file(RESOURCE_PATH.DIRECTORY_SEPARATOR.'investment'.DIRECTORY_SEPARATOR.'topbar'.DIRECTORY_SEPARATOR.$id))
            return DIRECTORY_SEPARATOR.RESOURCE.DIRECTORY_SEPARATOR.'investment'.DIRECTORY_SEPARATOR.'topbar'.DIRECTORY_SEPARATOR.$id;
    }
   
    public static function getImageProperty($key)
    {
        $params = array(
            'advantage'=>array('0'=>'advantage_image'),
            'company'=>array('0'=>'company_imgae'),
            'description'=>array('0'=>'description_image'),
            'introduction'=>array('0'=>'introduction_image'),
            'league'=>array('0'=>'description_train_image','1'=>'description_generalize_image'),
            'quote'=>array('0'=>'quote_image'),
        );
        return array_key_exists($key, $params) ? $params[$key] : null;
    }
	
	
	    
    public static function getDataByCategory($id,$limit)
    {
        $sql = "select a.id,a.title,a.thumb,a.discription,a.category_id,a.channel_recommand from `investment` as a where a.category_id=:cid and a.channel_recommand=:channel_recommand order by mtime desc limit {$limit}";
        $model = Investment::model()->getDbConnection()->createCommand($sql)->bindValues(array(':cid'=>(int)$id,':channel_recommand'=>1))->queryAll();  
        return $model;
    }
    
    public static function getGover($cid,$offset=0,$limit=1)
    {
        $sql = "select title,unit,maney,discription,address,id,thumb,category_id,channel_recommand,index_recommand from `investment`  where category_id=:cid and  index_recommand='1'  order by id desc limit {$offset},{$limit}";
        $model = Yii::app()->db->createCommand($sql)->bindValues(array(':cid'=>(int)$cid))->queryAll();
        return $model;
    }
}