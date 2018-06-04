
    
    <!--=== Job Description ===-->
    <div class="job-description">
        <div class="container content">
                
            <div class="row">
                <!-- Left Inner -->
                <div class="col-md-3 md-margin-bottom-40">
            <?php $this->renderPartial('adminleftbar');?>
            <!--End Left Sidebar-->
              </div>
                <div class="col-md-6">
                    <div class="row">
                         <div class="col-md-3" >
                             <label>Current Status</label>
                             <?php 
                             if(isset($jobDescription) && !empty($jobDescription)){ 
                             $approvalStatus = Jobpostings::model()->getAdminApprocalStatusByUserId($jobDescription->user_id);
                             if ($approvalStatus == 0) { ?>
                                    <span class="label label-danger" id="admin_approval_status<?php echo $jobDescription->user_id; ?>">Yet To View & Approve</span>
                                <?php } else if ($approvalStatus == 1) { ?>
                                    <span class="label label-success" id="admin_approval_status<?php echo $jobDescription->user_id; ?>">Approved</span>
                                <?php } else if ($approvalStatus == 2) { ?>
                                    <span class="label label-info" id="admin_approval_status<?php echo $jobDescription->user_id; ?>">Returned for Changes</span>
                                <?php } else if ($approvalStatus == 3) { ?>
                                    <span class="label label-warning" id="admin_approval_status<?php echo $jobDescription->user_id; ?>">Marked as Non-Relevant</span>
                                <?php }
                                ?>
                         </div>
                         <div class="col-md-9">
                             <label>Status Change As </label>
                             <button class="btn btn-info btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $jobDescription->user_id; ?>',1)"><i class="fa fa-share"></i> Approve</button>
                                <button class="btn btn-warning btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $jobDescription->user_id; ?>',2)"><i class="fa fa-pencil"></i> Changes need</button>
                                <button class="btn btn-danger btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $jobDescription->user_id; ?>',3)"><i class="fa fa-trash-o"></i> Not Relevant</button>
                         </div>
                    </div>
                    
                    
                    <?php } ?>
                    <?php if(isset($jobDescription) && !empty($jobDescription)){ ?>
                    
                    
                    <div class="left-inner">
                        <h2><?php echo $jobDescription->jobtitle;?></h2>
                        <p><?php echo $jobDescription->description;?></p>
                    </div>   
                    
                    
                    <?php  } else {?>
                    <div class="alert alert-info fade in">
                        <strong>Oops!</strong> Currently there are Job Postings in Your Search Criteria.
                    </div>
                <?php  } ?>
                </div>
                <!-- End Left Inner -->
                
                <!-- Right Inner -->
                <div class="col-md-3"> 
                    <div class="right-inner">
                        <?php if(isset($jobDescription) && !empty($jobDescription)){ 
                                $recruiterProfile = Recruiterprofile::model()->find('user_id=:user_id',array('user_id'=>$jobDescription->user_id));
                                if(isset($recruiterProfile) && !empty($recruiterProfile)) {
                                ?>
                        <h3>Posted by</h3>     
                        <?php  if(isset($recruiterProfile->profile_pic) && !empty($recruiterProfile->profile_pic)) {?>
                        <img src="<?php echo Yii::app()->request->baseUrl.'/uploads/profilepics/'.$recruiterProfile->profile_pic;?>" alt="" style="width:100%;">
                        <?php } else {?>
                        <img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/'?>assets/img/testimonials/user.jpg" alt="" style="width:100%;">
                        <?php } ?>
                        <div class="overflow-h">
                            <span class="font-s"><?php echo $recruiterProfile->name;?></span>
                            <p class="color-green">Position: <span class="hex"><?php echo $recruiterProfile->designation;?></span></p>
                            <ul class="social-icons">
                                <li><a class="social_facebook" data-original-title="Facebook" href="<?php echo $recruiterProfile->facebook;?>"></a></li>
                                <li><a class="social_googleplus" data-original-title="Google Plus" href="<?php echo $recruiterProfile->facebook;?>"></a></li>
                                <li><a class="social_linkedin" data-original-title="Linkedin" href="<?php echo $recruiterProfile->twitter;?>"></a></li>
                                <li><a class="social_twitter" data-original-title="Twitter" href="<?php echo $recruiterProfile->linkedin;?>"></a></li>
                            </ul>
                        </div>    
                        <div class="people-say" style="margin-top: 10px; margin-bottom: 10px;">                            
                            <div class="overflow-h">
                                <p>Posted in</p>                                
                                <span>Lorem ipsum dolor </span>
                            </div>    
                        </div>
                        <div class="people-say" style="margin-top: 10px; margin-bottom: 10px;">                            
                            <div class="overflow-h">
                                <p>Job Code</p>                                
                                <span><?php echo $jobDescription->id;?></span>
                            </div>    
                        </div>
                        <div class="people-say" style="margin-top: 10px; margin-bottom: 10px;">                            
                            <div class="overflow-h">
                                <p>Location</p>                                
                                <span><?php echo City::model()->getLocation($jobDescription->locations);?></span>
                            </div>    
                        </div>
                        <div class="people-say" style="margin-top: 10px; margin-bottom: 10px;">                            
                            <div class="overflow-h">
                                <p>Posted on</p>                                
                                <span><?php echo $jobDescription->created_on;?> </span>
                            </div>    
                        </div>
                        <div class="people-say" style="margin-top: 10px; margin-bottom: 10px;">                            
                            <div class="overflow-h">
                                <p>Views</p>                                
                                <span><?php echo $jobDescription->views;?></span>
                            </div>    
                        </div>
                        <div class="people-say" style="margin-top: 10px; margin-bottom: 10px;">                            
                            <div class="overflow-h">
                                <p>Applications</p>                                
                                <span><?php echo Jobpostings::model()->getCountOfJob($jobDescription->id);?></span>
                            </div>    
                        </div>
                        <hr>
           
                    </div>   
                    <?php  } }?>
                </div>
                <!-- End Right Inner -->
            </div>    
        </div>   
    </div>   
    <!--=== End Job Description ===-->
    
<?php $this->renderPartial('//layouts/footerv'); ?>