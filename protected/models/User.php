<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $membership_id
 * @property integer $user_type
 * @property string $created_on
 * @property string $updated_on
 * @property integer $status
 * @property string $activation_code
 * @property integer $admin_approval_status
 */
class User extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, membership_id, user_type, created_on', 'required'),
			array('user_type, status, admin_approval_status', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>250),
			array('password', 'length', 'max'=>64),
			array('membership_id', 'length', 'max'=>20),
			array('activation_code', 'length', 'max'=>264),
			array('updated_on', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, membership_id, user_type, created_on, updated_on, status, activation_code, admin_approval_status', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
			'membership_id' => 'Membership',
			'user_type' => 'User Type',
			'created_on' => 'Created On',
			'updated_on' => 'Updated On',
			'status' => 'Status',
			'activation_code' => 'Activation Code',
			'admin_approval_status' => 'Admin Approval Status',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('membership_id',$this->membership_id,true);
		$criteria->compare('user_type',$this->user_type);
		$criteria->compare('created_on',$this->created_on,true);
		$criteria->compare('updated_on',$this->updated_on,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('activation_code',$this->activation_code,true);
		$criteria->compare('admin_approval_status',$this->admin_approval_status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function  recordCount($status)
	{
            if($status=='all'){
                $model = User::model()->findAll();
            }else if($status=='active'){
                 $model = User::model()->findAll('status=:status',array(':status'=>1));
            }else if($status=='inactive'){
                 $model = User::model()->findAll('status=:status',array(':status'=>0));
            }else{
                $model = new User();
            }		
                return count($model);
	}
        public function getTotalUserCount(){
            $userArray = User::model()->findAll();
            return count($userArray);
        }
         public function getUserCountByAdminApproveStatus($status){
            $userArray = User::model()->findAll('admin_approval_status=:admin_approval_status',array(':admin_approval_status'=>$status));
            return count($userArray);
         }
        public function getUserCountByStatus($status){
            $userArray = User::model()->findAll('status=:status',array(':status'=>$status));
            return count($userArray);
        }
        public function getTotalUserCountByType($type){
            $userArray = User::model()->findAll('user_type=:user_type',array('user_type'=>$type));
            return count($userArray);
        }
        public function getUserCountByStatusAndType($type,$status){
            $userArray = array();
            if($type==4){
                $userArray = User::model()->findAll('status=:status AND user_type=:user_type',array(':status'=>$status,':user_type'=>$type));
            }else if($type==3 || $type==2){
                $userArray = Recruiterprofile::model()->findAll('status=:status AND type=:type',array(':status'=>$status,':type'=>$type));
            }
            return count($userArray);            
        }
        
        public function getUserCountByAdminApproveStatusAndType($type,$status){
            $userArray = array();
            if($type==4){
                $userArray = User::model()->findAll('admin_approval_status=:admin_approval_status AND user_type=:user_type',array(':admin_approval_status'=>$status,':user_type'=>$type));
            }else if($type==3 || $type==2){
                $userArray = Yii::app()->db->createCommand()                    
                            ->select('u.id,rp.id')
                            ->from('user u')    
                            ->leftJoin('recruiterprofile rp', 'rp.user_id=u.id')                            
                            ->where('rp.type=:type AND u.admin_approval_status=:admin_approval_status',array(':type'=>$type,'admin_approval_status'=>$status))
                            ->queryAll();
            }
            return count($userArray);            
        }
        
        public function getMemberDetailsByUserId($userId){
            $userDetails =Yii::app()->db->createCommand()                    
                            ->select('u.*,me.*,mp.*,mpr.*,mu.*')
                            ->from('user u')    
                            ->leftJoin('membereducation me', 'me.user_id=u.id')
                            ->leftJoin('memberpersonal mp', 'mp.user_id=u.id')
                            ->leftJoin('memberprofessional mpr', 'mpr.user_id=u.id')
                            ->leftJoin('memberuploads mu', 'mu.user_id=u.id')
                            ->where('u.id=:userId',array(':userId'=>$userId))
                            ->queryRow();
            
            return $userDetails;
            
        }
        
        
        public function getAdminApprocalStatusByUserId($id){
            $user  = User::model()->findByPk($id);
            if(isset($user) && !empty($user)){
                return $user->admin_approval_status;
            }
        }
        
        
        public function seoFriendlyUrl($string){
            if(isset($string) && !empty($string)){
            $string = str_replace(' ', '-', $string);
            $string = str_replace(array('[\', \']'), '', $string);
            $string = preg_replace('/\[.*\]/U', '', $string);
            $string = preg_replace('/&(amp;)?#?[a-z0-9]+;/i', '-', $string);
            $string = htmlentities($string, ENT_COMPAT, 'utf-8');
            $string = preg_replace('/&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);/i', '\\1', $string );
            $string = preg_replace(array('/[^a-z0-9]/i', '/[-]+/') , '-', $string);
            return strtolower(trim($string, '-'));
            }else{
                return strtolower(trim('jobportal', '-'));
            }
        }
}
