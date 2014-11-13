<?php

class Advisory extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'advisory';
	}

	public function rules()
	{
		return array(
			array('app_id, res_id, name, phone, content', 'required'),
			array('ctime, mtime', 'numerical', 'integerOnly'=>true),
			array('app_id, res_id, phone, return_time', 'length', 'max'=>11),
			array('name', 'length', 'max'=>32),
            array('tel', 'length','min'=>'11', 'max'=>16,'message'=>'电话号码最小12位,最长16位'),
			array('address, email', 'length', 'max'=>128),
            array('email','email'),
			array('content', 'length', 'max'=>1024),
            array('tel','MPhoneValidator','message'=>'请正确填写电话号码'),
            array('phone','MPhoneValidator','message'=>'请正确填写电话号码'),
            array('qq','MqqValidator','message'=>'号码位数太短啦,必须最小5位数QQ号码!'),
			array('id, app_id, res_id, name, phone, tel, address, qq, email, return_time, content, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		
		return array(
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'app_id' => 'App',
			'res_id' => 'Res',
			'name' => '姓名',
			'phone' => '手机',
			'tel' => '座机',
			'address' => '地址',
			'qq' => 'QQ',
			'email' => '邮箱',
			'return_time' => '回访',
			'content' => '留言',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
		);
	}

	
	public function search($appid)
	{
		
		$criteria=new CDbCriteria;
        $criteria->condition = 'app_id =:aid';
        $criteria->params = array(':aid'=>$appid);
		$criteria->compare('id',$this->id,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('res_id',$this->res_id,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('tel',$this->tel);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('return_time',$this->return_time,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('mtime',$this->mtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave() 
    {
        $time = time();
        if($this->isNewRecord)
        {
            $this->return_time = strtotime($this->return_time,$time);
            $this->ctime = $time;
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
}