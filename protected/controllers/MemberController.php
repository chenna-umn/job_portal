<?php

class MemberController extends Controller {

//	public $layout='mainv';
    public $defaultAction = 'index';

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {

        ini_set('max_execution_time', 300);
        $this->layout = '//layouts/register';

        $checkUser = User::model()->find('username=:username', array(':username' => $_POST['registeremail']));
        $user = new User();
        if (isset($_POST['registeremail']) && $_POST['registerpassword'] && !isset($checkUser) && empty($checkUser)) {
            $user->username = $_POST['registeremail'];
            $user->password = md5($_POST['registerpassword']);
            $user->membership_id = 'jp';
            $user->user_type = 4;
            $user->created_on = date('Y-m-d h:i:s');
            $user->updated_on = date('Y-m-d h:i:s');
            $user->status = 0;
            $user->activation_code = strtotime(date('Y-m-d h:i:s')) . md5($_POST['registeremail']);
            if ($user->validate()) {
                if ($user->save()) {
                    Yii::app()->user->setState('memberId', $user->id);
                    Yii::app()->user->setState('userType', $user->user_type);
                    Yii::app()->user->setState('memberName', $user->username);
                    Yii::app()->user->setState('memberloggedInAt', date('Y-m-d h:i:s'));
                    Yii::app()->user->setState('isMember', 1);
                    require_once('jp_assets/mailer/PHPMailerAutoload.php');
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
                                                                                    <table width="100%" border="0" cellpadding="0" cellspacing="0" align="left">
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
                                                                                                <table width="700" border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                                    <tr>
                                                                                                        <td width="100%" bgcolor="#ffffff">
                                                                                                            <!-- Left Box  -->
                                                                                                            <table width="70%"  border="0" cellpadding="0" cellspacing="0" align="left" class="deviceWidth">
                                                                                                                <tr>
                                                                                                                    <td class="center">
                                                                                                                        <table  border="0" cellpadding="0" cellspacing="0" align="left"> 
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 16px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Dear , ' . $_POST['registeremail'] . ', Welcome to SuryaJobs.com.                            
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    Thanking You For Registering with us. Please confirm your clicking on the following link:                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                     
                                                                                                                                    <td valign="top" class="left" style="padding: 7px 15px; text-align: center; background-color: #27d7e7;">
                                                                                                                                            <a href="' . Yii::app()->request->baseUrl . '/site/activate?link=' . $user->activation_code . '&mail=' . md5($_POST['registeremail']) . '" style="color: #fff; font-size: 12px; font-weight: bold; text-decoration: none; font-family: Arial, sans-serif; text-alight: center;">Activate</a>
                                                                                                                                    </td>  
                                                                                                                                    
                                                                                                                                </tr> 
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    In case the above link does not work, copy and paste the following URL onto the address bar of your browser.                         
                                                                                                                               </td>
                                                                                                                            </tr>
                                                                                                                            <tr>
                                                                                                                                <td  class="left" style="font-size: 14px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 10px 10px;">
                                                                                                                                    <a href="' . Yii::app()->request->baseUrl . '/site/activate?link=' . $user->activation_code . '&mail=' . md5($_POST['registeremail']) . '">' . Yii::app()->request->baseUrl . '/site/activate?link=' . $user->activation_code . '&mail=' . md5($_POST['registeremail']) . '</a>                         
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
//                                    $mail->SMTPSecure = 'tls';
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
                    $this->redirect(array('Member/create1', 'id' => $user->id));
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

    public function actioncreate1($id) {
        $this->layout = '//layouts/register1';
        if (isset($_GET['id']) && !empty($_GET['id'])) {

            $user = User::model()->find('id=:id', array('id' => $_GET['id']));
            if (isset($user) && !empty($user)) {
                Yii::app()->User->setState('memberId', $user->id);
                Yii::app()->User->setState('userType', $user->user_type);
                Yii::app()->User->setState('memberName', $user->username);
                Yii::app()->User->setState('memberloggedInAt', date('Y-m-d h:i:s'));
                Yii::app()->User->setState('isMember', 1);
                Yii::app()->User->setState('isGuest', 1);
            }
        }
        $MemberPersonal = new Memberpersonal();
        if (isset($_GET['id'])) {
            if (isset($_POST['Memberpersonal']) && isset($_POST['create'])) {
                $model = new Memberpersonal();
                $model->attributes = $_POST['Memberpersonal'];
                $model->user_id = $id;
                $model->preferred_location = implode(",", $_POST['Memberpersonal']['preferred_location']);
                $model->dob = $_POST['Memberpersonal']['dobyear'] . '-' . $_POST['Memberpersonal']['dobmonth'] . '-' . $_POST['Memberpersonal']['dobday'];
                $model->expected_salary_negotiable = isset($_POST['Memberpersonal']['expected_salary_negotiable']) ? 1 : 0;
                $model->current_salary_confidential = isset($_POST['Memberpersonal']['current_salary_confidential']) ? 1 : 0;
                $model->created_on = date('Y-m-d h:i:s');
                $model->updated_on = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "Personal Deatils Saved Successfully");
                        $this->redirect(array('Member/create2', 'id' => $id));
                    } else {
                        Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                        $this->redirect(array('Member/create1', 'id' => $id));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                    $this->redirect(array('Member/create1', 'id' => $id));
                }
            } else if (isset($_POST['Memberpersonal']) && isset($_POST['PersonalId'])) {
                $model = Memberpersonal::model()->findByPk($_POST['PersonalId']);
                $model->attributes = $_POST['Memberpersonal'];
                $model->user_id = $id;
                $model->preferred_location = implode(",", $_POST['Memberpersonal']['preferred_location']);
                $model->dob = $_POST['Memberpersonal']['dobyear'] . '-' . $_POST['Memberpersonal']['dobmonth'] . '-' . $_POST['Memberpersonal']['dobday'];
                $model->expected_salary_negotiable = isset($_POST['Memberpersonal']['expected_salary_negotiable']) ? 1 : 0;
                $model->current_salary_confidential = isset($_POST['Memberpersonal']['current_salary_confidential']) ? 1 : 0;
                $model->created_on = date('Y-m-d h:i:s');
                $model->updated_on = date('Y-m-d h:i:s');
                if ($model->validate()) {
                    if ($model->save()) {
                        Yii::app()->user->setFlash('success', "Personal Deatils Saved Successfully");
                        $this->redirect(array('Member/create2', 'id' => $id));
                    } else {
                        Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                        $this->redirect(array('Member/create1', 'id' => $id));
                    }
                } else {
                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                    $this->redirect(array('Member/create1', 'id' => $id));
                }
            } else {

                $MemberPersonal = Memberpersonal::model()->find('user_id=:user_id', array(':user_id' => $id));

                $this->render('create1', array('user_id' => $id, 'MemberPersonal' => $MemberPersonal));
            }
        } else {
            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
            $this->layout = '//layouts/register';
            $this->render('create1', array('user_id' => $id, 'Memberpersonal' => $MemberPersonal));
        }
    }

    public function actioncreate2($id) {
        $this->layout = '//layouts/register1';
        $Membereducation = new Membereducation();
        if (isset($_GET['id'])) {
            if (isset($_POST['Membereducation']) && isset($_POST['create'])) {
                $model = new Memberpersonal();
                for ($i = 0; $i < count($_POST['Membereducation']['institute']); $i++) {
                    if (isset($_POST['Membereducation']['institute'][$i]) && isset($_POST['Membereducation']['batchfrom'][$i]) && isset($_POST['Membereducation']['batchto'][$i]) && isset($_POST['Membereducation']['coursetype'][$i]) && isset($_POST['Membereducation']['degree_id'][$i])) {
                        $model = new Membereducation();
                        $model->user_id = $id;
                        $model->institute = $_POST['Membereducation']['institute'][$i];
                        $model->batchfrom = $_POST['Membereducation']['batchfrom'][$i];
                        $model->batchto = $_POST['Membereducation']['batchto'][$i];
                        $model->coursetype = $_POST['Membereducation']['coursetype'][$i];
                        $model->degree_id = $_POST['Membereducation']['degree_id'][$i];
                        $model->created_on = date('Y-m-d h:i:s');
                        $model->updated_on = date('Y-m-d h:i:s');
                        if ($model->validate()) {
                            if ($model->save()) {
                                Yii::app()->user->setFlash('success', "Educational Deatils Saved Successfully");
                            } else {
                                Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                            }
                        } else {
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                        }
                    }
                }
                $this->redirect(array('Member/create3', 'id' => $id));
            } else if (isset($_POST['Membereducation']) && isset($_POST['EducationId'])) {

                $daleteAll = Membereducation::model()->deleteAll('user_id=:user_id', array(':user_id' => $id));
                for ($i = 0; $i < count($_POST['Membereducation']['institute']); $i++) {
                    if (isset($_POST['Membereducation']['institute'][$i]) && isset($_POST['Membereducation']['batchfrom'][$i]) && isset($_POST['Membereducation']['batchto'][$i]) && isset($_POST['Membereducation']['coursetype'][$i]) && isset($_POST['Membereducation']['degree_id'][$i])) {
                        $model = new Membereducation();
                        $model->user_id = $id;
                        $model->institute = $_POST['Membereducation']['institute'][$i];
                        $model->batchfrom = $_POST['Membereducation']['batchfrom'][$i];
                        $model->batchto = $_POST['Membereducation']['batchto'][$i];
                        $model->coursetype = $_POST['Membereducation']['coursetype'][$i];
                        $model->degree_id = $_POST['Membereducation']['degree_id'][$i];
                        $model->created_on = date('Y-m-d h:i:s');
                        $model->updated_on = date('Y-m-d h:i:s');
                        if ($model->validate()) {
                            if ($model->save()) {
                                Yii::app()->user->setFlash('success', "Educational Deatils Saved Successfully");
                            } else {
                                Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                            }
                        } else {
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                        }
                    }
                }
                $this->redirect(array('Member/create3', 'id' => $id));
            } else {
                $Membereducation = Membereducation::model()->findAll('user_id=:user_id', array(':user_id' => $id));

                $this->render('create2', array('user_id' => $id, 'Membereducation' => $Membereducation));
            }
        } else {
            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
            $this->layout = '//layouts/register';
            $this->render('create2', array('user_id' => $id, 'Memberpersonal' => $MemberPersonal));
        }
    }

    public function actioncreate3($id) {
        $this->layout = '//layouts/register1';
        $Membereducation = new Membereducation();
        if (isset($_GET['id'])) {
            if (isset($_POST['Memberprofessional']) && isset($_POST['create'])) {

                $model = new Memberprofessional();

                if (isset($_POST['Memberprofessional']['hasexp'])) {
                    $model = new Memberprofessional();
                    $model->user_id = $id;
                    $model->hasexp = isset($_POST['Memberprofessional']['hasexp']) ? 1 : 0;
                    if ($model->validate()) {
                        if ($model->save()) {
                            Yii::app()->user->setFlash('success', "Professional Deatils Saved Successfully");
                        } else {
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                        }
                    } else {
                        Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                    }
                } else {
                    for ($i = 0; $i < count($_POST['Memberprofessional']['designation']); $i++) {
                        if (isset($_POST['Memberprofessional']['designation'][$i]) && isset($_POST['Memberprofessional']['organization'][$i]) && isset($_POST['Memberprofessional']['fromyear'][$i]) && isset($_POST['Memberprofessional']['frommonth'][$i]) && isset($_POST['Memberprofessional']['toyear'][$i]) && isset($_POST['Memberprofessional']['tomonth'][$i])) {
                            $model = new Memberprofessional();
                            $model->user_id = $id;
                            $model->designation = $_POST['Memberprofessional']['designation'][$i];
                            $model->organization = $_POST['Memberprofessional']['organization'][$i];
                            $model->fromyear = $_POST['Memberprofessional']['fromyear'][$i];
                            $model->frommonth = $_POST['Memberprofessional']['frommonth'][$i];
                            $model->toyear = $_POST['Memberprofessional']['toyear'][$i];
                            $model->tomonth = $_POST['Memberprofessional']['tomonth'][$i];
                            $model->created_on = date('Y-m-d h:i:s');
                            $model->hasexp = isset($_POST['Memberprofessional']['hasexp']) ? 0 : 1;

                            if ($model->validate()) {
                                if ($model->save()) {
                                    Yii::app()->user->setFlash('success', "Professional Deatils Saved Successfully");
                                } else {

                                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                                }
                            } else {

                                Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                            }
                        }
                    }
                }
                $this->redirect(array('Member/create4', 'id' => $id));
            } else if (isset($_POST['Memberprofessional']) && isset($_POST['professionId'])) {

                $daleteAll = Memberprofessional::model()->deleteAll('user_id=:user_id', array(':user_id' => $id));
                if (isset($_POST['Memberprofessional']['hasexp'])) {
                    $model = new Memberprofessional();
                    $model->user_id = $id;
                    $model->hasexp = isset($_POST['Memberprofessional']['hasexp']) ? 1 : 0;
                    if ($model->validate()) {
                        if ($model->save()) {
                            Yii::app()->user->setFlash('success', "Professional Deatils Saved Successfully");
                        } else {
                            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                        }
                    } else {
                        Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                    }
                } else {
                    for ($i = 0; $i < count($_POST['Memberprofessional']['designation']); $i++) {
                        if (isset($_POST['Memberprofessional']['designation'][$i]) && isset($_POST['Memberprofessional']['organization'][$i]) && isset($_POST['Memberprofessional']['fromyear'][$i]) && isset($_POST['Memberprofessional']['frommonth'][$i]) && isset($_POST['Memberprofessional']['toyear'][$i]) && isset($_POST['Memberprofessional']['tomonth'][$i])) {
                            $model = new Memberprofessional();
                            $model->user_id = $id;
                            $model->designation = $_POST['Memberprofessional']['designation'][$i];
                            $model->organization = $_POST['Memberprofessional']['organization'][$i];
                            $model->fromyear = $_POST['Memberprofessional']['fromyear'][$i];
                            $model->frommonth = $_POST['Memberprofessional']['frommonth'][$i];
                            $model->toyear = $_POST['Memberprofessional']['toyear'][$i];
                            $model->tomonth = $_POST['Memberprofessional']['tomonth'][$i];
                            $model->created_on = date('Y-m-d h:i:s');
                            $model->hasexp = isset($_POST['Memberprofessional']['hasexp']) ? 0 : 1;

                            if ($model->validate()) {
                                if ($model->save()) {
                                    Yii::app()->user->setFlash('success', "Professional Deatils Saved Successfully");
                                } else {

                                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                                }
                            } else {

                                Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                            }
                        }
                    }
                }
                $this->redirect(array('Member/create4', 'id' => $id));
            } else {

                $Memberprofessional = Memberprofessional::model()->findAll('user_id=:user_id', array(':user_id' => $id));

                $this->render('create3', array('user_id' => $id, 'Memberprofessional' => $Memberprofessional));
            }
        } else {
            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
            $this->layout = '//layouts/register';
            $this->render('create3', array('user_id' => $id, 'Memberpersonal' => $MemberPersonal));
        }
    }

    public function actioncreate4($id) {
        $this->layout = '//layouts/register1';
        $Memberuploads = new Memberuploads();
        if (isset($_GET['id'])) {
            $Memberuploads = Memberuploads::model()->find('user_id=:user_id', array(':user_id' => $id));
            if (empty($Memberuploads) && !isset($Memberuploads)) {
                $Memberuploads = new Memberuploads();
            }
            $Memberuploads->user_id = $id;
            $Memberuploads->created_on = date('Y-m-d h:i:s');

            if (isset($_FILES['pic']['name']) && !empty($_FILES['pic']['name'])) {
                $uploaddir = 'uploads/profilepics/';
                $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['pic']['name']);
                $filename = basename(date('Y-m-d-H-i') . "_" . $_FILES['pic']['name']);
                if ((is_dir('uploads/profilepics/'))) {
                    
                } else {
                    mkdir('uploads/profilepics/', 0777, true);
                }
                if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)) {
//                                   echo "eqweqweqw";exit;
                }
                $Memberuploads->profile_pic = $filename;
            } else {
//                             echo "Ewrwer";exit;
            }
            if (isset($_FILES['resume']['name']) && !empty($_FILES['resume']['name'])) {
                $uploaddir = 'uploads/resume/';
                $uploadfile = $uploaddir . basename(date('Y-m-d-H-i') . "_" . $_FILES['resume']['name']);
                $filename = basename(date('Y-m-d-H-i') . "_" . $_FILES['resume']['name']);
                if ((is_dir('uploads/resume/'))) {
                    
                } else {
                    mkdir('uploads/resume/', 0777, true);
                }
                move_uploaded_file($_FILES['resume']['tmp_name'], $uploadfile);
                $Memberuploads->resume = $filename;
            } else {
                //echo "rwerwe";exit;
            }
            if (isset($_FILES['pic']['name']) || isset($_FILES['resume']['name'])) {

                if ($Memberuploads->validate()) {
                    if ($Memberuploads->save()) {
                        Yii::app()->user->setFlash('success', "Resume Deatils Saved Successfully");
                    } else {

                        Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                    }
                } else {

                    Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
                }
            }
            $Memberuploads = Memberuploads::model()->find('user_id=:user_id', array(':user_id' => $id));

            $this->render('create4', array('user_id' => $id, 'Memberuploads' => $Memberuploads));
        } else {
            Yii::app()->user->setFlash('error', "Oops...!Something Went wrong While Registering...Please Try Later...!");
            $this->layout = '//layouts/register';
            $this->render('create1', array('user_id' => $id, 'Memberpersonal' => $MemberPersonal));
        }
    }

    public function actionDownload($name, $path) {


        //This application is developed by www.webinfopedia.com
//visit www.webinfopedia.com for PHP,Mysql,html5 and Designing tutorials for FREE!!!
        function output_file($file, $name, $mime_type='') {
            /*
              This function takes a path to a file to output ($file),  the filename that the browser will see ($name) and  the MIME type of the file ($mime_type, optional).
             */

            //Check the file premission
            if (!is_readable($file))
                die('File not found or inaccessible!');

            $size = filesize($file);
            $name = rawurldecode($name);

            /* Figure out the MIME type | Check in array */
            $known_mime_types = array(
                "pdf" => "application/pdf",
                "txt" => "text/plain",
                "html" => "text/html",
                "htm" => "text/html",
                "exe" => "application/octet-stream",
                "zip" => "application/zip",
                "doc" => "application/msword",
                "xls" => "application/vnd.ms-excel",
                "ppt" => "application/vnd.ms-powerpoint",
                "gif" => "image/gif",
                "png" => "image/png",
                "jpeg" => "image/jpg",
                "jpg" => "image/jpg",
                "php" => "text/plain"
            );

            if ($mime_type == '') {
                $file_extension = strtolower(substr(strrchr($file, "."), 1));
                if (array_key_exists($file_extension, $known_mime_types)) {
                    $mime_type = $known_mime_types[$file_extension];
                } else {
                    $mime_type = "application/force-download";
                };
            };

            //turn off output buffering to decrease cpu usage
            @ob_end_clean();

            // required for IE, otherwise Content-Disposition may be ignored
            if (ini_get('zlib.output_compression'))
                ini_set('zlib.output_compression', 'Off');

            header('Content-Type: ' . $mime_type);
            header('Content-Disposition: attachment; filename="' . $name . '"');
            header("Content-Transfer-Encoding: binary");
            header('Accept-Ranges: bytes');

            /* The three lines below basically make the 
              download non-cacheable */
            header("Cache-control: private");
            header('Pragma: private');
            header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

            // multipart-download and download resuming support
            if (isset($_SERVER['HTTP_RANGE'])) {
                list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
                list($range) = explode(",", $range, 2);
                list($range, $range_end) = explode("-", $range);
                $range = intval($range);
                if (!$range_end) {
                    $range_end = $size - 1;
                } else {
                    $range_end = intval($range_end);
                }
                /*
                  ------------------------------------------------------------------------------------------------------
                  //This application is developed by www.webinfopedia.com
                  //visit www.webinfopedia.com for PHP,Mysql,html5 and Designing tutorials for FREE!!!
                  ------------------------------------------------------------------------------------------------------
                 */
                $new_length = $range_end - $range + 1;
                header("HTTP/1.1 206 Partial Content");
                header("Content-Length: $new_length");
                header("Content-Range: bytes $range-$range_end/$size");
            } else {
                $new_length = $size;
                header("Content-Length: " . $size);
            }

            /* Will output the file itself */
            $chunksize = 1 * (1024 * 1024); //you may want to change this
            $bytes_send = 0;
            if ($file = fopen($file, 'r')) {
                if (isset($_SERVER['HTTP_RANGE']))
                    fseek($file, $range);

                while (!feof($file) &&
                (!connection_aborted()) &&
                ($bytes_send < $new_length)
                ) {
                    $buffer = fread($file, $chunksize);
                    print($buffer); //echo($buffer); // can also possible
                    flush();
                    $bytes_send += strlen($buffer);
                }
                fclose($file);
            } else
            //If no permissiion
                die('Error - can not open file.');
            //die
            die();
        }

//Set the time out
        set_time_limit(0);

//path to the file
        $file_path = $path . '/' . $name;


//Call the download function with file path,file name and file type
        output_file($file_path, '' . $name . '');
    }

    public function actionsavesearchfilter() {
        if (isset($_POST['id']) && isset($_POST['catid'])) {
            $result = 'failed';
            $searchFilter = Searchfilters::model()->find('user_id=:user_id AND cat_id=:cat_id', array('user_id' => Yii::app()->user->memberId, 'cat_id' => $_POST['catid']));
            if (isset($searchFilter) && !empty($searchFilter)) {
                if ($_POST['status'] == 0) {
                    $searchFilter->subcat_id = $searchFilter->subcat_id . ',' . $_POST['id'];
                } else {
                    $searchFilter->subcat_id = str_replace($_POST['id'], "", $searchFilter->subcat_id);
                }
                $searchFilter->updated_on = date('Y-m-d h:i:s');
                if ($searchFilter->validate()) {
                    if ($searchFilter->save()) {
                        $result = "success";
                    }
                }
            } else {
                $searchFilter = new Searchfilters();
                $searchFilter->user_id = Yii::app()->user->memberId;
                $searchFilter->cat_id = $_POST['catid'];
                $searchFilter->subcat_id = $_POST['id'];
                $searchFilter->created_on = date('Y-m-d h:i:s');
                $searchFilter->updated_on = date('Y-m-d h:i:s');
                if ($searchFilter->validate()) {
                    if ($searchFilter->save()) {
                        $result = "success";
                    }
                }
            }
        }
        echo $result;
    }

    public function actionApplyjob() {
        if (isset($_POST['id']) && isset($_POST['status'])) {
            $result = 'failed';
            $expCheck = 1;
            $status = '';
            $jobObject = Jobpostings::model()->findByPk($_POST['id']);
            if ($jobObject->apply_less_qualification == 1) {
                if ($jobObject->expmin <= Memberpersonal::getJobSeekerExpById(Yii::app()->user->memberId) && $jobObject->expmax >= Memberpersonal::getJobSeekerExpById(Yii::app()->user->memberId)) {
                    $expCheck = 1;
                }
            } else {
                $expCheck = 0;
                $result = 'expfailed';
            }
            if (isset($jobObject) && !empty($jobObject) && $expCheck == 1) {
                $applyJob = Applyjob::model()->find('user_id=:user_id AND job_id=:job_id', array('user_id' => Yii::app()->user->memberId, 'job_id' => $_POST['id']));
                if (isset($applyJob) && !empty($applyJob)) {
                    if ($_POST['status'] == 1) {
                        $applyJob->status = 0;
                    } else {
                        $applyJob->status = 1;
                    }
                    $applyJob->updated_on = date('Y-m-d h:i:s');
                    if ($applyJob->validate()) {
                        if ($applyJob->save()) {
                            $result = "success";
                            $status = 'Successfully Altered Status For ';
                        }
                    }
                } else {
                    $applyJob = new Applyjob();
                    $applyJob->user_id = Yii::app()->user->memberId;
                    $applyJob->job_id = $_POST['id'];
                    $applyJob->applied_on = date('Y-m-d h:i:s');
                    $applyJob->updated_on = date('Y-m-d h:i:s');
                    if ($applyJob->validate()) {
                        if ($applyJob->save()) {
                            $result = "success";
                            $status = 'Successfully Applied';
                        }
                    }
                }

                if ($result == "success") {
                    $memberDetails = User::model()->getMemberDetailsByUserId($applyJob->user_id);
                    $jobDetails = Jobpostings::model()->findByPk($applyJob->job_id);
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
                                                                           this mail is to inform you that you have ' . $status . 'for the job<a href="' . Yii::app()->request->baseUrl . '/site/JobDescription?userId=' . $memberDetails['user_id'] . '&id=' . $jobDetails['id'] . '" target="_blank">' . $jobDetails['jobtitle'] . '</a> - ' . City::model()->getLocation($jobDetails['locations']) . ' 
                                                                               We shall keep you updated of any progress.
                                                                                </td>
                                                                            </tr>
                                                                            <br>
                                                                            <tr>
                                                                                <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                                                          We wish you the best of luck for the current application                     
                                                                                </td>
                                                                            </tr>
                                                                            <br>
                                                                            <tr>
                                                                                <td bgcolor="#ffffff" style="font-size: 12px; color: #687074; font-weight: bold; text-align: left; font-family: Arial, Helvetica, sans-serif; line-height: 25px; vertical-align: middle; padding: 20px 0px 0px; " class="left">
                                                                          Please click on the following link to find,apply to similar such jobs:                       
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
                }
            }
        }
        echo $result;
    }

    public function actionsaveJob() {
        if (isset($_POST['id']) && isset($_POST['status'])) {
            $result = 'failed';
            $saveJob = Savejob::model()->find('user_id=:user_id AND job_id=:job_id', array('user_id' => Yii::app()->user->memberId, 'job_id' => $_POST['id']));
            if (isset($saveJob) && !empty($saveJob)) {
                if ($_POST['status'] == 1) {
                    $saveJob->status = 0;
                } else {
                    $saveJob->status = 1;
                }
                $saveJob->updated_on = date('Y-m-d h:i:s');
                if ($saveJob->validate()) {
                    if ($saveJob->save()) {
                        $result = "success";
                    }
                }
            } else {
                $saveJob = new Savejob();
                $saveJob->user_id = Yii::app()->user->memberId;
                $saveJob->job_id = $_POST['id'];
                $saveJob->applied_on = date('Y-m-d h:i:s');
                $saveJob->updated_on = date('Y-m-d h:i:s');
                if ($saveJob->validate()) {
                    if ($saveJob->save()) {
                        $result = "success";
                    }
                }
            }
        }
        echo $result;
    }

    public function actionjobFeed() {
        if (isset(Yii::app()->user->memberId) && !empty(Yii::app()->user->memberId)) {
            $listArray = $cityList = array();
            $subCatString = $cityListString = '';
            $minExp = 0;
            $maxExp = 100;
            $expLevel = $cityListStatus = 0;
            if (isset($_POST['expLevel'])) {
                $expLevel = $_POST['expLevel'];
                if ($_POST['expLevel'] == 0) {
                    $minExp = 0;
                    $maxExp = 100;
                } else if ($_POST['expLevel'] == 1) {
                    $minExp = 0;
                    $maxExp = 3;
                } else if ($_POST['expLevel'] == 2) {
                    $minExp = 4;
                    $maxExp = 6;
                } else if ($_POST['expLevel'] == 3) {
                    $minExp = 7;
                    $maxExp = 10;
                } else if ($_POST['expLevel'] == 4) {
                    $minExp = 11;
                    $maxExp = 15;
                } else if ($_POST['expLevel'] == 5) {
                    $minExp = 16;
                    $maxExp = 100;
                } else {
                    $minExp = 0;
                    $maxExp = 100;
                }
            }
            $cityListAll = Yii::app()->db->createCommand()
                    ->select('id')
                    ->from('city')
                    ->where('status=:status', array(':status' => 1))
                    ->order('name ASC')
                    ->queryAll();
            if (isset($cityListAll) && !empty($cityListAll)) {
                foreach ($cityListAll as $key => $value) {
                    $cityListString.= $value['id'] . ',';
                }
            }

            $cityList = explode(",", $cityListString);
            $cityList = array_filter($cityList);
            if (isset($_POST['cityList'])) {
                $cityList = $_POST['cityList'];
                $cityListStatus = 1;
            }
            $subCatList = Searchfilters::model()->findAll('user_id=:user_id', array(':user_id' => Yii::app()->user->memberId));
            if (isset($subCatList) && !empty($subCatList)) {
                foreach ($subCatList as $key => $value) {
                    $subCatString.= $value->subcat_id;
                }
            }

            $listArray = explode(",", $subCatString);
            $listArray = array_filter($listArray);
            $this->layout = '//layouts/mainv1';
            $jobsList = array();
            $limit = 1;
            if (isset($listArray) && !empty($listArray)) {
                $jobsList = Yii::app()->db->createCommand()
                        ->select('*')
                        ->from('jobpostings')
                        ->where(array('in', 'subcat_id', $listArray))
//                        ->andWhere(array('in', 'locations',$cityList))
                        ->andWhere('expmin>=:expmin AND expmax<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                        ->order('updated_on DESC')
                        ->limit($limit, 0)
                        ->queryAll();
            }

            $this->render('jobfeed', array('jobsList' => $jobsList, 'limit' => $limit, 'cityList' => $cityList, 'expLevel' => $expLevel, 'cityListStatus' => $cityListStatus));
        } else {
            $this->redirect(array('site/index'));
        }
    }

    public function actionjobFeedLoadMore() {
        $listArray = $cityList = array();
        $subCatString = $cityListString = $result = '';
        $minExp = 0;
        $maxExp = 100;
        $expLevel = 0;
        if (isset($_POST['expLevel'])) {
            $expLevel = $_POST['expLevel'];
            if ($_POST['expLevel'] == 0) {
                $minExp = 0;
                $maxExp = 100;
            } else if ($_POST['expLevel'] == 1) {
                $minExp = 0;
                $maxExp = 3;
            } else if ($_POST['expLevel'] == 2) {
                $minExp = 4;
                $maxExp = 6;
            } else if ($_POST['expLevel'] == 3) {
                $minExp = 7;
                $maxExp = 10;
            } else if ($_POST['expLevel'] == 4) {
                $minExp = 11;
                $maxExp = 15;
            } else if ($_POST['expLevel'] == 5) {
                $minExp = 16;
                $maxExp = 100;
            } else {
                $minExp = 0;
                $maxExp = 100;
            }
        }
        $cityListAll = Yii::app()->db->createCommand()
                ->select('id')
                ->from('city')
                ->where('status=:status', array(':status' => 1))
                ->order('name ASC')
                ->queryAll();
        if (isset($cityListAll) && !empty($cityListAll)) {
            foreach ($cityListAll as $key => $value) {
                $cityListString.= $value['id'] . ',';
            }
        }

        $cityList = explode(",", $cityListString);
        $cityList = array_filter($cityList);
        if (isset($_POST['cityList'])) {
            $cityList = $_POST['cityList'];
        }

        $subCatList = Searchfilters::model()->findAll('user_id=:user_id', array(':user_id' => Yii::app()->user->memberId));
        if (isset($subCatList) && !empty($subCatList)) {
            foreach ($subCatList as $key => $value) {
                $subCatString.= $value->subcat_id;
            }
        }

        $listArray = explode(",", $subCatString);
        $listArray = array_filter($listArray);

        $jobsList = array();
        $limit = 1;
        if (isset($listArray) && !empty($listArray)) {
            $jobsList = Yii::app()->db->createCommand()
                    ->select('*')
                    ->from('jobpostings')
                    ->where(array('in', 'subcat_id', $listArray))
//                        ->andWhere(array('in', 'locations',$cityList))
                    ->andWhere('expmin>=:expmin AND expmax<=:expmax', array(':expmin' => $minExp, ':expmax' => $maxExp))
                    ->order('updated_on DESC')
                    ->limit($limit, $_POST['limit'])
                    ->queryAll();
        }

        if (isset($jobsList) && !empty($jobsList)) {
            foreach ($jobsList as $key => $value) {
                if (array_intersect(explode(',', $value['locations']), $cityList)) {
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
                                        <a href="' . Yii::app()->request->baseUrl . '/jd-' . User::model()->seoFriendlyUrl($value['jobtitle']) . '-' . $value['id'] . '.htm" style="color:#555;" target="_blank">' . $value['jobtitle'] . '</a>
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
        }
        echo $result;
    }

    public function actionmemberProfile($id) {
        if (isset(Yii::app()->User->recId)) {
            $this->layout = '//layouts/recriuterhome';
        } else {
            $this->layout = '//layouts/mainv1';
        }

        if (isset($id) && !empty($id)) {
            $memberPersonal = Memberpersonal::model()->find('user_id=:user_id', array('user_id' => $id));
            $memberEducation = Membereducation::model()->findAll('user_id=:user_id', array('user_id' => $id));
            $memberProfessional = Memberprofessional::model()->findAll('user_id=:user_id', array('user_id' => $id));
            $memberUploads = Memberuploads::model()->find('user_id=:user_id', array('user_id' => $id));
            $this->render('memberprofile', array('memberPersonal' => $memberPersonal, 'memberEducation' => $memberEducation, 'memberProfessional' => $memberProfessional, 'memberUploads' => $memberUploads));
        }
    }

    public function actionrecruiterProfile($id) {
        if (isset(Yii::app()->User->recId)) {
            $this->layout = '//layouts/recriuterhome';
        } else {
            $this->layout = '//layouts/mainv1';
        }

        if (isset($id) && !empty($id)) {
            $recruiterProfile = Recruiterprofile::model()->find('user_id=:user_id', array('user_id' => $id));
            $this->render('recruiterProfile', array('recruiterProfile' => $recruiterProfile));
        }
    }

}
