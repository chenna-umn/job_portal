   <!--=== Content Part ===-->
    <div class="container s-results margin-bottom-50">
        <form action="<?php echo Yii::app()->request->baseUrl . '/Member/jobFeed'?>" id="sky-form4" class="sky-form" method="post">
        <div class="row">
            <div class="col-md-6">
                 <div class="headline" style="margin-bottom: 0px; margin-top: 0px;"><h1>My Job-feed</h1></div>
            </div>            
             <div class="col-md-6 sky-form">
            <div class="col-md-4" >
                    <section>
                        <label class="select">
                            <input type="hidden" id="showoptionstatus" value="0">
                            <select name="type" class="invalid" onclick="showOptions()">                                
                                <option selected value="" style="display:none;">Any Location</option>                                                                        
                            </select>
                            <i></i>
                        </label>
                    </section>
            </div>                
            <div class="col-md-4">
                    <section>
                        <label class="select">
                            <select name="expLevel" class="invalid" id="expLevel">
                                <option selected value="0" <?php if($expLevel == 0) { ?> selected <?php } ?>>Any Exp. Level</option>
                                <option value="1" <?php if($expLevel == 1) { ?> selected <?php } ?>>0-3 yrs</option>
                                <option value="2" <?php if($expLevel == 2) { ?> selected <?php } ?>>4-6 yrs</option>
                                <option value="3" <?php if($expLevel == 3) { ?> selected <?php } ?>>7-10 yrs</option> 
                                <option value="4" <?php if($expLevel == 4) { ?> selected <?php } ?>>11-15 yrs</option>
                                <option value="5" <?php if($expLevel == 5) { ?> selected <?php } ?>>15+ yrs</option>                               
                            </select>
                            <i></i>
                        </label>
                    </section>
            </div> 
            <div class="col-md-4">
                    <section>
                        <button type="submit" class="btn-u btn-u-brown"><i class="fa fa-filter"></i> Filter</button>
                    </section>
            </div>
                 </div>
            
        </div>
        <div class="row" style="display:none;" id="options">
            <div class="col-md-6">
                
            </div>
            
             <div class="col-md-6 sky-form">
                           
            <div class="col-md-4">
                    
            </div>
            <div class="col col-4" style="max-height: 250px; height: auto;background: none repeat scroll 0 0 #fff;overflow-y: scroll; position: absolute; z-index: 99999;">
                                   
                <?php 
                        $topCities = City::model()->getActiveTopCities();
                        if(isset($topCities) && !empty($topCities)){
                            foreach($topCities as $key=>$value){
                ?>    
                
                <label class="checkbox"><input type="checkbox" name="cityList[]"  value="<?php echo $value['id'];?>" <?php if(in_array($value['id'], $cityList) && $cityListStatus==1) {?> checked <?php } ?>><i></i><?php echo $value['name'];?></label>             
                                    
               <?php  } } ?>
                                </div>                             

            <div class="col-md-4">
                    
            </div>
                 </div>
            
        </div>
            <div class="row">
            <div class="col-md-9">               
                <?php if($cityListStatus==0 && $expLevel==0){ ?>                
                    
               <?php } else{
                   if($expLevel==0){
                     $expText ='';                   
                 }else if($expLevel==1){
                      $expText ='0-3 yrs';
                 }else if($expLevel==2){
                       $expText ='4-6 yrs';
                 }else if($expLevel==3){
                      $expText ='7-10 yrs';
                 }else if($expLevel==4){
                       $expText ='11-15 yrs';
                 }else if($expLevel==5){
                      $expText ='15+ yrs';
                 }?>
            
                <div class="" style="margin-top: 0px; margin-bottom: 10px;"> <h4>
                    <?php  echo '('.$expText.')  ';  if($cityListStatus==1)  { ?> <?php echo ' in '.City::model()->getLocation(implode(',', $cityList)).'  ';?><?php   } ?><a href="javascript:void(0);" onclick="doneAndSearch()">(clear Filters)</a></h4>
                
                </div>
                   
             <?php   } ?>
            </div>
                 <div class="col-md-3">  </div>
        </div>
            </form>
        <div class="row">
            <input type="hidden" id="limitvalue" value="<?php echo $limit;?>">
             <div class="col-md-9" id="records">               
                <!-- Begin Inner Results -->
                
            <?php 
                if(isset($jobsList) && !empty($jobsList)) {                   
               
                foreach($jobsList as $key=>$value){ 
                    
                   if(array_intersect(explode(',',$value['locations']), $cityList)) {?>
                <div class="inner-results">
                     <lable id="applyjobalert<?php echo $value['id'];?>" style="display:none;"></lable>
                     <lable id="savejobalert<?php echo $value['id'];?>" style="display:none;"></lable>
                </div>
                <div class="inner-results">
                    <div class="col-md-2" style="padding-left: 5px; padding-right: 5px;">
                        <ul class="list-inline down-ul">
                         
                        <li>
                            <ul class="list-inline star-vote">
                                 <?php if(Recruiterprofile::model()->getRecruiterTypeByUserId($value['user_id'])==2) {?>
                                <li style="padding-left: 2px; padding-right: 2px;"><a href="javascript:void(0)" class="tooltips" data-toggle="tooltip" data-original-title="Company Job"><i class="color-green fa fa-suitcase"></i></a></li>
                                <?php } else{?>
                                <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Recruiter Firm Job"><i class="fa fa-suitcase" style="cursor:pointer;"></i></li>
                                <?php } ?>
                                 <?php if(isset(Yii::app()->user->memberId)) { ?>
                                <?php $applyJob = Applyjob::model()->find('user_id=:user_id AND job_id=:job_id AND status=:status',array(':user_id'=>Yii::app()->user->memberId,':job_id'=>$value['id'],':status'=>1));?>
                                <?php $saveJob = Savejob::model()->find('user_id=:user_id AND job_id=:job_id AND status=:status',array(':user_id'=>Yii::app()->user->memberId,':job_id'=>$value['id'],':status'=>1));?>
                                <input type="hidden" id="applystatus<?php echo $value['id'];?>" <?php if(isset($applyJob) && !empty($applyJob)) { ?> value="1" <?php } else { ?> value="0" <?php } ?>>
                                <input type="hidden" id="savestatus<?php echo $value['id'];?>" <?php if(isset($saveJob) && !empty($saveJob)) { ?> value="1" <?php } else { ?> value="0" <?php } ?>>
                                <?php if(isset($applyJob) && !empty($applyJob)) { ?>
                                            <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Applied" id="applytooltip<?php echo $value['id'];?>" onclick="applyjob('<?php echo $value['id'];?>')"><i class="color-green fa fa-bookmark" id="applybtn<?php echo $value['id'];?>" style="cursor:pointer;"></i></li>
                                <?php } else { ?>
                                            <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Apply to this Job" id="applytooltip<?php echo $value['id'];?>" onclick="applyjob('<?php echo $value['id'];?>')"><i class="fa fa-bookmark" id="applybtn<?php echo $value['id'];?>" style="cursor:pointer;"></i></li>
                                            <?php } ?>
                                <?php if(isset($saveJob) && !empty($saveJob)) { ?>
                                           <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Saved" id="savetooltip<?php echo $value['id'];?>" onclick="savejob('<?php echo $value['id'];?>')" ><i class="color-green fa fa-star" id="savebtn<?php echo $value['id'];?>" style="cursor:pointer;"></i></li>
                                <?php } else { ?>
                                            <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Save this Job" id="savetooltip<?php echo $value['id'];?>" onclick="savejob('<?php echo $value['id'];?>')"><i class="fa fa-star" id="savebtn<?php echo $value['id'];?>" style="cursor:pointer;"></i></li>
                                            <?php } ?>
                                
                                <?php } else { ?>
                                <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Login to Apply"><i class="fa fa-bookmark" style="cursor:pointer;"></i></li>
                                <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Login to Save"><i class="fa fa-star-o" style="cursor:pointer;"></i></li>
                                <?php } ?>                                
                            </ul>
                        </li>
                    </ul>
                    </div>
                    <div class="col-md-7" style="padding-left: 5px; padding-right: 5px;">
                        <a href="<?php echo Yii::app()->request->baseUrl . '/jd-'.User::model()->seoFriendlyUrl($value['jobtitle']).'-' . $value['id'].'.htm'; ?>" style="color:#555;" target="_blank"><?php echo $value['jobtitle']; ?></a>
                    </div>
                    <div class="col-md-2" style="padding-left: 5px; padding-right: 5px;">
                        <p><?php echo City::model()->getLocation($value['locations']);?></p>
                    </div>
                    <div class="col-md-1" style="padding-left: 5px; padding-right: 5px;">
                        <p><?php echo date('Y/m/d',  strtotime($value['updated_on']));?></p>
                    </div>
                </div> 
                 
    <?php } } }else{?>

    <div class="alert alert-info fade in">
            <strong>Oops!</strong> Currently there are Job Postings in Your Search Criteria.
        </div>
    <?php  }
     ?>


                
            </div><!--/col-md-10-->
            <div class="col-md-3">
                <!-- Magazine Posts -->
                <div class="row margin-bottom-40">
                    <div class="magazine-posts col-md-12 col-sm-6 margin-bottom-30">
                        <h3><a href="#">Bootstrap 3 Template</a></h3>
                        <span><i class="color-green">By htmlstream</i> / March 19, 2014</span>
                        <div class="magazine-posts-img">
                            <a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/main/10.jpg" class="img-responsive"></a>
                                                           
                        </div>
                    </div>
                    <div class="magazine-posts col-md-12 col-sm-6">
                        <h3><a href="#">Parralax One Page</a></h3>
                        <span><i class="color-green">By Taylor Miller</i> / July 19, 2014</span>
                        <div class="magazine-posts-img">
                            <a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/main/1.jpg" class="img-responsive"></a>
                                                            
                        </div>
                    </div>                
                </div> 
                <div class="row margin-bottom-40">
                    <div class="magazine-posts col-md-12 col-sm-6 margin-bottom-30">
                        <h3><a href="#">Bootstrap 3 Template</a></h3>
                        <span><i class="color-green">By htmlstream</i> / March 19, 2014</span>
                        <div class="magazine-posts-img">
                            <a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/main/10.jpg" class="img-responsive"></a>
                                                           
                        </div>
                    </div>
                    <div class="magazine-posts col-md-12 col-sm-6">
                        <h3><a href="#">Parralax One Page</a></h3>
                        <span><i class="color-green">By Taylor Miller</i> / July 19, 2014</span>
                        <div class="magazine-posts-img">
                            <a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/main/1.jpg" class="img-responsive"></a>
                                                            
                        </div>
                    </div>                
                </div> 
                <div class="row margin-bottom-40">
                    <div class="magazine-posts col-md-12 col-sm-6 margin-bottom-30">
                        <h3><a href="#">Bootstrap 3 Template</a></h3>
                        <span><i class="color-green">By htmlstream</i> / March 19, 2014</span>
                        <div class="magazine-posts-img">
                            <a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/main/10.jpg" class="img-responsive"></a>
                                                           
                        </div>
                    </div>
                    <div class="magazine-posts col-md-12 col-sm-6">
                        <h3><a href="#">Parralax One Page</a></h3>
                        <span><i class="color-green">By Taylor Miller</i> / July 19, 2014</span>
                        <div class="magazine-posts-img">
                            <a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/main/1.jpg" class="img-responsive"></a>
                                                            
                        </div>
                    </div>                
                </div> 
                <!-- End Blog Twitter -->
            </div>

           
        </div>        
    </div>
    
