

    <!--=== Profile ===-->
    <div class="profile container content">
    	<div class="row">
            <!--Left Sidebar-->
              <div class="col-md-3 md-margin-bottom-40">
            <?php $this->renderPartial('adminleftbar');?>
            <!--End Left Sidebar-->
              </div>
            <div class="col-md-9">
                <!--Profile Body-->
                <div class="profile-body">
                    <!--Service Block v3-->
                    <div class="row margin-bottom-10">
                        <div class="col-sm-3 sm-margin-bottom-20">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=all&userstatus=all&adminapprovestatus=all' ?>">  
                                <div class="service-block-v3 service-block-u">                               
                                <span class="service-heading">Total Users</span>
                                <span class="counter" id="total_users"><?php echo User::model()->getTotalUserCount();?></span>
                                            
                            </div></a>
                        </div>
                        
                        <div class="col-sm-3">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=all&userstatus=1&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-blue">                              
                                <span class="service-heading">Active Users</span>
                                <span class="counter" id="total_users_active"><?php echo User::model()->getUserCountByStatus(1);?></span>
                            </div>
                            </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=all&userstatus=0&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-blue">                               
                                <span class="service-heading">Inactive Users</span>
                                <span class="counter" id="total_users_inactive"><?php echo User::model()->getUserCountByStatus(0);?></span>
                                           
                            </div>
                                </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=all&userstatus=all&adminapprovestatus=0' ?>">
                            <div class="service-block-v3 service-block-blue">                               
                                <span class="service-heading">Users To Be approve</span>
                                <span class="counter" id="total_users_to_be_approve"><?php echo User::model()->getUserCountByAdminApproveStatus(0);?></span>
                                           
                            </div>
                                </a>
                        </div>
                    </div><!--/end row-->
                    <!--End Service Block v3--> 
                </div>
                <div class="profile-body">
                    <!--Service Block v3-->
                    <div class="row margin-bottom-10">
                        <div class="col-sm-3 sm-margin-bottom-20">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=4&userstatus=all&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-u">                              
                                <span class="service-heading">Total Job Seekers</span>
                                <span class="counter" id="jobseekers_total"><?php echo User::model()->getTotalUserCountByType(4);?></span>
                                            
                            </div></a>
                        </div>
                        
                        <div class="col-sm-3">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=4&userstatus=1&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-blue">                               
                                <span class="service-heading">Active Job Seekers</span>
                                <span class="counter" id="jobseekers_active"><?php echo User::model()->getUserCountByStatusAndType(4,1);?></span>
                            </div></a>
                        </div>
                        <div class="col-sm-3">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=4&userstatus=0&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-blue">                               
                                <span class="service-heading">Inactive Job Seekers</span>
                                <span class="counter" id="jobseekers_inactive"><?php echo User::model()->getUserCountByStatusAndType(4,0);?></span>
                                           
                            </div></a>
                        </div>
                        <div class="col-sm-3">
                            <div class="service-block-v3 service-block-blue">  
                                <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=4&userstatus=all&adminapprovestatus=0' ?>">
                                <span class="service-heading">Job Seekers To Be approve</span>
                                <span class="counter" id="jobseekers_to_be_approve"><?php echo User::model()->getUserCountByAdminApproveStatusAndType(4,0);?></span>
                                           
                            </div></a>
                        </div>
                    </div><!--/end row-->
                    <!--End Service Block v3--> 
                </div>
                <div class="profile-body">
                    <!--Service Block v3-->
                    <div class="row margin-bottom-10">
                        <div class="col-sm-3 sm-margin-bottom-20">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=2&userstatus=all&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-u">                                
                                <span class="service-heading">Total Recruiters</span>
                                <span class="counter" id="recruiters_total"><?php echo User::model()->getTotalUserCountByType(2);?></span>
                                            
                            </div></a>
                        </div>
                        
                        <div class="col-sm-3">
                              <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=2&userstatus=1&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-blue">                               
                                <span class="service-heading">Active Recruiters</span>
                                <span class="counter" id="recruiters_active"><?php echo User::model()->getUserCountByStatusAndType(2,1);?></span>
                            </div></a>
                        </div>
                        <div class="col-sm-3">
                             <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=2&userstatus=0&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-blue">                               
                                <span class="service-heading">Inactive Recruiters</span>
                                <span class="counter" id="recruiters_inactive"><?php echo User::model()->getUserCountByStatusAndType(2,0);?></span>
                                           
                            </div></a>
                        </div>
                        
                        <div class="col-sm-3">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=2&userstatus=all&adminapprovestatus=0' ?>">
                            <div class="service-block-v3 service-block-blue">                               
                                <span class="service-heading">Recruiters To Be approve</span>
                                <span class="counter" id="recruiters_to_be_approve"><?php echo User::model()->getUserCountByAdminApproveStatusAndType(2,0);?></span>
                                           
                            </div></a>
                        </div>
                    </div><!--/end row-->
                    <!--End Service Block v3--> 
                </div>
                <div class="profile-body">
                    <!--Service Block v3-->
                    <div class="row margin-bottom-10">
                        <div class="col-sm-3 sm-margin-bottom-20">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=3&userstatus=all&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-u">                             
                                <span class="service-heading">Total Recruiting-Firms</span>
                                <span class="counter" id="recruiting_firms_total"><?php echo User::model()->getTotalUserCountByType(3);?></span>
                                            
                            </div></a>
                        </div>
                        
                        <div class="col-sm-3">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=3&userstatus=1&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-blue">                             
                                <span class="service-heading">Active Recruiting-Firms</span>
                                <span class="counter" id="recruiting_firms_active"><?php echo User::model()->getUserCountByStatusAndType(3,1);?></span>
                            </div>
                            </a>
                        </div>
                        <div class="col-sm-3">
                             <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=3&userstatus=0&adminapprovestatus=all' ?>"><div class="service-block-v3 service-block-blue">
                                 <span class="service-heading">Inactive Recruiting-Firms</span>
                                <span class="counter" id="recruiting_firms_inactive"><?php echo User::model()->getUserCountByStatusAndType(3,0);?></span>
                            </div></a>
                        </div>
                        <div class="col-sm-3">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/usersByStatus?usertype=3&userstatus=all&adminapprovestatus=0' ?>">
                            <div class="service-block-v3 service-block-blue">
                               
                                <span class="service-heading">Recruiting-Firms To Be approve</span>
                                <span class="counter" id="recruiting_firms_to_be_approve"><?php echo User::model()->getUserCountByAdminApproveStatusAndType(3,0);?></span>
                                           
                            </div></a>
                        </div>
                    </div><!--/end row-->
                    <!--End Service Block v3--> 
                </div>
                
                <div class="profile-body">
                    <!--Service Block v3-->
                    <div class="row margin-bottom-10">
                        <div class="col-sm-3 sm-margin-bottom-20">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/jobPostingsByStatus?type=all&status=all&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-u">                             
                                <span class="service-heading">Total Job Postings</span>
                                <span class="counter" id="job_postings_total"><?php echo Jobpostings::model()->recordCount('all');?></span>
                                            
                            </div></a>
                        </div>
                        
                        <div class="col-sm-3">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/jobPostingsByStatus?type=all&status=1&adminapprovestatus=all' ?>">
                            <div class="service-block-v3 service-block-blue">                             
                                <span class="service-heading">Active Job Postings</span>
                                <span class="counter" id="job_postings_active"><?php echo Jobpostings::model()->recordCount('active');?></span>
                            </div>
                            </a>
                        </div>
                        <div class="col-sm-3">
                             <a href="<?php echo Yii::app()->request->baseUrl . '/admin/jobPostingsByStatus?type=all&status=0&adminapprovestatus=all' ?>">
                                 <div class="service-block-v3 service-block-blue">
                                     <span class="service-heading">Inactive Job Postings</span>
                                     <span class="counter" id="job_postings_inactive"><?php echo Jobpostings::model()->recordCount('inactive');?></span>
                                </div>
                             </a>
                        </div>
                        <div class="col-sm-3">
                            <a href="<?php echo Yii::app()->request->baseUrl . '/admin/jobPostingsByStatus?type=all&status=all&adminapprovestatus=0' ?>">
                            <div class="service-block-v3 service-block-blue">                               
                                <span class="service-heading">Job Postings To Be approve</span>
                                <span class="counter" id="job_postings_to_be_approve"><?php echo Jobpostings::model()->getJobPostingsCountByAdminApproveStatus(0);?></span>
                                           
                            </div></a>
                        </div>
                    </div><!--/end row-->
                    <!--End Service Block v3--> 
                </div>
                <!--End Profile Body-->
            </div>
        </div><!--/end row-->
    </div><!--/container-->    
    <!--=== End Profile ===-->
    <script type="text/javascript">
        setInterval(function(){
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
            jQuery.ajax({                            
                url: baseurl+'/admin/getTotalUserCountAjax',
                type: "POST",
                data: {},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('total_users').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByStatusAjax',
                type: "POST",
                data: {status:1},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('total_users_active').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByStatusAjax',
                type: "POST",
                data: {status:0},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('total_users_inactive').innerHTML = resp;
                }
            });
             jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByAdminApproveStatusAjax',
                type: "POST",
                data: {status:0},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('total_users_to_be_approve').innerHTML = resp;
                }
            });
            
            
            
            
            jQuery.ajax({                            
                url: baseurl+'/admin/getTotalUserCountByTypeAjax',
                type: "POST",
                data: {type:4},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('jobseekers_total').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByStatusAndTypeAjax',
                type: "POST",
                data: {type:4,status:1},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('jobseekers_active').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByStatusAndTypeAjax',
                type: "POST",
                data: {type:4,status:0},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('jobseekers_inactive').innerHTML = resp;
                }
            });
             jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByAdminApproveStatusAndTypeAjax',
                type: "POST",
                data: {type:4,status:0},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('jobseekers_to_be_approve').innerHTML = resp;
                }
            });
            
            
            jQuery.ajax({                            
                url: baseurl+'/admin/getTotalUserCountByTypeAjax',
                type: "POST",
                data: {type:2},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('recruiters_total').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByStatusAndTypeAjax',
                type: "POST",
                data: {type:2,status:1},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('recruiters_active').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByStatusAndTypeAjax',
                type: "POST",
                data: {type:2,status:0},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('recruiters_inactive').innerHTML = resp;
                }
            });
             jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByAdminApproveStatusAndTypeAjax',
                type: "POST",
                data: {type:2,status:0},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('recruiters_to_be_approve').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getTotalUserCountByTypeAjax',
                type: "POST",
                data: {type:2},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('recruiting_firms_total').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByStatusAndTypeAjax',
                type: "POST",
                data: {type:2,status:1},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('recruiting_firms_active').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByStatusAndTypeAjax',
                type: "POST",
                data: {type:2,status:0},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('recruiting_firms_inactive').innerHTML = resp;
                }
            });
             jQuery.ajax({                            
                url: baseurl+'/admin/getUserCountByAdminApproveStatusAndTypeAjax',
                type: "POST",
                data: {type:2,status:0},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('recruiting_firms_to_be_approve').innerHTML = resp;
                }
            });
            
            
            
            jQuery.ajax({                            
                url: baseurl+'/admin/getTotalJobPostingCountAjax',
                type: "POST",
                data: {status:'all'},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('job_postings_total').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getTotalJobPostingCountAjax',
                type: "POST",
                data: {status:'active'},    
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('job_postings_active').innerHTML = resp;
                }
            });
            jQuery.ajax({                            
                url: baseurl+'/admin/getTotalJobPostingCountAjax',
                type: "POST",
                data: {status:'inactive'},               
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('job_postings_inactive').innerHTML = resp;
                }
            });
             jQuery.ajax({                            
                url: baseurl+'/admin/getJobPostingsCountByAdminApproveStatusAjax',
                type: "POST",
                data: {status:0},  
                error: function(){

                },
                success: function(resp){                   
                    document.getElementById('job_postings_to_be_approve').innerHTML = resp;
                }
            });
        },120000);
    </script>
    <?php $this->renderPartial('//layouts/footerv'); ?>