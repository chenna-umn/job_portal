<!--=== Content Part ===-->
<div class="container s-results margin-bottom-50">
    <div class="row">
            <div class="col-md-6">
                <div class="headline" style="margin-bottom: 0px;"><h1>Get started! Create your own Job-feed</h1></div>
                <div class="headline" style="margin-top: 0px; margin-bottom: 10px;"><h2>Click on a category to select the keywords</h2></div>
            </div>
            
             <div class="col-md-6 sky-form pull-right">
            <div class="col-md-3" >
                    
            </div> 
            <div class="col-md-4" >
                    
            </div>
            <div class="col-md-3">
                    <button type="button" class="btn-u btn-u-lg btn-u-brown" onclick="doneAndSearch()">Done & Search</button>
            </div>
                 <div class="col-md-2" >
                    
            </div>
                 </div>
            
        </div>
    <div class="row tab-v3">
        <div class="col-sm-4">
            <ul class="nav nav-pills nav-stacked"> 
                <?php
                if (isset($Categories) && !empty($Categories)) {
                      $i=0;
                    foreach ($Categories as $key => $category) {
                        ?>
                <li class="<?php if($i==0) echo "active";?>"><a data-toggle="tab" data-target="#cat-<?php echo $category->id; ?>" href="#cat-<?php echo $category->id; ?>" onclick="basicedit('<?php echo $category->id; ?>');"><i class="fa fa-home"></i> <span class="badge rounded badge-blue pull-right" id="spancountcat<?php echo $category->id;?>"><?php echo Searchfilters::model()->getSearchFilterCountByCat($category->id);?></span><?php echo $category->name . ' Jobs'; ?></a></li>

                    <?php  $i++;} ?>
                        <li class=""><a  href="<?php echo Yii::app()->request->baseUrl.'/site/displayFullList';?>" target="_blank"><i class="fa fa-home"></i>More</a></li>
              <?php  } else { ?>
                    <div class="alert alert-info fade in">
                        <strong>Oops...!</strong> Currently there are No Categories Available.
                    </div>
                <?php } ?>

            </ul>                    
        </div>
        <div class="col-sm-8">
            <div class="tab-content" style="padding-top: 0px;" >
                <?php
               
                if (isset($Categories) && !empty($Categories)) {
                     $j=0;
                    foreach ($Categories as $key => $category) {
                        ?>
                        <div id="cat-<?php echo $category->id; ?>" class="tab-pane <?php if($j==0) echo "active";?> fade in">
                            <form class="sky-form" action="">
                                <fieldset style="padding-top: 0px;">
                                    <section>                                        
                                        <div class="row">
                                            <?php
                                            $subcat = Subcategory::model()->getSubcategoryByCatFullList($category->id);
                                            $searchFilterArray = Searchfilters::model()->getSearchFilterByCat($category->id);
                                            if (isset($subcat) && !empty($subcat)) {
                                                foreach ($subcat as $key1 => $value) {
                                                    $status = in_array($value->id,$searchFilterArray)?1:0;
                                                    ?>                                             
                                                    <input type="hidden" id="status<?php echo $value->id;?>" value="<?php echo $status; ?>">
                                                    <button type="button" <?php if($status==0) { ?> class="btn-u btn-brd btn-brd-hover rounded btn-u-dark-blue btn-u-sm" <?php }else{?> class="btn-u btn-u-default rounded" <?php } ?> style="margin-bottom: 10px;" id="btn<?php echo $value->id;?>"onclick="changeStatus('<?php echo $value->id;?>','<?php echo $value->cat_id;?>')"> <?php echo $value->name; ?></button>
                                                <?php }
                                            } ?> 
                                        </div>
                                    </section> 
                                </fieldset>                                
                            </form>
                        </div>
                    <?php  $j++;}
                } ?>                            
            </div>                                    
        </div>
    </div>        
</div>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript">  
    $(window).scroll(function () {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            GetRecords();
        }
    });
    function GetRecords() {
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";  
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
    
    function changeStatus(id,catid){
     var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";  
     var status = document.getElementById('status'+id).value;
     var catvalue =  parseInt(document.getElementById('spancountcat'+catid).innerHTML);
     
     if(status == 0){
         $('#btn'+id).removeClass('btn-u btn-brd btn-brd-hover rounded btn-u-dark-blue btn-u-sm');  
         $('#btn'+id).addClass('btn-u btn-u-default rounded');
         document.getElementById('status'+id).value = 1;
         document.getElementById('spancountcat'+catid).innerHTML = catvalue + parseInt(1);
     }else{
         $('#btn'+id).removeClass('btn-u btn-u-default rounded');
         $('#btn'+id).addClass('btn-u btn-brd btn-brd-hover rounded btn-u-dark-blue btn-u-sm');
         document.getElementById('status'+id).value = 0;
         document.getElementById('spancountcat'+catid).innerHTML = catvalue - parseInt(1);
     }
          
         jQuery.ajax({                            
            url: baseurl+'/member/savesearchfilter',
            type: "POST",
            data: {id:id,catid:catid,status:status},  
            error: function(){
                alert("Something Went Wrong...Please Try Later.");
            },
            success: function(resp){                   
               if(resp == "success"){
                   
               }else{
                  alert("Something Went Wrong...Please Try Later.");
               }
            }
        });
    }
    function basicedit(id){ 
      
      document.getElementById('cat-'+id).classList.add('catmenu1');
    }
    function doneAndSearch(){
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>"; 
        window.location.href = baseurl+'/member/jobfeed'
    }

</script>


<?php //$this->renderPartial('//layouts/footerv'); ?>