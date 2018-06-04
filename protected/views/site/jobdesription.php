
    
    <!--=== Job Description ===-->
    <div class="job-description">
        <div class="container content">
                
            <div class="row">
                <!-- Left Inner -->
                <div class="col-md-8">
                    <?php if(isset($jobDescription) && !empty($jobDescription)){ ?>
                    
                    
                    <div class="left-inner">
                        <h2><?php echo $jobDescription->jobtitle;?></h2>
                        <p><?php echo $jobDescription->description;?></p>
                    </div>   
                    
                    <?php if(isset(Yii::app()->user->memberId)) { ?>
                     <lable id="applyjobalert"></lable>
                     <lable id="savejobalert"></lable>
                     <hr>
                    <?php $applyJob = Applyjob::model()->find('user_id=:user_id AND job_id=:job_id AND status=:status',array(':user_id'=>Yii::app()->user->memberId,':job_id'=>$jobDescription->id,':status'=>1));?>
                     <input type="hidden" id="applystatus<?php echo $jobDescription->id;?>" <?php if(isset($applyJob) && !empty($applyJob)) { ?> value="1" <?php } else { ?> value="0" <?php } ?>>
                    <button class="btn-u <?php if(isset($applyJob) && !empty($applyJob)) { ?> btn-u-sea <?php } else { ?> btn-u-default <?php } ?>" type="button" id="applybtn<?php echo $jobDescription->id;?>" onclick="applyjob('<?php echo $jobDescription->id;?>')"><?php if(isset($applyJob) && !empty($applyJob)) { ?> Applied / Remove from Apply List <?php } else { ?> Apply <?php } ?></button>
                    <?php $saveJob = Savejob::model()->find('user_id=:user_id AND job_id=:job_id AND status=:status',array(':user_id'=>Yii::app()->user->memberId,':job_id'=>$jobDescription->id,':status'=>1));?>
                    <input type="hidden" id="savestatus<?php echo $jobDescription->id;?>" <?php if(isset($saveJob) && !empty($saveJob)) { ?> value="1" <?php } else { ?> value="0" <?php } ?>>
                    <button class="btn-u<?php if(isset($applyJob) && !empty($applyJob)) { ?> btn-u-purple <?php } else { ?> btn-u-default <?php } ?>" type="button" id="savebtn<?php echo $jobDescription->id;?>" onclick="savejob('<?php echo $jobDescription->id;?>')"><?php if(isset($saveJob) && !empty($saveJob)) { ?> Saved / Remove from Save List <?php } else { ?> Save <?php } ?></button> 
                <?php } else {?>
                    
                    <a href="<?php echo Yii::app()->request->baseUrl.'/site/index'?>"><button class="btn-u btn-u-default" type="button" >Apply</button></a>
                    <a href="<?php echo Yii::app()->request->baseUrl.'/site/index'?>"><button class="btn-u btn-u-default" type="button" >Save</button></a>
                    
                    
                    <?php } ?>
                    <?php  } else {?>
                    <div class="alert alert-info fade in">
                        <strong>Oops!</strong> Currently there are Job Postings in Your Search Criteria.
                    </div>
                <?php  } ?>
                </div>
                <!-- End Left Inner -->
                
                <!-- Right Inner -->
                <div class="col-md-4"> 
                    <div class="right-inner">
                        <?php if(isset($jobDescription) && !empty($jobDescription)){ 
                                $recruiterProfile = Recruiterprofile::model()->find('user_id=:user_id',array('user_id'=>$jobDescription->user_id));
                                if(isset($recruiterProfile) && !empty($recruiterProfile)) {
                                ?>
                        <h3>Posted by</h3>     
                        <?php  if(isset($recruiterProfile->profile_pic) && !empty($recruiterProfile->profile_pic)) {?>
                        <img src="<?php echo Yii::app()->request->baseUrl.'/uploads/profilepics/'.$recruiterProfile->profile_pic;?>" alt="">
                        <?php } else {?>
                        <img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/'?>assets/img/testimonials/user.jpg" alt="">
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
           
                       

                        <h3>Overview</h3>
                        <div class="row">
                            <!-- Begin Overview -->
                            <div class="col-sm-6">
                                <div class="overview">
                                    <i class="fa fa-user"></i>
                                    <div class="overflow-h">
                                        <small>Followers</small>
                                        <small>2,1k</small>
                                        <div class="progress progress-u progress-xxs">
                                            <div style="width: 92%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="92" role="progressbar" class="progress-bar progress-bar-u">
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <!-- End Overview -->

                            <!-- Begin Overview -->
                            <div class="col-sm-6">
                                <div class="overview">
                                    <i class="fa fa-share"></i>
                                    <div class="overflow-h">
                                        <small>VieSharews</small>
                                        <small>749k</small>
                                        <div class="progress progress-u progress-xxs">
                                            <div style="width: 77%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="77" role="progressbar" class="progress-bar progress-bar-u">
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <!-- End Overview -->
                        </div>

                        <div class="row margin-bottom-20">
                            <!-- Begin Overview -->
                            <div class="col-sm-6">
                                <div class="overview">
                                    <i class="fa fa-eye"></i>
                                    <div class="overflow-h">
                                        <small>Views</small>
                                        <small>15,7k</small>
                                        <div class="progress progress-u progress-xxs">
                                            <div style="width: 88%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="88" role="progressbar" class="progress-bar progress-bar-u">
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <!-- End Overview -->
                            
                            <!-- Begin Overview -->
                            <div class="col-sm-6">
                                <div class="overview">
                                    <i class="fa fa-group"></i>
                                    <div class="overflow-h">
                                        <small>Opportunity Views</small>
                                        <small>202,8k</small>
                                        <div class="progress progress-u progress-xxs">
                                            <div style="width: 76%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="76" role="progressbar" class="progress-bar progress-bar-u">
                                            </div>
                                        </div>
                                    </div>    
                                </div>
                            </div>
                            <!-- End Overview -->
                        </div>

                        <!-- Pie Chart Progress Bar -->    
                        <div class="row margin-bottom-20">
                            <div class="p-chart col-sm-6 col-xs-6 sm-margin-bottom-10">
                                <h3>Engagement Score</h3>
                                <div class="circle" id="circle-4"></div>
                                <ul class="list-unstyled overflow-h">
                                    <li><i> - </i><a href="#">Tips to Improve</a></li>
                                    <li><i> - </i><a href="#">Compare to Others</a></li>
                                    <li><i> - </i><a href="#">More Information</a></li>
                                </ul>
                            </div> 
                            <div class="p-chart col-sm-6 col-xs-6">
                                <h3>Progfile Completness</h3>
                                <div class="circle" id="circle-5"></div>
                                <ul class="list-unstyled overflow-h">
                                    <li><i> - </i><a href="#">Steps to Completion</a></li>
                                    <li><i> - </i><a href="#">Compare to Others</a></li>
                                    <li><i> - </i><a href="#">More Information</a></li>
                                </ul>    
                            </div>       
                        </div>    
                        <!-- End Pie Chart Progress Bar -->

                        <hr>

                        <h3>What People are Saying about Company</h3>
                        <div class="people-say margin-bottom-20">
                            <img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/testimonials/img2.jpg" alt="">
                            <div class="overflow-h">
                                <span>Eva Maria Kl.</span>
                                <small class="hex pull-right">5 - hours ago</small>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis varius hendrerit nisl id condimentum.</p>
                            </div>    
                        </div>

                        <div class="people-say margin-bottom-20">
                            <img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/testimonials/user.jpg" alt="">
                            <div class="overflow-h">
                                <span>Christian Draxler</span>
                                <small class="hex pull-right">2 - days ago</small>
                                <p>Vestibulum justo est, pharetra fermentum justo in, tincidunt mollis turpis. Duis imperdiet non justo euismod semper.</p>
                            </div>    
                        </div>

                        <div class="people-say">
                            <img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/testimonials/img3.jpg" alt="">
                            <div class="overflow-h">
                                <span>Alex Taylor</span>
                                <small class="hex pull-right">3 - days ago</small>
                                <p>A Wal-Mart cashier is responsible for effectively executing and adhering to the â€œBasic Beliefsâ€� of the founder.</p>
                            </div>    
                        </div>

                        <hr> 

                        <button type="button" class="btn-u btn-block"> Apply with Resume</button>
                    </div>   
                    <?php  } }?>
                </div>
                <!-- End Right Inner -->
            </div>    
        </div>   
    </div>   
    <!--=== End Job Description ===-->
    <script type="text/javascript">
        function applyjob(id){       
     var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";  
     var status = document.getElementById('applystatus'+id).value;
     document.getElementById('applyjobalert').style.display = '';
     if(status == 0){
         $('#applybtn'+id).removeClass('btn-u-default');  
         $('#applybtn'+id).addClass('btn-u-sea');
         document.getElementById('applybtn'+id).innerHTML = "Applied / Remove from Apply List";
         document.getElementById('applystatus'+id).value = 1;         
     }else{
         $('#applybtn'+id).removeClass('btn-u-sea');
         $('#applybtn'+id).addClass('btn-u-default');
           document.getElementById('applybtn'+id).innerHTML = "Apply";
           document.getElementById('applystatus'+id).value = 0;         
     }          
         jQuery.ajax({                            
            url: baseurl+'/member/applyjob',
            type: "POST",
            data: {id:id,status:status},  
            error: function(){
                alert("Something Went Wrong...Please Try Later.");
            },
            success: function(resp){                   
               if(resp == "success"){
                   if(status == 0){
                         $('#applyjobalert').html('Congrats...! Job Applied Successfully.').css('color', 'green');
                   }else{
                         $('#applyjobalert').html('Congrats...! Job Removed from Apply List Successfully.').css('color', 'green');
                   }
                }else if(resp == "expfailed"){
                   $('#applyjobalert').html('You are Not allowed to apply for this job due to less Experiance.' ).css('color', 'red');
               }else{
                   $('#applyjobalert').html('Something Went Wrong...Please Try Later.' ).css('color', 'red');
//                  alert("Something Went Wrong...Please Try Later.");
               }
               setTimeout(function() {
                  $("#applyjobalert").fadeOut().empty();
                }, 3000);
            }
        });
    }
     function savejob(id){       
     var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";  
     var status = document.getElementById('savestatus'+id).value;
     document.getElementById('savejobalert').style.display = '';
     if(status == 0){
         $('#savebtn'+id).removeClass('btn-u-default');  
         $('#savebtn'+id).addClass('btn-u-purple');
         document.getElementById('savebtn'+id).innerHTML = "Saved / Remove from Save List";
         document.getElementById('savestatus'+id).value = 1;         
     }else{
         $('#savebtn'+id).removeClass('btn-u-purple');
         $('#savebtn'+id).addClass('btn-u-default');
           document.getElementById('savebtn'+id).innerHTML = "Save";
         document.getElementById('savestatus'+id).value = 0;         
     }
          
         jQuery.ajax({                            
            url: baseurl+'/member/savejob',
            type: "POST",
            data: {id:id,status:status}, 
            error: function(){
                alert("Something Went Wrong...Please Try Later.");
            },
            success: function(resp){                   
               if(resp == "success"){
                   if(status == 0){
                         $('#savejobalert').html('Congrats...! Job Saved Successfully.').css('color', 'green');
                   }else{
                         $('#savejobalert').html('Congrats...! Job Removed from Save List Successfully.').css('color', 'green');
                   }
               }else{
                   $('#savejobalert').html('Something Went Wrong...Please Try Later.' ).css('color', 'red');
//                  alert("Something Went Wrong...Please Try Later.");
               }
               setTimeout(function() {
                  $("#savejobalert").fadeOut().empty();
                }, 3000);
            }
        });
    }
    </script>
<?php $this->renderPartial('//layouts/footerv'); ?>