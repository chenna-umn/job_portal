<?php

/**
 * This is the model class for table "recruiterprofile".
 *
 * The followings are the available columns in table 'recruiterprofile':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property integer $mobile
 * @property string $email
 * @property string $organization
 * @property string $designation
 * @property integer $type
 * @property string $about
 * @property string $facebook
 * @property string $twitter
 * @property string $linkedin
 * @property string $profile_pic
 * @property string $company_logo
 * @property integer $notification_settings
 * @property integer $subscription
 * @property integer $status
 */
class Recruiterprofile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'recruiterprofile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name, mobile, email, organization, designation, type', 'required'),
			array('user_id, type, notification_settings, subscription, status', 'numerical', 'integerOnly'=>true),
			array('name, email, organization, designation', 'length', 'max'=>250),
			array('facebook, twitter, linkedin', 'length', 'max'=>500),
			array('about, profile_pic, company_logo', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, name, mobile, email, organization, designation, type, about, facebook, twitter, linkedin, profile_pic, company_logo, notification_settings, subscription, status', 'safe', 'on'=>'search'),
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
			'mobile' => 'Mobile',
			'email' => 'Email',
			'organization' => 'Organization',
			'designation' => 'Designation',
			'type' => 'Type',
			'about' => 'About',
			'facebook' => 'Facebook',
			'twitter' => 'Twitter',
			'linkedin' => 'Linkedin',
			'profile_pic' => 'Profile Pic',
			'company_logo' => 'Company Logo',
			'notification_settings' => 'Notification Settings',
			'subscription' => 'Subscription',
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
		$criteria->compare('mobile',$this->mobile);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('organization',$this->organization,true);
		$criteria->compare('designation',$this->designation,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('about',$this->about,true);
		$criteria->compare('facebook',$this->facebook,true);
		$criteria->compare('twitter',$this->twitter,true);
		$criteria->compare('linkedin',$this->linkedin,true);
		$criteria->compare('profile_pic',$this->profile_pic,true);
		$criteria->compare('company_logo',$this->company_logo,true);
		$criteria->compare('notification_settings',$this->notification_settings);
		$criteria->compare('subscription',$this->subscription);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Recruiterprofile the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getRecruiterTypeByUserId($userId){
                $recArray = Yii::app()->db->createCommand()                    
                        ->select('type')
                        ->from('recruiterprofile')
                        ->where('user_id=:user_id',array(':user_id'=>$userId))
                        ->queryRow();
              if(isset($recArray) && !empty($recArray)){
                  return $recArray['type'];
              }
        }
}
