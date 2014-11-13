<?php


class ShopContent extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function tableName()
	{
		return 'shop_content';
	}

	
	public function rules()
	{
		
		return array(
			array('content', 'required'),
			array('shop_id, pages', 'numerical', 'integerOnly'=>true),
			array('id, shop_id, content', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{	
		return array(
            'shop'=>array(self::BELONGS_TO,'Shop','id'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'shop_id' => 'Shop',
			'content' => '文章内容',
		);
	}

	
	public function search()
	{
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('shop_id',$this->shop_id);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function behaviors(){
        return array(
            'CSafeContentBehavor' => array(
                'class' => 'ext.behaviors.CSafeContentBehavior',
                'attributes' => array('content'),
            ),
        );
    }   
    
    public function beforeSave()
    {
        $arr = explode('#pages#',$this->content);
        $this->pages = count($arr)-1;
        return parent::beforeSave();
    }
    
}