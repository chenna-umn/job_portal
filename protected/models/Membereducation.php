<?php

/**
 * This is the model class for table "membereducation".
 *
 * The followings are the available columns in table 'membereducation':
 * @property integer $id
 * @property integer $user_id
 * @property string $institute
 * @property integer $batchfrom
 * @property integer $batchto
 * @property integer $coursetype
 * @property integer $degree_id
 * @property string $created_on
 * @property string $updated_on
 * @property integer $status
 */
class Membereducation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'membereducation';
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
			array('user_id, batchfrom, batchto, coursetype, degree_id, status', 'numerical', 'integerOnly'=>true),
			array('institute, created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, institute, batchfrom, batchto, coursetype, degree_id, created_on, updated_on, status', 'safe', 'on'=>'search'),
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
			'institute' => 'Institute',
			'batchfrom' => 'Batchfrom',
			'batchto' => 'Batchto',
			'coursetype' => 'Coursetype',
			'degree_id' => 'Degree',
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
		$criteria->compare('institute',$this->institute,true);
		$criteria->compare('batchfrom',$this->batchfrom);
		$criteria->compare('batchto',$this->batchto);
		$criteria->compare('coursetype',$this->coursetype);
		$criteria->compare('degree_id',$this->degree_id);
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
	 * @return Membereducation the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
