   <!--=== Content Part ===-->
    <div class="container s-results margin-bottom-50">
        <div class="row">
             <div class="col-md-9" id="records">
                <span class="results-number">About <?php echo count($savedJobs)?> results are found</span>
                <!-- Begin Inner Results -->
                
                <?php 
                if(isset($savedJobs) && !empty($savedJobs)){
                
                foreach($savedJobs as $key=>$value){?>
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
                                <?php $applyJob = Applyjob::model()->find('user_id=:user_id AND job_id=:job_id AND status=:status',array(':user_id'=>Yii::app()->user->memberId,':job_id'=>$value['job_id'],':status'=>1));?>
                                <?php $saveJob = Savejob::model()->find('user_id=:user_id AND job_id=:job_id AND status=:status',array(':user_id'=>Yii::app()->user->memberId,':job_id'=>$value['job_id'],':status'=>1));?>
                                <input type="hidden" id="applystatus<?php echo $value['id'];?>" <?php if(isset($applyJob) && !empty($applyJob)) { ?> value="1" <?php } else { ?> value="0" <?php } ?>>
                                <input type="hidden" id="savestatus<?php echo $value['id'];?>" <?php if(isset($saveJob) && !empty($saveJob)) { ?> value="1" <?php } else { ?> value="0" <?php } ?>>
                                <?php if(isset($applyJob) && !empty($applyJob)) { ?>
                                            <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Applied" id="applytooltip<?php echo $value['id'];?>" onclick="applyjob('<?php echo $value['job_id'];?>','<?php echo $value['id'];?>')"><i class="color-green fa fa-bookmark" id="applybtn<?php echo $value['id'];?>" style="cursor:pointer;"></i></li>
                                <?php } else { ?>
                                            <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Apply to this Job" id="applytooltip<?php echo $value['id'];?>" onclick="applyjob('<?php echo $value['job_id'];?>','<?php echo $value['id'];?>')"><i class="fa fa-bookmark" id="applybtn<?php echo $value['id'];?>" style="cursor:pointer;"></i></li>
                                            <?php } ?>
                                <?php if(isset($saveJob) && !empty($saveJob)) { ?>
                                           <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Saved" id="savetooltip<?php echo $value['id'];?>" onclick="savejob('<?php echo $value['job_id'];?>','<?php echo $value['id'];?>')" ><i class="color-green fa fa-star" id="savebtn<?php echo $value['id'];?>" style="cursor:pointer;"></i></li>
                                <?php } else { ?>
                                            <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Save this Job" id="savetooltip<?php echo $value['id'];?>" onclick="savejob('<?php echo $value['job_id'];?>','<?php echo $value['id'];?>')"><i class="fa fa-star" id="savebtn<?php echo $value['id'];?>" style="cursor:pointer;"></i></li>
                                            <?php } ?>
                                
                                <?php } else { ?>
                                <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Login to Apply"><i class="fa fa-bookmark" style="cursor:pointer;"></i></li>
                                <li style="padding-left: 2px; padding-right: 2px;" class="tooltips" data-toggle="tooltip" data-original-title="Login to Save"><i class="fa fa-star-o" style="cursor:pointer;"></i></li>
                                +<?php } ?>                                
                            </ul>
                        </li>                        
                    </ul>
                    </div>
                    <div class="col-md-7" style="padding-left: 5px; padding-right: 5px;word-break: break-all">
                        <a href="<?php echo Yii::app()->request->baseUrl . '/jd-'.User::model()->seoFriendlyUrl($value['jobtitle']).'-' . $value['id'].'.htm'; ?>" style="color:#555;"><?php echo $value['jobtitle'];?></a>
                    </div>
                    <div class="col-md-2" style="padding-left: 5px; padding-right: 5px;word-break: break-all">
                        <p><?php echo City::model()->getLocation($value['locations']);?></p>
                    </div>
                    <div class="col-md-1" style="padding-left: 5px; padding-right: 5px;">
                         <p><?php echo date("Y/m/d",strtotime($value['updated_on']));?></p>
                    </div>
                </div> 
                 
<?php } }else { ?>
                <div class="alert alert-info fade in">
                    <strong>Oops...!</strong> Currently, You are not applied to any Jobs.
                </div>
            <?php } ?>
                            

                

                
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
                <div class="posts margin-bottom-30">
                    <div class="headline"><h2>Recent Blog Entries</h2></div>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/10.jpg"></a></dt>
                        <dd>
                            <p><a href="#">Lorem sequat ipsum dolor lorem sunt aliqua put</a></p> 
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/11.jpg"></a></dt>
                        <dd>
                            <p><a href="#">It works on all major web browsers tablets</a></p> 
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/9.jpg"></a></dt>
                        <dd>
                            <p><a href="#">Brunch 3 wolf moon tempor sunt aliqua put.</a></p> 
                        </dd>
                    </dl>
                </div>
                <div class="posts margin-bottom-30">
                    <div class="headline"><h2>Recent Blog Entries</h2></div>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/10.jpg"></a></dt>
                        <dd>
                            <p><a href="#">Lorem sequat ipsum dolor lorem sunt aliqua put</a></p> 
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/11.jpg"></a></dt>
                        <dd>
                            <p><a href="#">It works on all major web browsers tablets</a></p> 
                        </dd>
                    </dl>
                    <dl class="dl-horizontal">
                        <dt><a href="#"><img alt="" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/9.jpg"></a></dt>
                        <dd>
                            <p><a href="#">Brunch 3 wolf moon tempor sunt aliqua put.</a></p> 
                        </dd>
                    </dl>
                </div>
                <!-- End Magazine Posts -->

                <!-- Social Icons -->
                <div class="magazine-sb-social margin-bottom-35">
                    <div class="headline headline-md"><h2>Social</h2></div>
                    <ul class="social-icons social-icons-color">
                        <li><a class="social_rss" data-original-title="Feed" href="#"></a></li>
                        <li><a class="social_facebook" data-original-title="Facebook" href="#"></a></li>
                        <li><a class="social_twitter" data-original-title="Twitter" href="#"></a></li>
                        <li><a class="social_vimeo" data-original-title="Vimeo" href="#"></a></li>
                        <li><a class="social_googleplus" data-original-title="Goole Plus" href="#"></a></li>
                        <li><a class="social_pintrest" data-original-title="Pinterest" href="#"></a></li>
                        <li><a class="social_linkedin" data-original-title="Linkedin" href="#"></a></li>
                        <li><a class="social_dropbox" data-original-title="Dropbox" href="#"></a></li>
                        <li><a class="social_picasa" data-original-title="Picasa" href="#"></a></li>
                        <li><a class="social_spotify" data-original-title="Spotify" href="#"></a></li>
                        <li><a class="social_skype" data-original-title="Skype" href="#"></a></li>
                        <li><a class="social_spotify" data-original-title="Spotify" href="#"></a></li>
                        <li><a class="social_stumbleupon" data-original-title="Stumbleupon" href="#"></a></li>
                        <li><a class="social_wordpress" data-original-title="Wordpress" href="#"></a></li>
                        <li><a class="social_github" data-original-title="Github" href="#"></a></li>
                        <li><a class="social_xing" data-original-title="Xing" href="#"></a></li>
                    </ul>
                    <div class="clearfix"></div>                
                </div>
                <!-- End Social Icons -->

                <!-- Quick Links -->
                <div class="magazine-sb-categories margin-bottom-20">
                    <div class="headline headline-md"><h2>Quick Links</h2></div>
                    <div class="row">
                        <ul class="list-unstyled col-xs-6">
                            <li><a href="#">Revolution Slider</a></li>
                            <li><a href="#">Parralax Page</a></li>
                            <li><a href="#">Backgrounds</a></li>
                            <li><a href="#">Parralax Slider</a></li>
                            <li><a href="#">Responsive</a></li>
                            <li><a href="#">Bootstrap 3x</a></li>
                        </ul>                        
                        <ul class="list-unstyled col-xs-6">
                            <li><a href="#">50+ Valid Pages</a></li>
                            <li><a href="#">Layer Slider</a></li>
                            <li><a href="#">Bootstrap 2x</a></li>
                            <li><a href="#">Fixed Header</a></li>
                            <li><a href="#">Best Template</a></li>
                            <li><a href="#">And Many More</a></li>
                        </ul>                        
                    </div>
                </div>
                <!-- End Quick Links -->

                <!-- Photo Stream -->
                <div class="headline"><h2>Photo Stream</h2></div>            
                <ul class="list-unstyled blog-photos margin-bottom-35">
                    <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/5.jpg" alt="" class="hover-effect"></a></li>
                    <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/6.jpg" alt="" class="hover-effect"></a></li>
                    <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/8.jpg" alt="" class="hover-effect"></a></li>
                    <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/10.jpg" alt="" class="hover-effect"></a></li>
                    <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/11.jpg" alt="" class="hover-effect"></a></li>
                    <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/1.jpg" alt="" class="hover-effect"></a></li>
                    <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/2.jpg" alt="" class="hover-effect"></a></li>
                    <li><a href="#"><img src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/sliders/elastislide/7.jpg" alt="" class="hover-effect"></a></li>
                </ul>
                <!-- End Photo Stream -->

                <!-- Blog Twitter -->
                <div class="blog-twitter">
                    <div class="headline"><h2>Latest Tweets</h2></div>
                    <div class="blog-twitter-inner">
                        <i class="icon-twitter"></i>
                        <a href="#">@htmlstream</a> 
                        At vero seos etodela ccusamus et iusto odio dignissimos. 
                        <a href="#">http://t.co/sBav7dm</a> 
                        <span class="twitter-time">5 hours ago</span>
                    </div>
                    <div class="blog-twitter-inner">
                        <i class="icon-twitter"></i>
                        <a href="#">@htmlstream</a> 
                        At vero eos et accusamus et iusto odio dignissimos. 
                        <a href="#">http://t.co/sBav7dm</a> 
                        <span class="twitter-time">5 hours ago</span>
                    </div>
                    <div class="blog-twitter-inner">
                        <i class="icon-twitter"></i>
                        <a href="#">@htmlstream</a> 
                        At vero eos et accusamus et iusto odio dignissimos. 
                        <a href="#">http://t.co/sBav7dm</a> 
                        <span class="twitter-time">5 hours ago</span>
                    </div>
                    <div class="blog-twitter-inner">
                        <i class="icon-twitter"></i>
                        <a href="#">@htmlstream</a> 
                        At vero eos et accusamus et iusto odio dignissimos. 
                        <a href="#">http://t.co/sBav7dm</a> 
                        <span class="twitter-time">5 hours ago</span>
                    </div>
                </div>
                <!-- End Blog Twitter -->
            </div>

           
        </div>        
    </div>
    
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">  
    $(window).scroll(function () {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
//            GetRecords();
        }
    });
    function GetRecords() {
        var baseurl = "<?php echo Yii::app()->request->baseUrl;?>";  
        jQuery.ajax({                            
            url: baseurl+'/site/loadmore',
            type: "POST",
            data: {id: 5},  
            error: function(){
                alert("Something Went Wrong...Please Try Later.");
            },
            success: function(resp){                   
                $("#records").append(resp);
            }
        });
        
    }
    function applyjob(jobId,id){       
     var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";  
     var status = document.getElementById('applystatus'+id).value;
     document.getElementById('applyjobalert'+id).style.display = '';
               
         jQuery.ajax({                            
            url: baseurl+'/member/applyjob',
            type: "POST",
            data: {id:jobId,status:status},  
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
     function savejob(jobId,id){       
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
            data: {id:jobId,status:status}, 
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