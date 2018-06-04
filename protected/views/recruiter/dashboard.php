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
    <div class="row" >
            <!-- Begin Sidebar Menu -->
            <div class="col-md-1">
                
            </div>
            <!-- End Sidebar Menu -->

            <!-- Begin Content -->
            <div class="col-md-10" style="background: #dedede;">
                <?php if(Yii::app()->user->hasFlash('error')){?>
                            <div class="row margin-bottom-10">
                                <div class="info alert alert-danger fade in">
                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                    <?php echo Yii::app()->user->getFlash('error'); ?>
                                </div>
                            </div>
                    <?php } ?>
                <?php if(Yii::app()->user->hasFlash('success')){?>
                            <div class="row margin-bottom-10">
                                <div class="info alert alert-info fade in">
                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                    <?php echo Yii::app()->user->getFlash('success'); ?>
                                </div>
                            </div>
                    <?php } ?>
                <div class="row margin-bottom-40" style="padding-top: 20px;">
                     <form action="<?php echo Yii::app()->request->baseUrl.'/Recruiter/createjob';?>" id="sky-form4" class="sky-form" method="post">
                    <div class="col-md-8">
                        <!-- Reg-Form -->
                       
                            <header>Job Post Details</header>
                           
                            <fieldset>                  
                                <section>
                                     <label class="label">Title for Job</label>
                                    <label class="input">                                       
                                        <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="Jobpostings[jobtitle]" placeholder="Title" class="invalid" required>
                                        <b class="tooltip tooltip-bottom-right">Needed to enter Title for Job</b>
                                   </label>
                                </section>
                                <section>
						<label class="label">Locations</label>
						<label class="select select-multiple" >
							<select multiple="" style="height: 150px ! important;" name="Jobpostings[locations][]" required>
                                                            <?php $city = City::model()->findAll('status=:status',array(':status'=>1));
                                                                    if(isset($city) && !empty($city)){
                                                                        foreach ($city as $key => $value) { 
                                                                             ?>                                       
                                                                    <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                                                            
                                                            <?php } } ?>								
							</select>
						</label>
						<div class="note"><strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.</div>
                                </section>
                                <section>
						<label class="label">Category</label>
						<label class="select">
							<select name="Jobpostings[cat_id]" onchange="getsubcat(this.value);" required>
                                                            <option value="" selected>Select Category</option>
                                                            <?php $category = Category::model()->findAll('status=:status',array(':status'=>1));
                                                                    if(isset($category) && !empty($category)){
                                                                        foreach ($category as $key => $value) { 
                                                                             ?>                                       
                                                                    <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                                                            
                                                            <?php } } ?>								
							</select>
                                                    <i></i>
						</label>
						
                                </section>
                                <section>
						<label class="label">Sub Category</label>
						<label class="select">
							<select id="subcatselect" disabled  name="Jobpostings[subcat_id]" required>
                                                             <option value="">Select Category to get Sub Category List.</option>                                                                                                                                                                   
                                                       </select>
                                                    <i></i>
						</label>
						
                                </section>
                                <section>
						<label class="label">Skills</label>
						<label class="select">
							<select name="Jobpostings[skill_id]" required>
                                                            <option value="" selected>Select Skill</option>
                                                            <?php $skillsub = Skillsub::model()->findAll('status=:status',array(':status'=>1));
                                                                    if(isset($skillsub) && !empty($skillsub)){
                                                                        foreach ($skillsub as $key => $value) { 
                                                                             ?>                                       
                                                                    <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                                                            
                                                            <?php } } ?>								
							</select>
                                                    <i></i>
						</label>
						
                                </section>
                                  <section>
                                    <label class="label">Minimum Salary (Rupees per Annum)</label>
                                    <label class="input">
                                      
                                        <input type="number" name="Jobpostings[salmin]" class="invalid" placeholder="Min Salary" min="0">
                                        <b class="tooltip tooltip-bottom-right"> Enter Minimum Salary</b>                                       
                                    </label>
                                </section>
                                
                                 <section>
                                    <label class="label">Maximum Salary (Rupees per Annum)</label>
                                    <label class="input">
                                      
                                        <input type="number" name="Jobpostings[salmax]" class="invalid" placeholder="Max Salary" min="0">
                                        <b class="tooltip tooltip-bottom-right"> Enter Maximum Salary</b>                                       
                                    </label>
                                </section>
                                   <section>
						<label class="label">Years of. Exp</label>
                                                <div class="row">
                                                    <div class="col-md-6">
						<label class="select" >
							<select required name="Jobpostings[expmin]">
                                                            <option value="" selected>min</option>
                                                            <?php                                                               
                                                                    for($i=0;$i<=50;$i++){ ?>                                       
                                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                            
                                                            <?php  } ?>								
							</select>
                                                    <i></i>
						</label>
                                                    </div>
                                                    <div class="col-md-6">
						<label class="select" >
							<select required name="Jobpostings[expmax]">
                                                            <option value="" selected>max</option>
                                                            <?php                                                               
                                                                    for($i=0;$i<=50;$i++){ ?>                                       
                                                                    <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                            
                                                            <?php  } ?>								
							</select>
                                                    <i></i>
						</label>
                                                    </div>
                                                    </div>
                                </section>
                                <section>
						<label class="label">Body</label>
						<label class="textarea textarea-resizable">
							<textarea rows="15" name="Jobpostings[description]" required class="ckeditor"></textarea>
						</label>
					</section>
                                
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[apply_less_qualification]" id="terms"><i></i>Restrict Applying Less Qualification Members.</label>
                                </section>
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[female]" id="terms"><i></i>Would prefer Female candidates for this role.</label>
                                </section>
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[physical]" id="terms"><i></i>Would prefer Differently-abled candidates for this role. This includes Physcial disability, Vision or Hearing impairment, etc.</label>
                                </section>
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[defence]" id="terms"><i></i>Would prefer ex-defence personnel.</label>
                                </section>
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[work_from_home]" id="terms"><i></i>May work from home.</label>
                                </section>
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[women_workforce]" id="terms"><i></i>Would prefer women joining back the workforce.</label>
                                </section>
                                <section>
                                    <div class="row">
                                        <div class="col-md-4">
						<label class="label">Status</label>
                                        </div>
                                        <div class="col-md-8">
						<label class="select">
							<select name="Jobpostings[status]" required>
                                                            <option value="1" selected>Active</option> 
                                                            <option value="0">In-Active</option>                                                             
							</select>
                                                    <i></i>
						</label>
                                         </div>
				    </div>		
                                </section>
                            </fieldset>  
                              <footer>
                                <button class="btn-u" type="submit">Submit</button>    
                                <button class="btn-u btn-u-default" type="reset">Cancel</button> 
                            </footer>
                        <!--</form>-->         
                        <!-- End Reg-Form -->
                    </div>

                    <!-- Login-Form -->
                    <div class="col-md-4 sky-form">
                        <!--<form class="sky-form" id="sky-form1" action="<?php echo Yii::app()->request->baseUrl.'/site/login';?>" novalidate="novalidate" method="post">-->
                            <header>Key Words</header>
                            
                            <fieldset>                  
                                <section>
                                     <label class="label">Keyword #1</label>
                                        <label class="input">                                       
                                              
                                                <input type="text" name="Jobpostings[keyword1]" placeholder="Keyword #1" class="invalid">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #1 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #2</label>
                                        <label class="input">                                       
                                               
                                                <input type="text" name="Jobpostings[keyword2]" placeholder="Keyword #2" class="invalid">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #2 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #3</label>
                                        <label class="input">                                       
                                               
                                                <input type="text" name="Jobpostings[keyword3]" placeholder="Keyword #3" class="invalid">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #3 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #4</label>
                                        <label class="input">                                       
                                             
                                                <input type="text" name="Jobpostings[keyword4]" placeholder="Keyword #4" class="invalid">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #4 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #5</label>
                                        <label class="input">                                       
                                               
                                                <input type="text" name="Jobpostings[keyword5]" placeholder="Keyword #5" class="invalid">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #5 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #6</label>
                                        <label class="input">                                       
                                              
                                                <input type="text" name="Jobpostings[keyword6]" placeholder="Keyword #6" class="invalid">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #6 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #7</label>
                                        <label class="input">                                       
                                               
                                                <input type="text" name="Jobpostings[keyword7]" placeholder="Keyword #7" class="invalid">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #7 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #7</label>
                                        <label class="input">                                       
                                            
                                                <input type="text" name="Jobpostings[keyword8]" placeholder="Keyword #8" class="invalid">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #8 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #9</label>
                                        <label class="input">                                       
                                           
                                                <input type="text" name="Jobpostings[keyword9]" placeholder="Keyword #9" class="invalid">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #9 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #10</label>
                                        <label class="input">                                       
                                           
                                                <input type="text" name="Jobpostings[keyword10]" placeholder="Keyword #10" class="invalid">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #10 for your job</b>
                                        </label>
                                </section> 
                         
                        
                       
                    </div>
                    </form> 
                    <!-- End Login-Form -->
                </div><!--/end row-->                
            </div>
            <div class="col-md-1">
                
            </div>
            <!-- End Content -->
        </div>          
    </div><!--/container--> 
      

    </div><!--/End Wrapepr-->
    <script>
     function getsubcat(catId){
        
            if(catId != null){
                var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
                document.getElementById("subcatselect").disabled=false;
                jQuery.ajax({                            
                            url: baseurl+'/SubCategory/getSubCategoriesByCat',
                            type: "POST",
                            data: {id: catId},  
                            error: function(){
                                     alert("Something Went Wrong...Please Try Later.");
                                },
                            success: function(resp){     
                                   
                                    jQuery("#subcatselect").html(resp);
                                }
                            });
            }else{
                alert("Please select Category To get Sub Category List")
            }
        }
         </script>