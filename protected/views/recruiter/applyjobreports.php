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
    <div class="row margin-bottom-10">                      
                        <div class="col-md-6 sky-form">
                            	
                                <section>
                                    <div class="row">
                                            <label class="label col col-4">Search by Job</label>
                                            <div class="col col-8">
                                                    <label class="select">
                                                         <select onchange="searchBy(this.value);">                                                             
                                                             <option value="all" selected>All Jobs</option>
                                                     <?php   if(isset($totalJobsPosted) && !empty($totalJobsPosted)){ 
                                                            foreach ($totalJobsPosted as $key => $value) { ?>                                                             
                                                                    <option value="<?php echo $value['id'];?>" <?php if(isset($_GET['id']) && $_GET['id']==$value['id']) { ?> selected <?php } ?>><?php echo $value['jobtitle'];?></option>
                                                           <?php } } ?>                                                                                                             
                                                       </select>
                                                        <i></i>
                                                    </label>
                                            </div>
                                    </div>
                                </section>                                                    
                           
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                    </div>
    <div class="row margin-bottom-10">        
        <div class="col-md-9">
            <div class="row margin-bottom-10">
                <p>Result Count : <?php echo $count; ?></p>
                <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                ));

                $this->widget('CListPager', array(
                    'pages' => $pages,
                ));

                foreach ($models as $model) {
                    ?>

                <?php }
                ?>
            </div>
            <div class="row margin-bottom-10">                       
                                    <div class=" margin-bottom-20">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Job Reference id</th>
                                                        <th>Job Title</th>
                                                        <th>Locations</th>
                                                        <th>Updated On</th>
                                                        <th>Job Seeker Name</th>
                                                        <th>Applied Status</th> 
                                                        <th>Recruiter Response Status</th>
                                                        <th>Action</th>                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <?php 
                                                     if(isset($models) && !empty($models)){
                                                         $i=0;
                                                            foreach($models as $model){?>                                                         
                                                    <tr id="record<?php echo $model['apid'];?>" class="bgcolor<?php echo $i%10;?>">
                                                        <td>
                                                            <?php echo $model['job_id'];?>
                                                        </td>
                                                        <td>                                                            
                                                            <a href="<?php echo Yii::app()->request->baseUrl . '/jd-'.User::model()->seoFriendlyUrl($model['jobtitle']).'-' . $model['job_id'].'.htm'; ?>" style="color:#72c02c;text-decoration: none;" target="_blank"><?php echo $model['jobtitle'];?></a>
                                                        </td>
                                                        <td>
                                                           <?php echo City::model()->getLocation($model['locations']);?>
                                                        </td>                                                        
                                                        <td>
                                                             <?php echo $model['updated_on'];?>  
                                                        </td>
                                                        <td>
                                                             <a href="<?php echo Yii::app()->request->baseUrl . '/mp-'.User::model()->seoFriendlyUrl(Memberpersonal::model()->getJobSeekerNameByUserId($model['jsid'])).'-' . $model['jsid'].'.htm'; ?>" style="color:#72c02c;text-decoration: none;" target="_blank"><?php echo Memberpersonal::model()->getJobSeekerNameByUserId($model['jsid']); ?></a> 
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($model['apstatus']==1){?>
                                                                    <span class="label label-success" id="status<?php echo $model['apid'];?>">Active</span>
                                                                <?php } else if($model['apstatus']==0){ ?>
                                                                    <span class="label label-warning" id="status<?php echo $model['apid'];?>">InActive</span>
                                                              <?php  }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($model['recruiter_responce_status']==0){?>
                                                                    <span class="label label-danger" id="recruiter_responce_status<?php echo $model['apid'];?>">Not Responded</span>
                                                                <?php } else if($model['recruiter_responce_status']==1){ ?>
                                                                    <span class="label label-success" id="recruiter_responce_status<?php echo $model['apid'];?>">Invited For an Interview</span>
                                                              <?php  }else if($model['recruiter_responce_status']==2){ ?>
                                                                    <span class="label label-info" id="recruiter_responce_status<?php echo $model['apid'];?>">Putted on Hold</span>
                                                              <?php  }else if($model['recruiter_responce_status']==3){ ?>
                                                                    <span class="label label-warning" id="recruiter_responce_status<?php echo $model['apid'];?>">Marked as Non-Relevant</span>
                                                              <?php  }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-info btn-xs" style="margin: 2px;" onclick="recruiterResponceStatus('<?php echo $model['apid'];?>',1)"><i class="fa fa-share"></i> Invite To Interview</button>
                                                            <button class="btn btn-warning btn-xs" style="margin: 2px;" onclick="recruiterResponceStatus('<?php echo $model['apid'];?>',2)"><i class="fa fa-pencil"></i> Put On Hold</button>
                                                            <button class="btn btn-danger btn-xs" style="margin: 2px;" onclick="recruiterResponceStatus('<?php echo $model['apid'];?>',3)"><i class="fa fa-trash-o"></i> Not Relevant</button>
                                                        </td>
                                                        
                                                    </tr>
                                                     <?php  $i++;} }else{ ?>
                                                         <div class="alert alert-info fade in">
                                                            <strong>Oops!</strong> Currently there are no Records as per your Criteria.
                                                        </div>
                                                   <?php  }
                                                     ?>
                                                </tbody>
                                            </table>
                                        </div>    
                                    </div>
                            
                    </div><!--/end row-->
              

           
            <div class="row margin-bottom-10">
                <?php
                $this->widget('CLinkPager', array(
                    'pages' => $pages,
                ));

                $this->widget('CListPager', array(
                    'pages' => $pages,
                ));
                ?>
            </div>
        </div>      
        <div class="col-md-3"></div>

    </div><!--/container--> 
