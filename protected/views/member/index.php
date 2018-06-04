<div class="container content" style="padding-top: 0px;">
    <div class="row">
            <!-- Begin Sidebar Menu -->
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4"> 
                <a href="<?php echo Yii::app()->request->baseUrl.'/site/index';?>" target="_blank"><button class="btn-u btn-u-lg btn-u-purple" type="button">Job Seeker</button></a>
                <a href="<?php echo Yii::app()->request->baseUrl.'/Recruiter/index';?>" target="_blank"> <button class="btn-u btn-u-lg btn-u-brown" type="button">Recruiters</button></a>
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
                        <form action="<?php echo Yii::app()->request->baseUrl.'/Member/index';?>" id="sky-form4" class="sky-form" method="post">
                            <header>Registration form</header>
                            
                            <fieldset>
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-envelope"></i>
                                        <input type="email" name="registeremail" id="register_email" class="invalid" placeholder="Email address" oncopy="return false;" onpaste="return false;" oncut="return false;">
                                        <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                                        <lable id="emailalert"></lable>
                                    </label>
                                </section>
                                
                                
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-lock"></i>
                                        <input type="password" name="registerpassword" id="password"  class="invalid" placeholder="Password" id="password">
                                        <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                    </label>
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
                                            <div class="note"><a class="modal-opener" href="#sky-form2">Forgot password?</a></div>
                                        </div>
                                    </div>
                                </section>
                                <input type="hidden" name="LoginForm[user_type]" value="4" class="invalid">
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
            } else $('#message').html('Sorry...!Passwords are not patching...Try again' ).css('color', 'red');
        });
        $('#register_email').on('keyup', function () {
            var email= $('#register_email').val();
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>";      
            if(email != null && checkEmail(email)){
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
    </script>
    
    </div><!--/End Wrapepr-->