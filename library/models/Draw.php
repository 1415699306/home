<?php
class Draw extends CActiveRecord
{
    private $max_pattern = '/^[1-9]{1}[0-9]{14,19}$/';
    private $strong_pattern = '/(1[3-8])[123569]{1}\d{8}|15[1235689]\d{8}|188\d{8}/';
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'draw';
	}

	public function rules()
	{
		
		return array(
			array('card,title,money,phone,remark', 'required'),
            array('id,card,status,banktype,title,total,money,phone,remark,ctime,mtime', 'safe'),
			array('user_id, ctime, mtime,money', 'length', 'max'=>11),
			array('title', 'length', 'max'=>80),
            array('money', 'length', 'max'=>11),
            array('phone,card', 'length', 'max'=>128),
            array('phone','checkPhoneNumber'),
            array('card','checkCard'),
            array('phone','MPhoneValidator','message'=>'请正确填写电话号码'),
			array('id,card,banktype,status,title,money,total,phone,remark,ctime,mtime', 'safe', 'on'=>'search'),
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
			'user_id' => '用户',
			'title' => '真实姓名',
            'banktype'=>'选择银行',
            'card' => '银行卡号',
            'money'=>'提现金额',
            'total'=>'总金额',
            'phone'=>'手机号码',
            'remark'=>'备注',
            'status' => '状态',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
		);
	}

	
	public function search()
	{

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('title',$this->title,true);
        $criteria->compare('remark',$this->remark,true);
        $criteria->compare('banktype',$this->banktype);
        $criteria->compare('status',$this->status);
        $criteria->compare('money',$this->money,true);
        $criteria->compare('phone',$this->phone,true);
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
            $this->user_id = Yii::app()->user->id;
        }
        $this->mtime = time();
        return parent::beforeSave();
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
       
    /**
     * 检查手机号码
     */
   public function checkPhoneNumber()
    {
        if(!$this->isNewRecord && Yii::app()->controller->action->id != 'flashUploadAvatar'){
            if(!preg_match($this->strong_pattern, $this->phone))
                $this->addError('phone','手机号码格式不正确!');
        }
    }
    
    public function checkCard()
    {
        if(!$this->isNewRecord && Yii::app()->controller->action->id != 'flashUploadAvatar'){
            if(!preg_match($this->max_pattern, $this->card))
                $this->addError('card','银行卡号格式不正确!');
        }
    }
    
}