</div>  
<?php
        Yii::app()->clientScript->registerScript(
           'myHideEffect',
           '$(".info").animate({opacity: 1.0}, 5000).fadeOut("slow");',
           CClientScript::POS_READY
        );
    ?>
    <script>
        function deleteRecord(recordId){
            var message = confirm("Are You Sure!\n That You want to delete Record.");
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>";           
                if (message == true) {                   
                     jQuery.ajax({                            
                            url: baseurl+'/Recruiter/deletejob',
                            type: "POST",
                            data: {id: recordId},  
                            error: function(){
                                     alert("Something Went Wrong...Please Try Later.");
                                },
                            success: function(resp){                   
                                    if(resp=="success"){
                                           document.getElementById('record'+recordId).style.display = "none";
                                    }else{
                                           alert("Something Went Wrong...Please Try Later.");
                                    }
                                }
                            });
                } else {
                   alert("Ok. You Have Cancelled The Deletion.");
                }
            
        }
        function makeStatusRecord(recordId,status){
            var message = confirm("Are You Sure!\n That You want to Update Status.");
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>";  
            var currentstatus = document.getElementById('hiddenmakestatus'+recordId).value;           
                if (message == true) {                   
                     jQuery.ajax({                            
                            url: baseurl+'/Recruiter/MakeStatusjob',
                            type: "POST",
                            data: {id: recordId},  
                            error: function(){
                                     alert("Something Went Wrong...Please Try Later.");
                                },
                            success: function(resp){                   
                                    if(resp=="success"){
                                        if(currentstatus=="1"){
                                          $('#status'+recordId).removeClass('label-success');  
                                          $('#status'+recordId).addClass('label-warning');  
                                          document.getElementById('status'+recordId).innerHTML = "InActive";
                                          $('#makestatus'+recordId).removeClass('label-warning');  
                                          $('#makestatus'+recordId).addClass('label-success'); 
                                          document.getElementById('makestatus'+recordId).innerHTML = "Make Active";
                                          document.getElementById('hiddenmakestatus'+recordId).value = "0";
                                        }else{             
                                            $('#status'+recordId).removeClass('label-warning');  
                                            $('#status'+recordId).addClass('label-success');  
                                            document.getElementById('status'+recordId).innerHTML = "Active";
                                            $('#makestatus'+recordId).removeClass('label-success');  
                                            $('#makestatus'+recordId).addClass('label-warning'); 
                                            document.getElementById('makestatus'+recordId).innerHTML = "Make InActive";
                                            document.getElementById('hiddenmakestatus'+recordId).value = "1"; 
                                        }
                                    }else{
                                           alert("Something Went Wrong...Please Try Later.");
                                    }
                                }
                            });
                } else {
                   alert("Ok. You Have Cancelled The Deletion.");
                }
            
        }
        function recruiterResponceStatus(apId,status){
            var message = confirm("Are You Sure!\n That You want to Update Status.");
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
            if(status==1){
              document.getElementById('recruiter_responce_status'+apId).className = "";                                         
              $('#recruiter_responce_status'+apId).addClass('label label-success');  
              document.getElementById('recruiter_responce_status'+apId).innerHTML = "Invited For an Interview";                                         
            }else if(status==2){             
                document.getElementById('recruiter_responce_status'+apId).className = "";                                         
              $('#recruiter_responce_status'+apId).addClass('label label-info');  
              document.getElementById('recruiter_responce_status'+apId).innerHTML = "Putted on Hold"; 
            }else if(status==3){             
                document.getElementById('recruiter_responce_status'+apId).className = "";                                         
              $('#recruiter_responce_status'+apId).addClass('label label-warning');  
              document.getElementById('recruiter_responce_status'+apId).innerHTML = "Marked as Non-Relevant"; 
            }
                if (message == true) {                   
                     jQuery.ajax({                            
                            url: baseurl+'/Recruiter/makeRecruiterResponceStatus',
                            type: "POST",
                            data: {id: apId,status:status},  
                            error: function(){
                                     alert("Something Went Wrong...Please Try Later.");
                                },
                            success: function(resp){                   
                                    if(resp=="success"){
                                        if(status==1){
                                          document.getElementById('recruiter_responce_status'+apId).className = "";                                         
                                          $('#recruiter_responce_status'+apId).addClass('label label-success');  
                                          document.getElementById('recruiter_responce_status'+apId).innerHTML = "Invited For an Interview";                                         
                                        }else if(status==2){             
                                            document.getElementById('recruiter_responce_status'+apId).className = "";                                         
                                          $('#recruiter_responce_status'+apId).addClass('label label-info');  
                                          document.getElementById('recruiter_responce_status'+apId).innerHTML = "Putted on Hold"; 
                                        }else if(status==3){             
                                            document.getElementById('recruiter_responce_status'+apId).className = "";                                         
                                          $('#recruiter_responce_status'+apId).addClass('label label-warning');  
                                          document.getElementById('recruiter_responce_status'+apId).innerHTML = "Marked as Non-Relevant"; 
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
        function searchBy(id){
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
            if(id=='all'){
                 var url = baseurl+'/Recruiter/appliedList';
            }else{
//                 var url = baseurl+'/SearchAppliedListByJobId?id='+id;
                   var url = baseurl+'/aplj-jobportal-'+id+'.htm';
            }
           
            window.location = url;
            window.location.replace (url);
            
        }
    </script>
</div><!--/End Wrapepr-->