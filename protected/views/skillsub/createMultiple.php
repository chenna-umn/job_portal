

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
                        <a href="<?php echo Yii::app()->request->baseUrl.'/Skillsub/create';?>"><button type="button" class="btn-u btn-u-orange">Add New Sub Skill</button></a>  
                        <a href="<?php echo Yii::app()->request->baseUrl.'/Skillsub/index';?>"><button type="button" class="btn-u">List All Sub Skills</button></a>   
                    </div>
                <div class="profile-body">
                    <!--Service Block v3-->
                    <div class="row margin-bottom-10">                       
                        <div class="col-md-8 bg-orange">
                        <form action="<?php echo Yii::app()->request->baseUrl.'/Skillsub/createMultiple';?>" class="sky-form bg-cyan" method="post">
				<header>Add Bulk Sub Skills</header>
				
				<fieldset>
                                    <section>
						<label class="label">Separator</label>
						<label class="select">
							<select name="separator" required>
								<option value="line">Line</option>
								<option value="comma" selected>Comma</option>	
                                                        </select>
							<i></i>
						</label>
					</section>
					<section>
						<label class="label">Select Skill</label>
						<label class="select">
							<select name="Skillsub[skillmain_id]" required>
                                                            <option value="">Select Skill</option>
								<?php  $categories = Skillmain::model()->findAll(array('order'=>'name ASC'));
                                                        if(isset($categories) && !empty($categories)){ 
                                                            foreach ($categories as $key => $value) { ?>
                                                                    <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>

                                                           <?php } } ?> 						
                                                        </select>
							<i></i>
						</label>
					</section>
                                    
					<section>
						<label class="label">Enter List</label>
						<label class="textarea textarea-resizable">
							<textarea rows="10" name="Skillsub[name]" required></textarea>
						</label>
					</section>
				</fieldset>
				
				<fieldset>
                                    <section>
						<label class="label">Display On Home Page</label>
						<label class="select">
							<select name="Skillsub[display_on_top]" required>
								<option value="0"  selected>NO</option>
								<option value="1">Yes</option>                                                               
															
                                                        </select>
							<i></i>
						</label>
					</section>
					<section>
						<label class="label">Status</label>
						<label class="select">
							<select name="Skillsub[status]" required>
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
    <?php $this->renderPartial('//layouts/footerv'); ?>