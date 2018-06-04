<div class="container content" style="padding-top: 0px;">
    <div class="row" style="margin-top: 20px;">
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
    <div class="row" style="margin-top: 20px;">
        <!-- Begin Sidebar Menu -->
        <div class="col-md-2" >
            <a href="<?php echo Yii::app()->request->baseUrl . '/Member/create1?id='.$user_id; ?>" ><button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Personal Details</button></a>
        </div>
        <div class="col-md-2"> 
            <a href="<?php echo Yii::app()->request->baseUrl . '/Member/create2?id='.$user_id; ?>"> <button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Education Details</button></a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo Yii::app()->request->baseUrl . '/Member/create3?id='.$user_id; ?>"> <button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Professional Details</button></a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo Yii::app()->request->baseUrl . '/Member/create4?id='.$user_id; ?>" ><button class="btn-u btn-u-sm rounded-2x btn-u-brown" type="button">Resume Uploads</button></a>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <div class="row">

        
          
            
            <div class="row">
                <form action="<?php echo Yii::app()->request->baseUrl . '/Member/create4?id='.$user_id; ?>" id="sky-form4" class="sky-form" method="post" enctype="multipart/form-data">
                <div class="col-md-6">
                    <!-- Reg-Form -->
                    
                        <header>Please upload your resume here </header>
                        <fieldset>   
                            <section>
						<label class="label">Attach Resume</label>
						<label class="input input-file" for="file">
							<div class="button"><input type="file" name="resume" accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="this.parentNode.nextSibling.value = this.value" id="file">Browse</div><input type="text" readonly="">
						</label>
                            </section>                              
                        </fieldset>
                        <footer>
                            
                            <button type="submit" class="btn-u pull-right">Submit & Continue</button>
                        </footer>
                          
                    <!-- End Reg-Form -->
                </div>

                <!-- Login-Form -->
                <div class="col-md-6 sky-form"> 
                     <header>Please upload your Profile Pic here </header>
                        <fieldset>                  
                            <section>
						<label class="label">Attach Profile Pic</label>
						<label class="input input-file" for="file1">
							<div class="button"><input type="file" name="pic" accept="image/*" onchange="this.parentNode.nextSibling.value = this.value" id="file1">Browse</div><input type="text" readonly="">
						</label>
                            </section>
                        </fieldset>
                        
                   
                </div>
                 </form> 
                <!-- End Login-Form -->
            </div><!--/end row-->      
            
            
            <?php if(isset($Memberuploads) && !empty($Memberuploads)) {?>
             <div class="row margin-bottom-40 sky-form">
                
                 <?php if(isset($Memberuploads->resume) && !empty($Memberuploads->resume)) { ?>
                    <div class="col-md-6">
                    <fieldset>                  
                            <section>
						<label class="label">Resume</label>
						<label class="label"> <a href="<?php echo Yii::app()->request->baseUrl . '/Member/download?name='.$Memberuploads->resume.'&path=uploads/resume'; ?>"> <?php echo $Memberuploads->resume;?></a></label>
                            </section>
                        </fieldset>
                </div>
<?php } ?>
                <!-- Login-Form -->
                <?php if(isset($Memberuploads->profile_pic) && !empty($Memberuploads->profile_pic)) { ?>
                <div class="col-md-6 sky-form"> 
                     
                        <fieldset>                  
                            <section>
						<label class="label">Profile Pic</label>
						<label class="label"> <a href="<?php echo Yii::app()->request->baseUrl . '/Member/download?name='.$Memberuploads->profile_pic.'&path=uploads/profilepics'; ?>"> <?php echo $Memberuploads->profile_pic;?></a></label>
                            </section>
                        </fieldset>
                   
                </div>
                <?php } ?>
               
                <!-- End Login-Form -->
            </div>
            
            <?php } ?>
            
            
            
            
            
            
            
        </div>

        <!-- End Content -->
    </div>          
</div><!--/container--> 

</div><!--/End Wrapepr-->