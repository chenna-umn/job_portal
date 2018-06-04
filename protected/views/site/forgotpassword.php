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
                        <form class="sky-form" id="sky-form1" action="<?php echo Yii::app()->request->baseUrl.'/site/ForgotPassword';?>" novalidate="novalidate" method="post">
                            <header>Forgot Password</header>                            
                            <fieldset>                  
                                <section>
                                    <div class="row">
                                        <label class="label col col-4">Enter Your Email to retrieve Password</label>
                                        <div class="col col-8">
                                            <label class="input state-error">
                                                <i class="icon-append fa fa-user"></i>
                                                <input type="email" name="ForgotPassword[username]" placeholder="Email" class="invalid">
                                            </label><em for="email" class="invalid">Please enter your email address</em>
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
    
    
    </div><!--/End Wrapepr-->