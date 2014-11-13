<?php


class Announcement extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'announcement';
	}

	
	public function rules()
	{
		return array(
			array('title, type,content, status, expiration_time', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('user_id, count, expiration_time, ctime, mtime', 'length', 'max'=>11),
            array('type', 'length', 'max'=>1),
			array('title', 'length', 'max'=>80),
			array('url', 'length', 'max'=>1024),
            array('url','url'),
            array('content','safe'),	
			array('id, user_id, type, title, content, url, status, expiration_time, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
            'user'=>array(self::BELONGS_TO,'User','user_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
            'id' => 'ID',
			'user_id' => 'User',
            'count'=>'查看',
			'title' => '公告标题',
            'type' => '公告类型',
			'content' => '内容',
			'url' => '连接地址',
			'status' => '公告状态',
            'expiration_time' => '过期时间',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
		);
	}

	public function search()
	{	
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('url',$this->url,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('expiration_time',$this->expiration_time,true);
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
            $this->user_id = Yii::app()->user->id;
            $this->ctime = $time;
        }
        if(!empty($this->expiration_time)){
            $this->expiration_time = strtotime($this->expiration_time,time());
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    public function behaviors()
    {
        return array(
            'CSafeContentBehavor' => array(
                'class' => 'ext.behaviors.CSafeContentBehavior',
                'attributes' => array('title','content'),
            ),
        );
    }
    
    public function afterDelete() 
    {
        ResourcesHelper::deleteContentImg($this->content);
        return parent::afterDelete();
    }
    
    
    /**
     * 取出前端公告
     */
    public static function getList($type)
    {
         $sql = "select id,title,url,expiration_time from `announcement` where type=:type  order by id desc limit 4";
         $model = Yii::app()->db->createCommand($sql)->bindValue(':type', (int)$type)->queryAll();
         return $model;
    }
    
    /**
     * 取出过期前端公告
     */
     public static function getExpire($type)
    {
         $sql = "select id,title,url,expiration_time from `announcement` where type=:type and expiration_time<:time order by id desc limit 4 ";
         $model = Yii::app()->db->createCommand($sql)->bindValues(array(':type'=>(int)$type,':time'=>time()))->queryAll();
         return $model;
    }
    
}