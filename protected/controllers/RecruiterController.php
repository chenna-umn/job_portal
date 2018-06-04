<?php

class RecruiterController extends Controller {

//	public $layout='mainv';
    public $defaultAction = 'index';

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {

        ini_set('max_execution_time', 300);
        if (isset(Yii::app()->user->recId) && !empty(Yii::app()->user->recId)) {
            $this->redirect(array('Recruiter/dashboard'));
        } else {
            $this->layout = '//layouts/register';
            $this->render('index');
        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     *  to register a new user.
     */
    public function actionregister() {

        require Yii::app()->request->baseUrl . '/jp_assets/mailer/PHPMailerAutoload.php';
        $checkUser = User::model()->find('username=:username', array(':username' => $_POST['email']));
        $user = new User();
        if (isset($_POST['email']) && $_POST['password'] && !isset($checkUser) && empty($checkUser)) {
            $user->username = $_POST['email'];
            $user->password = md5($_POST['password']);
            $user->membership_id = 'jp';
            $user->user_type = $_POST['type'];
            $user->created_on = date('Y-m-d h:i:s');
            $user->updated_on = date('Y-m-d h:i:s');
            $user->status = 0;
            $user->activation_code = strtotime(date('Y-m-d h:i:s')) . md5($_POST['email']);
            if ($user->validate()) {
                if ($user->save()) {
                    $recruiter = new Recruiterprofile();
                    $recruiter->name = $_POST['name'];
                    $recruiter->mobile = $_POST['mobile'];
                    $recruiter->email = $_POST['email'];
                    $recruiter->organization = $_POST['organization'];
                    $recruiter->designation = $_POST['designation'];
                    $recruiter->type = $_POST['type'];
                    $recruiter->status = 0;
                    $recruiter->user_id = $user->id;
                    if ($recruiter->validate()) {
                        if ($recruiter->save()) {

                            require_once(Yii::app()->request->baseUrl . '/jp_assets/mailer/PHPMailerAutoload.php');
                            $mail = new PHPMailer();
                            //$body             = file_get_contents('contents.html');
                            $body = '<!-- 
                                                                             * Template Name: Unify - Responsive Bootstrap Template
                                                                             * Description: Business, Corporate, Portfolio and Blog Theme.
                                                                             * Version: 1.6
                                                                             * Author: @htmlstream
                                                                             * Website: http://htmlstream.com
                                                                             -->
                                                                            <!doctype html>
                                                                            <html xmlns="http://www.w3.org/1999/xhtml">
                                                                            <head>
                                                                            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                                            <title>JOB PORTAL SIT Recruiter Registration Confirmation</title>

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
                                                                                        <table width="700" border="0" cellpadding="0" cellspacing="0" align="center" class="deviceWidth">
                                                                                            <tr>
                                                                                                <td width="100%" bgcolor="#ffffff">
                                                                                                    <!-- Left Box  -->
                                                                                                    <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                                        <tr>
                                                                                                            <td class="center">
                                                                                                                <table  border="0" cellpadding="0" cellspacing="0" align="center"> 
                                                                                                                    <tr>
                                                                                                                        <td  class="center" style="font-size: 16px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                            Dear , ' . $_POST['email'] . ' , Welcome to SuryaJobs.com.                            
                                                                                                                       </td>
                                                                                                                    </tr>
                                                                                                                    <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Thanking You For Registering with us. Please confirm your clicking on the following link:                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                     
                                                                                                                                    <td valign="top" class="left" style="padding: 7px 15px; text-align: center; background-color: #27d7e7;">
                                                                                                                                            <a href="' . Yii::app()->request->baseUrl . '/recruiter/activate?link=' . $user->activation_code . '&mail=' . md5($_POST['email']) . '" style="color: #fff; font-size: 12px; font-weight: bold; text-decoration: none; font-family: Arial, sans-serif; text-alight: center;">Activate</a>
                                                                                                                                    </td>  
                                                                                                                                    
                                                                                                                                </tr> 
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    In case the above link does not work, copy and paste the following URL onto the address bar of your browser.                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    <a href="' . Yii::app()->request->baseUrl . '/recruiter/activate?link=' . $user->activation_code . '&mail=' . md5($_POST['email']) . '">' . Yii::app()->request->baseUrl . '/recruiter/activate?link=' . $user->activation_code . '&mail=' . md5($_POST['email']) . '</a>                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    We hope that you shall find your dream job at Suryajobs.com and that we fulfill all your expectations.                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Best of luck,<br>
                                                                                                                                    Team SuryaJobs<br>
                                                                                                                                    www.suryajobs.com<br>
                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                             <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Visit our Help center or write into us at support@SuryaJobs.com for any assistance you may require. 
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                                                                                                                                        
                                                                                                                </table>
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
                            $mail->IsSMTP(); // telling the class to use SMTP
                            $mail->Host = "mail.suryaitsystems.com"; // SMTP server
//                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
                            $mail->SMTPAuth = true;                  // enable SMTP authentication
                            $mail->Host = "mail.suryaitsystems.com"; // sets the SMTP server
                            //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                            $mail->Username = "keshav@suryaitsystems.com"; // SMTP account username
                            $mail->Password = 'suryait';
                            $mail->SetFrom('keshav@suryaitsystems.com', 'JOB PORTAL SIT');
                            $mail->AddReplyTo("keshav@suryaitsystems.com", "JOB PORTAL SIT");
                            $mail->Subject = "JOB PORTAL SIT Activation Link";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                            $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $user->username;
                            $mail->AddAddress($address, $user->username);
                            //$mail->SMTPDebug  = 1;     
                            $mail->isHTML(true);

                            //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                            //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

                            if (!$mail->Send()) {
                                //  echo "Mailer Error: " . $mail->ErrorInfo;
                                Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Submitting Query...Please Try Later...!");
                            } else {
                                Yii::app()->user->setFlash('success', "Registered Successfully...Confirmation link sent to your mail");
                            }

                            $this->layout = '//layouts/register';

                            $this->render('index');
                            //    exit;
                        } else {
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                            $this->layout = '//layouts/register';

                            $this->render('index');
                        }
                    } else {
                        Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                        $this->layout = '//layouts/register';

                        $this->render('index');
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                    $this->layout = '//layouts/register';

                    $this->render('index');
                }
            } else {
                Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                $this->layout = '//layouts/register';

                $this->render('index');
            }
        } else {
            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
            $this->layout = '//layouts/register';

            $this->render('index');
        }
    }

    /**
     * This is to activate the user
     * 
     */
    public function actionactivate() {
        $this->layout = '//layouts/register';

        if (isset($_GET['link']) && $_GET['mail']) {
            $checkUser = User::model()->find('activation_code=:activation_code', array(':activation_code' => $_GET['link']));
            if (isset($checkUser) && !empty($checkUser)) {
                if (md5($checkUser->username) == $_GET['mail']) {
                    if ($checkUser->status == 0) {
                        $checkUser->status = 1;
                        if ($checkUser->validate() && $checkUser->save()) {
                            $recruiter = Recruiterprofile::model()->find('user_id=:user_id', array(':user_id' => $checkUser->id));
                            if (isset($recruiter) && !empty($recruiter)) {
                                $recruiter->status = 1;
                                if ($recruiter->validate() && $recruiter->save()) {
                                    Yii::app()->user->setFlash('success', "Your Account is  Activeted Successfully...Please login from brlow, With your Credentials.");
                                }
                            }
                        }
                    } else if ($checkUser->status == 1) {
                        Yii::app()->user->setFlash('success', "Your Account is Already in Active State...Please login  With your Credentials.");
                    } else {
                        
                    }
                } else {
                    Yii::app()->user->setFlash('error', "You are not Authorized to Activate account..Please Try Later...!");
                }
            } else {
                Yii::app()->user->setFlash('error', "Oops...Activation Link is Not Valid");
            }
        } else {
            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Activating...Please Try Later...!");
        }



        $this->render('activate');
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actiondashboard() {
        $this->layout = '//layouts/recriuterhome';
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $this->render('dashboard');
        } else {
            $this->redirect(array('site/index'));
        }
    }

    public function actioncreatejob() {
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $model = new Jobpostings();
            if (isset($_POST['Jobpostings'])) {
                $model->attributes = $_POST['Jobpostings'];
                $model->created_on = date('Y-m-d h:i:s');
                $model->updated_on = date('Y-m-d h:i:s');
                $model->locations = implode(',', $_POST['Jobpostings']['locations']);
                $model->female = isset($_POST['Jobpostings']['female']) ? 1 : 0;
                $model->physical = isset($_POST['Jobpostings']['physical']) ? 1 : 0;
                $model->defence = isset($_POST['Jobpostings']['defence']) ? 1 : 0;
                $model->work_from_home = isset($_POST['Jobpostings']['work_from_home']) ? 1 : 0;
                $model->women_workforce = isset($_POST['Jobpostings']['women_workforce']) ? 1 : 0;
                $model->apply_less_qualification = isset($_POST['Jobpostings']['apply_less_qualification']) ? 1 : 0;
                $model->user_id = Yii::app()->user->recId;
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "Created Successfully");
                    } else {
                        Yii::app()->user->setFlash('error', "Oops...!Something Went wrong..Please Try Later...!");
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong...Please Try Later...!");
                }
            }
            $this->layout = '//layouts/recriuterhome';
            $this->render('dashboard');
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionlistjobs() {
        $this->layout = '//layouts/recriuterhome';
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $criteria = new CDbCriteria();
            $criteria->order = 'updated_on DESC';
            $count = Jobpostings::model()->count($criteria);
            $pages = new CPagination($count);

            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            $models = Jobpostings::model()->findAll($criteria, array('order' => 'updated_on DESC'));
            $count = Jobpostings::model()->count($criteria);
            $this->render('listjobs', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
            $model = Jobpostings :: model()->findAll('user_id=:user_id', array('user_id' => Yii::app()->user->recId));
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    /**
     * This is the action to create a category.
     */
    public function actionUpdatejob($id) {
        $this->layout = '//layouts/recriuterhome';

        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $model = Jobpostings::model()->findByPk($id);
            if (isset($_POST['Jobpostings'])) {
                $model->attributes = $_POST['Jobpostings'];
                $model->updated_on = date('Y-m-d h:i:s');
                $model->locations = implode(',', $_POST['Jobpostings']['locations']);
                $model->female = isset($_POST['Jobpostings']['female']) ? 1 : 0;
                $model->physical = isset($_POST['Jobpostings']['physical']) ? 1 : 0;
                $model->defence = isset($_POST['Jobpostings']['defence']) ? 1 : 0;
                $model->work_from_home = isset($_POST['Jobpostings']['work_from_home']) ? 1 : 0;
                $model->women_workforce = isset($_POST['Jobpostings']['women_workforce']) ? 1 : 0;
                $model->apply_less_qualification = isset($_POST['Jobpostings']['apply_less_qualification']) ? 1 : 0;
                $model->user_id = Yii::app()->user->recId;
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "Job Updated Successfully");
                        $this->render('updatejob', array('model' => $model));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Adding Updating Category...Please Try Later...!");
                    $this->render('updatejob', array('model' => $model));
                }
            } else {
                $this->render('updatejob', array('model' => $model));
            }
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    /**
     * This is the action to delete a category.
     */
    public function actionDeletejob() {
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            if (isset($_POST['id'])) {
                $model = Jobpostings::model()->deleteByPk($_POST['id']);
                if ($model) {
                    echo "success";
                } else {
                    echo "failed";
                }
            }
        }
    }

    /**
     * This is the action to delete a category.
     */
    public function actiondeletesavedResumeFinder() {
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            if (isset($_POST['id'])) {
                $model = Resumefinder::model()->deleteByPk($_POST['id']);
                if ($model) {
                    echo "success";
                } else {
                    echo "failed";
                }
            }
        }
    }

    /**
     * This is the action to alter status of given category.
     * input : catId
     */
    public function actionMakeStatusjob() {
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            if (isset($_POST['id'])) {
                $model = Jobpostings::model()->findByPk($_POST['id']);
                if ($model->status == 1) {
                    $model->status = 0;
                } else {
                    $model->status = 1;
                }
                if ($model->validate()) {
                    if ($model->save()) {
                        echo "success";
                    } else {
                        echo "failed";
                    }
                }
            }
        }
    }

