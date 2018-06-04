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
                <div class="col-md-9">
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
                <div class="col-md-3"> 
                      
                </div>
                <!-- End Right Inner -->
            </div>    
        </div>   
    </div>
            
    </div>
    
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
<script type="text/javascript">  
    
    
    
</script>

       
    <?php $this->renderPartial('//layouts/footerv'); ?>