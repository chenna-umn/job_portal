<?php

class SiteController extends Controller {

//	public $layout='mainv';
//        public $defaultAction = 'index';
    public $defaultAction = 'accessPermission';

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionaccessPermission() {
        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/register';
        if (isset($_POST)) {
            if (isset($_POST['password']) && strtoupper($_POST['password']) == "SIT") {
                $this->redirect(array('site/index'));
            } else {
                Yii::app()->user->setFlash('error', "Please Provide valid Password...! To get HomePage");
                $this->render('accessPermission');
            }
        } else {
            $this->render('accessPermission');
        }
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/mainv';
        $Categories = Category::model()->findAllByAttributes(
                array(
            'display_on_top' => 1
                ), array(
            'order' => 'name asc',
                ));
        $this->render('index', array('Categories' => $Categories));
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        $this->layout = '//layouts/error';
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (!defined('CRYPT_BLOWFISH') || !CRYPT_BLOWFISH)
            throw new CHttpException(500, "This application requires that PHP was compiled with Blowfish support for crypt().");

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            Yii::app()->user->setState('type', $_POST['LoginForm']['user_type']);
            // validate user input and redirect to the previous page if valid
            if ($model->login()) {
                if (Yii::app()->user->userType == 1) {
                    $this->redirect(array('admin/index'));
                } else if (Yii::app()->user->userType == 2) {
                    $this->redirect(array('Recruiter/dashboard'));
                } else if (Yii::app()->user->userType == 4) {
//                                 $this->redirect(array('Member/create1','id'=>Yii::app()->user->memberId));
                    $this->redirect(array('Member/jobfeed'));
                }
            }
        }
        // display the login form
        $this->layout = '//layouts/register';
        Yii::app()->user->setFlash('error', "Please Provide valid Username / Password...!");
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {

        $this->layout = '//layouts/mainv';
        Yii::app()->user->logout();
        $this->redirect('index');

        //$this->redirect(Yii::app()->homeUrl);
    }

