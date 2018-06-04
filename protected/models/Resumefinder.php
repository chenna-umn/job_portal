<?php

/**
 * This is the model class for table "resumefinder".
 *
 * The followings are the available columns in table 'resumefinder':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $locations
 * @property string $category
 * @property string $skills
 * @property integer $salmin
 * @property integer $salmax
 * @property integer $expmin
 * @property integer $expmax
 * @property string $created_on
 * @property string $updated_on
 * @property integer $status
 */
class Resumefinder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'resumefinder';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id', 'required'),
			array('user_id, salmin, salmax, expmin, expmax, status', 'numerical', 'integerOnly'=>true),
			array('name, locations, category, skills, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, name, locations, category, skills, salmin, salmax, expmin, expmax, created_on, updated_on, status', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'name' => 'Name',
			'locations' => 'Locations',
			'category' => 'Category',
			'skills' => 'Skills',
			'salmin' => 'Salmin',
			'salmax' => 'Salmax',
			'expmin' => 'Expmin',
			'expmax' => 'Expmax',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'status' => 'Status',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('locations',$this->locations,true);
		$criteria->compare('category',$this->category,true);
		$criteria->compare('skills',$this->skills,true);
		$criteria->compare('salmin',$this->salmin);
		$criteria->compare('salmax',$this->salmax);
		$criteria->compare('expmin',$this->expmin);
		$criteria->compare('expmax',$this->expmax);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Resumefinder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
