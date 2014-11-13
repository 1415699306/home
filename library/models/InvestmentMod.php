<?php

/**
 * This is the model class for table "investment_mod".
 *
 * The followings are the available columns in table 'investment_mod':
 * @property string $id
 * @property string $investment_id
 * @property string $mod
 */
class InvestmentMod extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return InvestmentMod the static model class
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
		return 'investment_mod';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('investment_id, mod', 'required'),
			array('investment_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, investment_id, mod', 'safe', 'on'=>'search'),
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
            'investment'=>array(self::BELONGS_TO,'Investment','investment_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'investment_id' => 'Investment',
			'mod' => 'Mod',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('investment_id',$this->investment_id,true);
		$criteria->compare('mod',$this->mod,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    /**
     * 读取模板路径
     * 
     * @param type $id
     * @param type $tempatle
     * @return string
     */
    public static function getTemplate($id,$tempatle)
    {
        return THEME_PATH.DIRECTORY_SEPARATOR.'investment'.DIRECTORY_SEPARATOR.'views'.DIRECTORY_SEPARATOR.'default'.DIRECTORY_SEPARATOR.$tempatle.DIRECTORY_SEPARATOR.$tempatle.'_'.$id;       
    }
    
    /**
     * 获取项目图片路径
     * 
     * @param string $name
     */
    public static function getImage($name,$thumb=true,$ext=null)
    {
        $arr = array();
        $ext = !empty($ext) ? DIRECTORY_SEPARATOR.$ext.DIRECTORY_SEPARATOR : DIRECTORY_SEPARATOR;
        preg_match('/(.*?)\.(\w+)$/iU',$name,$arr);
        $path = RESOURCE_URL.DIRECTORY_SEPARATOR.'investment'.$ext;
        if($thumb == true && 2 < count($arr))
           return $path.$arr[1].'.'.$arr[2];
        else
           return $path.$name;
    }
    
    /**
     * 前端页面排序索引
     * @return array
     */
    public static function getModIndex()
    {
        return  array(
            '0'=>'company',
            '1'=>'advantage',
            '2'=>'description',
            '3'=>'introduction',
            '4'=>'league',
            '5'=>'quote',
        );      
    }
    
    public static function getModName($key)
    {
        $params = array(
            'company'=>'园区介绍',
            'advantage'=>'项目优势',
            'description'=>'园区现状',
            'introduction'=>'项目支持',
            'league'=>'合作介绍',
            'quote'=>'项目问答',
        );
        return array_key_exists($key, $params) ? $params[$key] : 'null';
    }
}