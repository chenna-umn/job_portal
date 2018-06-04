<div class="container content" style="padding-top: 0px;">
    <div class="row">
            <!-- Begin Sidebar Menu -->
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4"> 
               
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
                    <div class="col-md-2">                       
                    </div>
                    <!-- Login-Form -->
                    <div class="col-md-8">
                        <form class="sky-form" id="sky-form1" action="<?php echo Yii::app()->request->baseUrl.'/site/updatePasswordConfirm';?>" novalidate="novalidate" method="post">
                            <header>Forgot Password</header>                            
                            <fieldset>  
                               
                                <input type="hidden" name="link"  class="invalid" value="<?php echo $activation_code;?>">
                                <section>
                                    <div class="row">
                                        <label class="label col col-4">New Password</label>
                                        <div class="col col-8">
                                            <label class="input">
                                                <i class="icon-append fa fa-lock"></i>
                                                <input type="password" name="UpdatePassword[password]" id="password"  class="invalid" placeholder="Password" id="password">
                                                <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                            </label>
                                        </div>
                                    </div>
                                </section>
                                <section>
                                    <div class="row">
                                        <label class="label col col-4">Confirm Password</label>
                                        <div class="col col-8">
                                            <label class="input">
                                                <i class="icon-append fa fa-lock"></i>
                                                <input type="password" name="UpdatePassword[passwordConfirm]" class="invalid" id="passwordConfirm" placeholder="Confirm password">
                                                <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                                <lable id="message"></lable>
                                            </label>
                                        </div>
                                    </div>
                                </section>
                                
                            </fieldset>
                            <footer>
                                <button class="btn-u" type="submit">Submit</button>                                
                            </footer>
                        </form> 
                    </div>
                    <div class="col-md-2">                       
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
        
        
    </script>
    
    </div><!--/End Wrapepr-->