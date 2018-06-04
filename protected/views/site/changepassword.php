<div class="container content">
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
        <div class="col-md-1">

        </div>
        <!-- End Sidebar Menu -->

        <!-- Begin Content -->
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    <?php if (Yii::app()->user->hasFlash('error')) { ?>
                        <div class="row margin-bottom-10">
                            <div class="info alert alert-danger fade in">
                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                <?php echo Yii::app()->user->getFlash('error'); ?>
                            </div>
                        </div>
                    <?php } ?>
                    <?php if (Yii::app()->user->hasFlash('success')) { ?>
                        <div class="row margin-bottom-10">
                            <div class="info alert alert-info fade in">
                                <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                <?php echo Yii::app()->user->getFlash('success'); ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-2">

                </div>
            </div>
            <div class="row margin-bottom-40">
                <div class="col-md-1">                       
                </div>
                <!-- Login-Form -->
                <div class="col-md-10">
                    <form class="sky-form" id="sky-form1" action="<?php echo Yii::app()->request->baseUrl . '/site/changePasswordConfirm'; ?>" novalidate="novalidate" method="post">
                        <header>Change Password</header>

                        <fieldset>        
                            <input type="hidden" id="orgpwd" name="orgpwd" value="<?php echo $currentPasword; ?>">
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Original Password</label>
                                    <div class="col col-8">
                                        <label class="input state-error">
                                            <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="originalpwd" placeholder="Original Password" id="originalpwd" class="invalid">
                                            <lable id="validate"></lable>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">New Password</label>
                                    <div class="col col-8">
                                        <label class="input state-error">
                                            <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="password" id="password"  class="invalid" placeholder="New Password" id="password">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b>
                                            <lable id="valid"></lable>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Verify New Password</label>
                                    <div class="col col-8">
                                        <label class="input state-error">
                                            <i class="icon-append fa fa-lock"></i>
                                            <input type="password" name="passwordConfirm" class="invalid" id="passwordConfirm" placeholder="Verify New Password">
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
                <div class="col-md-1">                       
                </div>
                <!-- End Login-Form -->
            </div><!--/end row-->                
        </div>
        <div class="col-md-1">

        </div>
        <!-- End Content -->
    </div>          
</div><!--/container--> 


</div><!--/End Wrapepr-->
<script type="text/javascript">
    $('#passwordConfirm').on('keyup', function () {
        if ($(this).val() == $('#password').val()) {
            $('#message').html('Congrats...! The Passwords are matching').css('color', 'green');
        } else $('#message').html('Sorry...!Passwords are not patching...Try again' ).css('color', 'red');
    });
    $('#originalpwd').on('keyup', function () {              
        if (calcMD5($(this).val()) == $('#orgpwd').val()) {               
            $('#validate').html('Congrats...! The Passwords are matching').css('color', 'green');
        } else $('#validate').html('Sorry...!Passwords are not matching...Try again' ).css('color', 'red');
    });
    $('#password').on('keyup', function () {              
        if (calcMD5($(this).val()) == $('#orgpwd').val()) {               
            $('#valid').html('New Password And Current Passwords are Same.').css('color', 'red');
        } else $('#valid').html('Please Remember This Password to login After the Successfull Completion' ).css('color', 'green');
    });
        
</script>