    /**
     * To check that email is already registered or not
     */
    public function actioncheckemail() {

        if (isset($_POST['email'])) {
            $model = User::model()->find('username=:username', array(':username' => $_POST['email']));
            if (isset($model) && !empty($model)) {
                echo "registered";
            } else {
                echo "notregistered";
            }
        } else {
            echo "notset";
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
                                    Yii::app()->user->setFlash('success', "Your Account is  Activated Successfully...Please login from brlow, With your Credentials.");
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

    public function actionForgotPassword() {

        $this->layout = '//layouts/register';
        if (isset($_POST['ForgotPassword'])) {
            $user = User::model()->find('LOWER(username)=?', array(strtolower($_POST['ForgotPassword']['username'])));
            if (isset($user) && !empty($user)) {

                require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                $mail = new PHPMailer();
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
                                <title>Job Portal Forgot Password</title>

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
                                                                            <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                Dear , ' . $user->username . ' ,                            
                                                                           </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                Please click on the following link to reset your password:                        
                                                                           </td>
                                                                        </tr>  
                                                                         <tr>
                                                                                <td valign="top" class="left" style="padding: 7px 15px; text-align: center; background-color: #27d7e7;">
                                                                                        <a href="' . Yii::app()->request->baseUrl . '/site/updatePassword?link=' . $user->activation_code . '&mail=' . md5($user->username) . '" style="color: #fff; font-size: 12px; font-weight: bold; text-decoration: none; font-family: Arial, sans-serif; text-alight: center;">Reset Password</a>
                                                                                    </td>                                                                                                                    
                                                                            </tr> 
                                                                            <tr>
                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                        In case the above link does not work, copy and paste the following URL onto the address bar of your browser.
                                                                                   </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                        <a href="' . Yii::app()->request->baseUrl . '/site/updatePassword?link=' . $user->activation_code . '&mail=' . md5($user->username) . '">' . Yii::app()->request->baseUrl . '/site/updatePassword?link=' . $user->activation_code . '&mail=' . md5($user->username) . '</a>                         
                                                                                   </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                        SuryaJobs recommends that you change your password to something you can easily remember.
                                                                                         Please note that your password length must be in the range of 6-15 characters.

                                                                                   </td>
                                                                                </tr>
                                                                                <tr>
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
                                                                                </tr>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
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
                $mail->SMTPDebug = 2;                   // 2 = messages only
                $mail->SMTPAuth = true;                  // enable SMTP authentication
                $mail->Host = "mail.suryaitsystems.com"; // sets the SMTP server
                //$mail->Port       = 465;                    // set the SMTP port for the GMAIL server
                $mail->Username = "keshav@suryaitsystems.com"; // SMTP account username
                $mail->Password = 'suryait';
                $mail->SetFrom('keshav@suryaitsystems.com', 'JOB PORTAL SIT');
                $mail->AddReplyTo("keshav@suryaitsystems.com", "JOB PORTAL SIT");
                $mail->Subject = "JOB PORTAL SIT Forgot Password";
//                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                $mail->MsgHTML($body);        // SMTP password
//                    $mail->SMTPSecure = 'tls';
                $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                $mail->Port = 587;
                $address = $user->username;
                $mail->AddAddress($address, $user->username);
                //$mail->SMTPDebug  = 1;     
                $mail->isHTML(true);

                //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

                if (!$mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                    exit;
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Submitting Query...Please Try Later...!");
                } else {
                    echo "dsadsadas";
                    exit;
                    Yii::app()->user->setFlash('success', "Reset Password link sent to your mail...Please Proceed further to update Password");
                }
            } else {
                Yii::app()->user->setFlash('error', "No user is registered with given email with us. Please Provide valid Email.!");
            }
            $this->render('forgotpassword');
        } else {
            $this->render('forgotpassword');
        }
    }

    public function actionUpdatePassword() {

        $this->layout = '//layouts/register';

        if (isset($_GET['link']) && $_GET['mail']) {
            $checkUser = User::model()->find('activation_code=:activation_code', array(':activation_code' => $_GET['link']));
            if (isset($checkUser) && !empty($checkUser)) {
                if (md5($checkUser->username) == $_GET['mail']) {
                    $this->render('updatepassword', array('activation_code' => $_GET['link']));
                } else {
                    Yii::app()->user->setFlash('error', "You are not Authorized to Activate account..Please Try Later...!");
                    $this->render('forgotpassword');
                }
            } else {
                Yii::app()->user->setFlash('error', "Reset Password  Link is Not Valid");
                $this->render('forgotpassword');
            }
        }
    }

    public function actionUpdatePasswordConfirm() {

        $this->layout = '//layouts/register';
        if (isset($_POST['UpdatePassword'])) {

            $checkUser = User::model()->find('activation_code=:activation_code', array(':activation_code' => $_POST['link']));
            if (isset($checkUser) && !empty($checkUser)) {
                $checkUser->password = md5($_POST['UpdatePassword']['password']);
                if ($checkUser->validate()) {
                    if ($checkUser->save()) {

                        require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                        $mail = new PHPMailer();
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
                                                        <title>Job Portal Password Updated</title>

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
                                                                                                        Dear , ' . $checkUser->username . '                            
                                                                                                   </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td  class="center" style="font-size: 14px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                        Password Updated Successfully                         
                                                                                                   </td>
                                                                                                </tr>  
                                                                                                                                                                                                                     
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
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
                        $mail->Subject = "JOB PORTAL SIT Forgot Password";
                        //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                        $mail->MsgHTML($body);        // SMTP password
//                                            $mail->SMTPSecure = 'tls';
                        $mail->ConfirmReadingTo = "chinna1754@gmail.com";
                        $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                        $mail->Port = 587;
                        $address = $checkUser->username;
                        $mail->AddAddress($address, $checkUser->username);
                        //$mail->SMTPDebug  = 1;     
                        $mail->isHTML(true);

                        //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                        //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

                        if (!$mail->Send()) {
                            //  echo "Mailer Error: " . $mail->ErrorInfo;
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Updating Password...Please Try Later...!");
                        } else {
                            Yii::app()->user->setFlash('success', "Password Updated Successfully");
                            $this->render('login');
                        }
                    }
                }
            } else {
                Yii::app()->user->setFlash('error', "No user is registered with given email with us. Please Provide valid Email.!");
                $this->render('forgotpassword');
            }
        } else {
            $this->render('forgotpassword');
        }
    }

    public function actionchangePassword() {

        $user = new User();
        if (Yii::app()->user->userType == 2) {
            $this->layout = '//layouts/recriuterhome';
            $user = User::model()->findByPk(Yii::app()->user->recId);
        } else if (Yii::app()->user->userType == 4) {
            $this->layout = '//layouts/mainv1';
            $user = User::model()->findByPk(Yii::app()->user->memberId);
        }
        if (isset($user) && !empty($user)) {
            $this->render('changepassword', array('currentPasword' => $user->password));
        } else {
            $this->render('changepassword');
        }
    }

    public function actionchangePasswordConfirm() {
        $this->layout = '//layouts/mainv1';
        $user = new User();
        if (Yii::app()->user->userType == 2) {
            $user = User::model()->findByPk(Yii::app()->user->recId);
        } else if (Yii::app()->user->userType == 4) {
            $user = User::model()->findByPk(Yii::app()->user->memberId);
        }
        if (isset($_POST['originalpwd']) && !empty($_POST['originalpwd']) && (md5($_POST['originalpwd']) == $_POST['orgpwd'])) {
            if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['passwordConfirm']) && !empty($_POST['passwordConfirm']) && ($_POST['passwordConfirm'] == $_POST['password'] )) {
                if (md5($_POST['password']) == $_POST['orgpwd']) {
                    if (isset($user) && !empty($user)) {
                        Yii::app()->user->setFlash('error', "Current Password and New passwords are Same...Please Try again with Valid Details.");
                        $this->render('changepassword', array('currentPasword' => $user->password));
                    } else {
                        Yii::app()->user->setFlash('error', "Current Password and New passwords are Same...Please Try again with Valid Details.");
                        $this->render('changepassword');
                    }
                } else {
                    $user->password = md5($_POST['password']);
                    $user->updated_on = date('Y-m-d h:i:s');
                    if ($user->validate()) {
                        if ($user->save()) {
                            require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                            $mail = new PHPMailer();
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
                                                        <title>Job Portal Password changed successfully</title>

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
                                                                                                    <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                        Dear , ' . $checkUser->username . ' ,                           
                                                                                                   </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                        Your password has been changed successfully.Please let us know immediately if this wasn\'t done by you.                         
                                                                                                   </td>
                                                                                                </tr>  
                                                                                                <tr>
                                                                                                        <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                            SuryaJobs recommends that you change your password every month and use as strong a password as possible for maximum security.
                                                                                                       </td>
                                                                                                    </tr>
                                                                                                    
                                                                                                    <tr>
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
                                                                                                    </tr>                                                                                                                     
                                                                                            </table>
                                                                                        </td>
                                                                                    </tr>
                                                                                </table>
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
                            $mail->Subject = "JOB PORTAL SIT Password changed successfully";
                            //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                            $mail->MsgHTML($body);        // SMTP password
//                                            $mail->SMTPSecure = 'tls';
                            $mail->ConfirmReadingTo = "chinna1754@gmail.com";
                            $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                            $mail->Port = 587;
                            $address = $checkUser->username;
                            $mail->AddAddress($address, $checkUser->username);
                            //$mail->SMTPDebug  = 1;     
                            $mail->isHTML(true);

                            //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                            //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

                            if (!$mail->Send()) {
                                //  echo "Mailer Error: " . $mail->ErrorInfo;
                                Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Updating Password...Please Try Later...!");
                            } else {
                                Yii::app()->user->setFlash('success', "Password is updated Successfully.");
                                $this->render('changepassword', array('currentPasword' => $user->password));
                            }
                        }
                    }
                }
            } else {
                if (isset($user) && !empty($user)) {
                    Yii::app()->user->setFlash('error', "New Password and Verify New Passwords are not matching...Please Try again with Valid Details.");
                    $this->render('changepassword', array('currentPasword' => $user->password));
                } else {
                    Yii::app()->user->setFlash('error', "New Password and Verify New Passwords are not matching...Please Try again with Valid Details.");
                    $this->render('changepassword');
                }
            }
        } else {
            if (isset($user) && !empty($user)) {
                Yii::app()->user->setFlash('error', "Current Password is not matching with your Given Password...Please Try again with Valid Details.");
                $this->render('changepassword', array('currentPasword' => $user->password));
            } else {
                Yii::app()->user->setFlash('error', "Current Password is not matching with your Given Password...Please Try again with Valid Details.");
                $this->render('changepassword');
            }
        }
    }

    public function actionemailSettings() {
        $this->layout = '//layouts/mainv1';

        if (Yii::app()->user->userType == 2) {
            $model = Emailsettings::model()->find('user_id=:user_id', array(':user_id' => Yii::app()->user->recId));
        } else if (Yii::app()->user->userType == 4) {
            $model = Emailsettings::model()->find('user_id=:user_id', array(':user_id' => Yii::app()->user->memberId));
        }
        if (!isset($model) && empty($model)) {
            $model = new Emailsettings();
        }
        if (isset($_POST['Emailsettings'])) {

            $model->daily_news_jobs = isset($_POST['Emailsettings']['daily_news_jobs']) ? 1 : 0;
            $model->applied_jobs = isset($_POST['Emailsettings']['applied_jobs']) ? 1 : 0;
            $model->recruiter_action = isset($_POST['Emailsettings']['recruiter_action']) ? 1 : 0;
            $model->promotional = isset($_POST['Emailsettings']['promotional']) ? 1 : 0;
            $model->follow_up = isset($_POST['Emailsettings']['follow_up']) ? 1 : 0;
            $model->hide_profile = isset($_POST['Emailsettings']['hide_profile']) ? 1 : 0;
            if (Yii::app()->user->userType == 2) {
                $model->user_id = Yii::app()->user->recId;
            } else if (Yii::app()->user->userType == 4) {
                $model->user_id = Yii::app()->user->memberId;
            }
            $model->created_on = date('Y-m-d h:i:s');
            $model->updated_on = date('Y-m-d h:i:s');
            if ($model->validate()) {
                if ($model->save()) {
                    Yii::app()->user->setFlash('success', "Email Settings are Updated Successfully");
                    $this->render('emailsettings', array('model' => $model));
                }
            } else {
                print_r($model->getErrors());
                exit;
                Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While updating Email Settings...Please Try Later...!");
                $this->render('emailsettings', array('model' => $model));
            }
        } else {
            $model = new Emailsettings();
            $this->render('emailsettings', array('model' => $model));
        }
    }

