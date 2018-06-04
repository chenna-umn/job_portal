<div class="container content" style="padding-top: 0px;">
    <div class="row">
            <!-- Begin Sidebar Menu -->
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4"> 
                <a href="<?php echo Yii::app()->request->baseUrl.'/site/index';?>" target="_blank"><button class="btn-u btn-u-lg btn-u-purple" type="button">Job Seeker</button></a>
                <a href="javascript:void(0);"> <button class="btn-u btn-u-lg btn-u-brown" type="button">Recruiters</button></a>
            </div>
            <div class="col-md-4">
                
            </div>
    </div>
        <div class="row">
            <!-- Begin Sidebar Menu -->
            <div class="col-md-2">
                
            </div>
            <!-- End Sidebar Menu -->

            <!-- Begin Content -->
            <div class="col-md-8">
                <?php if(Yii::app()->user->hasFlash('error')){?>
                            <div class="row margin-bottom-10">
                                <div class="info alert alert-danger fade in">
                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                    <?php echo Yii::app()->user->getFlash('error'); ?>
                                </div>
                            </div>
                    <?php } ?>
                <?php if(Yii::app()->user->hasFlash('success')){?>
                            <div class="row margin-bottom-10">
                                <div class="info alert alert-info fade in">
                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                    <?php echo Yii::app()->user->getFlash('success'); ?>
                                </div>
                            </div>
                    <?php } ?>
                <div class="row margin-bottom-40">
                    <div class="col-md-6">
                        <!-- Reg-Form -->
                        <form action="<?php echo Yii::app()->request->baseUrl.'/Recruiter/register';?>" id="sky-form4" class="sky-form" method="post">
                            <header>Registration form</header>
                            
                            <fieldset>                  
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="name" placeholder="name" class="invalid">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                    </label>
                                </section>
                                
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-envelope"></i>
                                        <input type="email" name="email" id="register_email" class="invalid" placeholder="Email address" oncopy="return false;" onpaste="return false;" oncut="return false;">
                                        <b class="tooltip tooltip-bottom-right">Needed to verify your account,Please Enter the Email other than Gmail,Yahoo,Hotmail.</b>
                                        <lable id="emailalert"></lable>
                                        <div class="note"><strong>Note:</strong> Please Enter the Email other than Gmail,Yahoo,Hotmail.</div>
                                    </label>
                                </section>
                                
                                 <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-envelope"></i>
                                        <input type="number" name="mobile" id="register_email" class="invalid" placeholder="Mobile Number" maxlength="10">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the mobile</b>                                        
                                    </label>
                                </section>
                                
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="password" id="password"  class="invalid" placeholder="Password" id="password">
                                        <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                    </label>
                                </section>
                                
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="passwordConfirm" class="invalid" id="passwordConfirm" placeholder="Confirm password">
                                        <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                        <lable id="message"></lable>
                                    </label>
                                </section>                                                                                         
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="designation" class="invalid" placeholder="Designation">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the Designation</b>
                                    </label>
                                </section>
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="organization" class="invalid" placeholder="Organization">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the Organization</b>
                                    </label>
                                </section>
                                <section>
                                    <label class="select state-error">
                                        <select name="type" class="invalid">
                                            <option selected value="">Select</option>
                                            <option value="2">Direct Employee</option>
                                            <option value="3">Recruitment Firm</option>                                            
                                        </select>
                                        <i></i>
                                    </label><em for="type" class="invalid">Please select your Option</em>
                                </section>
                                <section>
                                   
                                    <label class="checkbox"><input type="checkbox" name="terms" id="terms"><i></i>I agree with the Terms and Conditions</label>
                                </section>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn-u">Submit</button>
                            </footer>
                        </form>         
                        <!-- End Reg-Form -->
                    </div>

                    <!-- Login-Form -->
                    <div class="col-md-6">
                        <form class="sky-form" id="sky-form1" action="<?php echo Yii::app()->request->baseUrl.'/site/login';?>" novalidate="novalidate" method="post">
                            <header>Login form</header>
                            
                            <fieldset>                  
                                <section>
                                    <div class="row">
                                        <label class="label col col-4">E-mail</label>
                                        <div class="col col-8">
                                            <label class="input state-error">
                                                <i class="icon-append fa fa-user"></i>
                                                <input type="email" name="LoginForm[username]" placeholder="Email" class="invalid">
                                            </label><em for="email" class="invalid">Please enter your email address</em>
                                        </div>
                                    </div>
                                </section>
                                
                                <section>
                                    <div class="row">
                                        <label class="label col col-4">Password</label>
                                        <div class="col col-8">
                                            <label class="input state-error">
                                                <i class="icon-append fa fa-lock"></i>
                                                <input type="password" name="LoginForm[password]" placeholder="Password" class="invalid">
                                            </label><em for="password" class="invalid">Please enter your password</em>
                                            <div class="note"><a class="modal-opener" href="<?php echo Yii::app()->request->baseUrl.'/site/ForgotPassword';?>">Forgot password?</a></div>
                                        </div>
                                    </div>
                                </section>
                                <input type="hidden" name="LoginForm[user_type]" value="2" class="invalid">
                                <section>
                                    <div class="row">
                                        <div class="col col-4"></div>
                                        <div class="col col-8">
                                            <label class="checkbox"><input type="checkbox" checked="" name="remember"><i></i>Keep me logged in</label>
                                        </div>
                                    </div>
                                </section>
                            </fieldset>
                            <footer>
                                <button class="btn-u" type="submit">Log in</button>                                
                            </footer>
                        </form> 
                    </div>
                    <!-- End Login-Form -->
                </div><!--/end row-->                
            </div>
            <div class="col-md-2">
                
            </div>
            <!-- End Content -->
        </div>          
    </div><!--/container--> 
    <script type="text/javascript">
        $('#passwordConfirm').on('keyup', function () {
            if ($(this).val() == $('#password').val()) {
                $('#message').html('Congrats...! The Passwords are matching').css('color', 'green');
            } else $('#message').html('Sorry...!Passwords are not matching...Try again' ).css('color', 'red');
        });
        $('#register_email').on('keyup', function () {
            var email= $('#register_email').val();
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>";
            
            if(email != null && checkEmail(email) && !isBlockedEmail(email)){
            jQuery.ajax({                            
                            url: baseurl+'/site/checkemail',
                            type: "POST",
                            data: {email: email},  
                            error: function(){
                                    $('#emailalert').html('Please enter email to check availability' ).css('color', 'red');
                                },
                            success: function(resp){                   
                                    if(resp=="registered"){
                                           $('#emailalert').html('This email is already registerd with us..please try with another email address.' ).css('color', 'red');
                                    }else if(resp=="notregistered"){
                                           $('#emailalert').html('Congrats...! this email is available to register').css('color', 'green');
                                    }else if(resp=="notset"){
                                             $('#emailalert').html('Please enter email to check availability' ).css('color', 'red');
                                    }                                        
                                }
                            });
                        } else{
                             $('#emailalert').html('Please enter valid email to register...' ).css('color', 'red');
                        }
            
        });
        function checkEmail(inputvalue){	
            var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
            if(pattern.test(inputvalue)){         
                        return true;  
            }else{   
                       return false;
            }
        }
        function isBlockedEmail(str) {
          var blocked = ["gmail.com", "hotmail.com", "yahoo.com"];
          for(var i = 0; i< blocked.length; i++) {
            if(str.indexOf(blocked[i]) != -1) {
               return true;
            }
          }
          return false;
        }
    </script>
    
    </div><!--/End Wrapepr-->