<?php

/**
 * This is the model class for table "eminent_relation".
 *
 * The followings are the available columns in table 'eminent_relation':
 * @property string $id
 * @property string $app_id
 * @property string $res_id
 * @property string $eminent_id
 */
class EminentRelation extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return EminentRelation the static model class
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
		return 'eminent_relation';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('app_id, res_id, eminent_id', 'required'),
			array('app_id, res_id, eminent_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, app_id, res_id, eminent_id', 'safe', 'on'=>'search'),
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
            'eminentPerson'=>array(self::BELONGS_TO,'EminentPerson','eminent_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'app_id' => 'App',
			'res_id' => 'Res',
			'eminent_id' => 'Eminent',
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
		$criteria->compare('app_id',$this->app_id,true);
		$criteria->compare('res_id',$this->res_id,true);
		$criteria->compare('eminent_id',$this->eminent_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public static function setCheckBox($id,$app_id,$res_id)
    {
        return EminentRelation::model()->countByAttributes(array('eminent_id'=>$id,'app_id'=>$app_id,'res_id'=>$res_id));
    }
    
    /**
     * 保存名人关系表
     * 
     * @param type $params
     * @param type $app_id
     * @param type $res_id
     */
    public static function saveByEminent($params,$app_id,$res_id)
    {
        $i = 0;
        $return = array();
        foreach ($params as $key)
        {
            $keys = array_keys($params);
            $EminentRelation = new EminentRelation();
            $EminentRelation->app_id = $app_id;
            $EminentRelation->res_id = $res_id;
            $EminentRelation->eminent_id = $keys[$i];
            $EminentRelation->save();
            ++$i;
        }
    }
    
    /**
     * 更新名人关系表
     * 
     * @param type $params
     * @param type $app_id
     * @param type $res_id
     * @return type
     */
    public static function updateByEminent($params,$app_id,$res_id)
    {
        EminentRelation::model()->deleteAllByAttributes(array('app_id'=>$app_id,'res_id'=>$res_id));
        return self::saveByEminent($params, $app_id, $res_id);
    }
}