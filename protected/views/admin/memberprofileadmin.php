   <!--=== Content Part ===-->
    <div class="container s-results margin-bottom-50">
        <div class="job-description">
        <div class="container content">
            <?php if(isset($memberPersonal) && !empty($memberPersonal)){?>
            <div class="title-box-v2">
                <h2><?php echo $memberPersonal->name.' - ';?>Profile Information</h2>                
            </div>    
            <?php } ?>
            <div class="row">
                <!-- Left Inner -->
                <div class="col-md-3 md-margin-bottom-40">
            <?php $this->renderPartial('adminleftbar');?>
            <!--End Left Sidebar-->
              </div>
                <div class="col-md-9">
                    <div class="row">
                         <div class="col-md-3" >
                             <label>Current Status</label>
                             <?php 
                             
                             $approvalStatus = User::model()->getAdminApprocalStatusByUserId($memberPersonal->user_id);
                             if ($approvalStatus == 0) { ?>
                                    <span class="label label-danger" id="admin_approval_status<?php echo $memberPersonal->user_id; ?>">Yet To View & Approve</span>
                                <?php } else if ($approvalStatus == 1) { ?>
                                    <span class="label label-success" id="admin_approval_status<?php echo $memberPersonal->user_id; ?>">Approved</span>
                                <?php } else if ($approvalStatus == 2) { ?>
                                    <span class="label label-info" id="admin_approval_status<?php echo $memberPersonal->user_id; ?>">Returned for Changes</span>
                                <?php } else if ($approvalStatus == 3) { ?>
                                    <span class="label label-warning" id="admin_approval_status<?php echo $memberPersonal->user_id; ?>">Marked as Non-Relevant</span>
                                <?php }
                                ?>
                         </div>
                         <div class="col-md-9" >
                             <label>Status Change As </label>
                             <button class="btn btn-info btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $memberPersonal->user_id; ?>',1)"><i class="fa fa-share"></i> Approve</button>
                                <button class="btn btn-warning btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $memberPersonal->user_id; ?>',2)"><i class="fa fa-pencil"></i> Changes need</button>
                                <button class="btn btn-danger btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $memberPersonal->user_id; ?>',3)"><i class="fa fa-trash-o"></i> Not Relevant</button>
                         </div>
                    </div>
                    
                    <div class="">                        
                         <?php if(isset($memberPersonal) && !empty($memberPersonal)){?>
                        <div class="row">
                        <div class="col-md-3" >
                        <?php if(isset($memberUploads->profile_pic) && !empty($memberUploads->profile_pic)) {?>
                        <img style="width: 100%;height:100%;" alt="Profile Pic" src="<?php echo Yii::app()->request->baseUrl.'/uploads/profilepics/'.$memberUploads->profile_pic;?>">
                        <?php  } ?>
                        </div>
                        <div class="col-md-9">
                        <h3><?php echo $memberPersonal->name;?></h3>
                        <?php if(isset($memberUploads->resume) && !empty($memberUploads->resume)) {?>
                        Resume : <a href="<?php echo Yii::app()->request->baseUrl . '/Member/download?name='.$memberUploads->resume.'&path=uploads/resume'; ?>"><i class="fa fa-download"></i> <?php echo $memberUploads->resume;?></a>                          
                         <?php } ?> 
                        </div> </div><?php } ?>
                         
                        
                     <hr>
                        <?php if(isset($memberPersonal) && !empty($memberPersonal)){ ?>
                      <h2>Personal Details</h2>
                        <div class="progression">
                            <div class="row">
                                    <div class="col-md-4">
                                        Gender
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.$memberPersonal->gender; ?>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        Mobile
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.$memberPersonal->mobile; ?>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        DOB
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.$memberPersonal->gender; ?>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                       Current Location
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.City::model()->getLocation($memberPersonal->current_location); ?>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                       Preferred Location
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.City::model()->getLocation($memberPersonal->preferred_location); ?>
                                    </div>
                            </div>
                             <div class="row">
                                    <div class="col-md-4">
                                       Industry
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.Category::model()->getIndustryNameById($memberPersonal->industry); ?>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        Functional Area
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.Skillsub::model()->getFunctionalAreaById($memberPersonal->functional_area); ?>
                                        
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        Notice Period
                                    </div>
                                    <div class="col-md-8">
                                        <?php if($memberPersonal->notice_period == 1){
                                            echo " : Immediately Available";
                                        }else if($memberPersonal->notice_period == 2){
                                            echo " : 1 month";
                                        }else if($memberPersonal->notice_period == 3){
                                            echo " : 3 months";
                                        }else if($memberPersonal->notice_period == 4){
                                            echo " : 6 months";
                                        } 
                                            ?>                                        
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        Experience
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.$memberPersonal->expyear.' Yrs '.$memberPersonal->expmonth.' Months'; ?>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        Current Salary
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.$memberPersonal->current_salary.' Lacks/Anum'; ?>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        Expected Salary
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.$memberPersonal->expected_salary.' Lacks/Anum'; ?>
                                    </div>
                            </div>                            
                        </div>
                        <?php } ?>
                        <hr>

                        <h2>Educational Details</h2>
                        <div class="row">
                            <div class="col-md-2 divstylesavejob" >
                                    Degree
                            </div>
                            
                            <div class="col-md-4 divstylesavejob" >
                                    Institute
                            </div>
                            
                            <div class="col-md-2 divstylesavejob" >
                                    Course Type
                            </div>

                            <div class="col-md-2 divstylesavejob" >
                                    Batch From 
                            </div>

                            <div class="col-md-2 divstylesavejob" >
                                    Batch To
                            </div>

                            
                        </div>
                        <div class="row">
                            <?php
                if (isset($memberEducation) && !empty($memberEducation)) {
                    $i = 0;
                    foreach ($memberEducation as $model) {
                        ?> 
                        <div class="row bgcolor<?php echo $i%10;?>">
                            <div class="col-md-2 divstylepadding">
                                <?php echo Degree::model()->getDegreeNameById($model->degree_id); ?>
                                   
                            </div>

                            <div class="col-md-4 divstylepadding">
                                    <?php echo $model->institute; ?>
                            </div>

                            <div class="col-md-2 divstylepadding">
                                <?php if($model->coursetype == 1){
                                            echo "Full Time";
                                        }else if($model->coursetype == 2){
                                            echo "Part Time";
                                        }else if($model->coursetype == 3){
                                            echo "Distance Learning program";
                                        }else if($model->coursetype == 4){
                                            echo "Executive Program";
                                        } 
                                            ?> 
                                     
                            </div>

                            <div class="col-md-2 divstylepadding">
                                     <?php echo $model->batchfrom; ?>
                            </div>

                            <div class="col-md-2 divstylepadding">
                                     <?php echo $model->batchto; ?>
                            </div>

                            
                        </div>        

                        <?php $i++;
                    }
                } else { ?>
                    <div class="alert alert-info fade in">
                        <strong>Oops!</strong> Currently there are no Records in Educational Details.
                    </div>
                <?php } ?>
                            
                        </div>
                        <hr>

                        <h2>Professional Details</h2>
                        <div class="row">
                            <div class="col-md-4 divstylesavejob" >
                                    Organization
                            </div>
                            
                            <div class="col-md-4 divstylesavejob" >
                                    Designation
                            </div>
                            
                            <div class="col-md-2 divstylesavejob" >
                                    Worked From
                            </div>

                            <div class="col-md-2 divstylesavejob" >
                                    Worked Upto 
                            </div>
                        </div>
                        <div class="row">
                            <?php
                if (isset($memberProfessional) && !empty($memberProfessional)) { 
                    $i = 0;
                    foreach ($memberProfessional as $model) {
                        ?> 
                            <?php if($model->hasexp==1){?>
                        <div class="row bgcolor<?php echo $i%10;?>">
                            <div class="col-md-4 divstylepadding">
                                 <?php echo $model->organization; ?>
                                   
                            </div>

                            <div class="col-md-4 divstylepadding">
                                    <?php echo $model->designation; ?>
                            </div>

                            <div class="col-md-2 divstylepadding">
                                <?php 
                                    $monthNum = sprintf("%02s", $model->frommonth);
                                    $monthName = date("F", strtotime($monthNum));
                                ?>
                                 <?php echo $monthName.' '.$model->fromyear; ?>
                                     
                            </div>

                            <div class="col-md-2 divstylepadding">
                                <?php 
                                    $monthNum = sprintf("%02s", $model->frommonth);
                                    $monthName = date("F", strtotime($monthNum));
                                ?>
                                     <?php echo $monthName.' '.$model->toyear; ?>
                            </div>

                        </div>        

                        <?php $i++;
                    } else { ?>
                    <div class="alert alert-info fade in">
                        <strong>Oops!</strong> The Member Did Not have Any Experience  Till Now.
                    </div>
                <?php } }
                } else { ?>
                    <div class="alert alert-info fade in">
                        <strong>Oops!</strong> Currently there are no Records in Experience Details.
                    </div>
                <?php } ?>
                            
                        </div>
                        <hr>
                         <h2><?php if(isset($memberUploads->resume) && !empty($memberUploads->resume)) {?>
                        Resume : <a href="<?php echo Yii::app()->request->baseUrl . '/Member/download?name='.$memberUploads->resume.'&path=uploads/resume'; ?>"><i class="fa fa-download"></i> <?php echo $memberUploads->resume;?></a>                          
                         <?php } ?></h2>
    
                    </div>
                </div>
                <!-- End Left Inner -->
                
                <!-- Right Inner -->
                
                <!-- End Right Inner -->
            </div>    
        </div>   
    </div>
            
    </div>
    
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
<script>
        
        function adminApproveStatus(userId,status){
        var message = confirm("Are You Sure!\n That You want to Update Status.");
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        if(status==1){
            document.getElementById('admin_approval_status'+userId).className = "";                                         
            $('#admin_approval_status'+userId).addClass('label label-success');  
            document.getElementById('admin_approval_status'+userId).innerHTML = "Approved";                                         
        }else if(status==2){             
            document.getElementById('admin_approval_status'+userId).className = "";                                         
            $('#admin_approval_status'+userId).addClass('label label-info');  
            document.getElementById('admin_approval_status'+userId).innerHTML = "Returned for Changes"; 
        }else if(status==3){             
            document.getElementById('admin_approval_status'+userId).className = "";                                         
            $('#admin_approval_status'+userId).addClass('label label-warning');  
            document.getElementById('admin_approval_status'+userId).innerHTML = "Marked as Non-Relevant"; 
        }
        if (message == true) {                   
            jQuery.ajax({                            
                url: baseurl+'/admin/makeadminApproveStatus',
                type: "POST",
                data: {id: userId,status:status},  
                error: function(){
                    alert("Something Went Wrong...Please Try Later.");
                },
                success: function(resp){                   
                    if(resp=="success"){
                        if(status==1){
                            document.getElementById('admin_approval_status'+userId).className = "";                                         
                            $('#admin_approval_status'+userId).addClass('label label-success');  
                            document.getElementById('admin_approval_status'+userId).innerHTML = "Approved";                                         
                        }else if(status==2){             
                            document.getElementById('admin_approval_status'+userId).className = "";                                         
                            $('#admin_approval_status'+userId).addClass('label label-info');  
                            document.getElementById('admin_approval_status'+userId).innerHTML = "Returned for Changes"; 
                        }else if(status==3){             
                            document.getElementById('admin_approval_status'+userId).className = "";                                         
                            $('#admin_approval_status'+userId).addClass('label label-warning');  
                            document.getElementById('admin_approval_status'+userId).innerHTML = "Marked as Non-Relevant"; 
                        }
                    }else{
                        alert("Something Went Wrong...Please Try Later.");
                    }
                }
            });
        } else {
            alert("Ok. You Have Cancelled The Status Updation.");
        }
            
    }
    </script>

       
    <?php $this->renderPartial('//layouts/footerv'); ?>