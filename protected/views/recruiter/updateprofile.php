<div class="container content" style="padding-top: 0px;">
    <div class="row" style="padding-bottom: 50px;">
            <!-- Begin Sidebar Menu -->
            <div class="col-md-4">
                
            </div>
            <div class="col-md-4"> 
               
            </div>
            <div class="col-md-4">
                
            </div>
    </div>
    <div class="row" >
            <!-- Begin Sidebar Menu -->
            <div class="col-md-1">
                
            </div>
            <!-- End Sidebar Menu -->

            <!-- Begin Content -->
            <div class="col-md-10" style="background: #dedede;">
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
                <div class="row margin-bottom-40" style="padding-top: 20px;">
                     <form action="<?php echo Yii::app()->request->baseUrl.'/Recruiter/updateprofile?id='.Yii::app()->user->recId;;?>" id="sky-form4" class="sky-form" method="post" enctype="multipart/form-data">
                    <div class="col-md-8">
                        <!-- Reg-Form -->
                       
                            <header>Profile Details</header>
                           
                            <fieldset>                  
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="name" placeholder="name" class="invalid" value="<?php echo $model->name;?>" required>
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                    </label>
                                </section>
                                
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-envelope"></i>
                                        <input type="email" name="email" id="register_email" class="invalid" placeholder="Email address" oncopy="return false;" onpaste="return false;" oncut="return false;" value="<?php echo $model->email;?>" disabled>
                                        <b class="tooltip tooltip-bottom-right">Needed to verify your account</b>
                                        <lable id="emailalert"></lable>
                                    </label>
                                </section>
                                
                                 <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-envelope"></i>
                                        <input type="number" name="mobile" id="register_email" class="invalid" placeholder="Mobile Number" maxlength="10" value="<?php echo $model->mobile;?>">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the mobile</b>                                        
                                    </label>
                                </section>                               
                                <section>						
						<label class="textarea textarea-resizable">
							<textarea rows="5" name="about" placeholder="About Me"> <?php echo  $model->about;?></textarea>
						</label>
				</section>
                                
                               
                                <section>                                                                                       
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="designation" class="invalid" placeholder="Designation" value="<?php echo $model->designation;?>">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the Designation</b>
                                    </label>
                                </section>
                                <section>
                                    <label class="input">
                                        <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="organization" class="invalid" placeholder="Organization" value="<?php echo $model->organization;?>">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the Organization</b>
                                    </label>
                                </section>
                                <section>
                                    <label class="select state-error">
                                        <select name="type" class="invalid">
                                            <option selected value="">Select</option>
                                            <option value="2" <?php  if($model->type==2){?>selected <?php } ?>>Direct Employee</option>
                                            <option value="3" <?php  if($model->type==3){?>selected <?php } ?>>Recruitment Firm</option>                                            
                                        </select>
                                        <i></i>
                                    </label><em for="type" class="invalid">Please select your Option</em>
                                </section>
                              
                            </fieldset>
                              <footer>
                                <button class="btn-u" type="submit">Submit</button>    
                                <button class="btn-u btn-u-default" type="reset">Cancel</button> 
                            </footer>
                        <!--</form>-->         
                        <!-- End Reg-Form -->
                    </div>

                    <!-- Login-Form -->
                    <div class="col-md-4 sky-form">
                        <!--<form class="sky-form" id="sky-form1" action="<?php //echo Yii::app()->request->baseUrl.'/site/login';?>" novalidate="novalidate" method="post">-->
                            <header>Upload Photos</header>
                            
                            <fieldset>                  
                                <section>
                                     <label class="label">Profile Pic</label>
                                        <label>
                                            <input type="file" name="profile_pic">
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Company Logo</label>
                                       <label>
                                                <input type="file" name="company_logo">
                                        </label>
                                </section>  
                       
                    </div>
                    </form> 
                    <!-- End Login-Form -->
                </div><!--/end row-->                
            </div>
            <div class="col-md-1">
                
            </div>
            <!-- End Content -->
        </div>          
    </div><!--/container--> 
      

    </div><!--/End Wrapepr-->