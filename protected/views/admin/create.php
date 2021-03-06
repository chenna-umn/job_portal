

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
                <?php if(Yii::app()->user->hasFlash('error')){?>
                            <div class="row margin-bottom-10">
                                <div class="info alert alert-danger fade in">
                                    <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                                    <?php echo Yii::app()->user->getFlash('error'); ?>
                                </div>
                            </div>
                    <?php } ?>
                <div class="row margin-bottom-10">                          
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/createMultiple';?>"><button type="button" class="btn-u btn-u-orange">Add Multi Categories</button></a>  
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/categories';?>"><button type="button" class="btn-u">List All Categories</button></a>   
                    </div>
                <div class="profile-body">
                    <!--Service Block v3-->
                    <div class="row margin-bottom-10">                       
                        <div class="col-md-8 bg-cyan">
                        <form action="<?php echo Yii::app()->request->baseUrl.'/admin/create';?>" class="sky-form bg-cyan" method="post">
				<header>Add a Category</header>
				
				<fieldset>
					<section>
						<label class="label">Category Name</label>
						<label class="input">
							<input type="text" name="Category[name]" required>
                                                        <b class="tooltip tooltip-top-left">Enter Category Name</b>
						</label>
					</section>			
					
				</fieldset>
				
				<fieldset>
					<section>
						<label class="label">Status</label>
						<label class="select">
							<select name="Category[status]" required>
								<option value="0">InActive</option>
								<option value="1" selected>Active</option>                                                               
															
                                                        </select>
							<i></i>
						</label>
					</section>	
                                    <section>
						<label class="label">Display On Home Page</label>
						<label class="select">
							<select name="Category[display_on_top]" required>
								<option value="0"  selected>NO</option>
								<option value="1">Yes</option>                                                               
															
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