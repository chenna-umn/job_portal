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
                     <form action="<?php echo Yii::app()->request->baseUrl.'/Recruiter/updatejob?id='.$model->id;?>" id="sky-form4" class="sky-form" method="post">
                    <div class="col-md-8">
                        <!-- Reg-Form -->
                       
                            <header>Job Post Details</header>
                           
                            <fieldset>                  
                                <section>
                                     <label class="label">Title for Job</label>
                                    <label class="input">                                       
                                        <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="Jobpostings[jobtitle]" placeholder="Title" class="invalid" value="<?php echo $model->jobtitle;?>">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter Title for Job</b>
                                   </label>
                                </section>
                                <section>
						<label class="label">Locations</label>
						<label class="select select-multiple" >
							<select multiple="" style="height: 150px ! important;" name="Jobpostings[locations][]">
                                                            <?php $city = City::model()->findAll('status=:status',array(':status'=>1));
                                                            $selectedcity = explode(',',$model->locations);
                                                                    if(isset($city) && !empty($city)){
                                                                        foreach ($city as $key => $value) { 
                                                                             ?>                                       
                                                                    <option value="<?php echo $value['id'];?>" <?php if(in_array($value['id'], $selectedcity)) { ?> selected <?php } ?> ><?php echo $value['name'];?></option>
                                                            
                                                            <?php } } ?>								
							</select>
						</label>
						<div class="note"><strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.</div>
                                </section>
                                <section>
						<label class="label">Category</label>
						<label class="select" >
							<select name="Jobpostings[cat_id]" onchange="getsubcat(this.value);">
                                                            <?php $category = Category::model()->findAll('status=:status',array(':status'=>1));
                                                                    if(isset($category) && !empty($category)){
                                                                        foreach ($category as $key => $value) { 
                                                                             ?>                                       
                                                                    <option value="<?php echo $value['id'];?>" <?php if($value['id']==$model->cat_id) { ?> selected <?php } ?> ><?php echo $value['name'];?></option>
                                                            
                                                            <?php } } ?>								
							</select>
                                                    <i></i>
						</label>
						
                                </section>
                                <section>
						<label class="label">Sub Category</label>
						<label class="select">
							<select id="subcatselect" disabled  name="Jobpostings[subcat_id]" required>
                                                            <?php $subCategory = Subcategory::model()->findAll('status=:status AND cat_id=:cat_id',array(':status'=>1,':cat_id'=>$model->cat_id));
                                                                    if(isset($subCategory) && !empty($subCategory)){
                                                                        foreach ($subCategory as $key => $value) { 
                                                                             ?>                                       
                                                                    <option value="<?php echo $value['id'];?>" <?php if($value['id']==$model->subcat_id) { ?> selected <?php } ?> ><?php echo $value['name'];?></option>
                                                            
                                                            <?php } } ?>                                                                                                                                                                   
                                                       </select>
                                                    <i></i>
						</label>
						
                                </section>
                                <section>
						<label class="label">Skills</label>
						<label class="select" >
							<select name="Jobpostings[skill_id]">
                                                            <?php $skillsub = Skillsub::model()->findAll('status=:status',array(':status'=>1));
                                                                    if(isset($skillsub) && !empty($skillsub)){
                                                                        foreach ($skillsub as $key => $value) { 
                                                                             ?>                                       
                                                                    <option value="<?php echo $value['id'];?>" <?php if($value['id']==$model->skill_id) { ?> selected <?php } ?>><?php echo $value['name'];?></option>
                                                            
                                                            <?php } } ?>								
							</select>
                                                    <i></i>
						</label>
						
                                </section>
                                  <section>
                                    <label class="label">Minimum Salary (Lacks per Annum)</label>
                                    <label class="input">
                                      
                                        <input type="number" name="Jobpostings[salmin]" class="invalid" placeholder="Min Salary" min="0" value="<?php  echo $model->salmin;?>">
                                        <b class="tooltip tooltip-bottom-right"> Enter Minimum Salary</b>                                       
                                    </label>
                                </section>
                                
                                 <section>
                                    <label class="label">Maximum Salary (Lacks per Annum)</label>
                                    <label class="input">
                                      
                                        <input type="number" name="Jobpostings[salmax]" class="invalid" placeholder="Min Salary" min="0" value="<?php  echo $model->salmax;?>">
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
                                                                    <option value="<?php echo $i;?>" <?php if($i==$model->expmin) { ?> selected <?php } ?>><?php echo $i;?></option>
                                                            
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
                                                                    <option value="<?php echo $i;?>" <?php if($i==$model->expmax) { ?> selected <?php } ?>><?php echo $i;?></option>
                                                            
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
							<textarea rows="15" name="Jobpostings[description]" class="ckeditor"> <?php echo $model->description;?></textarea>
						</label>
					</section>
                                
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[apply_less_qualification]" id="terms" <?php if($model->apply_less_qualification==1) { ?> checked <?php } ?> ><i></i>Restrict Applying Less Qualification Members.</label>
                                </section>
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[female]" id="terms" <?php if($model->female==1) { ?> checked <?php } ?> ><i></i>Would prefer Female candidates for this role.</label>
                                </section>
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[physical]" id="terms" <?php if($model->physical==1) { ?> checked <?php } ?>><i></i>Would prefer Differently-abled candidates for this role. This includes Physcial disability, Vision or Hearing impairment, etc.</label>
                                </section>
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[defence]" id="terms" <?php if($model->defence==1) { ?> checked <?php } ?>><i></i>Would prefer ex-defence personnel.</label>
                                </section>
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[work_from_home]" id="terms" <?php if($model->work_from_home==1) { ?> checked <?php } ?>><i></i>May work from home.</label>
                                </section>
                                <section>                                   
                                    <label class="checkbox" style="font-size: 12px !important;"><input type="checkbox" name="Jobpostings[women_workforce]" id="terms" <?php if($model->women_workforce==1) { ?> checked <?php } ?>><i></i>Would prefer women joining back the workforce.</label>
                                </section>
                                <section>
                                    <div class="row">
                                        <div class="col-md-4">
						<label class="label">Status</label>
                                        </div>
                                        <div class="col-md-8">
						<label class="select">
							<select name="Jobpostings[status]" required>
                                                            <option value="1" selected <?php if($model->status==1) { ?> selected <?php } ?>>Active</option> 
                                                            <option value="0" <?php if($model->status==0) { ?> selected <?php } ?>>In-Active</option>                                                             
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
                        <!--<form class="sky-form" id="sky-form1" action="<?php // echo Yii::app()->request->baseUrl.'/site/login';?>" novalidate="novalidate" method="post">-->
                            <header>Key Words</header>
                            
                            <fieldset>                  
                                <section>
                                     <label class="label">Keyword #1</label>
                                        <label class="input">                                       
                                              
                                                <input type="text" name="Jobpostings[keyword1]" placeholder="Keyword #1" class="invalid" value="<?php echo $model->keyword1;?>">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #1 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #2</label>
                                        <label class="input">                                       
                                               
                                                <input type="text" name="Jobpostings[keyword2]" placeholder="Keyword #2" class="invalid" value="<?php echo $model->keyword2;?>">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #2 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #1</label>
                                        <label class="input">                                       
                                               
                                                <input type="text" name="Jobpostings[keyword3]" placeholder="Keyword #3" class="invalid" value="<?php echo $model->keyword3;?>">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #3 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #4</label>
                                        <label class="input">                                       
                                             
                                                <input type="text" name="Jobpostings[keyword4]" placeholder="Keyword #4" class="invalid" value="<?php echo $model->keyword4;?>">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #4 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #5</label>
                                        <label class="input">                                       
                                               
                                                <input type="text" name="Jobpostings[keyword5]" placeholder="Keyword #5" class="invalid" value="<?php echo $model->keyword5;?>">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #5 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #6</label>
                                        <label class="input">                                       
                                              
                                                <input type="text" name="Jobpostings[keyword6]" placeholder="Keyword #6" class="invalid" value="<?php echo $model->keyword6;?>">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #6 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #7</label>
                                        <label class="input">                                       
                                               
                                                <input type="text" name="Jobpostings[keyword7]" placeholder="Keyword #7" class="invalid" value="<?php echo $model->keyword7;?>">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #7 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #7</label>
                                        <label class="input">                                       
                                            
                                                <input type="text" name="Jobpostings[keyword8]" placeholder="Keyword #8" class="invalid" value="<?php echo $model->keyword8;?>">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #8 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #9</label>
                                        <label class="input">                                       
                                           
                                                <input type="text" name="Jobpostings[keyword9]" placeholder="Keyword #9" class="invalid" value="<?php echo $model->keyword9;?>">
                                                <b class="tooltip tooltip-bottom-right">Enter Keyword #9 for your job</b>
                                        </label>
                                </section>  
                                <section>
                                     <label class="label">Keyword #10</label>
                                        <label class="input">                                       
                                           
                                                <input type="text" name="Jobpostings[keyword10]" placeholder="Keyword #10" class="invalid" value="<?php echo $model->keyword10;?>">
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
      <script>
     function getsubcat(catId){
        
            if(catId != null){
                var baseurl = "<?php echo Yii::app()->request->baseUrl;?>"; 
                
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

    </div><!--/End Wrapepr-->