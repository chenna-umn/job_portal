

    <!--=== Profile ===-->
    <div class="profile container content">
    	<div class="row">
            <!--Left Sidebar-->
              <div class="col-md-3 md-margin-bottom-40">
          <?php $this->renderPartial('/admin/adminleftbar');?>
            <!--End Left Sidebar-->
              </div>
            <div class="col-md-9">
                <!--Profile Body-->
                <?php if(Yii::app()->user->hasFlash('error')){?>
                            <div class="row margin-bottom-10">
                                <div class="info alert alert-danger fade in">
                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                    <?php echo Yii::app()->user->getFlash('error'); ?>
                                </div>
                            </div>
                    <?php } ?>
                <div class="row margin-bottom-10">                          
                        <a href="<?php echo Yii::app()->request->baseUrl.'/City/createMultiple';?>"><button type="button" class="btn-u btn-u-orange">Add Multi Cities</button></a>  
                        <a href="<?php echo Yii::app()->request->baseUrl.'/City/index';?>"><button type="button" class="btn-u">List All Cities</button></a>   
                    </div>
                <div class="profile-body">
                    <!--Service Block v3-->
                    <div class="row margin-bottom-10">                       
                        <div class="col-md-8 bg-cyan">
                        <form action="<?php echo Yii::app()->request->baseUrl.'/City/create';?>" class="sky-form bg-cyan" method="post">
				<header>Add a City</header>
				
				<fieldset>
                                        <section>
						<label class="label">Select Country</label>
						<label class="select">
							<select name="City[country_id]" required onchange="getstates(this.value)">
                                                            <option value="">Select Country</option>
								<?php  $categories = Country::model()->findAll(array('order'=>'name ASC'));
                                                        if(isset($categories) && !empty($categories)){ 
                                                            foreach ($categories as $key => $value) { ?>
                                                                    <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>

                                                           <?php } } ?> 						
                                                        </select>
							<i></i>
						</label>
					</section>
                                        <section>
						<label class="label">Select State</label>
						<label class="select">
                                                        <select id="stateselect" disabled  name="City[state_id]" required>
                                                             <option value="">Select Country to get State List.</option>                                                                                                                                                                   
                                                       </select>
                                                        <i></i>
                                                    </label>
					</section>
					<section>
						<label class="label">City Name</label>
						<label class="input">
							<input type="text" name="City[name]" required>
                                                        <b class="tooltip tooltip-top-left">Enter City Name</b>
						</label>
					</section>			
					
				</fieldset>
				
				<fieldset>
                                    <section>
						<label class="label">Display On Home Page</label>
						<label class="select">
							<select name="City[display_on_top]" required>
								<option value="0"  selected>NO</option>
								<option value="1">Yes</option>                                                               
															
                                                        </select>
							<i></i>
						</label>
					</section>
					<section>
						<label class="label">Status</label>
						<label class="select">
							<select name="City[status]" required>
								<option value="0">InActive</option>
								<option value="1" selected>Active</option>                                                               
															
                                                        </select>
							<i></i>
						</label>
					</section>					
				</fieldset>				
				
				<footer>
					<button type="submit" class="button">Submit</button>
					<button type="button" class="button button-secondary" onclick="window.history.back();">Back</button>
				</footer>
			</form>
                        </div>
                                                <div class="col-md-2"></div>

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
        function getstates(countryId){
            if(countryId != null){
                var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
                document.getElementById("stateselect").disabled=false;
                jQuery.ajax({                            
                            url: baseurl+'/City/getStateList',
                            type: "POST",
                            data: {id: countryId},  
                            error: function(){
                                     alert("Something Went Wrong...Please Try Later.");
                                },
                            success: function(resp){                  
                                    jQuery("#stateselect").html(resp);
                                }
                            });
            }else{
                alert("Please select Country To get State List")
            }
        }
    </script>
    <?php $this->renderPartial('//layouts/footerv'); ?>