<?php

/**
 * This is the model class for table "emailsettings".
 *
 * The followings are the available columns in table 'emailsettings':
 * @property integer $id
 * @property integer $user_id
 * @property integer $daily_news_jobs
 * @property integer $applied_jobs
 * @property integer $recruiter_action
 * @property integer $promotional
 * @property integer $follow_up
 * @property integer $hide_profile
 * @property string $created_on
 * @property string $updated_on
 */
class Emailsettings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'emailsettings';
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
			array('user_id, daily_news_jobs, applied_jobs, recruiter_action, promotional, follow_up, hide_profile', 'numerical', 'integerOnly'=>true),
			array('created_on, updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, daily_news_jobs, applied_jobs, recruiter_action, promotional, follow_up, hide_profile, created_on, updated_on', 'safe', 'on'=>'search'),
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
			'daily_news_jobs' => 'Daily News Jobs',
			'applied_jobs' => 'Applied Jobs',
			'recruiter_action' => 'Recruiter Action',
			'promotional' => 'Promotional',
			'follow_up' => 'Follow Up',
			'hide_profile' => 'Hide Profile',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
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
		$criteria->compare('daily_news_jobs',$this->daily_news_jobs);
		$criteria->compare('applied_jobs',$this->applied_jobs);
		$criteria->compare('recruiter_action',$this->recruiter_action);
		$criteria->compare('promotional',$this->promotional);
		$criteria->compare('follow_up',$this->follow_up);
		$criteria->compare('hide_profile',$this->hide_profile);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Emailsettings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
