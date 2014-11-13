<?php

/**
 * This is the model class for table "public_order".
 *
 * The followings are the available columns in table 'public_order':
 * @property string $id
 * @property string $user_id
 * @property string $order_id
 * @property string $app_id
 * @property string $res_id
 * @property string $money
 * @property string $total_fee
 * @property integer $trade_status
 * @property string $ctime
 * @property string $mtime
 */
class PublicOrder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return PublicOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'public_order';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, order_id, app_id, res_id, money, total_fee, ctime, mtime', 'required'),
			array('trade_status', 'numerical', 'integerOnly'=>true),
			array('user_id, app_id, address, res_id, ctime, mtime', 'length', 'max'=>11),
			array('order_id', 'length', 'max'=>16),
			array('money, total_fee', 'length', 'max'=>10),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, user_id, order_id, address, app_id, res_id, money, total_fee, trade_status, ctime, mtime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
            'dreamPledge'=>array(self::BELONGS_TO,'DreamPledges','res_id'),
            //'userCount'=>array(self::STAT,'PublicOrder','id','condition'=>'user_id = '.Yii::app()->user->id),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => '用户',
			'order_id' => '订单号',
			'app_id' => '应用ID',
			'res_id' => '资源ID',
			'money' => '金额',
			'total_fee' => '已支付金额',
			'trade_status' => '订单状态',
			'ctime' => '下单时间',
            'address'=>'收货地址ID',
			'mtime' => 'Mtime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($app_id=0)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;
        $criteria->condition = 'app_id=:aid';
        $criteria->params = array(':aid'=>$app_id);
		$criteria->compare('id',$this->id,true);
		$criteria->compare('user_id',$this->user_id,true);
		$criteria->compare('order_id',$this->order_id,true);
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('res_id',$this->res_id,true);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('total_fee',$this->total_fee,true);
		$criteria->compare('trade_status',$this->trade_status);
        $criteria->compare('address',$this->address);
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
    
    
     public static function getStatus($key)
    {
        $params = array(
          '0'=>'等待支付',
          '1'=>'支付成功',
        );
        return array_key_exists($key, $params) ? $params[$key] : null;
    }
	
	public static function updateOrder($order_id, $order_fee, $trade_status)
    {
        $session = new CHttpSession();
        $session->open();
        $json = $session->get('payment_pay');
        if(empty($json))Helper::showMsg ('系统消息', '订单已失效,请重新提交!');
        $order = PublicOrder::model()->find('LOWER(order_id)=?',array($order_id));
        $pledge = DreamPledges::model()->with('dream')->findByPk($order->res_id);
        PublicCount::setCount(BaseApp::DREAMPLEDGBES,$order->res_id);
        DreamCount::setCount($pledge->dream->id,$pledge->money);
        $address = new PublicOrderAddress();
        $address->address_id = $order->address;
        $address->order_id = $order_id;
        $address->user_id = $order->user_id;
        $address->ctime = $address->mtime = time();
        $address->save();
        $session->remove('payment_pay');
        $order->total_fee = $order_fee;
        $order->trade_status = $trade_status;
        return $order->save();
        //return self::model()->update(array('order_id'=>$order_id,'total_fee'=>$order_fee,'trade_status'=>$trade_status));
    }
}