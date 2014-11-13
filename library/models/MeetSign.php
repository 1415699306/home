<?php

class MeetSign extends CActiveRecord
{
    public $verifyCode;
    private $strong_pattern = '/^\d*$/';
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'meet_sign';
	}

	
	public function rules()
	{
		
		return array(
			array('meet_id, user_name, address, company, job, number, email, verifyCode', 'required'),
			array('meet_id, number, ctime, mtime', 'length', 'max'=>11),
			array('user_name, job', 'length', 'max'=>32),
			array('phone, tel', 'length', 'max'=>15),
            array('phone,tel','MPhoneValidator','message'=>'电话号码不正确!'),
			array('address, company, email', 'length', 'max'=>128),
            array('phone, tel','checkPhone'),
            array('email','email'),
            array('user_name','checkName'),
            array('verifyCode', 'captcha','allowEmpty'=>!CCaptcha::checkRequirements()),
		
			array('id, meet_id, user_name, phone, tel, address, company, job, number, email, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		
		return array(
            'meet'=>array(self::BELONGS_TO,'Meet','meet_id'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'meet_id' => 'Meet',
			'user_name' => '姓名',
			'phone' => '手机',
			'tel' => '联系电话',
			'address' => '联系地址',
			'company' => '公司名称',
			'job' => '职务',
			'number' => '参与人数',
			'email' => '电子邮箱',
            'verifyCode'=>'验证码',
			'ctime' => '报名时间',
			'mtime' => 'Mtime',
            'meet'=>'主题',
		);
	}

	
	public function search()
	{
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('meet_id',$this->meet_id,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('job',$this->job,true);
		$criteria->compare('number',$this->number,true);
		$criteria->compare('email',$this->email,true);
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
            $this->ctime = $time;
        }
        $this->mtime = $time;
        return parent::beforeSave();
    }
    
    public function checkName($username)
    {
        if(preg_match($this->strong_pattern,$this->user_name))
            $this->addError ($username, '用户名不能纯数字,请更正!');
    }
    
    public function checkPhone()
    {
        $message = '电话号码和手机号码不能同时为空,请填写!';
        if(empty($this->tel) && empty($this->phone))
        {
            $this->addError('tel', $message);
            $this->addError('phone', $message);
        }
    }
}