    public function actionSearchBySubcat($id) {
        $this->layout = '//layouts/mainv1';
        $jobsList = array();
        $limit = 1;
        if (isset($id) && !empty($id)) {
            $jobsList = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('jobpostings')
                    ->where('subcat_id=:subcat_id', array(':subcat_id' => $id))
                    ->order('updated_on DESC')
                    ->limit($limit, 0)
                    ->queryAll();
        }
        $this->render('results', array('jobsList' => $jobsList, 'subCatId' => $id, 'limit' => $limit));
    }

    public function actionsearchJob() {
        $this->layout = '//layouts/mainv1';
        $jobsList = array();
        $limit = 1;
        $resultArray = array();
        if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
            $jobsList = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('jobpostings')
                    ->where('jobtitle LIKE :name OR keyword1 LIKE :name 
                                 OR keyword2 LIKE :name OR keyword3 LIKE :name                                 
                                 OR keyword4 LIKE :name OR keyword5 LIKE :name
                                 OR keyword6 LIKE :name OR keyword7 LIKE :name
                                 OR keyword8 LIKE :name OR keyword9 LIKE :name 
                                 OR keyword10 LIKE :name', array(':name' => '%' . trim($_POST['keyword']) . '%'))
                    ->order('updated_on DESC')
                    ->limit($limit, 0)
                    ->queryAll();

            if (isset($_POST['location']) && !empty($_POST['location'])) {
                foreach ($jobsList as $key => $value) {
                    $cityList1 = explode(",", $value['locations']);
                    $cityList1 = array_filter($cityList1);
                    $city = City::model()->find('name=:name', array(':name' => $_POST['location']));
                    if (isset($city) && !empty($city)) {
                        if (in_array($city->id, $cityList1)) {
                            $resultArray[$key] = $value;
                        }
                    }
                }
            } else {
                $resultArray = $jobsList;
            }
        }

        $this->render('searchresults', array('jobsList' => $resultArray, 'keyword' => $_POST['keyword'], 'limit' => $limit, 'cityList' => isset($_POST['location']) ? $_POST['location'] : ''));
    }

    public function actionsearchJobAdvanced() {
        $this->layout = '//layouts/mainv1';
        if (isset($_POST['keyword'])) {
            $jobsList = array();
            $limit = 1;
            $resultArray = array();

            $salMin = isset($_POST['salmin']) ? $_POST['salmin'] * 100000 : 0;
            $salMax = isset($_POST['salmax']) ? $_POST['salmax'] * 100000 : 10000 * 100000;
            $expMin = isset($_POST['expmin']) ? $_POST['expmin'] : 0;
            $expMax = isset($_POST['expmax']) ? $_POST['expmax'] : 100;
            if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {

                $jobsList = Yii::app()->db->createCommand()
                        ->select('*')
                        ->from('jobpostings')
                        ->where('(jobtitle LIKE :name OR keyword1 LIKE :name 
                                 OR keyword2 LIKE :name OR keyword3 LIKE :name                                 
                                 OR keyword4 LIKE :name OR keyword5 LIKE :name
                                 OR keyword6 LIKE :name OR keyword7 LIKE :name
                                 OR keyword8 LIKE :name OR keyword9 LIKE :name 
                                 OR keyword10 LIKE :name)  AND (salmin>=:salmin AND salmax<=:salmax)
                                 AND (expmin>=:expmin AND expmax<=:expmax)', array(':name' => '%' . trim($_POST['keyword']) . '%', ':salmin' => $salMin, 'salmax' => $salMax, 'expmin' => $expMin, 'expmax' => $expMax))
                        ->order('updated_on DESC')
//                        ->limit($limit,0)
                        ->queryAll();


                foreach ($jobsList as $key => $value) {

                    if (isset($_POST['location']) && !empty($_POST['location'])) {
                        $cityList1 = explode(",", $value['locations']);
                        $cityList1 = array_filter($cityList1);
                    }

                    if (isset($_POST['category']) && !empty($_POST['category'])) {

                        $catList = explode(",", $value['subcat_id']);
                        $catList = array_filter($catList);
                    }
                    if (isset($_POST['skills']) && !empty($_POST['skills'])) {

                        $skillList = explode(",", $value['skill_id']);
                        $skillList = array_filter($skillList);
                    }

                    if (isset($cityList1) && isset($catList) && isset($skillList)) {
                        $city = City::model()->find('name=:name', array(':name' => $_POST['location']));
                        if (in_array($city->id, $cityList1) || in_array($_POST['category'], $catList) || in_array($_POST['skills'], $skillList)) {
                            $resultArray[$key] = $value;
                        }
                    } else {
                        $resultArray = $jobsList;
                    }
                }
            }
//               echo "<pre>";
//                   print_r($_POST);
//                     print_r($resultArray);exit;
            $this->render('searchresultsadvance', array('jobsList' => $resultArray));
        } else {
            $this->redirect('index');
        }
    }

