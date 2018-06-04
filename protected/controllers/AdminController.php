<?php

class AdminController extends Controller
{
	public $layout='admin';
        public $defaultAction = 'index'; 
         
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}
        /**
         * This is the default 'index' action that is invoked
         * when an action is not explicitly requested by users.
         */
        public function actionIndex() {  
          
            ini_set('max_execution_time', 300);
                $this->layout = '//layouts/admin';
                 Yii::app()->user->setState("adminmenu","index");
                if(Yii::app()->user->isAdmin){
                    $this->render('index');
                }else{
                    $this->redirect(array('site/index'));
                }
            }
            
            /**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		if (!defined('CRYPT_BLOWFISH')||!CRYPT_BLOWFISH)
			throw new CHttpException(500,"This application requires that PHP was compiled with Blowfish support for crypt().");

		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
                        Yii::app()->user->setState('type',$_POST['LoginForm']['user_type']);
			// validate user input and redirect to the previous page if valid
			if($model->login())   {       
                            if(Yii::app()->user->userType==1){
                                 $this->redirect(array('admin/index'));
                            }else if(Yii::app()->user->userType==2){
                                 $this->redirect(array('Recruiter/dashboard'));
                            }else if(Yii::app()->user->userType==4){
                                 $this->redirect(array('Member/create1','id'=>Yii::app()->user->memberId));
                            }
                           
                        }else{
                              Yii::app()->user->setFlash('error', "Please Provide valid Username / Password...!");
                        }
                       
		}
		// display the login form
                 $this->layout = '//layouts/register';
                   
		$this->render('login',array('model'=>$model));
	}
            /**
             * This is the action to handle external exceptions.
             */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}
       
        /**
             * This is the action to list the all the categories.
             */
        
        public function actionCategories()
        {
             Yii::app()->user->setState("adminmenu","categories");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();     
                $criteria->order = 'updated_on DESC';
                $count=Category::model()->count($criteria);
                $pages=new CPagination($count);

                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=Category::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                $count = Category::model()->count($criteria);
                $this->render('categories', array(
                'models' => $models,
                     'pages' => $pages,'count'=>$count
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        
        public function actionusersList()
        {
             Yii::app()->user->setState("adminmenu","user");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();     
                $criteria->order = 'updated_on DESC';
                $count=  User::model()->count($criteria);
                $pages=new CPagination($count);

                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=User::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                $count = User::model()->count($criteria);
                $this->render('userslist', array(
                'models' => $models,
                     'pages' => $pages,'count'=>$count
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        
         public function actionjobPostingsList()
        {
             Yii::app()->user->setState("adminmenu","jobpostings");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();     
                $criteria->order = 'updated_on DESC';
                $count= Jobpostings::model()->count($criteria);
                $pages=new CPagination($count);

                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=Jobpostings::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                $count = Jobpostings::model()->count($criteria);
                $this->render('jobpostingslist', array(
                'models' => $models,
                     'pages' => $pages,'count'=>$count
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        
        /**
             * This is the action to create a category.
             */
        
        public function actionCreate()
        {
            //date_default_timezone_set("Asia/Calcutta");
            Yii::app()->user->setState("adminmenu","categories");
             if(Yii::app()->user->isAdmin){
                    $model = new Category();
                    if(isset($_POST['Category'])){
                        $model->attributes = $_POST['Category'];
                        $model->created_on = date('Y-m-d h:i:s');
                        $model->updated_on = date('Y-m-d h:i:s');
                        if($model->validate()){
                            if($model->save()){
                            Yii::app()->user->setFlash('success', "Caregory Added Successfully");
                                $this->redirect(array('admin/Categories'));                  
                            }
                        }else{
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding New Category...Please Try Later...!");   
                           $this->redirect(array('admin/create'));
                        }
                    }                    
                    $this->render('create');
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
                /**
             * This is the action to create Bulk categories.
             */
        
        public function actionCreateMultiple()
        {
            //date_default_timezone_set("Asia/Calcutta");
            Yii::app()->user->setState("adminmenu","categories");
             if(Yii::app()->user->isAdmin){
                    
                    if(isset($_POST['Category'])){
                        $list = array();
                        $count = 0;
                        if($_POST['separator']=='line'){
                            $list = explode("\n", trim($_POST['Category']['name']));
                        }else{
                            $list = explode(",", trim($_POST['Category']['name']));
                        }
                        foreach($list as $key=>$value){
                            if(!empty($value)){
                            $model = new Category();
                            $model->name = trim($value);
                            $model->created_on = date('Y-m-d h:i:s');
                            $model->updated_on = date('Y-m-d h:i:s');
                            $model->status= $_POST['Category']['status'];
                            if($model->validate()){
                                if($model->save()){
                                     $count++;
                                }
                               
                            }
                          }
                        }                        
                       Yii::app()->user->setFlash('success', "$count Caregories Added Successfully");
                        $this->redirect(array('admin/Categories'));
                    }else{                    
                     $this->render('createMultiple');
                    }
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }

        /**
             * This is the action to create a category.
             */
        
        public function actionUpdate($id)
        {
             Yii::app()->user->setState("adminmenu","categories");
             if(Yii::app()->user->isAdmin){
                    $model = Category::model()->findByPk($id);                 
                    if(isset($_POST['Category'])){ 
                        $model->attributes = $_POST['Category'];
                        $model->updated_on = date('Y-m-d h:i:s');
                        if($model->validate()){
                            if($model->save()){
                            Yii::app()->user->setFlash('success', "Caregory Updated Successfully");
                               $this->render('update',array('model'=>$model));                 
                            }
                        }else{
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding Updating Category...Please Try Later...!");   
                           $this->render('update',array('model'=>$model));
                        }
                    }else{
                        $this->render('update',array('model'=>$model));
                    }                    
//                    $this->render('update',array('model'=>$model));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        
        /**
             * This is the action to list the all the categories.
             */
        
        public function actionCategoriesByStatus($field,$value)
        {
            Yii::app()->user->setState("adminmenu","categories");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();     
                $criteria->order = 'updated_on DESC';
                if($value=='active' && $field='status'){
                    $criteria->condition = "$field=1";
                }else if($value=='inactive' && $field='status'){
                    $criteria->condition = "$field=0";
                }else if($field='name'){
                     $criteria->condition = "$field LIKE :value";
                     $criteria->params = array(':value' => '%'. trim($value) . '%'); 
                }
                $count=Category::model()->count($criteria);
                $pages=new CPagination($count);
                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=Category::model()->findAll($criteria,array('order'=>'updated_on DESC'));   
                $count = Category::model()->count($criteria);
                $this->render('categoriesbystatus', array(
                    'models' => $models,
                    'pages' => $pages,'count'=>$count
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        
        public function actionusersByStatus($usertype,$userstatus,$adminapprovestatus)
        {
            Yii::app()->user->setState("adminmenu","user");
             if(Yii::app()->user->isAdmin){
                  $criteria=new CDbCriteria();    
                  $my_params = array();
                 if($usertype==4){
                     $criteria->order = 'updated_on DESC';                    
                     
                     if($userstatus!='all'){
                         $criteria->condition = "status = :userstatus AND user_type= :user_type AND user_type!=1";                                             
                          $my_params['userstatus'] = $userstatus;
                          $my_params['user_type'] = $usertype;
                     }else{
                           $criteria->condition = "user_type= :user_type AND user_type!=1";
                          
                            $my_params['user_type'] = $usertype; 
                     }
                     if($adminapprovestatus !='all'){
                         $criteria->addCondition('admin_approval_status=:admin_approval_status');
                          $my_params['admin_approval_status'] = $adminapprovestatus;                         
                     }
                     $criteria->params = $my_params;
                 }else if($usertype=='all'){
                     $criteria->order = 'updated_on DESC';                    
                   
                     if($userstatus!='all'){
                          $criteria->condition = "status = :userstatus AND user_type!=1";
                          
                           $my_params['userstatus'] = $userstatus;
                     }else{
                           $criteria->condition = "user_type!=1";
                     }
                      if($adminapprovestatus !='all'){
                         $criteria->addCondition('admin_approval_status=:admin_approval_status');
                          $my_params['admin_approval_status'] = $adminapprovestatus;                         
                     }
                      $criteria->params = $my_params;
                    
                 }else if($usertype==2 || $usertype==3){
                     $criteria->order = 'updated_on DESC';                    
                   
                     if($userstatus!='all'){
                          $criteria->join='LEFT JOIN recruiterprofile rp ON rp.user_id=t.id';
                          $criteria->condition = "t.status = :userstatus AND user_type= :user_type AND rp.type=:rtype AND user_type!=1";                        
//                          $criteria->params = array(':userstatus' => $userstatus,':user_type'=>2,':rtype'=>$usertype);                     
                          $my_params['userstatus'] = $userstatus;
                          $my_params['user_type'] =2;
                          $my_params['rtype'] =$usertype;
                     }else{
                           $criteria->join='LEFT JOIN recruiterprofile rp ON rp.user_id=t.id';
                           $criteria->condition = "user_type= :user_type AND rp.type=:rtype AND user_type!=1";                        
//                           $criteria->params = array(':user_type'=>2,':rtype'=>$usertype);  
                         
                          $my_params['user_type'] =2;
                          $my_params['rtype'] =$usertype;
                     }
                      if($adminapprovestatus !='all'){
                         $criteria->addCondition('admin_approval_status=:admin_approval_status');
                          $my_params['admin_approval_status'] = $adminapprovestatus;                         
                     }
                     $criteria->params = $my_params;
                 } 
                $count=  User::model()->count($criteria);
                $pages=new CPagination($count);
                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=User::model()->findAll($criteria,array('order'=>'updated_on DESC'));   
                $count = User::model()->count($criteria);
                $this->render('userslist', array(
                    'models' => $models,
                    'pages' => $pages,'count'=>$count,'usertype'=>$usertype,'userstatus'=>$userstatus,'adminapprovestatus'=>$adminapprovestatus
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        
        
        
        public function actionjobPostingsByStatus($type,$status,$adminapprovestatus)
        {
            Yii::app()->user->setState("adminmenu","user");
             if(Yii::app()->user->isAdmin){
                  $criteria=new CDbCriteria();    
                  $my_params = array();
                 if($type=='all'){
                     $criteria->order = 'updated_on DESC';                    
                   
                     if($status!='all'){
                          $criteria->condition = "status = :status";
                          
                           $my_params['status'] = $status;
                     }else{
                          
                     }
                      if($adminapprovestatus !='all'){
                         $criteria->addCondition('admin_approval_status=:admin_approval_status');
                          $my_params['admin_approval_status'] = $adminapprovestatus;                         
                     }
                      $criteria->params = $my_params;
                    
                 }else if($type==2 || $type==3){
                     $criteria->order = 'updated_on DESC';                    
                   
                     if($status!='all'){
                          $criteria->join='LEFT JOIN recruiterprofile rp ON rp.user_id=t.user_id';
                          $criteria->condition = "t.status = :status AND rp.type=:rtype";                        
//                          $criteria->params = array(':userstatus' => $userstatus,':user_type'=>2,':rtype'=>$usertype);                     
                          $my_params['status'] = $status;
                        
                          $my_params['rtype'] =$type;
                     }else{
                           $criteria->join='LEFT JOIN recruiterprofile rp ON rp.user_id=t.user_id';
                           $criteria->condition = "rp.type=:rtype";                        
//                           $criteria->params = array(':user_type'=>2,':rtype'=>$usertype);  
                         
                        
                          $my_params['rtype'] =$type;
                     }
                      if($adminapprovestatus !='all'){
                         $criteria->addCondition('admin_approval_status=:admin_approval_status');
                          $my_params['admin_approval_status'] = $adminapprovestatus;                         
                     }
                     $criteria->params = $my_params;
                 } 
                $count= Jobpostings::model()->count($criteria);
                $pages=new CPagination($count);
                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=Jobpostings::model()->findAll($criteria,array('order'=>'updated_on DESC'));   
                $count = Jobpostings::model()->count($criteria);
                $this->render('jobpostingslist', array(
                    'models' => $models,
                    'pages' => $pages,'count'=>$count,'type'=>$type,'status'=>$status,'adminapprovestatus'=>$adminapprovestatus
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
        }
        /**
             * This is the action to delete a category.
             */
        
        public function actionDelete()
        {             
             if(Yii::app()->user->isAdmin){                                  
                    if(isset($_POST['id'])){ 
                         $model = Category::model()->deleteByPk($_POST['id']);
                         if($model){
                             echo "success";
                         }else{
                             echo "failed";
                         }
                    }
                }
        }
        /**
             * This is the action to alter status of given category.
             * input : catId
             */
        
        public function actionMakeStatus()
        {             
             if(Yii::app()->user->isAdmin){                                  
                    if(isset($_POST['id'])){ 
                         $model = Category::model()->findByPk($_POST['id']);
                         if($model->status==1){
                             $model->status=0;
                         }else{
                             $model->status=1;
                         }
                         if($model->validate()){
                             if($model->save()){
                                 echo "success";
                             }else{
                             echo "failed";
                            }
                             
                         }
                    }
                }
        }
        
         public function actionrecruiterProfileAdmin($id){
             
                  $this->layout = '//layouts/admin';                        
              
             if(isset($id) && !empty($id)){
                 $recruiterProfile = Recruiterprofile::model()->find('user_id=:user_id',array('user_id'=>$id));                              
                 $this->render('recruiterProfileadmin',array('recruiterProfile'=>$recruiterProfile));
            
                 }
         }
         
         public function actionmemberProfileAdmin($id){
              $this->layout = '//layouts/admin';              
              
             if(isset($id) && !empty($id)){
                 $memberPersonal = Memberpersonal::model()->find('user_id=:user_id',array('user_id'=>$id));
                 $memberEducation = Membereducation::model()->findAll('user_id=:user_id',array('user_id'=>$id));
                 $memberProfessional = Memberprofessional::model()->findAll('user_id=:user_id',array('user_id'=>$id));
                 $memberUploads = Memberuploads::model()->find('user_id=:user_id',array('user_id'=>$id));
                 $this->render('memberprofileadmin',array('memberPersonal'=>$memberPersonal,'memberEducation'=>$memberEducation,'memberProfessional'=>$memberProfessional,'memberUploads'=>$memberUploads));
            
                 }
         }
         
         public function actionmakeadminApproveStatus() {
         if (isset(Yii::app()->user->isAdmin) && !empty(Yii::app()->user->isAdmin)) {
            if (isset($_POST['id'])) {
                $model = User::model()->findByPk($_POST['id']);
             
                    $model->admin_approval_status = $_POST['status'];
                    
               
                if ($model->validate()) {
                    if ($model->save()) {
                        $status = '';
                        if($_POST['status'] == 1){
                             $status = 'Approved';
                        }else if($_POST['status'] == 2){
                             $status = 'Returned for Changes';
                        }else if($_POST['status'] == 3){
                             $status = 'Marked As You are Non-Relevant for this Profile';
                        }
                        if(isset($model) && !empty($model)){
                          require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                                    $mail = new PHPMailer();
                                    //$body             = file_get_contents('contents.html');
                        $body = '<!doctype html>
                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                    <head>
                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                    <title>JOB PORTAL SIT Member Registration Confirmation</title>

                                    <style type="text/css">
                                        .ReadMsgBody {width: 100%; background-color: #ffffff;}
                                        .ExternalClass {width: 100%; background-color: #ffffff;}
                                        body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                                        table {border-collapse: collapse;}

                                        @media only screen and (max-width: 640px)  {
                                                        body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                                                        body[yahoo] .center {text-align: center!important;}  
                                                }

                                        @media only screen and (max-width: 479px) {
                                                        body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                                                        body[yahoo] .center {text-align: center!important;}  
                                                }
                                    </style>
                                    </head>
                                    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                                    <!-- Wrapper -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tr>
                                            <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

                                                <!--Start Header-->
                                                <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                    <tr>
                                                        <td style="padding: 6px 0px 0px">
                                                            <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                <tr>
                                                                    <td width="100%" >
                                                                        <!--Start logo-->
                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                            <tr>
                                                                                <td class="center" style="padding: 10px 0px 10px 0px">
                                                                                    <!--<a href="#"><img src="http://tomcom.suryaitsystems.com/tomcom/jp_assets/assets/img/sit/banner.png"></a>-->
                                                                                </td>
                                                                            </tr>
                                                                        </table><!--End logo-->
                                                                        <!--Start nav-->
                                                                        <!--End nav-->
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                       </td>
                                                    </tr>
                                                </table> 
                                                <!--End Header-->

                                                <!-- Start Headliner-->                                                                                       

                                                <div style="height:15px">&nbsp;</div><!-- divider -->

                                                <!--Start Discount -->
                                                <table width="900" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                    <tr>
                                                        <td width="100%" bgcolor="#ffffff">
                                                            <!-- Left Box  -->
                                                            <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                <tr>
                                                                    <td class="center">
                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                                                            <tr>
                                                                                <td  class="center" style="font-size: 16px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                    Dear , ' . $model->username .'                            
                                                                               </td>
                                                                            </tr>';

                                                                       $body.='<tr>
                                                                                <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                                                                    Reply for your profile Approval   By Admin is "'.$status.'"                        
                                                                                </td>
                                                                            </tr><br>'; 
                                                                        $body.='</table>
                                                                    </td>
                                                                </tr>
                                                            </table><!--End Left Box-->

                                                        </td>
                                                    </tr>
                                                </table>       



                                                        </td>
                                                    </tr>
                                                </table>                                                                                       

                                            </td>
                                        </tr>
                                    </table> 
                                    <!-- End Wrapper -->
                                    </body>
                                    </html>';
//                                                                      echo $body;
                                    $mail->IsSMTP(); // telling the class to use SMTP
                                    $mail->Host = "smtp.gmail.com"; // SMTP server
                                    //$mail->SMTPDebug  = 2;                   // 2 = messages only
                                    $mail->SMTPAuth = true;                  // enable SMTP authentication
                                    $mail->Host = "smtp.gmail.com"; // sets the SMTP server
                                    //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                                    $mail->Username = "jobportalsit@gmail.com"; // SMTP account username
                                    $mail->Password = "sit123123";
                                    $mail->SetFrom('jobportalsit@gmail.com', 'JOB PORTAL SIT');
                                    $mail->AddReplyTo("jobportalsit@gmail.com", "JOB PORTAL SIT");
                                    $mail->Subject = "Admin Approval Status";
                //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                                    $mail->MsgHTML($body);        // SMTP password
                                    $mail->SMTPSecure = 'tls';
                                    $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                                    $mail->Port = 587;
                                    $address = $model->username;
                                    $mail->AddAddress($address, $model->username);
                                    //$mail->SMTPDebug  = 1;     
                                    $mail->isHTML(true);

                                    //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                                    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
                                    $mail->Send();                                    
                     }
                        echo "success";
                    } else {
                        echo "failed";
                    }
                }
            }
        }
    }
    
    public function actionJobDescriptionAdmin($id){
         $this->layout = '//layouts/admin'; 
        
         $jobDescription = Jobpostings::model()->find('id=:id',array('id'=>$id));
         
         $jobDescription->views = $jobDescription->views+1;
         if($jobDescription->validate()){
             $jobDescription->save();
         }
         
         $this->render('jobdesriptionadmin',array('jobDescription'=>$jobDescription));
    }
    
public function actionmakeadminApproveStatusJobPosts() {
         if (isset(Yii::app()->user->isAdmin) && !empty(Yii::app()->user->isAdmin)) {
            if (isset($_POST['id'])) {
                $jobObject = Jobpostings::model()->findByPk($_POST['id']);
             
                    $jobObject->admin_approval_status = $_POST['status'];
                    
               
                if ($jobObject->validate()) {
                    if ($jobObject->save()) {
                        $status = '';
                        if($_POST['status'] == 1){
                             $status = 'Approved';
                        }else if($_POST['status'] == 2){
                             $status = 'Returned for Changes';
                        }else if($_POST['status'] == 3){
                             $status = 'Marked As You are Non-Relevant for this Profile';
                        }
                        $model = User::model()->findByPk($jobObject->user_id);
                        if(isset($model) && !empty($model)){
                          require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                                    $mail = new PHPMailer();
                                    //$body             = file_get_contents('contents.html');
                        $body = '<!doctype html>
                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                    <head>
                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                    <title>JOB PORTAL SIT Member Registration Confirmation</title>

                                    <style type="text/css">
                                        .ReadMsgBody {width: 100%; background-color: #ffffff;}
                                        .ExternalClass {width: 100%; background-color: #ffffff;}
                                        body     {width: 100%; background-color: #ffffff; margin:0; padding:0; -webkit-font-smoothing: antialiased;font-family: Arial, Helvetica, sans-serif}
                                        table {border-collapse: collapse;}

                                        @media only screen and (max-width: 640px)  {
                                                        body[yahoo] .deviceWidth {width:440px!important; padding:0;}    
                                                        body[yahoo] .center {text-align: center!important;}  
                                                }

                                        @media only screen and (max-width: 479px) {
                                                        body[yahoo] .deviceWidth {width:280px!important; padding:0;}    
                                                        body[yahoo] .center {text-align: center!important;}  
                                                }
                                    </style>
                                    </head>
                                    <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" yahoo="fix" style="font-family: Arial, Helvetica, sans-serif">

                                    <!-- Wrapper -->
                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="center">
                                        <tr>
                                            <td width="100%" valign="top" bgcolor="#ffffff" style="padding-top:20px">

                                                <!--Start Header-->
                                                <table width="700" bgcolor="#fff" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                    <tr>
                                                        <td style="padding: 6px 0px 0px">
                                                            <table width="680" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                <tr>
                                                                    <td width="100%" >
                                                                        <!--Start logo-->
                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                            <tr>
                                                                                <td class="center" style="padding: 10px 0px 10px 0px">
                                                                                    <!--<a href="#"><img src="http://tomcom.suryaitsystems.com/tomcom/jp_assets/assets/img/sit/banner.png"></a>-->
                                                                                </td>
                                                                            </tr>
                                                                        </table><!--End logo-->
                                                                        <!--Start nav-->
                                                                        <!--End nav-->
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                       </td>
                                                    </tr>
                                                </table> 
                                                <!--End Header-->

                                                <!-- Start Headliner-->                                                                                       

                                                <div style="height:15px">&nbsp;</div><!-- divider -->

                                                <!--Start Discount -->
                                                <table width="900" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                    <tr>
                                                        <td width="100%" bgcolor="#ffffff">
                                                            <!-- Left Box  -->
                                                            <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                <tr>
                                                                    <td class="center">
                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                                                            <tr>
                                                                                <td  class="center" style="font-size: 16px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                    Dear , ' . $model->username .'                            
                                                                               </td>
                                                                            </tr>';

                                                                       $body.='<tr>
                                                                                <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                                                                    Reply for your job Posting  <a href="'.Yii::app()->request->baseUrl.'/site/JobDescription?recId='.$jobObject['user_id'].'&id='.$jobObject['id'].'" target="_blank">'.$jobObject['jobtitle'].'</a> - '.City::model()->getLocation($jobObject['locations']).' has Approval   By Admin is "'.$status.'"                        
                                                                                </td>
                                                                            </tr><br>'; 
                                                                        $body.='</table>
                                                                    </td>
                                                                </tr>
                                                            </table><!--End Left Box-->

                                                        </td>
                                                    </tr>
                                                </table>       



                                                        </td>
                                                    </tr>
                                                </table>                                                                                       

                                            </td>
                                        </tr>
                                    </table> 
                                    <!-- End Wrapper -->
                                    </body>
                                    </html>';
//                                                                      echo $body;
                                    $mail->IsSMTP(); // telling the class to use SMTP
                                    $mail->Host = "smtp.gmail.com"; // SMTP server
                                    //$mail->SMTPDebug  = 2;                   // 2 = messages only
                                    $mail->SMTPAuth = true;                  // enable SMTP authentication
                                    $mail->Host = "smtp.gmail.com"; // sets the SMTP server
                                    //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                                    $mail->Username = "jobportalsit@gmail.com"; // SMTP account username
                                    $mail->Password = "sit123123";
                                    $mail->SetFrom('jobportalsit@gmail.com', 'JOB PORTAL SIT');
                                    $mail->AddReplyTo("jobportalsit@gmail.com", "JOB PORTAL SIT");
                                    $mail->Subject = "Admin Approval Status For Job Posting";
                //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                                    $mail->MsgHTML($body);        // SMTP password
                                    $mail->SMTPSecure = 'tls';
                                    $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                                    $mail->Port = 587;
                                    $address = $model->username;
                                    $mail->AddAddress($address, $model->username);
                                    //$mail->SMTPDebug  = 1;     
                                    $mail->isHTML(true);

                                    //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                                    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
                                    $mail->Send();                                    
                     }
                        echo "success";
                    } else {
                        echo "failed";
                    }
                }
            }
        }
    }
    
    public function actiongetTotalUserCountAjax(){
        echo $count = User::model()->getTotalUserCount();
    }
    public function actiongetUserCountByStatusAjax(){
        echo $count = User::model()->getUserCountByStatus($_POST['status']);
    }
    public function actiongetUserCountByAdminApproveStatusAjax(){
        echo $count = User::model()->getUserCountByAdminApproveStatus($_POST['status']);
    }
    
    public function actiongetTotalUserCountByTypeAjax(){
        echo $count = User::model()->getTotalUserCountByType($_POST['type']);
    }
     public function actiongetUserCountByStatusAndTypeAjax(){
        echo $count = User::model()->getUserCountByStatusAndType($_POST['type'],$_POST['status']);
    }
    public function actiongetUserCountByAdminApproveStatusAndTypeAjax(){
        echo $count = User::model()->getUserCountByAdminApproveStatusAndType($_POST['type'],$_POST['status']);
    }
    
    public function actiongetTotalJobPostingCountAjax(){
        echo $count = Jobpostings::model()->recordCount($_POST['status']);
    }
     public function actiongetJobPostingsCountByAdminApproveStatusAjax(){
        echo $count = Jobpostings::model()->getJobPostingsCountByAdminApproveStatus($_POST['status']);
    }
    
    
    public function actionjobPostingsSearchByCategory($id){
        Yii::app()->user->setState("adminmenu","jobpostings");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();
                $criteria->condition = 'cat_id=:cat_id';
                $criteria->params = array(':cat_id'=>$id);
                $criteria->order = 'updated_on DESC';
             
                $count= Jobpostings::model()->count($criteria);
                $pages=new CPagination($count);

                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=Jobpostings::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                $count = Jobpostings::model()->count($criteria);
                $this->render('jobpostingslist', array(
                'models' => $models,
                     'pages' => $pages,'count'=>$count,'cat_id'=>$id
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
    }
    public function actionjobPostingsSearchBySubCategory($id){
        Yii::app()->user->setState("adminmenu","jobpostings");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();
                $criteria->condition = 'subcat_id=:subcat_id';
                $criteria->params = array(':subcat_id'=>$id);
                $criteria->order = 'updated_on DESC';
             
                $count= Jobpostings::model()->count($criteria);
                $pages=new CPagination($count);

                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=Jobpostings::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                $count = Jobpostings::model()->count($criteria);
                $this->render('jobpostingslist', array(
                'models' => $models,
                     'pages' => $pages,'count'=>$count,'subcat_id'=>$id
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
    }
    
    public function actionjobPostingsSearchBySkill($id){
        Yii::app()->user->setState("adminmenu","jobpostings");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();
                $criteria->condition = 'skill_id=:skill_id';
                $criteria->params = array(':skill_id'=>$id);
                $criteria->order = 'updated_on DESC';
             
                $count= Jobpostings::model()->count($criteria);
                $pages=new CPagination($count);

                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=Jobpostings::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                $count = Jobpostings::model()->count($criteria);
                $this->render('jobpostingslist', array(
                'models' => $models,
                     'pages' => $pages,'count'=>$count,'skill_id'=>$id
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
    }
    public function actionjobPostingsSearchByCity($id){
        Yii::app()->user->setState("adminmenu","jobpostings");
             if(Yii::app()->user->isAdmin){
                $criteria=new CDbCriteria();
                $criteria->condition = 'locations LIKE :locations';
                $criteria->params = array(':locations'=>'%'.$id.'%');
                $criteria->order = 'updated_on DESC';
             
                $count= Jobpostings::model()->count($criteria);
                $pages=new CPagination($count);

                // results per page
                $pages->pageSize=10;
                $pages->applyLimit($criteria);
                $models=Jobpostings::model()->findAll($criteria,array('order'=>'updated_on DESC'));     
                $count = Jobpostings::model()->count($criteria);
                $this->render('jobpostingslist', array(
                'models' => $models,
                     'pages' => $pages,'count'=>$count,'city_id'=>$id
                ));
                  
                }else{
                    $this->redirect(array('site/index'));
                }
    }
    
}
