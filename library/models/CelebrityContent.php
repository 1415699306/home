<?php


class CelebrityContent extends CActiveRecord
{
	
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	
	public function tableName()
	{
		return 'celebrity_content';
	}

	
	public function rules()
	{
		
		return array(
			array('content', 'required'),
			array('celebrity_id, pages', 'numerical', 'integerOnly'=>true),
			array('id, celebrity_id, content', 'safe', 'on'=>'search'),
		);
	}

	
	public function relations()
	{
		
		return array(
            'celebrity'=>array(self::BELONGS_TO,'Celebrity','celebrity_id'),
		);
	}

	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'celebrity_id' => 'Celebrity',
			'content' => '文章内容',
		);
	}

	
	public function search()
	{
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('celebrity_id',$this->celebrity_id);
		$criteria->compare('content',$this->content,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    
    public function beforeSave()
    {
        $arr = explode('#pages#',$this->content);
        $this->pages = count($arr)-1;
        return parent::beforeSave();
    }
    
}