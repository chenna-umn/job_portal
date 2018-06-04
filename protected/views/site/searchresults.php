   <!--=== Content Part ===-->
  
    <div class="container s-results margin-bottom-50" style="margin-top:20px;">
        <form action="<?php echo Yii::app()->request->baseUrl.'/site/searchJob';?>" method="post">
        <div class="row">
            <div class="col-md-3">
                 <div class="headline" style="margin-bottom: 0px; margin-top: 0px;"><h1>Search Results</h1></div>
            </div>            
             <div class="col-md-9 sky-form">
            <div class="col-md-5" >
                    <section>                               
                                    <label class="input">
                                        <input type="text" name="keyword" placeholder="Key Words" class="invalid" required <?php if(isset($keyword)) { ?> value="<?php echo $keyword; ?>" <?php }else { ?> value=""<?php } ?>>
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the Keywords</b>
                                   </label>
                                </section>
                
                                
            </div>                
            <div class="col-md-5">               
                    <section>                               
                                    <label class="input">
                                        <input type="text" list="list" placeholder="Location" class="form-control" name="location"<?php if(isset($cityList) && !empty($cityList)){ ?>  value="<?php echo $cityList;?>" <?php } ?>>
							<datalist id="list">
                                                            <?php $cityArray = City::model()->findAll('status=:status',array(':status'=>1));
                                                                  if(isset($cityArray) && !empty ($cityArray)){
                                                                      foreach($cityArray as $key=>$value){ ?>
                                                                            <option value="<?php echo $value['name'];?>"></option>
                                                                <?php  } }?>
							</datalist>
                                   </label>
                                </section>
            </div> 
            <div class="col-md-2">
                    <section>
                        <button type="submit" class="btn-u btn-u-brown"></i> Search</button>
                    </section>
            </div>
                 </div>
            
        </div>
            </form>
        <div class="row">
            <input type="hidden" id="limitvalue" value="<?php echo $limit;?>">
             <div class="col-md-9" id="records">               
                <!-- Begin Inner Results -->
                <?php 
                if(isset($jobsList) && !empty($jobsList)) {
                
                foreach($jobsList as $key=>$value){?>
            
                <div class="inner-results">
                    <div class="col-md-2" style="padding-left: 5px; padding-right: 5px;">
                        <ul class="list-inline down-ul">
                        <li>
                            <ul class="list-inline star-vote">
                                 <?php if(Recruiterprofile::model()->getRecruiterTypeByUserId($value['user_id'])==2) {?>
                                <li style="padding-left: 2px; padding-right: 2px;"><a href="#" class="tooltips" data-toggle="tooltip" data-original-title="Company Job"><i class="color-green fa fa-suitcase"></i></a></li>
                                <?php } else{?>
                                <li style="padding-left: 2px; padding-right: 2px;"><i class="fa fa-suitcase"></i></li>
                                <?php } ?>
                                <li style="padding-left: 2px; padding-right: 2px;"><i class="fa fa-bookmark"></i></li>
                                <li style="padding-left: 2px; padding-right: 2px;"><i class="fa fa-star-o"></i></li>
                                                                
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
                 
    <?php } }else{?>

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
                
                
               

                <!-- Blog Twitter -->
                
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
        var baseurl = "<?php echo Yii::app()->request->baseUrl;?>";  
        var keyword =  "<?php echo $keyword;?>";
        var limit =  "<?php echo $limit;?>";
         var location =  "<?php echo $cityList;?>";
        var limitcount = parseInt(document.getElementById("limitvalue").value);
        jQuery.ajax({                            
            url: baseurl+'/site/SearchJobsByLimit',
            type: "POST",
            data: {keyword: keyword,limit : limitcount},  
            error: function(){
                alert("Something Went Wrong...Please Try Later.");
            },
            success: function(resp){    
                document.getElementById("limitvalue").value = limitcount + parseInt(limit);
                $("#records").append(resp);
            }
        });
        
    }
    
</script>

       
    <?php $this->renderPartial('//layouts/footerv'); ?>