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
                                    <div class="table-search-v1 margin-bottom-20">
                                        <div class="table-responsive">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Job Title</th>
                                                        <th>Locations</th> 
                                                        <th>Created On</th>
                                                        <th>Updated On</th>
                                                        <th>Edit</th>
                                                        <th>Status</th> 
                                                        <th>Delete</th> 
                                                        <th>Alter Status</th> 
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                     <?php 
                                                     if(isset($models) && !empty($models)){
                                                            foreach($models as $model){?>
                                                    <tr id="record<?php echo $model['id'];?>">
                                                        <td>
                                                            <?php echo $model['jobtitle'];?>
                                                        </td>
                                                        <td>
                                                           <?php echo City::model()->getLocation($model['locations']);?>
                                                        </td>
                                                        <td>
                                                            <?php echo $model['created_on'];?>
                                                        </td>
                                                        <td>
                                                             <?php echo $model['updated_on'];?>  
                                                        </td>
                                                        <td>                                                            
                                                            <a href="<?php echo Yii::app()->request->baseUrl . '/upjob-'.User::model()->seoFriendlyUrl($model['jobtitle']).'-' . $model['id'].'.htm'; ?>" target="_blank"><i class="fa fa-pencil"></i></a>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($model['status']==1){?>
                                                                    <span class="label label-success" id="status<?php echo $model['id'];?>">Active</span>
                                                                <?php } else if($model['status']==0){ ?>
                                                                    <span class="label label-warning" id="status<?php echo $model['id'];?>">In-Active</span>
                                                              <?php  }
                                                            ?>
                                                        </td>  
                                                        <td>
                                                            <a href="javascript:void(0);" onclick="deleteRecord(<?php echo $model['id'];?>)"><i class="fa fa-trash-o"></i></a>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if($model['status']==1){?>
                                                             <a href="javascript:void(0);" onclick="makeStatusRecord('<?php echo $model['id'];?>','<?php echo $model['status'];?>')" style="text-decoration:none;">   <span class="label label-warning" id="makestatus<?php echo $model['id'];?>"> Make In-Active</span> </a>
                                                                <?php } else if($model['status']==0){ ?>
                                                             <a href="javascript:void(0);" onclick="makeStatusRecord('<?php echo $model['id'];?>','<?php echo $model['status'];?>')" style="text-decoration:none;">   <span class="label label-success" id="makestatus<?php echo $model['id'];?>">Make Active</span> </a>
                                                              <?php  }
                                                            ?>
                                                             <input type="hidden" id="hiddenmakestatus<?php echo $model['id'];?>" value="<?php echo $model['status'];?>">
                                                        </td>
                                                    </tr>
                                                     <?php } }else{ ?>
                                                         <div class="alert alert-info fade in">
                                                            <strong>Oops!</strong> Currently there are no category exists.
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
    </script>
</div><!--/End Wrapepr-->