    public function actionSearchJobsByLimit() {
        $jobsList = array();
        $limit = 1;
        $result = '';
        $resultArray = array();
        if (isset($_POST['keyword']) && !empty($_POST['keyword'])) {
            $jobsList = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('jobpostings')
                    ->where('jobtitle LIKE :name OR keyword1 LIKE :name 
                                 OR keyword2 LIKE :name OR keyword3 LIKE :name                                 
                                 OR keyword4 LIKE :name OR keyword5 LIKE :name
                                 OR keyword6 LIKE :name OR keyword7 LIKE :name
                                 OR keyword8 LIKE :name OR keyword9 LIKE :name 
                                 OR keyword10 LIKE :name', array(':name' => '%' . trim($_POST['keyword']) . '%'))
                    ->order('updated_on DESC')
                    ->limit($limit, $_POST['limit'])
                    ->queryAll();

            if (isset($_POST['location']) && !empty($_POST['location'])) {
                foreach ($jobsList as $key => $value) {
                    $cityList1 = explode(",", $value['locations']);
                    $cityList1 = array_filter($cityList1);
                    $city = City::model()->find('name=:name', array(':name' => $_POST['location']));
                    if (isset($city) && !empty($city)) {
                        if (in_array($city->id, $cityList1)) {
                            $resultArray[$key] = $value;
                        }
                    }
                }
            } else {
                $resultArray = $jobsList;
            }
        }
        if (isset($resultArray) && !empty($resultArray)) {
            foreach ($resultArray as $key => $value) {
                $result.='<div class="inner-results">
                                    <div class="col-md-2" style="padding-left: 5px; padding-right: 5px;">
                                        <ul class="list-inline down-ul">
                                        <li>
                                            <ul class="list-inline star-vote">
                                                <li style="padding-left: 2px; padding-right: 2px;"><i class="color-green fa fa-suitcase"></i></li>
                                                <li style="padding-left: 2px; padding-right: 2px;"><i class="fa fa-bookmark"></i></li>
                                                <li style="padding-left: 2px; padding-right: 2px;"><i class="fa fa-star-o"></i></li>
                                                <li style="padding-left: 2px; padding-right: 2px;"><i class="fa fa-download"></i></li>                                
                                            </ul>
                                        </li>                        
                                    </ul>
                                    </div>
                                    <div class="col-md-7" style="padding-left: 5px; padding-right: 5px;">
                                        <a href="' . Yii::app()->request->baseUrl . '/site/JobDescription?id=' . $value['id'] . '" style="color:#555;" target="_blank">' . $value['jobtitle'] . '</a>
                                    </div>
                                    <div class="col-md-2" style="padding-left: 5px; padding-right: 5px;">
                                        <p>' . City::model()->getLocation($value['locations']) . '</p>
                                    </div>
                                    <div class="col-md-1" style="padding-left: 5px; padding-right: 5px;">
                                         <p>' . date('Y/m/d', strtotime($value['updated_on'])) . '</p>
                                    </div>
                                </div>';
            }
        }
        echo $result;
    }

    public function actionSearchBySubcatByLimit() {
        $jobsList = array();
        $result = '';
        $limit = 10;
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            $jobsList = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('jobpostings')
                    ->where('subcat_id=:subcat_id', array(':subcat_id' => $_POST['id']))
                    ->order('updated_on DESC')
                    ->limit($limit, $_POST['limit'])
                    ->queryAll();
//                     $jobsList = Jobpostings::model()->findAll('subcat_id=:subcat_id',array(':subcat_id'=>$id));
        }

        if (isset($jobsList) && !empty($jobsList)) {
            foreach ($jobsList as $key => $value) {
                $result.='<div class="inner-results">
                                    <div class="col-md-2" style="padding-left: 5px; padding-right: 5px;">
                                        <ul class="list-inline down-ul">
                                        <li>';

                $result.='<ul class="list-inline star-vote">';
                if (Recruiterprofile::model()->getRecruiterTypeByUserId($value['user_id']) == 2) {
                    $result.='<li style="padding-left: 2px; padding-right: 2px;"><a href="javascript:void(0)" class="tooltips" data-toggle="tooltip" data-original-title="Company Job"><i class="color-green fa fa-suitcase"></i></a></li>';
                } else {
                    $result.='<li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Recruiter Firm Job"><i class="fa fa-suitcase" style="cursor:pointer;"></i></li>';
                }
                if (isset(Yii::app()->user->memberId)) {
                    $applyJob = Applyjob::model()->find('user_id=:user_id AND job_id=:job_id AND status=:status', array(':user_id' => Yii::app()->user->memberId, ':job_id' => $value['id'], ':status' => 1));
                    $saveJob = Savejob::model()->find('user_id=:user_id AND job_id=:job_id AND status=:status', array(':user_id' => Yii::app()->user->memberId, ':job_id' => $value['id'], ':status' => 1));
                    $result.='<input type="hidden" id="applystatus' . $value['id'] . '" ';
                    if (isset($applyJob) && !empty($applyJob)) {
                        $result.='value="1"';
                    } else {
                        $result.='value="0"';
                    }$result.='>';

                    $result.='<input type="hidden" id="savestatus' . $value['id'] . '" ';
                    if (isset($saveJob) && !empty($saveJob)) {
                        $result.='value="1"';
                    } else {
                        $result.='value="0"';
                    } $result.='>';
                    if (isset($applyJob) && !empty($applyJob)) {
                        $result.='<li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Applied" id="applytooltip' . $value['id'] . '" onclick="applyjob(' . $value['id'] . ')"><i class="color-green fa fa-bookmark" id="applybtn' . $value['id'] . '" style="cursor:pointer;"></i></li>';
                    } else {
                        $result.='<li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Apply to this Job" id="applytooltip' . $value['id'] . '" onclick="applyjob(' . $value['id'] . ')"><i class="fa fa-bookmark" id="applybtn' . $value['id'] . '" style="cursor:pointer;"></i></li>';
                    }
                    if (isset($saveJob) && !empty($saveJob)) {
                        $result.='<li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Saved" id="savetooltip' . $value['id'] . '" onclick="savejob(' . $value['id'] . ')" ><i class="color-green fa fa-star" id="savebtn' . $value['id'] . '" style="cursor:pointer;"></i></li>';
                    } else {
                        $result.=' <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Save this Job" id="savetooltip' . $value['id'] . '" onclick="savejob(' . $value['id'] . ')"><i class="fa fa-star" id="savebtn' . $value['id'] . '" style="cursor:pointer;"></i></li>';
                    }
                } else {
                    $result.='<li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Login to Apply"><i class="fa fa-bookmark" style="cursor:pointer;"></i></li>';
                    $result.=' <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Login to Save"><i class="fa fa-star-o" style="cursor:pointer;"></i></li>';
                }
                $result.='</ul>';

                $result.='</li>                        
                                    </ul>
                                    </div>
                                    <div class="col-md-7" style="padding-left: 5px; padding-right: 5px;">
                                        <a href="' . Yii::app()->request->baseUrl . '/site/JobDescription?id=' . $value['id'] . '" style="color:#555;" target="_blank">' . $value['jobtitle'] . '</a>
                                    </div>
                                    <div class="col-md-2" style="padding-left: 5px; padding-right: 5px;">
                                        <p>' . City::model()->getLocation($value['locations']) . '</p>
                                    </div>
                                    <div class="col-md-1" style="padding-left: 5px; padding-right: 5px;">
                                         <p>' . date('Y/m/d', strtotime($value['updated_on'])) . '</p>
                                    </div>
                                </div>';
            }
        }
        echo $result;
    }