    public function actionMakeStatusSavedResumeFinder() {
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            if (isset($_POST['id'])) {
                $model = Resumefinder::model()->findByPk($_POST['id']);
                if ($model->status == 1) {
                    $model->status = 0;
                } else {
                    $model->status = 1;
                }
                if ($model->validate()) {
                    if ($model->save()) {
                        echo "success";
                    } else {
                        echo "failed";
                    }
                }
            }
        }
    }

    public function actionupdateprofile($id) {
        $this->layout = '//layouts/recriuterhome';

        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {

            $recruiter = Recruiterprofile::model()->find('user_id=:user_id', array(':user_id' => $id));

            //echo "<pre>";
            // print_r($_FILES);
//                    echo $uploaddir =Yii::app()->request->baseUrl.'/uploads/profilepics/';exit;
            if (isset($_POST['name'])) {
                $recruiter->name = $_POST['name'];
                $recruiter->mobile = $_POST['mobile'];
                $recruiter->organization = $_POST['organization'];
                $recruiter->designation = $_POST['designation'];
                $recruiter->type = $_POST['type'];
                $recruiter->about = $_POST['about'];
                if (isset($_FILES['profile_pic']['name']) && !empty($_FILES['profile_pic']['name'])) {
                    $uploaddir = 'uploads/profilepics/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['profile_pic']['name']);
                    $filename = basename(date('Y-m-d-H-i') . "_" . $_FILES['profile_pic']['name']);
                    if ((is_dir('uploads/profilepics/'))) {
                        
                    } else {
                        mkdir('uploads/profilepics/', 0777, true);
                    }
                    if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadfile)) {
//                                   echo "eqweqweqw";exit;
                    }
                    $recruiter->profile_pic = $filename;
                } else {
//                             echo "Ewrwer";exit;
                }
                if (isset($_FILES['company_logo']['name']) && !empty($_FILES['company_logo']['name'])) {
                    $uploaddir = 'uploads/companylogo/';
                    $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['company_logo']['name']);
                    $filename = basename(date('Y-m-d-H-i') . "_" . $_FILES['company_logo']['name']);
                    if ((is_dir('uploads/companylogo/'))) {
                        
                    } else {
                        mkdir('uploads/companylogo/', 0777, true);
                    }
                    move_uploaded_file($_FILES['company_logo']['tmp_name'], $uploadfile);
                    $recruiter->company_logo = $filename;
                } else {
                    //echo "rwerwe";exit;
                }


                if ($recruiter->validate()) {
                    if ($recruiter->save()) {
                        Yii::app()->user->setFlash('success', "Profile Updated Successfully");
                        $this->render('updateprofile', array('model' => $recruiter));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Updating Profile...Please Try Later...!");
                    $this->render('updateprofile', array('model' => $recruiter));
                }
            } else {
                $this->render('updateprofile', array('model' => $recruiter));
            }
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionappliedList() {

        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $this->layout = '//layouts/recriuterhome';
            $criteria = new CDbCriteria();
            $criteria->select = 't.*,jp.user_id as rec_id,jp.*,ap.id as apid,t.user_id as jsid,t.status as apstatus';
            $criteria->join = 'JOIN jobpostings jp ON jp.id = t.job_id';
            $criteria->condition = "jp.user_id=:recId";
            $criteria->params = (array(':recId' => Yii::app()->user->recId));
            $criteria->order = 't.updated_on DESC';
            $count = Applyjob::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }
            $models = Yii::app()->db->createCommand()
                    ->select('ap.*,jp.user_id as rec_id,jp.*,ap.id as apid,ap.user_id as jsid,ap.status as apstatus')
                    ->from('applyjob ap')
                    ->join('jobpostings jp', 'jp.id = ap.job_id')
                    ->where('jp.user_id=:recId', array(':recId' => Yii::app()->user->recId))
                    ->order('ap.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();

            $count = Applyjob::model()->count($criteria);


            $totalJobsPosted = Jobpostings :: model()->findAll('user_id=:user_id', array('user_id' => Yii::app()->user->recId));

            $this->render('applyjobreports', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count, 'totalJobsPosted' => $totalJobsPosted
            ));
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionSearchAppliedListByJobId($id) {
        $this->layout = '//layouts/recriuterhome';
        if (isset($_GET['recId']) && !empty($_GET['recId'])) {

            $user = User::model()->find('id=:id', array('id' => $_GET['recId']));
            if (isset($user) && !empty($user)) {
                Yii::app()->User->setState('recId', $user->id);
                Yii::app()->User->setState('userType', $user->user_type);
                Yii::app()->User->setState('recname', $user->username);
                Yii::app()->User->setState('memberloggedInAt', date('Y-m-d h:i:s'));
                Yii::app()->User->setState('isRecruiter', 1);
                Yii::app()->User->setState('isGuest', 1);
            }
        }
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter) && isset($id) && !empty($id)) {

            $criteria = new CDbCriteria();
            $criteria->select = 't.*,jp.user_id as rec_id,jp.*,ap.id as apid,t.user_id as jsid,t.status as apstatus';
            $criteria->join = 'JOIN jobpostings jp ON jp.id = t.job_id';
            $criteria->condition = "jp.user_id=:recId AND jp.id=:jodId";
            $criteria->params = (array(':recId' => Yii::app()->user->recId, ':jodId' => $id));
            $criteria->order = 't.updated_on DESC';
            $count = Applyjob::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }
            $models = Yii::app()->db->createCommand()
                    ->select('ap.*,jp.user_id as rec_id,jp.*,ap.id as apid,ap.user_id as jsid,ap.status as apstatus')
                    ->from('applyjob ap')
                    ->join('jobpostings jp', 'jp.id = ap.job_id')
                    ->where('jp.user_id=:recId AND jp.id=:jodId', array(':recId' => Yii::app()->user->recId, ':jodId' => $id))
                    ->order('ap.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();

            $count = Applyjob::model()->count($criteria);


            $totalJobsPosted = Jobpostings :: model()->findAll('user_id=:user_id', array('user_id' => Yii::app()->user->recId));

            $this->render('applyjobreports', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count, 'totalJobsPosted' => $totalJobsPosted
            ));
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionSearchSavedListByJobId($id) {
        if (isset($_GET['recId']) && !empty($_GET['recId'])) {

            $user = User::model()->find('id=:id', array('id' => $_GET['recId']));
            if (isset($user) && !empty($user)) {
                Yii::app()->User->setState('recId', $user->id);
                Yii::app()->User->setState('userType', $user->user_type);
                Yii::app()->User->setState('recname', $user->username);
                Yii::app()->User->setState('memberloggedInAt', date('Y-m-d h:i:s'));
                Yii::app()->User->setState('isRecruiter', 1);
                Yii::app()->User->setState('isGuest', 1);
            }
        }
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter) && isset($id) && !empty($id)) {
            $this->layout = '//layouts/recriuterhome';
            $criteria = new CDbCriteria();
            $criteria->select = 't.*,jp.user_id as rec_id,jp.*,ap.id as apid,t.user_id as jsid,t.status as apstatus';
            $criteria->join = 'JOIN jobpostings jp ON jp.id = t.job_id';
            $criteria->condition = "jp.user_id=:recId AND jp.id=:jodId";
            $criteria->params = (array(':recId' => Yii::app()->user->recId, ':jodId' => $id));
            $criteria->order = 't.updated_on DESC';
            $count = Savejob::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }
            $models = Yii::app()->db->createCommand()
                    ->select('sj.*,jp.user_id as rec_id,jp.*,sj.id as apid,sj.user_id as jsid,sj.status as apstatus')
                    ->from('savejob sj')
                    ->join('jobpostings jp', 'jp.id = sj.job_id')
                    ->where('jp.user_id=:recId  AND jp.id=:jodId', array(':recId' => Yii::app()->user->recId, ':jodId' => $id))
                    ->order('sj.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();

            $count = Savejob::model()->count($criteria);
            $totalJobsPosted = Jobpostings :: model()->findAll('user_id=:user_id', array('user_id' => Yii::app()->user->recId));
            $this->render('savejobreports', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count, 'totalJobsPosted' => $totalJobsPosted
            ));
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionsavedList() {
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $this->layout = '//layouts/recriuterhome';
            $criteria = new CDbCriteria();
            $criteria->select = 't.*,jp.user_id as rec_id,jp.*,ap.id as apid,t.user_id as jsid,t.status as apstatus';
            $criteria->join = 'JOIN jobpostings jp ON jp.id = t.job_id';
            $criteria->condition = "jp.user_id=:recId";
            $criteria->params = (array(':recId' => Yii::app()->user->recId));
            $criteria->order = 't.updated_on DESC';
            $count = Savejob::model()->count($criteria);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $pages->applyLimit($criteria);
            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }
            $models = Yii::app()->db->createCommand()
                    ->select('sj.*,jp.user_id as rec_id,jp.*,sj.id as apid,sj.user_id as jsid,sj.status as apstatus')
                    ->from('savejob sj')
                    ->join('jobpostings jp', 'jp.id = sj.job_id')
                    ->where('jp.user_id=:recId', array(':recId' => Yii::app()->user->recId))
                    ->order('sj.updated_on desc')
                    ->limit($pageSize, $from)
                    ->queryAll();

            $count = Savejob::model()->count($criteria);
            $totalJobsPosted = Jobpostings :: model()->findAll('user_id=:user_id', array('user_id' => Yii::app()->user->recId));
            $this->render('savejobreports', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count, 'totalJobsPosted' => $totalJobsPosted
            ));
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionmakeRecruiterResponceStatus() {
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            if (isset($_POST['id'])) {
                $model = Applyjob::model()->findByPk($_POST['id']);
                $model->recruiter_responce_status = $_POST['status'];
                $model->updated_on_by_recruiter = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        $status = $mailText1 = $mailText2 = $mailText3 = '';
                        if ($_POST['status'] == 1) {
                            $status = 'Invited For An Interview';
                            $mailText1 = 'You have been shortlisted for';
                            $mailText2 = 'please click below to apply for more similar jobs';
                            $mailText3 = '';
                        } else if ($_POST['status'] == 2) {
                            $status = 'Putted You On Hold';
                            $mailText1 = 'this mail is to inform you that you have been put on hold ';
                            $mailText2 = 'We hope that your application will be reconsidered again.Meanwhile,please click below to apply for more similar jobs:';
                            $mailText3 = '';
                        } else if ($_POST['status'] == 3) {
                            $status = 'Marked As You are Non-Relevant for this Job';
                            $mailText1 = 'SITS has flagged your application  as non-related,and you have been removed from the selection pool for the stated job.This could mean that this job isn\'t related to your stream of work or that you did not meet any requirements(like experience/skills.locations etc.) as stated in the job description for ';
                            $mailText2 = 'We hope this was accidental and would urge to exercise more caution while applying to jobs in the future,as more such incidents could result in your account getting terminated.';
                            $mailText3 = 'Please review the other jobs you have applied to by clicking below,to prevent such incidents in the future:';
                        }
                        $memberDetails = User::model()->getMemberDetailsByUserId($model->user_id);
                        $jobDetails = Jobpostings::model()->findByPk($model->job_id);
                        if (isset($memberDetails) && !empty($memberDetails) && isset($jobDetails) && !empty($jobDetails)) {
                            require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                            $mail = new PHPMailer();
                            //$body             = file_get_contents('contents.html');
                            $body = '<!doctype html>
                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                    <head>
                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                    <title>JOB PORTAL SIT ' . $status . '</title>

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
                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                    Dear , ' . $memberDetails['name'] . '( ' . $memberDetails['username'] . ')                            
                                                                               </td>
                                                                            </tr>';

                            $body.='<tr>
                                                                                <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                                                           ' . $mailText1 . '<a href="' . Yii::app()->request->baseUrl . '/site/JobDescription?userId=' . $memberDetails['user_id'] . '&id=' . $jobDetails['id'] . '" target="_blank">' . $jobDetails['jobtitle'] . '</a> - ' . City::model()->getLocation($jobDetails['locations']) . '                       
                                                                                </td>
                                                                            </tr>
                                                                            <br>
                                                                            <tr>
                                                                                <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                                                           ' . $mailText2 . '                       
                                                                                </td>
                                                                            </tr>
                                                                            <br>
                                                                            <tr>
                                                                                <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                                                           ' . $mailText3 . '                        
                                                                                </td>
                                                                            </tr>
                                                                            <br><tr>
                                                                                <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                                                                       <a href="' . Yii::app()->request->baseUrl . '/site/memberAppliedJobs?userId=' . $memberDetails['user_id'] . '" target="_blank">Somilar Jobs Status</a>                        
                                                                                </td>
                                                                            </tr>';



                            $body.='<tr>
                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                        Thanks,<br>
                                                                                        Team SuryaJobs<br>
                                                                                        www.suryajobs.com<br>

                                                                                   </td>
                                                                                </tr>
                                                                                 <tr>
                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                        Visit our Help center or write into us at support@SuryaJobs.com for any assistance you may require. 
                                                                                   </td>
                                                                                </tr></table>
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
                            $mail->Host = "mail.suryaitsystems.com"; // SMTP server
//                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
                            $mail->SMTPAuth = true;                  // enable SMTP authentication
                            $mail->Host = "mail.suryaitsystems.com"; // sets the SMTP server
                            //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                            $mail->Username = "keshav@suryaitsystems.com"; // SMTP account username
                            $mail->Password = 'suryait';
                            $mail->SetFrom('keshav@suryaitsystems.com', 'JOB PORTAL SIT');
                            $mail->AddReplyTo("keshav@suryaitsystems.com", "JOB PORTAL SIT");
                            $mail->Subject = 'JOB PORTAL SIT ' . $status;
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $memberDetails['username'];
                            $mail->AddAddress($address, $memberDetails['username']);
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

    public function actionmakeRecruiterResponceStatusSaveJob() {
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            if (isset($_POST['id'])) {
                $model = SaveJob::model()->findByPk($_POST['id']);

                $model->recruiter_responce_status = $_POST['status'];
                $model->updated_on_by_recruiter = date('Y-m-d h:i:s');

                if ($model->validate()) {
                    if ($model->save()) {
                        $status = '';
                        if ($_POST['status'] == 1) {
                            $status = 'Invited For An Interview';
                        } else if ($_POST['status'] == 2) {
                            $status = 'Putted You On Hold';
                        } else if ($_POST['status'] == 3) {
                            $status = 'Marked As You are Non-Relevant for this Job';
                        }
                        $memberDetails = User::model()->getMemberDetailsByUserId($model->user_id);
                        $jobDetails = Jobpostings::model()->findByPk($model->job_id);
                        if (isset($memberDetails) && !empty($memberDetails) && isset($jobDetails) && !empty($jobDetails)) {
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
                                                                                    Dear , ' . $memberDetails['name'] . '( ' . $memberDetails['username'] . ')                            
                                                                               </td>
                                                                            </tr>';

                            $body.='<tr>
                                                                                <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                                                           Reply for your Save for the job <a href="' . Yii::app()->request->baseUrl . '/site/JobDescription?userId=' . $memberDetails['user_id'] . '&id=' . $jobDetails['id'] . '" target="_blank">' . $jobDetails['jobtitle'] . '</a> - ' . City::model()->getLocation($jobDetails['locations']) . '  By recuiter is "' . $status . '"                        
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
                            $mail->Host = "mail.suryaitsystems.com"; // SMTP server
//                                            $mail->SMTPDebug  = 2;                   // 2 = messages only
                            $mail->SMTPAuth = true;                  // enable SMTP authentication
                            $mail->Host = "mail.suryaitsystems.com"; // sets the SMTP server
                            //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                            $mail->Username = "keshav@suryaitsystems.com"; // SMTP account username
                            $mail->Password = 'suryait';
                            $mail->SetFrom('keshav@suryaitsystems.com', 'JOB PORTAL SIT');
                            $mail->AddReplyTo("keshav@suryaitsystems.com", "JOB PORTAL SIT");
                            $mail->Subject = "Daily JobFeed";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $memberDetails['username'];
                            $mail->AddAddress($address, $memberDetails['username']);
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

    public function actionresumeFinder() {
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {

            $this->layout = '//layouts/recriuterhome';
            $this->render('resumefinder');
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionresumeFeed() {
        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $this->layout = '//layouts/recriuterhome';
            if (isset($_POST['Resumefinder'])) {
                $model = new Resumefinder();
                $model->attributes = $_POST['Resumefinder'];
                $model->locations = isset($_POST['Resumefinder']['locations']) ? implode(",", $_POST['Resumefinder']['locations']) : '';
                $model->skills = isset($_POST['Resumefinder']['skills']) ? implode(",", $_POST['Resumefinder']['skills']) : '';
                $model->category = isset($_POST['Resumefinder']['category']) ? implode(",", $_POST['Resumefinder']['category']) : '';
                $model->user_id = Yii::app()->user->recId;
                $model->created_on = date('Y-m-d h:i:s');
                $model->updated_on = date('Y-m-d h:i:s');
//            echo "<pre>";
//            print_r($_POST['Resumefinder']);
//            print_r($model->attributes);
//            exit;
                if ($model->validate()) {
                    if ($model->save()) {
                        $listArray = $cityList = $skillArray = array();
                        $subCatString = $cityListString = $skillString = '';
                        $minExp = $minsal = 0;
                        $maxsal = 100000 * 100;
                        $maxExp = 100;
                        if (isset($model->expmin) && !empty($model->expmin)) {
                            $minExp = $model->expmin;
                        }
                        if (isset($model->expmax) && !empty($model->expmax)) {
                            $maxExp = $model->expmax;
                        }
                        if (isset($model->salmin) && !empty($model->salmin)) {
                            $minsal = $model->salmin * 100000;
                        }
                        if (isset($model->salmax) && !empty($model->salmax)) {
                            $maxsal = $model->salmax * 100000;
                        }

                        $expLevel = $cityListStatus = 0;

                        $cityListAll = Yii::app()->db->createCommand()
                                ->select('id')
                                ->from('city')
                                ->where('status=:status', array(':status' => 1))
                                ->order('name ASC')
                                ->queryAll();
                        foreach ($cityListAll as $key => $value) {
                            $cityList[] = $value['id'];
                        }
                        if (isset($model->locations) && !empty($model->locations)) {
                            $cityListString = $model->locations;
                            $cityList = explode(",", $cityListString);
                        }
                        $cityList = array_filter($cityList);
                        $listArrayAll = Yii::app()->db->createCommand()
                                ->select('id')
                                ->from('subcategory')
                                ->where('status=:status', array(':status' => 1))
                                ->order('updated_on DESC')
                                ->queryAll();

                        foreach ($listArrayAll as $key => $value) {
                            $listArray[] = $value['id'];
                        }
                        $skillArrayAll = Yii::app()->db->createCommand()
                                ->select('id')
                                ->from('skillsub')
                                ->where('status=:status', array(':status' => 1))
                                ->order('updated_on DESC')
                                ->queryAll();
                        foreach ($skillArrayAll as $key => $value) {
                            $skillArray[] = $value['id'];
                        }
                        if (isset($model->skills) && !empty($model->skills)) {
                            $skillString = $model->skills;
                            $skillArray = explode(",", $skillString);
                        }


                        if (isset($model->category) && !empty($model->category)) {
                            $subCatString = $model->category;
                            $listArray = explode(",", $subCatString);
                        }


//                   $criteria=new CDbCriteria();
//                        $criteria->select = 't.*.mp.*';
//                        $criteria->join ='JOIN memberpersonal mp ON mp.user_id=t.id'; 
//                        $criteria->join ='LEFT JOIN memberuploads mu ON mu.user_id=t.id';  
//                        $criteria->order = 't.updated_on DESC';
//                        $count=User::model()->count($criteria);
//                        $pages=new CPagination($count);
//                        // results per page
//                        $pages->pageSize=1;
//                        $pages->applyLimit($criteria);
                        $pageSize = $to = 10;
                        $from = 0;
                        if (isset($_GET['page'])) {
                            $from = ($_GET['page'] - 1) * $pageSize;
                            $to = ($_GET['page']) * $pageSize;
                        }

                        $modelsq = Yii::app()->db->createCommand()
                                ->select('u.*,mp.*,mu.*,u.id as user_id')
                                ->from('user u')
                                ->join('memberpersonal mp', 'mp.user_id=u.id')
                                ->leftJoin('memberuploads mu', 'mu.user_id=u.id')
                                ->where(array('in', 'mp.current_location', $cityList))
                                ->orWhere(array('in', 'mp.preferred_location', $cityList))
                                ->andWhere(array('in', 'mp.industry', $listArray))
                                ->andWhere('mp.expyear>=:expmin AND mp.expyear<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                                ->andWhere('mp.expected_salary>=:salmin AND mp.expected_salary<=:salmax', array(':salmin' => $minsal, ':salmax' => $maxsal))
                                ->andWhere(array('in', 'mp.functional_area', $skillArray))
                                ->order('u.updated_on DESC')
                                ->queryAll();
                        $models = Yii::app()->db->createCommand()
                                ->select('u.*,mp.*,mu.*,u.id as user_id')
                                ->from('user u')
                                ->join('memberpersonal mp', 'mp.user_id=u.id')
                                ->leftJoin('memberuploads mu', 'mu.user_id=u.id')
                                ->where(array('in', 'mp.current_location', $cityList))
                                ->orWhere(array('in', 'mp.preferred_location', $cityList))
                                ->andWhere(array('in', 'mp.industry', $listArray))
                                ->andWhere('mp.expyear>=:expmin AND mp.expyear<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                                ->andWhere('mp.expected_salary>=:salmin AND mp.expected_salary<=:salmax', array(':salmin' => $minsal, ':salmax' => $maxsal))
                                ->andWhere(array('in', 'mp.functional_area', $skillArray))
                                ->order('u.updated_on DESC')
                                ->limit($pageSize, $from)
                                ->queryAll();

                        $count = count($modelsq);
                        $pages = new CPagination($count);
                        // results per page
                        $pages->pageSize = 10;

                        $this->render('resumefinderreports', array(
                            'models' => $models,
                            'pages' => $pages, 'count' => $count
                        ));
                    } else {
                        print_r($model->getErrors());
                    }
                } else {
                    print_r($model->getErrors());
                }
            } else {
                $this->render('resumefinder');
            }
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionupdateSavedResume($id) {

        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $this->layout = '//layouts/recriuterhome';
            if (isset($id) && !empty($id)) {
                $model = Resumefinder::model()->findByPk($id);
                $model->attributes = $_POST['Resumefinder'];
                $model->locations = isset($_POST['Resumefinder']['locations']) ? implode(",", $_POST['Resumefinder']['locations']) : '';
                $model->skills = isset($_POST['Resumefinder']['skills']) ? implode(",", $_POST['Resumefinder']['skills']) : '';
                $model->category = isset($_POST['Resumefinder']['category']) ? implode(",", $_POST['Resumefinder']['category']) : '';
                $model->updated_on = date('Y-m-d H:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        $listArray = $cityList = array();
                        $subCatString = $cityListString = $skillString = '';
                        $minExp = $minsal = 0;
                        $maxsal = 100000 * 100;
                        $maxExp = 100;
                        if (isset($model->expmin) && !empty($model->expmin)) {
                            $minExp = $model->expmin;
                        }
                        if (isset($model->expmax) && !empty($model->expmax)) {
                            $maxExp = $model->expmax;
                        }
                        if (isset($model->salmin) && !empty($model->salmin)) {
                            $minsal = $model->salmin * 100000;
                        }
                        if (isset($model->salmax) && !empty($model->salmax)) {
                            $maxsal = $model->salmax * 100000;
                        }

                        $expLevel = $cityListStatus = 0;

                        $cityListAll = Yii::app()->db->createCommand()
                                ->select('id')
                                ->from('city')
                                ->where('status=:status', array(':status' => 1))
                                ->order('name ASC')
                                ->queryAll();
                        foreach ($cityListAll as $key => $value) {
                            $cityList[] = $value['id'];
                        }
                        if (isset($model->locations) && !empty($model->locations)) {
                            $cityListString = $model->locations;
                            $cityList = explode(",", $cityListString);
                        }
                        $cityList = array_filter($cityList);
                        $listArrayAll = Yii::app()->db->createCommand()
                                ->select('id')
                                ->from('subcategory')
                                ->where('status=:status', array(':status' => 1))
                                ->order('updated_on DESC')
                                ->queryAll();

                        foreach ($listArrayAll as $key => $value) {
                            $listArray[] = $value['id'];
                        }
                        $skillArrayAll = Yii::app()->db->createCommand()
                                ->select('id')
                                ->from('skillsub')
                                ->where('status=:status', array(':status' => 1))
                                ->order('updated_on DESC')
                                ->queryAll();
                        foreach ($skillArrayAll as $key => $value) {
                            $skillArray[] = $value['id'];
                        }
                        if (isset($model->skills) && !empty($model->skills)) {
                            $skillString = $model->skills;
                            $skillArray = explode(",", $skillString);
                        }


                        if (isset($model->category) && !empty($model->category)) {
                            $subCatString = $model->category;
                            $listArray = explode(",", $subCatString);
                        }


//                   $criteria=new CDbCriteria();
//                        $criteria->select = 't.*.mp.*';
//                        $criteria->join ='JOIN memberpersonal mp ON mp.user_id=t.id'; 
//                        $criteria->join ='LEFT JOIN memberuploads mu ON mu.user_id=t.id';  
//                        $criteria->order = 't.updated_on DESC';
//                        $count=User::model()->count($criteria);
//                        $pages=new CPagination($count);
//                        // results per page
//                        $pages->pageSize=1;
//                        $pages->applyLimit($criteria);
                        $pageSize = $to = 10;
                        $from = 0;
                        if (isset($_GET['page'])) {
                            $from = ($_GET['page'] - 1) * $pageSize;
                            $to = ($_GET['page']) * $pageSize;
                        }

                        $modelsq = Yii::app()->db->createCommand()
                                ->select('u.*,mp.*,mu.*,u.id as user_id')
                                ->from('user u')
                                ->join('memberpersonal mp', 'mp.user_id=u.id')
                                ->leftJoin('memberuploads mu', 'mu.user_id=u.id')
                                ->where(array('in', 'mp.current_location', $cityList))
                                ->orWhere(array('in', 'mp.preferred_location', $cityList))
                                ->andWhere(array('in', 'mp.industry', $listArray))
                                ->andWhere('mp.expyear>=:expmin AND mp.expyear<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                                ->andWhere('mp.expected_salary>=:salmin AND mp.expected_salary<=:salmax', array(':salmin' => $minsal, ':salmax' => $maxsal))
                                ->andWhere(array('in', 'mp.functional_area', $skillArray))
                                ->order('u.updated_on DESC')
                                ->queryAll();
                        $models = Yii::app()->db->createCommand()
                                ->select('u.*,mp.*,mu.*,u.id as user_id')
                                ->from('user u')
                                ->join('memberpersonal mp', 'mp.user_id=u.id')
                                ->leftJoin('memberuploads mu', 'mu.user_id=u.id')
                                ->where(array('in', 'mp.current_location', $cityList))
                                ->orWhere(array('in', 'mp.preferred_location', $cityList))
                                ->andWhere(array('in', 'mp.industry', $listArray))
                                ->andWhere('mp.expyear>=:expmin AND mp.expyear<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                                ->andWhere('mp.expected_salary>=:salmin AND mp.expected_salary<=:salmax', array(':salmin' => $minsal, ':salmax' => $maxsal))
                                ->andWhere(array('in', 'mp.functional_area', $skillArray))
                                ->order('u.updated_on DESC')
                                ->limit($pageSize, $from)
                                ->queryAll();

                        $count = count($modelsq);
                        $pages = new CPagination($count);
                        // results per page
                        $pages->pageSize = 10;
                        $this->render('resumefinderreports', array(
                            'models' => $models,
                            'pages' => $pages, 'count' => $count
                        ));
                    } else {
                        
                    }
                } else {
                    
                }
            } else {
                $this->render('resumefinder');
            }
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionupdateSavedResumeSearch($id) {

        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $this->layout = '//layouts/recriuterhome';
            if (isset($id) && !empty($id)) {
                $model = Resumefinder::model()->findByPk($id);

                if (isset($model) && !empty($model)) {
                    $listArray = $cityList = array();
                    $subCatString = $cityListString = $skillString = '';
                    $minExp = $minsal = 0;
                    $maxsal = 100000 * 100;
                    $maxExp = 100;
                    if (isset($model->expmin) && !empty($model->expmin)) {
                        $minExp = $model->expmin;
                    }
                    if (isset($model->expmax) && !empty($model->expmax)) {
                        $maxExp = $model->expmax;
                    }
                    if (isset($model->salmin) && !empty($model->salmin)) {
                        $minsal = $model->salmin * 100000;
                    }
                    if (isset($model->salmax) && !empty($model->salmax)) {
                        $maxsal = $model->salmax * 100000;
                    }

                    $expLevel = $cityListStatus = 0;

                    $cityListAll = Yii::app()->db->createCommand()
                            ->select('id')
                            ->from('city')
                            ->where('status=:status', array(':status' => 1))
                            ->order('name ASC')
                            ->queryAll();
                    foreach ($cityListAll as $key => $value) {
                        $cityList[] = $value['id'];
                    }
                    if (isset($model->locations) && !empty($model->locations)) {
                        $cityListString = $model->locations;
                        $cityList = explode(",", $cityListString);
                    }
                    $cityList = array_filter($cityList);
                    $listArrayAll = Yii::app()->db->createCommand()
                            ->select('id')
                            ->from('subcategory')
                            ->where('status=:status', array(':status' => 1))
                            ->order('updated_on DESC')
                            ->queryAll();

                    foreach ($listArrayAll as $key => $value) {
                        $listArray[] = $value['id'];
                    }
                    $skillArrayAll = Yii::app()->db->createCommand()
                            ->select('id')
                            ->from('skillsub')
                            ->where('status=:status', array(':status' => 1))
                            ->order('updated_on DESC')
                            ->queryAll();
                    foreach ($skillArrayAll as $key => $value) {
                        $skillArray[] = $value['id'];
                    }
                    if (isset($model->skills) && !empty($model->skills)) {
                        $skillString = $model->skills;
                        $skillArray = explode(",", $skillString);
                    }


                    if (isset($model->category) && !empty($model->category)) {
                        $subCatString = $model->category;
                        $listArray = explode(",", $subCatString);
                    }

                    $pageSize = $to = 10;
                    $from = 0;
                    if (isset($_GET['page'])) {
                        $from = ($_GET['page'] - 1) * $pageSize;
                        $to = ($_GET['page']) * $pageSize;
                    }

                    $modelsq = Yii::app()->db->createCommand()
                            ->select('u.*,mp.*,mu.*,u.id as user_id')
                            ->from('user u')
                            ->join('memberpersonal mp', 'mp.user_id=u.id')
                            ->leftJoin('memberuploads mu', 'mu.user_id=u.id')
                            ->where(array('in', 'mp.current_location', $cityList))
                            ->orWhere(array('in', 'mp.preferred_location', $cityList))
                            ->andWhere(array('in', 'mp.industry', $listArray))
                            ->andWhere('mp.expyear>=:expmin AND mp.expyear<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                            ->andWhere('mp.expected_salary>=:salmin AND mp.expected_salary<=:salmax', array(':salmin' => $minsal, ':salmax' => $maxsal))
                            ->andWhere(array('in', 'mp.functional_area', $skillArray))
                            ->order('u.updated_on DESC')
                            ->queryAll();
                    $models = Yii::app()->db->createCommand()
                            ->select('u.*,mp.*,mu.*,u.id as user_id')
                            ->from('user u')
                            ->join('memberpersonal mp', 'mp.user_id=u.id')
                            ->leftJoin('memberuploads mu', 'mu.user_id=u.id')
                            ->where(array('in', 'mp.current_location', $cityList))
                            ->orWhere(array('in', 'mp.preferred_location', $cityList))
                            ->andWhere(array('in', 'mp.industry', $listArray))
                            ->andWhere('mp.expyear>=:expmin AND mp.expyear<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                            ->andWhere('mp.expected_salary>=:salmin AND mp.expected_salary<=:salmax', array(':salmin' => $minsal, ':salmax' => $maxsal))
                            ->andWhere(array('in', 'mp.functional_area', $skillArray))
                            ->order('u.updated_on DESC')
                            ->limit($pageSize, $from)
                            ->queryAll();

                    $count = count($modelsq);
                    $pages = new CPagination($count);
                    // results per page
                    $pages->pageSize = 10;
                    $this->render('resumefinderreports', array(
                        'models' => $models,
                        'pages' => $pages, 'count' => $count
                    ));
                } else {
                    $this->redirect(array('Recruiter/resumeFeedSavedSearch'));
                }
            } else {
                $this->render('resumefinder');
            }
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionresumeFeedSaved($id) {

        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $this->layout = '//layouts/recriuterhome';
            if (isset($id) && !empty($id)) {
                $model = Resumefinder::model()->find('id=:id', array(':id' => $id));
                if (Yii::app()->user->recId == $model->user_id) {
                    if (isset($model) && !empty($model)) {
                        $listArray = $cityList = array();
                        $subCatString = $cityListString = $skillString = '';
                        $minExp = $minsal = 0;
                        $maxsal = 100000 * 100;
                        $maxExp = 100;
                        if (isset($model->expmin) && !empty($model->expmin)) {
                            $minExp = $model->expmin;
                        }
                        if (isset($model->expmax) && !empty($model->expmax)) {
                            $maxExp = $model->expmax;
                        }
                        if (isset($model->salmin) && !empty($model->salmin)) {
                            $minsal = $model->salmin * 100000;
                        }
                        if (isset($model->salmax) && !empty($model->salmax)) {
                            $maxsal = $model->salmax * 100000;
                        }

                        $expLevel = $cityListStatus = 0;



                        if (isset($model->locations)) {
                            $cityListString = $model->locations;
                        }
                        $cityList = explode(",", $cityListString);
                        $cityList = array_filter($cityList);
                        if (isset($model->category) && !empty($model->category)) {
                            $subCatString = $model->category;
                        }
                        $listArray = explode(",", $subCatString);
                        $listArray = array_filter($listArray);

                        $pageSize = $to = 10;
                        $from = 0;
                        if (isset($_GET['page'])) {
                            $from = ($_GET['page'] - 1) * $pageSize;
                            $to = ($_GET['page']) * $pageSize;
                        }

                        $modelsq = Yii::app()->db->createCommand()
                                ->select('u.*,mp.*,mu.*,u.id as user_id')
                                ->from('user u')
                                ->join('memberpersonal mp', 'mp.user_id=u.id')
                                ->leftJoin('memberuploads mu', 'mu.user_id=u.id')
                                ->where(array('in', 'mp.industry', $listArray))
                                ->orWhere(array('in', 'mp.functional_area', $skillArray))
                                ->orWhere('mp.expyear>=:expmin AND mp.expyear<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                                ->orWhere('mp.expected_salary>=:salmin AND mp.expected_salary<=:salmax', array(':salmin' => $minsal, ':salmax' => $maxsal))
//                                ->where(array('in', 'mp.current_location',$cityList))
                                ->orWhere(array('in', 'mp.preferred_location', $cityList))
                                ->order('u.updated_on DESC')
                                ->queryAll();
                        $models = Yii::app()->db->createCommand()
                                ->select('u.*,mp.*,mu.*,u.id as user_id')
                                ->from('user u')
                                ->join('memberpersonal mp', 'mp.user_id=u.id')
                                ->leftJoin('memberuploads mu', 'mu.user_id=u.id')
                                ->where(array('in', 'mp.industry', $listArray))
                                ->orWhere(array('in', 'mp.functional_area', $skillArray))
                                ->orWhere('mp.expyear>=:expmin AND mp.expyear<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                                ->orWhere('mp.expected_salary>=:salmin AND mp.expected_salary<=:salmax', array(':salmin' => $minsal, ':salmax' => $maxsal))
//                                ->where(array('in', 'mp.current_location',$cityList))
                                ->orWhere(array('in', 'mp.preferred_location', $cityList))
                                ->order('u.updated_on DESC')
                                ->limit($pageSize, $from)
                                ->queryAll();

                        $count = count($modelsq);
                        $pages = new CPagination($count);
                        // results per page
                        $pages->pageSize = 10;
                        $this->render('resumefinderreports', array(
                            'models' => $models,
                            'pages' => $pages, 'count' => $count
                        ));
                    } else {
                        
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!You are not an Authorised person to view this result...Please Try Later...!");
                    $this->render('resumefinder');
                }
            } else {
                $this->render('resumefinder');
            }
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionupdateSavedResumeFinder($id) {

        if (isset(Yii::app()->user->isRecruiter) && !empty(Yii::app()->user->isRecruiter)) {
            $this->layout = '//layouts/recriuterhome';
            if (isset($id) && !empty($id)) {
                $model = Resumefinder::model()->find('id=:id', array(':id' => $id));

                if (Yii::app()->user->recId == $model->user_id) {

                    if (isset($model) && !empty($model)) {

                        $this->render('updateresumefinder', array(
                            'model' => $model));
                    } else {
                        Yii::app()->user->setFlash('error', "Oops...!You are not an Authorised person to view this result...Please Try Later...!");
                        $this->render('resumefinder');
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!You are not an Authorised person to view this result...Please Try Later...!");
                    $this->render('resumefinder');
                }
            } else {
                Yii::app()->user->setFlash('error', "Oops...!You are not an Authorised person to view this result...Please Try Later...!");
                $this->render('resumefinder');
            }
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

    public function actionresumeFeedSavedSearch() {
        $this->layout = '//layouts/recriuterhome';
        if (isset(Yii::app()->user->recId) && !empty(Yii::app()->user->recId)) {

            $pageSize = $to = 10;
            $from = 0;
            if (isset($_GET['page'])) {
                $from = ($_GET['page'] - 1) * $pageSize;
                $to = ($_GET['page']) * $pageSize;
            }
            $modelsq = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('resumefinder')
                    ->where('user_id=:user_id', array(':user_id' => Yii::app()->user->recId))
                    ->order('updated_on DESC')
                    ->queryAll();
            $models = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('resumefinder')
                    ->where('user_id=:user_id', array(':user_id' => Yii::app()->user->recId))
                    ->order('updated_on DESC')
                    ->limit($pageSize, $from)
                    ->queryAll();

            $count = count($modelsq);
            $pages = new CPagination($count);
            // results per page
            $pages->pageSize = 10;
            $this->render('resumefindersavedsearch', array(
                'models' => $models,
                'pages' => $pages, 'count' => $count
            ));
        } else {
            $this->redirect(array('Recruiter/index'));
        }
    }

}
