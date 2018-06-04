

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
                     <?php if(Yii::app()->user->hasFlash('success')){?>
                            <div class="row margin-bottom-10">
                                <div class="info alert alert-info fade in">
                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                    <?php echo Yii::app()->user->getFlash('success'); ?>
                                </div>
                            </div>
                    <?php } ?>
                    <div class="row margin-bottom-10">                      
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/jobPostingsByStatus?type=all&status=all&adminapprovestatus=all';?>"><button type="button" class="btn-u btn-u-lg rounded-4x btn-u-purple">Total Job Postings : <?php echo Jobpostings::model()->recordCount('all');?></button></a> 
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/jobPostingsByStatus?type=all&status=1&adminapprovestatus=all';?>"><button type="button" class="btn-u btn-u-lg rounded-4x btn-u-sea">Active Job Postings : <?php echo Jobpostings::model()->recordCount('active');?></button></a> 
                      <a href="<?php echo Yii::app()->request->baseUrl.'/admin/jobPostingsByStatus?type=all&status=0&adminapprovestatus=all';?>"><button type="button" class="btn-u btn-u-lg rounded-4x btn-u-default">In Active Job Postings : <?php echo Jobpostings::model()->recordCount('inactive');?></button></a> 
                        
                    </div>
                    <div class="row margin-bottom-10"> 
                        <form action="<?php echo Yii::app()->request->baseUrl.'/admin/jobPostingsByStatus';?>" method="get">
                        <div class="col-md-3">
                            <div class="input-group">
                                <label>User Type    </label>                        
                                <select class="form-control" required name="type">
                                    <option value="all" <?php if(isset($type) && !empty($type) && $type=='all') {?> selected <?php } ?>>All Users</option>                                    
                                    <option value="2" <?php if(isset($type) && !empty($type) && $type==2) {?> selected <?php } ?>>Recruiters</option>
                                    <option value="3" <?php if(isset($type) && !empty($type) && $type==3) {?> selected <?php } ?>>Recruiting-Firms</option>
                                </select>
                            </div>   
                        </div>
                          <div class="col-md-3">
                            <div class="input-group">
                                <label>Status</label>                    
                                <select class="form-control" required  name="status">
                                    <option value="all" <?php if(isset($status) && !empty($status) && $status=='all') {?> selected <?php } ?>>Both Status</option>
                                    <option value="1" <?php if(isset($status) && !empty($status) && $status=='1') {?> selected <?php } ?>>Active</option>
                                    <option value="0" <?php if(isset($status) && $status=='0') {?> selected <?php } ?>>In-Active</option>                                   
                                </select>
                            </div>   
                        </div> 
                        <div class="col-md-3">
                            <div class="input-group">
                                <label>Admin Approval Status</label>                       
                                <select class="form-control" required name="adminapprovestatus">
                                    <option value="all" <?php if(isset($adminapprovestatus) && !empty($adminapprovestatus) && $adminapprovestatus=='all') {?> selected <?php } ?>>All Status</option>
                                    <option value="0" <?php if(isset($adminapprovestatus) && $adminapprovestatus=='0') {?> selected <?php } ?>>Yet To Approve</option>
                                    <option value="1" <?php if(isset($adminapprovestatus) && !empty($adminapprovestatus) && $adminapprovestatus==1) {?> selected <?php } ?>>Approved</option>
                                    <option value="2" <?php if(isset($adminapprovestatus) && !empty($adminapprovestatus) && $adminapprovestatus==2) {?> selected <?php } ?>>Marked as Changes Required</option>
                                    <option value="3" <?php if(isset($adminapprovestatus) && !empty($adminapprovestatus) && $adminapprovestatus==3) {?> selected <?php } ?>>Ignored</option>
                                </select>
                            </div>   
                        </div> 
                            <div class="col-md-1">
                            <div class="input-group">
                                  <label>Filter</label> 
                                <button type="submit" class="btn-u btn-u-green">Filter Now</button>
                            </div>   
                        </div> 
                            </form>
                    </div>
                    <div class="row margin-bottom-10"> 
                        <form action="<?php echo Yii::app()->request->baseUrl.'/admin/jobPostingsByStatus';?>" method="get">
                        <div class="col-md-3">
                            <div class="input-group">
                                <label>Category</label>                        
                                <select name="cat_id" onchange="jobPostingsSearchByCategory(this.value);" required class="form-control">
                                    <option value="" selected>Select Category</option>
                                    <?php $category = Category::model()->findAll('status=:status',array(':status'=>1));
                                            if(isset($category) && !empty($category)){
                                                foreach ($category as $key => $value) { 
                                                     ?>                                       
                                            <option value="<?php echo $value['id'];?>" <?php if(isset($cat_id) && $cat_id==$value['id']) {?> selected <?php } ?>><?php echo $value['name'];?></option>

                                    <?php } } ?>								
                                </select>
                            </div>   
                        </div>
                          <div class="col-md-3">
                            <div class="input-group">
                                <label>Sub Category</label>                    
                                <select name="subcat_id" onchange="jobPostingsSearchBySubCategory(this.value);" required class="form-control">
                                    <option value="" selected>Select Sub-Category</option>
                                    <?php $subCategory = Subcategory::model()->findAll('status=:status',array(':status'=>1));
                                            if(isset($subCategory) && !empty($subCategory)){
                                                foreach ($subCategory as $key => $value) { 
                                                     ?>                                       
                                            <option value="<?php echo $value['id'];?>" <?php if(isset($subcat_id) && $subcat_id==$value['id']) {?> selected <?php } ?>><?php echo $value['name'];?></option>

                                    <?php } } ?>								
                                </select>
                            </div>   
                        </div> 
                        <div class="col-md-3">
                            <div class="input-group">
                                <label>Skill</label>                       
                                <select name="skill_id" onchange="jobPostingsSearchBySkill(this.value);" required class="form-control">
                                    <option value="" selected>Select Skill</option>
                                    <?php $skillSub = Skillsub::model()->findAll('status=:status',array(':status'=>1));
                                            if(isset($skillSub) && !empty($skillSub)){
                                                foreach ($skillSub as $key => $value) { 
                                                     ?>                                       
                                            <option value="<?php echo $value['id'];?>" <?php if(isset($skill_id) && $skill_id==$value['id']) {?> selected <?php } ?>><?php echo $value['name'];?></option>

                                    <?php } } ?>								
                                </select>
                            </div>   
                        </div> 
                            <div class="col-md-3">
                            <div class="input-group">
                                <label>Location</label>                       
                                <select name="skill_id" onchange="jobPostingsSearchByCity(this.value);" required class="form-control">
                                    <option value="" selected>Select City</option>
                                    <?php $city = City::model()->findAll('status=:status',array(':status'=>1));
                                            if(isset($city) && !empty($city)){
                                                foreach ($city as $key => $value) { 
                                                     ?>                                       
                                            <option value="<?php echo $value['id'];?>" <?php if(isset($city_id) && $city_id==$value['id']) {?> selected <?php } ?>><?php echo $value['name'];?></option>

                                    <?php } } ?>								
                                </select>
                            </div>   
                        </div> 
                            </form>
                    </div>
                    
                    <!--Service Block v3-->
                    <div class="row margin-bottom-10">
                        <p>Result Count : <?php echo $count; ?></p>
                        <?php 
                            $this->widget('CLinkPager', array(
                                'pages' => $pages,
                            ));                            

                            $this->widget('CListPager', array(
                                    'pages'=>$pages,
                            ));                            
                            
                        ?>
                        
                    </div><!--/end row-->                   
                   
                   
                    <div class="row margin-bottom-10"> 
                <div class="row">
                            <div class="col-md-2 divstylesavejob" >
                                   Job Title
                            </div>
                    
                            <div class="col-md-2 divstylesavejob" >
                                    Locations
                            </div>
                            <div class="col-md-1 divstylesavejob" >
                                    Updated On
                            </div>

                            <div class="col-md-1 divstylesavejob" >
                                    Status
                            </div>
                            <div class="col-md-3 divstylesavejob" >
                                    Admin Approval Status
                            </div>
                            <div class="col-md-3 divstylesavejob" >
                                    Action
                            </div>
                        </div>
                <?php
                if (isset($models) && !empty($models)) {
                    $i = 0;
                    foreach ($models as $model) {
                        ?> 
                        <div class="row bgcolor<?php echo $i%10;?>" id="record<?php echo $model['id'];?>">
                            <div class="col-md-2 divstylepadding" style="word-break:break-all;">
                               
                              <a href="<?php echo Yii::app()->request->baseUrl . '/admin/JobDescriptionAdmin?id=' . $model['id']; ?>" style="color:#72c02c;text-decoration: none;" target="_blank"> <?php echo $model['jobtitle'];?></a>
                               
                            </div>

                            <div class="col-md-2 divstylepadding" style="word-break:break-all;">
                                   <?php echo City::model()->getLocation($model['locations']);?> 
                            </div>
                            <div class="col-md-1 divstylepadding">
                                <?php echo $model['updated_on'];?>  
                            </div>
                             

                            <div class="col-md-1 divstylepadding" style="word-break:break-all;">
                                        <?php if ($model['status'] == 1) { ?>
                                            <span class="label label-success" id="status<?php echo $model['id']; ?>">Active</span>
                                        <?php } else if ($model['status'] == 0) { ?>
                                            <span class="label label-warning" id="status<?php echo $model['id']; ?>">InActive</span>
                                        <?php }
                                        ?>
                            </div>


                            <div class="col-md-3 divstylepadding" style="word-break:break-all;">
                                <?php if ($model['admin_approval_status'] == 0) { ?>
                                    <span class="label label-danger" id="admin_approval_status<?php echo $model['id']; ?>">Yet To View & Approve</span>
                                <?php } else if ($model['admin_approval_status'] == 1) { ?>
                                    <span class="label label-success" id="admin_approval_status<?php echo $model['id']; ?>">Approved</span>
                                <?php } else if ($model['admin_approval_status'] == 2) { ?>
                                    <span class="label label-info" id="admin_approval_status<?php echo $model['id']; ?>">Returned for Changes</span>
                                <?php } else if ($model['admin_approval_status'] == 3) { ?>
                                    <span class="label label-warning" id="admin_approval_status<?php echo $model['id']; ?>">Marked as Non-Relevant</span>
                                <?php }
                                ?>
                            </div>

                            <div class="col-md-3 divstylepadding" style="word-break:break-all;">
                                <button class="btn btn-info btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $model['id']; ?>',1)"><i class="fa fa-share"></i> Approve</button>
                                <button class="btn btn-warning btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $model['id']; ?>',2)"><i class="fa fa-pencil"></i> Changes need</button>
                                <button class="btn btn-danger btn-xs" style="margin: 2px;" onclick="adminApproveStatus('<?php echo $model['id']; ?>',3)"><i class="fa fa-trash-o"></i> Not Relevant</button>
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
                                    'pages'=>$pages,
                            ));                           
                           
                        ?>
                    </div><!--/end row-->
                    <!--End Service Block v3-->

                    <hr>


                    <hr>

                </div>
                <!--End Profile Body-->
            </div>
        </div><!--/end row-->
    </div><!--/container-->    
    <!--=== End Profile ===-->
    <?php
        Yii::app()->clientScript->registerScript(
           'myHideEffect',
           '$(".info").animate({opacity: 1.0}, 5000).fadeOut("slow");',
           CClientScript::POS_READY
        );
    ?>
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
                url: baseurl+'/admin/makeadminApproveStatusJobPosts',
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
    
    function jobPostingsSearchByCategory(id){
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
            var url = baseurl+'/admin/jobPostingsSearchByCategory?id='+id;
            window.location = url;
            window.location.replace (url);
            
        }
        
        function jobPostingsSearchBySubCategory(id){
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
            var url = baseurl+'/admin/jobPostingsSearchBySubCategory?id='+id;
            window.location = url;
            window.location.replace (url);
            
        }
        function jobPostingsSearchBySkill(id){
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
            var url = baseurl+'/admin/jobPostingsSearchBySkill?id='+id;
            window.location = url;
            window.location.replace (url);
            
        }
        function jobPostingsSearchByCity(id){
            var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
            var url = baseurl+'/admin/jobPostingsSearchByCity?id='+id;
            window.location = url;
            window.location.replace (url);
            
        }
    </script>
    <?php $this->renderPartial('//layouts/footerv'); ?>