    public function actionmemberAppliedJobs() {
        $this->layout = '//layouts/mainv1';
        if (isset($_GET['userId']) && !empty($_GET['userId'])) {

            $user = User::model()->find('id=:id', array('id' => $_GET['userId']));
            if (isset($user) && !empty($user)) {
                Yii::app()->User->setState('memberId', $user->id);
                Yii::app()->User->setState('userType', $user->user_type);
                Yii::app()->User->setState('memberName', $user->username);
                Yii::app()->User->setState('memberloggedInAt', date('Y-m-d h:i:s'));
                Yii::app()->User->setState('isMember', 1);
                Yii::app()->User->setState('isGuest', 1);
            }
        }
        $appliedJobs = array();
        $appliedJobs = Yii::app()->db->createCommand()
                ->select('jp.*,aj.*,jp.user_id as  recruiter_id')
                ->from('applyjob aj')
                ->leftJoin('jobpostings jp', 'jp.id=aj.job_id')
                ->where('aj.status>=:status AND aj.user_id<=:member_id', array('status' => 1, 'member_id' => Yii::app()->user->memberId))
                ->order('aj.id DESC')
                ->queryAll();
        $this->render('appliedjobs', array('appliedJobs' => $appliedJobs));
    }

    public function actionmemberSavedJobs() {
        $this->layout = '//layouts/mainv1';
        $savedJobs = array();
        $savedJobs = Yii::app()->db->createCommand()
                ->select('jp.*,sj.*,jp.user_id as  recruiter_id')
                ->from('savejob sj')
                ->leftJoin('jobpostings jp', 'jp.id=sj.job_id')
                ->where('sj.status>=:status AND sj.user_id<=:member_id', array('status' => 1, 'member_id' => Yii::app()->user->memberId))
                ->order('sj.id DESC')
                ->queryAll();
        $this->render('savedjobs', array('savedJobs' => $savedJobs));
    }

    public function actiondisplayActiveList() {
        $this->layout = '//layouts/mainv1';

        $Categories = Category::model()->findAllByAttributes(
                array(
            'display_on_top' => 1
                ), array(
            'order' => 'name asc',
                ));
        $this->render('resultsactivelist', array('Categories' => $Categories));
    }

    public function actiondisplayFullList() {
        $this->layout = '//layouts/mainv1';

        $Categories = Category::model()->findAllByAttributes(
                array(
            'status' => 1
                ), array(
            'order' => 'name asc',
                ));
        $this->render('resultsfulllist', array('Categories' => $Categories));
    }

    public function actionJobDescription($id) {
        $this->layout = '//layouts/mainv1';
        if (isset($_GET['userId']) && !empty($_GET['userId'])) {

            $user = User::model()->find('id=:id', array('id' => $_GET['userId']));
            if (isset($user) && !empty($user)) {
                Yii::app()->User->setState('memberId', $user->id);
                Yii::app()->User->setState('userType', $user->user_type);
                Yii::app()->User->setState('memberName', $user->username);
                Yii::app()->User->setState('memberloggedInAt', date('Y-m-d h:i:s'));
                Yii::app()->User->setState('isMember', 1);
                Yii::app()->User->setState('isGuest', 1);
            }
        }
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
        $jobDescription = Jobpostings::model()->find('id=:id', array('id' => $id));

        $jobDescription->views = $jobDescription->views + 1;
        if ($jobDescription->validate()) {
            $jobDescription->save();
        }

        $this->render('jobdesription', array('jobDescription' => $jobDescription));
    }

    public function actionLoadmore() {
        $result = '';
        for ($i = 0; $i < 100; $i++) {
            $result.='<div class="inner-results">
                    <div class="col-md-2" style="padding-left: 5px; padding-right: 5px;">
                        <ul class="list-inline down-ul">
                        <li>
                            <ul class="list-inline star-vote">
                                <li><i class="color-green fa fa-star"></i></li>
                                <li><i class="color-green fa fa-star"></i></li>
                                <li><i class="color-green fa fa-star"></i></li>
                                <li><i class="color-green fa fa-star"></i></li>
                                <li><i class="color-green fa fa-star-half-o"></i></li>
                            </ul>
                        </li>                        
                    </ul>
                    </div>
                    <div class="col-md-7" style="padding-left: 5px; padding-right: 5px;">
                        <a href="#" style="color:#555;">Web design Web design Web design Web design Web design</a>
                    </div>
                    <div class="col-md-2" style="padding-left: 5px; padding-right: 5px;">
                        <p>Delhi/NCR/Gurgaon</p>
                    </div>
                    <div class="col-md-1" style="padding-left: 5px; padding-right: 5px;">
                         <p>28/02/2015</p>
                    </div>
                </div>';
        }
        echo $result;
    }

    public function actionresumeUploadAlert() {
        ini_set('max_execution_time', 3000);
        $totalRecords = Memberuploads::model()->findAll('resume IS NULL');
        $totalCount = count($totalRecords);
        $recForLoop = 2;
        $noofloops = $totalCount / $recForLoop;
        for ($i = $recForLoop, $limitstart = 0, $k = 0; $k <= $noofloops; $i = $i + $recForLoop, $limitstart = $limitstart + $recForLoop, $k++) {
            $resultArray = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('memberuploads')
                    ->where('resume IS NULL')
                    ->order('id DESC')
                    ->limit($recForLoop, $limitstart)
                    ->queryAll();

            if (isset($resultArray) && !empty($resultArray)) {

                foreach ($resultArray as $key => $value) {
                    $memberDetails = User::model()->getMemberDetailsByUserId($value['user_id']);
                    if (isset($memberDetails) && !empty($memberDetails)) {
                        require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                        $mail = new PHPMailer();
                        //$body             = file_get_contents('contents.html');
                        $body = '                                       <!doctype html>
                                                                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                                                                    <head>
                                                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                                                    <title>JOB PORTAL SIT Member Resume Upload Missing</title>

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
                                                                                                                                    Dear , ' . $memberDetails['name'] . '( ' . $memberDetails['username'] . ')                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                           <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Please upload your resume by clicking on the following link:                         
                                                                                                                               </td>
                                                                                                                            </tr>  
                                                                                                                            
                                                                                                                            <tr>                                                                                                                                     
                                                                                                                                    <td valign="top" class="left" style="padding: 7px 15px; text-align: center; background-color: #27d7e7;">
                                                                                                                                            <a href="' . Yii::app()->request->baseUrl . '/Member/create1?id=' . $memberDetails['user_id'] . '" style="color: #fff; font-size: 12px; font-weight: bold; text-decoration: none; font-family: Arial, sans-serif; text-alight: center;">Upload your Resume</a>
                                                                                                                                    </td>  
                                                                                                                                    
                                                                                                                                </tr> 
                                                                                                                           
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                   SuryaJobs.com does not approve profiles which have not uploaded their resumes in full,so as to maintain the quality of our site.We urge you to upload your resume at the earliest to avail the full benefits of SuryaJobs.com.                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
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
//                                    echo $body;
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
                        $mail->Subject = "JOB PORTAL SIT Member Resume Upload Missing";
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
                    } else {
                        
                    }
                }
            }
        }
    }

