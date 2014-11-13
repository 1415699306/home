<?php

/**
 * This is the model class for table "tags_relations".
 *
 * The followings are the available columns in table 'tags_relations':
 * @property string $id
 * @property string $tag_id
 * @property string $res_id
 * @property integer $app_id
 */
class TagsRelations extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return TagsRelations the static model class
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
		return 'tags_relations';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tag_id, res_id, app_id', 'required'),
			array('app_id', 'numerical', 'integerOnly'=>true),
			array('tag_id, res_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, tag_id, res_id, app_id', 'safe', 'on'=>'search'),
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
            'tags'=>array(self::BELONGS_TO,'Tags','tag_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'tag_id' => 'Tag',
			'res_id' => 'Res',
			'app_id' => 'App',
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
		$criteria->compare('tag_id',$this->tag_id,true);
		$criteria->compare('res_id',$this->res_id,true);
		$criteria->compare('app_id',$this->app_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}