<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
<script type="text/javascript">  
    $(window).scroll(function () {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            GetRecords();
        }
    });
    function GetRecords() {
        
        var cityList = [];
            var els = document.getElementsByName('cityList[]');

            for (var i=0;i<els.length;i++){
              if ( els[i].checked ) {
                cityList.push(els[i].value);
              }
            }
            
        var expLevel = document.getElementById("expLevel");
        var expLevelOption = expLevel.options[expLevel.selectedIndex].value;        
        var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
        var limit =  "<?php echo $limit;?>";
        var limitcount = parseInt(document.getElementById("limitvalue").value);
        jQuery.ajax({                            
            url: baseurl+'/member/jobFeedLoadMore',
            type: "POST",
            data: {limit : limitcount,expLevel:expLevelOption,cityList:cityList},  
            error: function(){
                alert("Something Went Wrong...Please Try Later.");
            },
            success: function(resp){    
                document.getElementById("limitvalue").value = limitcount + parseInt(limit);
                $("#records").append(resp);
            }
        });
        
    }
    
    function showOptions(){
        var status = document.getElementById("showoptionstatus").value;
        if(status==0){
            document.getElementById("options").style.display="block";
            document.getElementById("showoptionstatus").value=1;
        }else{
            document.getElementById("options").style.display="none";
            document.getElementById("showoptionstatus").value=0;
        }
        
    }
    function doneAndSearch(){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        window.location.href = baseurl+'/member/jobfeed'
    }
    function applyjob(id){       
     var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";  
     var status = document.getElementById('applystatus'+id).value;
     document.getElementById('applyjobalert'+id).style.display = '';
              
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
                         $('#applybtn'+id).addClass('color-green');
                         document.getElementById('applystatus'+id).value = 1;
                         $('#applytooltip'+id).attr('data-original-title', "Applied");        
                     }else{
                         $('#applybtn'+id).removeClass('color-green');
                         $('#applytooltip'+id).attr('data-original-title', "Apply to this job");
                         document.getElementById('applystatus'+id).value = 0;       
                     }
                   if(status == 0){
                         $('#applyjobalert'+id).html('Congrats...! Job Applied Successfully.').css('color', 'green');
                   }else{
                         $('#applyjobalert'+id).html('Congrats...! Job Removed from Apply List Successfully.').css('color', 'green');
                   }
                }else if(resp == "expfailed"){
                   $('#applyjobalert'+id).html('You are Not allowed to apply for this job due to less Experiance.' ).css('color', 'red');
               }else{
                   $('#applyjobalert'+id).html('Something Went Wrong...Please Try Later.' ).css('color', 'red');
//                  alert("Something Went Wrong...Please Try Later.");
               }
               setTimeout(function() {
                  $('#applyjobalert'+id).fadeOut().empty();
                }, 5000);
            }
        });
    }
     function savejob(id){       
     var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";  
     var status = document.getElementById('savestatus'+id).value;
     document.getElementById('savejobalert'+id).style.display = '';
     if(status == 0){
         $('#savebtn'+id).addClass('color-green');
         document.getElementById('savestatus'+id).value = 1;
         $('#savetooltip'+id).attr('data-original-title', "Saved / Remove from Save List");       
     }else{
          $('#savebtn'+id).removeClass('color-green');
          document.getElementById('savestatus'+id).value = 0;
          $('#savetooltip'+id).attr('data-original-title', "Save");        
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
                         $('#savejobalert'+id).html('Congrats...! Job Saved Successfully.').css('color', 'green');
                   }else{
                         $('#savejobalert'+id).html('Congrats...! Job Removed from Save List Successfully.').css('color', 'green');
                   }
               }else{
                   $('#savejobalert'+id).html('Something Went Wrong...Please Try Later.' ).css('color', 'red');
//                  alert("Something Went Wrong...Please Try Later.");
               }
               setTimeout(function() {
                  $('#savejobalert'+id).fadeOut().empty();
                }, 5000);
            }
        });
    }
</script>

       
    <?php $this->renderPartial('//layouts/footerv'); ?>