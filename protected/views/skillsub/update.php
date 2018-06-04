

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
                <?php if(Yii::app()->user->hasFlash('success')){?>
                            <div class="row margin-bottom-10">
                                <div class="info alert alert-info fade in">
                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                    <?php echo Yii::app()->user->getFlash('success'); ?>
                                </div>
                            </div>
                    <?php } ?>
                <div class="profile-body">
                    <!--Service Block v3-->
                    <div class="row margin-bottom-10">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/Subcategory/index';?>"><button type="button" class="btn-u btn-u-dark-blue">List All Sub Categories</button></a>                        
                    </div>
                    <div class="row margin-bottom-10">                       
                        <div class="col-md-8 bg-cyan">
                        <form action="<?php echo Yii::app()->request->baseUrl.'/Subcategory/update?id='.$model->id;?>" class="sky-form bg-cyan" method="post">
				<header>Update Sub Category</header>
				
				<fieldset>
                                        <section>
						<label class="label">Select Sub Category</label>
						<label class="select">
							<select name="Subcategory[cat_id]" required>
                                                            <option value="">Select Category</option>
								<?php  $categories = Category::model()->findAll(array('order'=>'name ASC'));
                                                        if(isset($categories) && !empty($categories)){ 
                                                            foreach ($categories as $key => $value) { ?>
                                                                    <option value="<?php echo $value['id'];?>"<?php if($value['id']==$model->cat_id) { ?> selected <?php } ?>><?php echo $value['name'];?></option>

                                                           <?php } } ?> 						
                                                        </select>
							<i></i>
						</label>
					</section>
                                    
					<section>
						<label class="label">Category Name</label>
						<label class="input">
							<input type="text" name="Subcategory[name]" value="<?php echo $model->name;?>" required>
                                                        <b class="tooltip tooltip-top-left">Enter Category Name</b>
						</label>
					</section>			
					
				</fieldset>
				
				<fieldset>
                                        <section>
						<label class="label">Status</label>
						<label class="select">
							<select name="Subcategory[display_on_top]" required>
                                                            
								<option value="0" <?php if($model->display_on_top==0){ ?> selected <?php } ?>>No</option>
                                                           
								<option value="1" <?php if($model->display_on_top==1){ ?> selected <?php } ?> >Yes</option>                                                               
															
                                                        </select>
							<i></i>
						</label>
					</section>
					<section>
						<label class="label">Status</label>
						<label class="select">
							<select name="Subcategory[status]" required>
                                                            
								<option value="0" <?php if($model->status==0){ ?> selected <?php } ?>>InActive</option>
                                                           
								<option value="1" <?php if($model->status==1){ ?> selected <?php } ?> >Active</option>                                                               
															
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