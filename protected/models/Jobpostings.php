<?php

/**
 * This is the model class for table "jobpostings".
 *
 * The followings are the available columns in table 'jobpostings':
 * @property integer $id
 * @property integer $user_id
 * @property string $jobtitle
 * @property integer $views
 * @property string $locations
 * @property integer $cat_id
 * @property integer $subcat_id
 * @property integer $skill_id
 * @property string $salmin
 * @property string $salmax
 * @property integer $expmin
 * @property integer $expmax
 * @property string $description
 * @property integer $female
 * @property integer $physical
 * @property integer $defence
 * @property integer $work_from_home
 * @property integer $women_workforce
 * @property string $created_on
 * @property string $updated_on
 * @property integer $admin_approval_status
 * @property integer $apply_less_qualification
 * @property integer $status
 * @property string $keyword1
 * @property string $keyword2
 * @property string $keyword3
 * @property string $keyword4
 * @property string $keyword5
 * @property string $keyword6
 * @property string $keyword7
 * @property string $keyword8
 * @property string $keyword9
 * @property string $keyword10
 */
class Jobpostings extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'jobpostings';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, jobtitle, female, created_on', 'required'),
			array('user_id, views, cat_id, subcat_id, skill_id, expmin, expmax, female, physical, defence, work_from_home, women_workforce, admin_approval_status, apply_less_qualification, status', 'numerical', 'integerOnly'=>true),
			array('salmin, salmax', 'length', 'max'=>50),
			array('locations, description, updated_on, keyword1, keyword2, keyword3, keyword4, keyword5, keyword6, keyword7, keyword8, keyword9, keyword10', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, jobtitle, views, locations, cat_id, subcat_id, skill_id, salmin, salmax, expmin, expmax, description, female, physical, defence, work_from_home, women_workforce, created_on, updated_on, admin_approval_status, apply_less_qualification, status, keyword1, keyword2, keyword3, keyword4, keyword5, keyword6, keyword7, keyword8, keyword9, keyword10', 'safe', 'on'=>'search'),
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
			'jobtitle' => 'Jobtitle',
			'views' => 'Views',
			'locations' => 'Locations',
			'cat_id' => 'Cat',
			'subcat_id' => 'Subcat',
			'skill_id' => 'Skill',
			'salmin' => 'Salmin',
			'salmax' => 'Salmax',
			'expmin' => 'Expmin',
			'expmax' => 'Expmax',
			'description' => 'Description',
			'female' => 'Female',
			'physical' => 'Physical',
			'defence' => 'Defence',
			'work_from_home' => 'Work From Home',
			'women_workforce' => 'Women Workforce',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'admin_approval_status' => 'Admin Approval Status',
			'apply_less_qualification' => 'Apply Less Qualification',
			'status' => 'Status',
			'keyword1' => 'Keyword1',
			'keyword2' => 'Keyword2',
			'keyword3' => 'Keyword3',
			'keyword4' => 'Keyword4',
			'keyword5' => 'Keyword5',
			'keyword6' => 'Keyword6',
			'keyword7' => 'Keyword7',
			'keyword8' => 'Keyword8',
			'keyword9' => 'Keyword9',
			'keyword10' => 'Keyword10',
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
		$criteria->compare('jobtitle',$this->jobtitle,true);
		$criteria->compare('views',$this->views);
		$criteria->compare('locations',$this->locations,true);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('subcat_id',$this->subcat_id);
		$criteria->compare('skill_id',$this->skill_id);
		$criteria->compare('salmin',$this->salmin,true);
		$criteria->compare('salmax',$this->salmax,true);
		$criteria->compare('expmin',$this->expmin);
		$criteria->compare('expmax',$this->expmax);
		$criteria->compare('description',$this->description,true);
		$criteria->compare('female',$this->female);
		$criteria->compare('physical',$this->physical);
		$criteria->compare('defence',$this->defence);
		$criteria->compare('work_from_home',$this->work_from_home);
		$criteria->compare('women_workforce',$this->women_workforce);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('admin_approval_status',$this->admin_approval_status);
		$criteria->compare('apply_less_qualification',$this->apply_less_qualification);
		$criteria->compare('status',$this->status);
		$criteria->compare('keyword1',$this->keyword1,true);
		$criteria->compare('keyword2',$this->keyword2,true);
		$criteria->compare('keyword3',$this->keyword3,true);
		$criteria->compare('keyword4',$this->keyword4,true);
		$criteria->compare('keyword5',$this->keyword5,true);
		$criteria->compare('keyword6',$this->keyword6,true);
		$criteria->compare('keyword7',$this->keyword7,true);
		$criteria->compare('keyword8',$this->keyword8,true);
		$criteria->compare('keyword9',$this->keyword9,true);
		$criteria->compare('keyword10',$this->keyword10,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Jobpostings the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getCountOfJob($jobId){
            $appJobs = Applyjob::model()->findAll('job_id=:job_id',array(':job_id'=>$jobId));
            return count($appJobs);
        }
        
        public function  recordCount($status)
	{
            if($status=='all'){
                $model = Jobpostings::model()->findAll();
            }else if($status=='active'){
                 $model = Jobpostings::model()->findAll('status=:status',array(':status'=>1));
            }else if($status=='inactive'){
                 $model = Jobpostings::model()->findAll('status=:status',array(':status'=>0));
            }else{
                $model = new Jobpostings();
            }		
                return count($model);
	}
        public function getJobPostingsCountByAdminApproveStatus($status){
            $jobPostings = Jobpostings::model()->findAll('admin_approval_status=:admin_approval_status',array(':admin_approval_status'=>$status));
            return count($jobPostings);
         }
         public function getAdminApprocalStatusByUserId($id){
            $jobPostings  = Jobpostings::model()->findByPk($id);
            if(isset($jobPostings) && !empty($jobPostings)){
                return $jobPostings->admin_approval_status;
            }
        }
}
