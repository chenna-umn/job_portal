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
            <?php if (Yii::app()->user->hasFlash('error')) { ?>
                <div class="row margin-bottom-10">
                    <div class="info alert alert-danger fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('error'); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if (Yii::app()->user->hasFlash('success')) { ?>
                <div class="row margin-bottom-10">
                    <div class="info alert alert-info fade in">
                        <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                        <?php echo Yii::app()->user->getFlash('success'); ?>
                    </div>
                </div>
            <?php } ?>
            <div class="row margin-bottom-40" style="padding-top: 20px;">
                
                <form action="<?php echo Yii::app()->request->baseUrl . '/udsrf-'.User::model()->seoFriendlyUrl($model->name).'-' . $model->id.'.htm'; ?>" id="sky-form4" class="sky-form" method="post">
                    <div class="col-md-6">
                        <!-- Reg-Form -->

                        <header>Location</header>

                        <fieldset>                  
                            
                            <section>
                                <label class="label">Name</label>
                                <label class="input">
                                   
                                    <input type="text" name="Resumefinder[name]" placeholder="Name" class="invalid" value="<?php echo $model->name;?>" required>
                                    <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                </label>                                
                            </section>
                            <section>
                                <label class="label">Locations</label>
                                
                                <?php
                                    $cityArray = explode(",",$model->locations);
                                    $cityArray  = array_filter($cityArray);
                                
                                ?>
                                <label class="select select-multiple" >
                                    <select multiple="" style="height: 200px ! important;" name="Resumefinder[locations][]">
                                        <?php
                                        $city = City::model()->findAll('status=:status', array(':status' => 1));
                                        if (isset($city) && !empty($city)) {
                                            foreach ($city as $key => $value) {
                                                ?>                                       
                                        <option value="<?php echo $value['id']; ?>" <?php if(in_array($value['id'], $cityArray)){  ?> selected <?php } ?>><?php echo $value['name']; ?></option>

    <?php }
} ?>								
                                    </select>
                                </label>
                                <div class="note"><strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.</div>
                            </section>
                            <section>
                                <label class="label">Category</label>
                                <?php
                                    $listArray = explode(",",$model->category);
                                    $listArray  = array_filter($listArray);
                                
                                ?>
                                <label class="select select-multiple">
                                    <select multiple="" name="Resumefinder[category][]" class="invalid" style="height: 200px ! important;">
                                        <option selected value="" >Select</option>    
                                            <?php $category = Category::model()->findAll('status=:status', array(':status' => 1));
                                            foreach ($category as $key => $value) { ?>
                                            <optgroup label="<?php echo '---' . $value->name . '---'; ?>">
                                                <?php $subcategory = Subcategory::model()->findAll('cat_id=:cat_id AND status=:status', array(':cat_id' => $value->id, ':status' => 1)); ?>
                                                <?php foreach ($subcategory as $key1 => $value1) { ?>
                                                    <option value="<?php echo $value1->id; ?>" <?php if(in_array($value1->id, $listArray)){  ?> selected <?php } ?>><?php echo $value1->name; ?></option>                                                                                                       
                                            <?php } ?>                                                 
                                            </optgroup>                                             
<?php } ?>                                      
                                    </select>                                                    
                                </label>
                                <div class="note"><strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.</div>
                            </section>

                        </fieldset> 
                        <!--</form>-->         
                        <!-- End Reg-Form -->
                    </div>

                    <!-- Login-Form -->
                    <div class="col-md-6 sky-form">

                        <header>Skills</header>

                        <fieldset>                  
                            <section>
                                <label class="label">Skills</label>
                                 <?php
                                    $skillsArray = explode(",",$model->skills);
                                    $skillsArray  = array_filter($skillsArray);
                                
                                ?>
                                <label class="select select-multiple">
                                    <select name="Resumefinder[skills][]" class="invalid"  multiple="" style="height: 250px ! important;">
                                        <option selected value="">Select</option>    
                                            <?php $skillmain = Skillmain::model()->findAll('status=:status', array(':status' => 1));
                                            foreach ($skillmain as $key => $value) { ?>
                                            <optgroup label="<?php echo '---' . $value->name . '---'; ?>">
                                                <?php $skillsub = Skillsub::model()->findAll('skillmain_id=:skillmain_id AND status=:status', array(':skillmain_id' => $value->id, ':status' => 1)); ?>
                                                <?php foreach ($skillsub as $key1 => $value1) { ?>
                                                    <option value="<?php echo $value1->id; ?>" <?php if(in_array($value1->id, $skillsArray)){  ?> selected <?php } ?>><?php echo $value1->name; ?></option>                                                                                                       
                                            <?php } ?>                                                 
                                            </optgroup>                                             
<?php } ?>                                      
                                    </select> 
                                </label>
                                <div class="note"><strong>Note:</strong> hold down the ctrl/cmd button to select multiple options.</div>
                            </section>
                            <section>
                                <label class="label">Salary in Lacks</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="select" >
                                            <select name="Resumefinder[salmin]">
                                                <option value="" selected>min</option>
                                                    <?php for ($i = 0; $i <= 99; $i++) { ?>                                       
                                                    <option value="<?php echo $i; ?>" <?php if($i==$model->salmin) { ?> selecetd <?php } ?>><?php echo $i; ?></option>

                                                   <?php } ?>								
                                            </select>
                                            <i></i>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="select" >
                                            <select name="Resumefinder[salmax]">
                                                <option value="" selected>max</option>
                                                <?php for ($i = 0; $i <= 99; $i++) { ?>                                       
                                                    <option value="<?php echo $i; ?>" <?php if($i==$model->salmax) { ?> selecetd <?php } ?>><?php echo $i; ?></option>

                                                <?php } ?>	
                                                <option value="100">100 +</option>
                                            </select>
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <label class="label">Years of. Exp</label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="select" >
                                            <select name="Resumefinder[expmin]">
                                                <option value="" selected>min</option>
                                                <?php for ($i = 0; $i <= 99; $i++) { ?>                                       
                                                    <option value="<?php echo $i; ?>" <?php if($i==$model->expmin) { ?> selecetd <?php } ?>><?php echo $i; ?></option>

                                                <?php } ?>		
                                                <option value="100">100 +</option>
                                            </select>
                                            <i></i>
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="select" >
                                            <select name="Resumefinder[expmax]">
                                                <option value="" selected>max</option>
                                                <?php for ($i = 0; $i <= 99; $i++) { ?>                                       
                                                    <option value="<?php echo $i; ?>" <?php if($i==$model->expmax) { ?> selecetd <?php } ?>><?php echo $i; ?></option>
                                                <?php } ?>								
                                            </select>
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <footer>
                                <button class="btn-u btn-u-lg btn-u-purple" type="submit">Update & Search</button>    
                                <button class="btn-u btn-u-lg btn-u-default" type="reset">Cancel</button> 
                            </footer>



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