    public function actionphotoUploadAlert() {
        ini_set('max_execution_time', 3000);
        $totalRecords = Memberuploads::model()->findAll('profile_pic IS NULL');
        $totalCount = count($totalRecords);
        $recForLoop = 2;
        $noofloops = $totalCount / $recForLoop;
        for ($i = $recForLoop, $limitstart = 0, $k = 0; $k <= $noofloops; $i = $i + $recForLoop, $limitstart = $limitstart + $recForLoop, $k++) {
            $resultArray = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('memberuploads')
                    ->where('profile_pic IS NULL')
                    ->order('id DESC')
                    ->limit($recForLoop, $limitstart)
                    ->queryAll();

            if (isset($resultArray) && !empty($resultArray)) {

                foreach ($resultArray as $key => $value) {
                    $memberDetails = User::model()->getMemberDetailsByUserId($value['user_id']);

                    if (isset($memberDetails) && !empty($memberDetails)) {
                        require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                        $mail = new PHPMailer();
                        //$body             = file_get_contents('contents.html');
                        $body = '                                       <!doctype html>
                                                                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                                                                    <head>
                                                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                                                    <title>JOB PORTAL SIT Member Photo Upload</title>

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
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Dear , ' . $memberDetails['name'] . '( ' . $memberDetails['username'] . ') Welcome to SuryaJobs.com.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    We have noted that your profile is missing some important details.Please go to your profile and fill in the missing details clicking on the link below:                         
                                                                                                                               </td>
                                                                                                                            </tr>  
                                                                                                                            
                                                                                                                            <tr>
                                                                                                                                     
                                                                                                                                    <td valign="top" class="left" style="padding: 7px 15px; text-align: center; background-color: #27d7e7;">
                                                                                                                                            <a href="' . Yii::app()->request->baseUrl . '/Member/create1?id=' . $memberDetails['user_id'] . '" style="color: #fff; font-size: 12px; font-weight: bold; text-decoration: none; font-family: Arial, sans-serif; text-alight: center;">Upload your Photo</a>
                                                                                                                                    </td>  
                                                                                                                                    
                                                                                                                                </tr> 
                                                                                                                           
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    We hope that you shall find your dream job at Suryajobs.com and that we fulfill all your expectations.                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
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
                        $mail->Subject = "JOB PORTAL SIT Photo Upload";
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
                    } else {
                        
                    }
                }
            }
        }
    }

    public function actionfillMissingDetails() {
        ini_set('max_execution_time', 3000);
        $totalRecords = User::model()->findAll('user_type=:user_type', array(':user_type' => 4));
        $totalCount = count($totalRecords);
        $recForLoop = 2;
        $noofloops = $totalCount / $recForLoop;
        for ($i = $recForLoop, $limitstart = 0, $k = 0; $k <= $noofloops; $i = $i + $recForLoop, $limitstart = $limitstart + $recForLoop, $k++) {
            $resultArray = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('user')
                    ->where('user_type=:user_type', array(':user_type' => 4))
                    ->order('id DESC')
                    ->limit($recForLoop, $limitstart)
                    ->queryAll();

            if (isset($resultArray) && !empty($resultArray)) {

                foreach ($resultArray as $key => $value) {
                    $memberPersonal = Memberpersonal::model()->find('user_id=:user_id', array(':user_id' => $value['id']));
                    $memberEducation = Membereducation::model()->find('user_id=:user_id', array(':user_id' => $value['id']));
                    $Memberprofessional = Memberprofessional::model()->find('user_id=:user_id', array(':user_id' => $value['id']));
                    $Memberuploads = Memberuploads::model()->find('user_id=:user_id', array(':user_id' => $value['id']));

                    if (empty($memberPersonal) || empty($memberEducation) || empty($Memberprofessional) || empty($Memberuploads)) {
                        $memberDetails = User::model()->getMemberDetailsByUserId($value['id']);
                    }



                    if (isset($memberDetails) && !empty($memberDetails)) {
                        require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                        $mail = new PHPMailer();
                        //$body             = file_get_contents('contents.html');
                        $body = '                                       <!doctype html>
                                                                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                                                                    <head>
                                                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                                                    <title>JOB PORTAL SIT Member Fill Missing Details</title>

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
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Dear , ' . $memberDetails['name'] . '( ' . $memberDetails['username'] . ') Welcome to SuryaJobs.com.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    We have noted that your profile is missing some important details.Please go to your profile and fill in the missing details clicking on the link below:                         
                                                                                                                               </td>
                                                                                                                            </tr>  
                                                                                                                            
                                                                                                                            <tr>
                                                                                                                                     
                                                                                                                                    <td valign="top" class="left" style="padding: 7px 15px; text-align: center; background-color: #27d7e7;">
                                                                                                                                            <a href="' . Yii::app()->request->baseUrl . '/Member/create1?id=' . $memberDetails['user_id'] . '" style="color: #fff; font-size: 12px; font-weight: bold; text-decoration: none; font-family: Arial, sans-serif; text-alight: center;">My Profile</a>
                                                                                                                                    </td>  
                                                                                                                                    
                                                                                                                                </tr> 
                                                                                                                           
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    We hope that you shall find your dream job at Suryajobs.com and that we fulfill all your expectations.                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
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
                        $mail->Subject = "JOB PORTAL SIT Member Fill Missing Details";
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
                    } else {
                        
                    }
                }
            }
        }
    }

