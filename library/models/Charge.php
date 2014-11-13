<?php
class Charge extends CActiveRecord
{
    
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function tableName()
	{
		return 'charge';
	}

	public function rules()
	{
		return array(
			array('money', 'required'),
            array('id,order_id,banktype,money,ctime,mtime', 'safe'),
			array('user_id,ctime, mtime,money', 'length', 'max'=>11),
            array('money', 'length', 'max'=>11),
			array('id,order_id,banktype,money,ctime,mtime', 'safe', 'on'=>'search'),
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
            'banktype'=>'选择银行',
            'money'=>'充值金额',
            'order_id'=>'订单号',
			'ctime' => '添加时间',
			'mtime' => '更新时间',
		);
	}

	
	public function search()
	{

		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
        $criteria->compare('order_id',$this->order_id);
        $criteria->compare('money',$this->money);
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
                'attributes' => array('money'),
            ),
        );
    } 
    
}