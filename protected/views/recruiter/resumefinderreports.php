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
        <div class="col-md-10">
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
            <!--/end row-->
            <div class="row margin-bottom-10"> 
                <div class="row">
                            <div class="col-md-1 divstylesavejob" >
                                    Job Seeker Name
                            </div>

                            <div class="col-md-1 divstylesavejob" >
                                    Mobile 
                            </div>

                            <div class="col-md-2 divstylesavejob" >
                                    Email
                            </div>

                            <div class="col-md-2 divstylesavejob" >
                                    Current Location(s)
                            </div>

                            <div class="col-md-3 divstylesavejob" >
                                    Preferred Location(s)
                            </div>

                            <div class="col-md-1 divstylesavejob" >
                                    Resume
                            </div>

                            <div class="col-md-1 divstylesavejob" >
                                    Profile Pic
                            </div>

                            <div class="col-md-1 divstylesavejob" >
                                    View Full Profile
                            </div>
                        </div>
                <?php
                if (isset($models) && !empty($models)) {
                    $i = 0;
                    foreach ($models as $model) {
                        ?> 
                        <div class="row bgcolor<?php echo $i%10;?>">
                            
                            <div class="col-md-1 divstylepadding" >
                                
                                    <a href="<?php echo Yii::app()->request->baseUrl . '/mp-'.User::model()->seoFriendlyUrl($model['name']).'-' . $model['user_id'].'.htm'; ?>" style="color:#72c02c;text-decoration: none;" target="_blank">  <?php echo $model['name']; ?></a>
                            </div>

                            <div class="col-md-1 divstylepadding" >
                                    <?php echo $model['mobile']; ?> 
                            </div>

                            <div class="col-md-2 divstylepadding" style="word-break: break-all;">
                                    <p style="word-break: break-all;"><?php echo $model['username']; ?></p>
                            </div>

                            <div class="col-md-2 divstylepadding" style="word-break: break-all;">
                                    <?php echo City::model()->getLocation($model['current_location']); ?>
                            </div>

                            <div class="col-md-3 divstylepadding" style="word-break: break-all;">
                                    <?php echo City::model()->getLocation($model['preferred_location']); ?>
                            </div>

                            <div class="col-md-1 divstylepadding"style="word-break: break-all;" >
                                    <?php if(isset($model['resume']) && !empty($model['resume'])){?>
                                
                                <a href="<?php echo Yii::app()->request->baseUrl . '/Member/download?name='.$model['resume'].'&path=uploads/resume'; ?>" style="word-break: break-all;"> <?php echo $model['resume'];?></a>
                                <?php }else { ?>
                                <p>Not Uploaded</p>
                                <?php } ?>
                            </div>

                            <div class="col-md-1 divstylepadding" style="word-break: break-all;">
                                    <?php if(isset($model['profile_pic']) && !empty($model['profile_pic'])){?>
                                <a href="<?php echo Yii::app()->request->baseUrl . '/Member/download?name='.$model['profile_pic'].'&path=uploads/profilepics'; ?>" style="word-break: break-all;"> <img src="<?php echo Yii::app()->request->baseUrl . '/uploads/profilepics/'.$model['profile_pic']; ?>" style="width:100%;height: 100%;"></img></a>
                                <?php }else { ?>
                                <p>Not Uploaded</p>
                                <?php } ?>
                            </div>

                            <div class="col-md-1 divstylepadding" style="word-break: break-all;">
                                
                                    <a href="<?php echo Yii::app()->request->baseUrl . '/mp-'.User::model()->seoFriendlyUrl($model['username']).'-' . $model['user_id'].'.htm'; ?>" style="text-decoration: none;word-break: break-all;" target="_blank">  View Full Profile...</a>
                            </div>
                            
                        </div>        

                        <?php $i++;
                    }
                } else { ?>
                    <div class="alert alert-info fade in">
                        <strong>Oops!</strong> Currently there are no Records as per your Criteria.
                    </div>
                <?php } ?>
            </div>


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
        <div class="col-md-2"></div>

    </div><!--/container--> 
</div>  
<?php
Yii::app()->clientScript->registerScript(
        'myHideEffect', '$(".info").animate({opacity: 1.0}, 5000).fadeOut("slow");', CClientScript::POS_READY
);
?>
<script>
    function deleteRecord(recordId){
        var message = confirm("Are You Sure!\n That You want to delete Record.");
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";           
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
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";  
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
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        if (message == true) {                   
            jQuery.ajax({                            
                url: baseurl+'/Recruiter/makeRecruiterResponceStatusSaveJob',
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
</script>
</div><!--/End Wrapepr-->