    public function actionuserJobFeed() {
        ini_set('max_execution_time', 3000);
        $totalRecords = User::model()->findAll('user_type=:userType', array(':userType' => 4));
        $totalCount = count($totalRecords);
        $recForLoop = 2;
        $noofloops = $totalCount / $recForLoop;
        for ($i = $recForLoop, $limitstart = 0, $k = 0; $k <= $noofloops; $i = $i + $recForLoop, $limitstart = $limitstart + $recForLoop, $k++) {
            $resultArray = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('user')
                    ->where('user_type=:userType', array(':userType' => 4))
                    ->order('id DESC')
                    ->limit($recForLoop, $limitstart)
                    ->queryAll();

            if (isset($resultArray) && !empty($resultArray)) {
                foreach ($resultArray as $key => $value) {
                    $memberDetails = User::model()->getMemberDetailsByUserId($value['id']);

                    $listArray = $cityList = array();
                    $subCatString = $cityListString = '';
                    $minExp = 0;
                    $maxExp = 100;
                    $cityListAll = Yii::app()->db->createCommand()
                            ->select('id')
                            ->from('city')
                            ->where('status=:status', array(':status' => 1))
                            ->order('name ASC')
                            ->queryAll();
                    if (isset($cityListAll) && !empty($cityListAll)) {
                        foreach ($cityListAll as $key => $value1) {
                            $cityListString.= $value1['id'] . ',';
                        }
                    }

                    $cityList = explode(",", $cityListString);
                    $cityList = array_filter($cityList);
                    $subCatList = Searchfilters::model()->findAll('user_id=:user_id', array(':user_id' => $value['id']));
                    if (isset($subCatList) && !empty($subCatList)) {
                        foreach ($subCatList as $key => $value2) {
                            $subCatString.= $value2->subcat_id;
                        }
                    }

                    $listArray = explode(",", $subCatString);
                    $listArray = array_filter($listArray);
                    $this->layout = '//layouts/mainv1';
                    $jobsList = array();
                    $limit = 25;
                    if (isset($listArray) && !empty($listArray)) {
                        $jobsList = Yii::app()->db->createCommand()
                                ->select('*')
                                ->from('jobpostings')
                                ->where(array('in', 'subcat_id', $listArray))
                                ->andWhere('expmin>=:expmin AND expmax<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                                ->order('updated_on DESC')
                                ->limit($limit, 0)
                                ->queryAll();
                    }
                    if (isset($memberDetails) && !empty($memberDetails) && isset($jobsList) && !empty($jobsList)) {
                        require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                        $mail = new PHPMailer();
                        //$body             = file_get_contents('contents.html');
                        $body = '                                       <!doctype html>
                                                                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                                                                    <head>
                                                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                                                    <title>JOB PORTAL SIT Member Daily Job Alert</title>

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
                                                                                                                                    Dear , ' . $memberDetails['name'] . '( ' . $memberDetails['username'] . ') ,                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    This is your Daily Job Alert as per the filters set in your profile. Here are some of the recently posted jobs on SuryaJobs.com that will interest you: 
                                                                                                                               </td>
                                                                                                                            </tr>';
                        if (isset($jobsList) && !empty($jobsList)) {

                            foreach ($jobsList as $key => $value3) {

                                if (array_intersect(explode(',', $value3['locations']), $cityList)) {
                                    $body.='<tr>
                                                                                                                                                    <td class="left" bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px; " class="left">
                                                                                                                                                         ' . date('Y/m/d', strtotime($value3['updated_on'])) . ' - <a href="' . Yii::app()->request->baseUrl . '/site/JobDescription?userId=' . $memberDetails['user_id'] . '&id=' . $value3['id'] . '" target="_blank">' . $value3['jobtitle'] . '</a> - ' . City::model()->getLocation($value3['locations']) . '                          
                                                                                                                                                    </td>
                                                                                                                                                </tr><br>';
                                }
                            }
                        }
                        $body.='</table>
                                                                                                                    </td>
                                                                                                                </tr>
                                                                                                            </table><!--End Left Box-->

                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    <tr>
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
                        $mail->Subject = "JOB PORTAL SIT Member Daily Job Alert";
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
                    } else {
                        
                    }
                }
            }
        }
    }

    public function actionuserSimilarJobs() {
        ini_set('max_execution_time', 3000);
        $totalRecords = User::model()->findAll('user_type=:userType', array(':userType' => 4));
        $totalCount = count($totalRecords);
        $recForLoop = 2;
        $noofloops = $totalCount / $recForLoop;
        for ($i = $recForLoop, $limitstart = 0, $k = 0; $k <= $noofloops; $i = $i + $recForLoop, $limitstart = $limitstart + $recForLoop, $k++) {
            $resultArray = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('user')
                    ->where('user_type=:userType', array(':userType' => 4))
                    ->order('id DESC')
                    ->limit($recForLoop, $limitstart)
                    ->queryAll();

            if (isset($resultArray) && !empty($resultArray)) {
                foreach ($resultArray as $key => $value) {
                    $memberDetails = User::model()->getMemberDetailsByUserId($value['id']);

                    $listArray = $cityList = array();
                    $subCatString = $cityListString = '';
                    $minExp = 0;
                    $maxExp = 100;
                    $cityListAll = Yii::app()->db->createCommand()
                            ->select('id')
                            ->from('city')
                            ->where('status=:status', array(':status' => 1))
                            ->order('name ASC')
                            ->queryAll();
                    if (isset($cityListAll) && !empty($cityListAll)) {
                        foreach ($cityListAll as $key => $value1) {
                            $cityListString.= $value1['id'] . ',';
                        }
                    }

                    $cityList = explode(",", $cityListString);
                    $cityList = array_filter($cityList);
                    $subCatList = Searchfilters::model()->findAll('user_id=:user_id', array(':user_id' => $value['id']));
                    if (isset($subCatList) && !empty($subCatList)) {
                        foreach ($subCatList as $key => $value2) {
                            $subCatString.= $value2->subcat_id;
                        }
                    }

                    $listArray = explode(",", $subCatString);
                    $listArray = array_filter($listArray);
                    $this->layout = '//layouts/mainv1';
                    $jobsList = array();
                    $limit = 25;
                    if (isset($listArray) && !empty($listArray)) {
                        $jobsList = Yii::app()->db->createCommand()
                                ->select('*')
                                ->from('jobpostings')
                                ->where(array('in', 'subcat_id', $listArray))
                                ->andWhere('expmin>=:expmin AND expmax<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                                ->order('updated_on DESC')
                                ->limit($limit, 0)
                                ->queryAll();
                    }
                    if (isset($memberDetails) && !empty($memberDetails) && isset($jobsList) && !empty($jobsList)) {
                        require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                        $mail = new PHPMailer();
                        //$body             = file_get_contents('contents.html');
                        $body = '                                       <!doctype html>
                                                                                    <html xmlns="http://www.w3.org/1999/xhtml">
                                                                                    <head>
                                                                                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                                                                                    <title>JOB PORTAL SIT Similar Job alerts</title>

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
                                                                                                                                    Dear , ' . $memberDetails['name'] . '( ' . $memberDetails['username'] . ') ,                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    This is your Job Alert showing jobs found on our site which are similar to the jobs you are looking for. Please have a look at some similar jobs
                                                                                                                               </td>
                                                                                                                            </tr>';
                        if (isset($jobsList) && !empty($jobsList)) {

                            foreach ($jobsList as $key => $value3) {

                                if (array_intersect(explode(',', $value3['locations']), $cityList)) {
                                    $body.='<tr>
                                                                                                                                                    <td class="left" bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px; " class="left">
                                                                                                                                                         ' . date('Y/m/d', strtotime($value3['updated_on'])) . ' - <a href="' . Yii::app()->request->baseUrl . '/site/JobDescription?userId=' . $memberDetails['user_id'] . '&id=' . $value3['id'] . '" target="_blank">' . $value3['jobtitle'] . '</a> - ' . City::model()->getLocation($value3['locations']) . '                          
                                                                                                                                                    </td>
                                                                                                                                                </tr><br>';
                                }
                            }
                        }
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
//                                  echo $body;
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
                        $mail->Subject = "JOB PORTAL SIT Similar Job alerts";
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
                    } else {
                        
                    }
                }
            }
        }
    }

    public function actionrecriterDailyAppliedReportCumulative() {
        ini_set('max_execution_time', 3000);
        $totalRecords = User::model()->findAll('user_type=:userType', array(':userType' => 2));
        $totalCount = count($totalRecords);
        $recForLoop = 2;
        $body1 = $body2 = $body3 = '';
        $body1 = ' <!doctype html>
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>JOB PORTAL SIT Daily applied list</title>

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
                                                            ';
        $noofloops = $totalCount / $recForLoop;

        for ($i = $recForLoop, $limitstart = 0, $k = 0; $k <= $noofloops; $i = $i + $recForLoop, $limitstart = $limitstart + $recForLoop, $k++) {
            $resultArray = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('user')
                    ->where('user_type=:userType', array(':userType' => 2))
                    ->order('id DESC')
                    ->limit($recForLoop, $limitstart)
                    ->queryAll();

            if (isset($resultArray) && !empty($resultArray)) {
                foreach ($resultArray as $key => $value) {
                    $body1 = '<tr>
                                    <td  class="center" style="font-size: 16px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                        Dear , ' . $value['username'] . ' <br>                           
                                   </td>
                                </tr>';
                    $totalJobsPosted = Jobpostings :: model()->findAll('user_id=:user_id', array('user_id' => $value['id']));
                    foreach ($totalJobsPosted as $key1 => $jobIndi) {
                        $models = Yii::app()->db->createCommand()
                                ->select('ap.*,jp.user_id as rec_id,jp.*,ap.id as apid,ap.user_id as jsid,ap.status as apstatus')
                                ->from('applyjob ap')
                                ->join('jobpostings jp', 'jp.id = ap.job_id')
                                ->where('jp.user_id=:recId AND jp.id=:jodId', array(':recId' => $value['id'], ':jodId' => $jobIndi['id']))
                                ->order('ap.updated_on desc')
                                ->queryAll();
                        $count = count($models);

                        $body2.='<tr>
                                            <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                                <a href="' . Yii::app()->request->baseUrl . '/Recruiter/SearchAppliedListByJobId?recId=' . $jobIndi['user_id'] . '&id=' . $jobIndi['id'] . '" target="_blank">' . $count . ' new candidates have applied</a>  for the job of   <a href="' . Yii::app()->request->baseUrl . '/site/JobDescription?recId=' . $jobIndi['user_id'] . '&id=' . $jobIndi['id'] . '" target="_blank">' . $jobIndi['jobtitle'] . '</a> - ' . City::model()->getLocation($jobIndi['locations']) . '.                       
                                            </td>
                                        </tr><br>';
                    }
                }
                $body3 = '<tr>
                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                    We hope you you find the perfect candidate soon!
                               </td>
                            </tr><tr>
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

                if (isset($totalJobsPosted) && !empty($totalJobsPosted)) {
                    require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                    $mail = new PHPMailer();
                    //$body             = file_get_contents('contents.html');


                    $body = $body1 . $body2 . $body3;
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
                    $mail->Subject = "JOB PORTAL SIT Daily applied list";
                    //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                    $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                    $mail->Port = 587;
                    $address = $value['username'];
                    $mail->AddAddress($address, $value['username']);
                    //$mail->SMTPDebug  = 1;     
                    $mail->isHTML(true);

                    //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
                    $mail->Send();
                } else {
                    
                }
            }
        }
    }

    public function actionrecriterDailySavedReportCumulative() {
        ini_set('max_execution_time', 3000);
        $totalRecords = User::model()->findAll('user_type=:userType', array(':userType' => 2));
        $totalCount = count($totalRecords);
        $recForLoop = 2;
        $body1 = $body2 = $body3 = '';
        $body1 = ' <!doctype html>
                    <html xmlns="http://www.w3.org/1999/xhtml">
                    <head>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <title>JOB PORTAL SIT Daily saved list</title>

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
                                                            ';
        $noofloops = $totalCount / $recForLoop;

        for ($i = $recForLoop, $limitstart = 0, $k = 0; $k <= $noofloops; $i = $i + $recForLoop, $limitstart = $limitstart + $recForLoop, $k++) {
            $resultArray = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('user')
                    ->where('user_type=:userType', array(':userType' => 2))
                    ->order('id DESC')
                    ->limit($recForLoop, $limitstart)
                    ->queryAll();

            if (isset($resultArray) && !empty($resultArray)) {
                foreach ($resultArray as $key => $value) {
                    $body1 = '<tr>
                                    <td  class="center" style="font-size: 16px; color: #687074; font-weight: bold; text-align: center; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                        Dear , ' . $value['username'] . '    <br>                         
                                   </td>
                                </tr>';
                    $totalJobsPosted = Jobpostings :: model()->findAll('user_id=:user_id', array('user_id' => $value['id']));
                    foreach ($totalJobsPosted as $key1 => $jobIndi) {
                        $models = Yii::app()->db->createCommand()
                                ->select('sj.*,jp.user_id as rec_id,jp.*,sj.id as apid,sj.user_id as jsid,sj.status as apstatus')
                                ->from('savejob sj')
                                ->join('jobpostings jp', 'jp.id = sj.job_id')
                                ->where('jp.user_id=:recId AND jp.id=:jodId', array(':recId' => $value['id'], ':jodId' => $jobIndi['id']))
                                ->order('sj.updated_on desc')
                                ->queryAll();
                        $count = count($models);

                        $body2.='<tr>
                                            <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                               Your job for   <a href="' . Yii::app()->request->baseUrl . '/site/JobDescription?recId=' . $jobIndi['user_id'] . '&id=' . $jobIndi['id'] . '" target="_blank">' . $jobIndi['jobtitle'] . '</a> - ' . City::model()->getLocation($jobIndi['locations']) . ' has been saved <a href="' . Yii::app()->request->baseUrl . '/Recruiter/SearchAppliedListByJobId?recId=' . $jobIndi['user_id'] . '&id=' . $jobIndi['id'] . '" target="_blank">' . $count . ' times today  </a> .                        
                                            </td>
                                        </tr>
                                        <br>
                                        <tr>
                                        <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                            You may view them and contact any candidates you find suitable by clicking below:
                                       </td>
                                    </tr> <br>
                                    <tr>
                                            <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                               <a href="' . Yii::app()->request->baseUrl . '/Recruiter/SearchAppliedListByJobId?recId=' . $jobIndi['user_id'] . '&id=' . $jobIndi['id'] . '" target="_blank">View Member Details</a> .                        
                                            </td>
                                        </tr> <br>';
                    }
                }
                $body3 = '<tr>
                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                    We hope you you find the perfect candidate soon!
                               </td>
                            </tr><tr>
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
                echo $body = $body1 . $body2 . $body3;
                if (isset($totalJobsPosted) && !empty($totalJobsPosted)) {
                    require_once('/jp_assets/mailer/PHPMailerAutoload.php');
                    $mail = new PHPMailer();
                    //$body             = file_get_contents('contents.html');


                    $body = $body1 . $body2 . $body3;
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
                    $mail->Subject = "JOB PORTAL SIT Daily saved list";
                    //                    $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
                    $mail->MsgHTML($body);        // SMTP password
//                                    $mail->SMTPSecure = 'tls';
                    $mail->SMTPKeepAlive = true;                                                 // Enable encryption, 'ssl' also accepted
                    $mail->Port = 587;
                    $address = $value['username'];
                    $mail->AddAddress($address, $value['username']);
                    //$mail->SMTPDebug  = 1;     
                    $mail->isHTML(true);

                    //$mail->AddAttachment("images/phpmailer.gif");      // attachment
                    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
                    $mail->Send();
                } else {
                    
                }
            }
        }
    }

}

