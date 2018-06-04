   <!--=== Content Part ===-->
    <div class="container s-results margin-bottom-50">
        <div class="job-description">
        <div class="container content">
            <?php if(isset($recruiterProfile) && !empty($recruiterProfile)){?>
            <div class="title-box-v2">
                <h2><?php echo $recruiterProfile->name.' - ';?>Profile Information</h2>                
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
                             
                             $approvalStatus = User::model()->getAdminApprocalStatusByUserId($recruiterProfile->user_id);
                             if ($approvalStatus == 0) { ?>
                                    <span class="label label-danger" id="admin_approval_status<?php echo $recruiterProfile->user_id; ?>">Yet To View & Approve</span>
                                <?php } else if ($approvalStatus == 1) { ?>
                                    <span class="label label-success" id="admin_approval_status<?php echo $recruiterProfile->user_id; ?>">Approved</span>
                                <?php } else if ($approvalStatus == 2) { ?>
                                    <span class="label label-info" id="admin_approval_status<?php echo $recruiterProfile->user_id; ?>">Returned for Changes</span>
                                <?php } else if ($approvalStatus == 3) { ?>
                                    <span class="label label-warning" id="admin_approval_status<?php echo $recruiterProfile->user_id; ?>">Marked as Non-Relevant</span>
                                <?php }
                                ?>
                         </div>
                         <div class="col-md-9" >
                             <label>Status Change As </label>
                             <button class="btn btn-info btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $recruiterProfile->user_id; ?>',1)"><i class="fa fa-share"></i> Approve</button>
                                <button class="btn btn-warning btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $recruiterProfile->user_id; ?>',2)"><i class="fa fa-pencil"></i> Changes need</button>
                                <button class="btn btn-danger btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $recruiterProfile->user_id; ?>',3)"><i class="fa fa-trash-o"></i> Not Relevant</button>
                         </div>
                    </div>
                    <hr>
                    <div class="">                        
                         <?php if(isset($recruiterProfile) && !empty($recruiterProfile)){?>
                        <div class="row">
                        <div class="col-md-3" >
                        <?php if(isset($recruiterProfile->profile_pic) && !empty($recruiterProfile->profile_pic)) {?>
                        <img style="width: 100%;height:100%;" alt="Profile Pic" src="<?php echo Yii::app()->request->baseUrl.'/uploads/profilepics/'.$recruiterProfile->profile_pic;?>">
                        <?php  } ?>
                        </div>
                        <div class="col-md-3" >
                        <?php if(isset($recruiterProfile->company_logo) && !empty($recruiterProfile->company_logo)) {?>
                        <img style="width: 100%;height:100%;" alt="Company Logo" src="<?php echo Yii::app()->request->baseUrl.'/uploads/profilepics/'.$recruiterProfile->company_logo;?>">
                        <?php  } ?>
                        </div>
                        <div class="col-md-6">
                        <h3><?php echo $recruiterProfile->name;?></h3>                        
                        </div> </div><?php } ?>
                         
                        
                     <hr>
                        <?php if(isset($recruiterProfile) && !empty($recruiterProfile)){ ?>
                      <h2>Personal Details</h2>
                        <div class="progression">    
                            <div class="row">
                                    <div class="col-md-4">
                                        Email
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.$recruiterProfile->email; ?>
                                    </div>
                            </div>
                            
                            <div class="row">
                                    <div class="col-md-4">
                                        Mobile
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.$recruiterProfile->mobile; ?>
                                    </div>
                            </div>
                            
                            <div class="row">
                                    <div class="col-md-4">
                                       Organization
                                    </div>
                                     <div class="col-md-8">
                                        <?php echo ' : '.$recruiterProfile->organization; ?>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                       Designation
                                    </div>
                                     <div class="col-md-8">
                                        <?php echo ' : '.$recruiterProfile->designation; ?>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                       Recruiter Type
                                    </div>
                                    <div class="col-md-8">
                                        <?php if($recruiterProfile->type == 2) { echo " : Direct Recruiter"; } else { echo " : Recruiter Firm";}?>
                                    </div>
                            </div>
                             <div class="row">
                                    <div class="col-md-4">
                                       About
                                    </div>
                                    <div class="col-md-8" style="word-break:break-all;">
                                        <?php echo ' : '.$recruiterProfile->about; ?>
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        Facebook
                                    </div>
                                    <div class="col-md-8">
                                        <?php echo ' : '.$recruiterProfile->facebook; ?>
                                        
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        twitter
                                    </div>
                                    <div class="col-md-8">
                                         <?php echo ' : '.$recruiterProfile->twitter; ?>
                                        
                                    </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-4">
                                        linkedin
                                    </div>
                                    <div class="col-md-8">
                                         <?php echo ' : '.$recruiterProfile->linkedin; ?>
                                        
                                    </div>
                            </div>
                            
                                                       
                        </div>
                        <?php } ?>
                        
                        
                        <hr>
                       
    
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