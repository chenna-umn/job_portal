<?php

/**
 * This is the model class for table "memberpersonal".
 *
 * The followings are the available columns in table 'memberpersonal':
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $mobile
 * @property string $dob
 * @property integer $current_location
 * @property string $preferred_location
 * @property integer $industry
 * @property integer $functional_area
 * @property string $gender
 * @property integer $notice_period
 * @property integer $expyear
 * @property integer $expmonth
 * @property double $current_salary
 * @property integer $current_salary_confidential
 * @property integer $expected_salary_negotiable
 * @property string $created_on
 * @property string $updated_on
 * @property integer $status
 * @property double $expected_salary
 */
class Memberpersonal extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'memberpersonal';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, name, mobile, dob, gender, created_on', 'required'),
			array('user_id, current_location, industry, functional_area, notice_period, expyear, expmonth, current_salary_confidential, expected_salary_negotiable, status', 'numerical', 'integerOnly'=>true),
			array('current_salary, expected_salary', 'numerical'),
			array('mobile', 'length', 'max'=>15),
			array('gender', 'length', 'max'=>10),
			array('preferred_location, updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, name, mobile, dob, current_location, preferred_location, industry, functional_area, gender, notice_period, expyear, expmonth, current_salary, current_salary_confidential, expected_salary_negotiable, created_on, updated_on, status, expected_salary', 'safe', 'on'=>'search'),
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
			'dob' => 'Dob',
			'current_location' => 'Current Location',
			'preferred_location' => 'Preferred Location',
			'industry' => 'Industry',
			'functional_area' => 'Functional Area',
			'gender' => 'Gender',
			'notice_period' => 'Notice Period',
			'expyear' => 'Expyear',
			'expmonth' => 'Expmonth',
			'current_salary' => 'Current Salary',
			'current_salary_confidential' => 'Current Salary Confidential',
			'expected_salary_negotiable' => 'Expected Salary Negotiable',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'status' => 'Status',
			'expected_salary' => 'Expected Salary',
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
		$criteria->compare('mobile',$this->mobile,true);
		$criteria->compare('dob',$this->dob,true);
		$criteria->compare('current_location',$this->current_location);
		$criteria->compare('preferred_location',$this->preferred_location,true);
		$criteria->compare('industry',$this->industry);
		$criteria->compare('functional_area',$this->functional_area);
		$criteria->compare('gender',$this->gender,true);
		$criteria->compare('notice_period',$this->notice_period);
		$criteria->compare('expyear',$this->expyear);
		$criteria->compare('expmonth',$this->expmonth);
		$criteria->compare('current_salary',$this->current_salary);
		$criteria->compare('current_salary_confidential',$this->current_salary_confidential);
		$criteria->compare('expected_salary_negotiable',$this->expected_salary_negotiable);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('expected_salary',$this->expected_salary);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Memberpersonal the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
         public function getJobSeekerNameByUserId($userId){            
            $model = Yii::app()->db->createCommand()
                        ->select('name')
                        ->from('memberpersonal')                       
                        ->where('user_id=:user_id',array('user_id'=>$userId))                        
                        ->queryRow();
            if(isset($model) && !empty($model)){
                return $model['name'];
            }else{
                return '';
            }
        }
        
        public function getJobSeekerExpById($userId){
            $model = Yii::app()->db->createCommand()
                        ->select('expyear')
                        ->from('memberpersonal')                       
                        ->where('user_id=:user_id',array('user_id'=>$userId))                        
                        ->queryRow();
            if(isset($model) && !empty($model)){
                return $model['expyear'];
            }else{
                return 0;
            }
        }
}
