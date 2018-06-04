<?php

/**
 * This is the model class for table "memberprofessional".
 *
 * The followings are the available columns in table 'memberprofessional':
 * @property integer $id
 * @property integer $user_id
 * @property integer $hasexp
 * @property string $designation
 * @property string $organization
 * @property integer $fromyear
 * @property integer $frommonth
 * @property integer $toyear
 * @property integer $tomonth
 * @property string $created_on
 * @property integer $status
 */
class Memberprofessional extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'memberprofessional';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, hasexp', 'required'),
			array('user_id, hasexp, fromyear, frommonth, toyear, tomonth, status', 'numerical', 'integerOnly'=>true),
			array('designation, organization, created_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, hasexp, designation, organization, fromyear, frommonth, toyear, tomonth, created_on, status', 'safe', 'on'=>'search'),
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
			'hasexp' => 'Hasexp',
			'designation' => 'Designation',
			'organization' => 'Organization',
			'fromyear' => 'Fromyear',
			'frommonth' => 'Frommonth',
			'toyear' => 'Toyear',
			'tomonth' => 'Tomonth',
			'created_on' => 'Created On',
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
		$criteria->compare('hasexp',$this->hasexp);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('organization',$this->organization,true);
		$criteria->compare('fromyear',$this->fromyear);
		$criteria->compare('frommonth',$this->frommonth);
		$criteria->compare('toyear',$this->toyear);
		$criteria->compare('tomonth',$this->tomonth);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Memberprofessional the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
