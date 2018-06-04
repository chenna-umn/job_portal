<div class="container content" style="padding-top: 0px;">
    <div class="row" style="margin-top: 20px;>
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
        </div>
    <div class="row" style="margin-top: 20px;">
        <!-- Begin Sidebar Menu -->
        <div class="col-md-2">
            <a href="<?php echo Yii::app()->request->baseUrl . '/Member/create1?id='.$user_id; ?>" ><button class="btn-u btn-u-sm rounded-2x btn-u-brown" type="button">Personal Details</button></a>
        </div>
        <div class="col-md-2"> 
            <a href="javascript:void(0);"> <button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Education Details</button></a>
        </div>
        <div class="col-md-2">
            <a href="javascript:void(0);"> <button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Professional Details</button></a>
        </div>
        <div class="col-md-2">
            <a href="javascript:void(0);" ><button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Resume Uploads</button></a>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <div class="row">

          
            <?php if(empty($MemberPersonal)) {?>
            <div class="row margin-bottom-40">
                <form action="<?php echo Yii::app()->request->baseUrl . '/Member/create1?id='.$user_id; ?>" id="sky-form4" class="sky-form" method="post">
                <div class="col-md-6">
                    <!-- Reg-Form -->
                    
                        <header>Registration form</header>
                        <fieldset>   
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Name</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="Memberpersonal[name]" placeholder="name" class="invalid" required>
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                        </label>
                                    </div>
                                </div>
                            </section>        
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Mobile</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <input type="number" name="Memberpersonal[mobile]"  class="invalid" placeholder="Mobile Number" maxlength="10" required> 
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the mobile</b> 
                                        </label>
                                    </div>
                                </div>
                            </section> 
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Gender</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                        <select name="Memberpersonal[gender]" class="invalid" required>
                                            <option selected value="">Select Gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>  
                                            <option value="Other">Other</option>  
                                        </select>
                                        <i></i>
                                    </label>
                                    </div>
                                </div>
                            </section>                             
                            
                            
                            
                            <section>
                                <div class="row">
                                    <label class="label col col-4"> Date of Birth</label>
                                    <div class="col col-8">
                                        <div class="col-md-4" style="padding-left: 0px; padding-right: 2px;">
                                            <label class="input">                                      
                                                <input type="number" placeholder="Day"  name="Memberpersonal[dobday]" class="invalid" min="0" max="31" required>
                                                <b class="tooltip tooltip-bottom-right">Needed to enter the Day of Date of Birth</b>
                                            </label>
                                        </div>
                                        <div class="col-md-4" style="padding-left: 2px; padding-right: 2px;">
                                            <label class="input">                                      
                                                <input type="number" placeholder="Month"  name="Memberpersonal[dobmonth]" class="invalid" min="1" max="12" required>
                                                <b class="tooltip tooltip-bottom-right">Needed to enter the Month of Date of Birth</b>
                                            </label>
                                        </div>
                                        <div class="col-md-4" style="padding-left: 2px; padding-right: 0px;">
                                            <label class="input">                                      
                                                <input type="number" placeholder="Year"  name="Memberpersonal[dobyear]" class="invalid" minlenght="4" maxlenth="4" required>
                                                <b class="tooltip tooltip-bottom-right">Needed to enter the Year of Date of Birth</b>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Current Location</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                            <select name="Memberpersonal[current_location]" class="invalid" required>
                                                <option selected value="">Select</option>    
                                                <?php $states = State::model()->findAll('status=:status', array(':status' => 1));
                                                foreach ($states as $key => $value) { ?>
                                                    <optgroup label="<?php echo '---' . $value->name . '---'; ?>">
                                                        <?php $city = City::model()->findAll('state_id=:state_id AND status=:status', array(':state_id' => $value->id, ':status' => 1)); ?>
                                                        <?php foreach ($city as $key1 => $value1) { ?>
                                                            <option value="<?php echo $value1->id; ?>"><?php echo $value1->name; ?></option>                                                                                                       
                                                        <?php } ?>                                                 
                                                    </optgroup>                                             
                                                <?php } ?>                                      
                                            </select>
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                            </section> 

                            <section>
                                <div class="row">
                                    <label class="label col col-4">Preferred Location</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                            <select name="Memberpersonal[preferred_location][]" class="invalid" multiple style="height: 200px;" required>
                                                <option selected value="">Select</option>    
                                                <?php $states = State::model()->findAll('status=:status', array(':status' => 1));
                                                foreach ($states as $key => $value) { ?>
                                                    <optgroup label="<?php echo '---' . $value->name . '---'; ?>">
                                                        <?php $city = City::model()->findAll('state_id=:state_id AND status=:status', array(':state_id' => $value->id, ':status' => 1)); ?>
                                                        <?php foreach ($city as $key1 => $value1) { ?>
                                                            <option value="<?php echo $value1->id; ?>"><?php echo $value1->name; ?></option>                                                                                                       
                                                        <?php } ?>                                                 
                                                    </optgroup>                                             
                                                <?php } ?>                                      
                                            </select>                                            
                                        </label>
                                    </div>
                                </div>
                            </section>                            
                        </fieldset>
                        <footer>
                            <input type="hidden" name="create" value="create"> 
                            <button type="submit" class="btn-u pull-right">Submit & Continue</button>
                        </footer>
                          
                    <!-- End Reg-Form -->
                </div>

                <!-- Login-Form -->
                <div class="col-md-6 sky-form">  
                        <fieldset>                  
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Industry</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                            <select name="Memberpersonal[industry]" class="invalid" required>
                                                <option selected value="" >Select</option>    
                                                <?php $category = Category::model()->findAll('status=:status', array(':status' => 1));
                                                foreach ($category as $key => $value) { ?>
                                                    <optgroup label="<?php echo '---' . $value->name . '---'; ?>">
                                                        <?php $subcategory = Subcategory::model()->findAll('cat_id=:cat_id AND status=:status', array(':cat_id' => $value->id, ':status' => 1)); ?>
                                                        <?php foreach ($subcategory as $key1 => $value1) { ?>
                                                            <option value="<?php echo $value1->id; ?>"><?php echo $value1->name; ?></option>                                                                                                       
                                                        <?php } ?>                                                 
                                                    </optgroup>                                             
                                                <?php } ?>                                      
                                            </select>     
                                             <i></i>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Functional Area</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                            <select name="Memberpersonal[functional_area]" class="invalid" required>
                                                <option selected value="">Select</option>    
                                                <?php $skillmain = Skillmain::model()->findAll('status=:status', array(':status' => 1));
                                                foreach ($skillmain as $key => $value) { ?>
                                                    <optgroup label="<?php echo '---' . $value->name . '---'; ?>">
                                                        <?php $skillsub = Skillsub::model()->findAll('skillmain_id=:skillmain_id AND status=:status', array(':skillmain_id' => $value->id, ':status' => 1)); ?>
                                                        <?php foreach ($skillsub as $key1 => $value1) { ?>
                                                            <option value="<?php echo $value1->id; ?>"><?php echo $value1->name; ?></option>                                                                                                       
                                                        <?php } ?>                                                 
                                                    </optgroup>                                             
                                                <?php } ?>                                      
                                            </select>  
                                             <i></i>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Notice Period</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                        <select name="Memberpersonal[notice_period]" class="invalid" required>
                                            <option selected value="">Select</option>
                                            <option value="1">Immediately Available</option>
                                            <option value="2">1 month</option>  
                                            <option value="3">3 months</option>  
                                            <option value="4">6 months</option> 
                                        </select>
                                        <i></i>
                                    </label>
                                    </div>
                                </div>
                            </section>   
                           <section>
                                <div class="row">
                                    <label class="label col col-4">Experience</label>
                                    <div class="col col-8">
                                        <div class="col-md-6">
                                            <label class="select state-error">
                                                <select name="Memberpersonal[expyear]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=0;$i<=30;$i++){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                             <option  value="30+">30+</option>
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="select state-error">
                                                <select name="Memberpersonal[expmonth]" class="invalid" required>
                                                    <option selected value="">MM</option>
                                                    <?php for($i=0;$i<=11;$i++){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>  
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Annual Salary (INR)(in lakhs/year)</label>
                                    <div class="col col-8">
                                        <div class="col-md-6">
                                            <label class="select state-error">
                                                <select name="Memberpersonal[current_salary]" class="invalid" required>
                                                    <option selected value="">Select</option>
                                                    <?php for($i=1;$i<=30;$i++){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                             <option  value="30+">30+</option>
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                             <label class="checkbox"><input type="checkbox" name="Memberpersonal[current_salary_confidential]" id="terms"><i></i>Confidential </label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>  
                          
                             <section>
                                <div class="row">
                                    <label class="label col col-4">Expected Salary (INR) (INR)(in lakhs/year)</label>
                                    <div class="col col-8">
                                        <div class="col-md-6">
                                            <label class="select state-error">
                                                <select name="Memberpersonal[expected_salary]" class="invalid" required>
                                                    <option selected value="">Select</option>
                                                    <?php for($i=1;$i<=30;$i++){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                             <option  value="30+">30+</option>
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                             <label class="checkbox"><input type="checkbox" name="Memberpersonal[expected_salary_negotiable]" id="terms"><i></i>Negotiable  </label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>
                        </fieldset>
                        
                   
                </div>
                 </form> 
                <!-- End Login-Form -->
            </div><!--/end row-->      
            <?php } else{ ?>
            
            <div class="row margin-bottom-40">
                <form action="<?php echo Yii::app()->request->baseUrl . '/Member/create1?id='.$user_id; ?>" id="sky-form4" class="sky-form" method="post">
                <div class="col-md-6">
                    <!-- Reg-Form -->
                    
                        <header>Registration form</header>
                        <fieldset>   
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Name</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="Memberpersonal[name]" placeholder="name" class="invalid" value="<?php echo $MemberPersonal->name;?>" required>
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                        </label>
                                    </div>
                                </div>
                            </section>        
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Mobile</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <input type="number" name="Memberpersonal[mobile]"  class="invalid" placeholder="Mobile Number" value="<?php echo $MemberPersonal->mobile;?>" maxlength="10" required> 
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the mobile</b> 
                                        </label>
                                    </div>
                                </div>
                            </section> 
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Gender</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                        <select name="Memberpersonal[gender]" class="invalid" required>
                                            <option selected value="">Select Gender</option>
                                            <option value="Male" <?php if($MemberPersonal->gender == "Male") { ?>selected <?php } ?>>Male</option>
                                            <option value="Female" <?php if($MemberPersonal->gender == "Female") { ?>selected <?php } ?>>Female</option>  
                                            <option value="Other" <?php if($MemberPersonal->gender == "Other") { ?>selected <?php } ?>>Other</option>  
                                        </select>
                                        <i></i>
                                    </label>
                                    </div>
                                </div>
                            </section>                             
                            
                            
                            
                            <section>
                                <div class="row">
                                    <label class="label col col-4"> Date of Birth</label>
                                    <div class="col col-8">
                                        <div class="col-md-4" style="padding-left: 0px; padding-right: 2px;">
                                            <label class="input">                                      
                                                <input type="number" placeholder="Day"  name="Memberpersonal[dobday]" class="invalid" min="0" max="31" required value="<?php echo date('j', strtotime($MemberPersonal->dob)); ?>">
                                                <b class="tooltip tooltip-bottom-right">Needed to enter the Day of Date of Birth</b>
                                            </label>
                                        </div>
                                        <div class="col-md-4" style="padding-left: 2px; padding-right: 2px;">
                                            <label class="input">                                      
                                                <input type="number" placeholder="Month"  name="Memberpersonal[dobmonth]" class="invalid" min="1" max="12" required value="<?php echo date('n', strtotime($MemberPersonal->dob)); ?>">
                                                <b class="tooltip tooltip-bottom-right">Needed to enter the Month of Date of Birth</b>
                                            </label>
                                        </div>
                                        <div class="col-md-4" style="padding-left: 2px; padding-right: 0px;">
                                            <label class="input">                                      
                                                <input type="number" placeholder="Year"  name="Memberpersonal[dobyear]" class="invalid" minlenght="4" maxlenth="4" required value="<?php echo date('Y', strtotime($MemberPersonal->dob)); ?>">
                                                <b class="tooltip tooltip-bottom-right">Needed to enter the Year of Date of Birth</b>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Current Location</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                            <select name="Memberpersonal[current_location]" class="invalid" required>
                                                <option selected value="">Select</option>    
                                                <?php $states = State::model()->findAll('status=:status', array(':status' => 1));
                                                foreach ($states as $key => $value) { ?>
                                                    <optgroup label="<?php echo '---' . $value->name . '---'; ?>">
                                                        <?php $city = City::model()->findAll('state_id=:state_id AND status=:status', array(':state_id' => $value->id, ':status' => 1)); ?>
                                                        <?php foreach ($city as $key1 => $value1) { ?>
                                                            
                                                            <option value="<?php echo $value1->id; ?>" <?php if($value1->id==$MemberPersonal->current_location) { ?> selected <?php } ?> ><?php echo $value1->name; ?></option>                                                                                                       
                                                        <?php } ?>                                                 
                                                    </optgroup>                                             
                                                <?php } ?>                                      
                                            </select>
                                            <i></i>
                                        </label>
                                    </div>
                                </div>
                            </section> 

                            <section>
                                <div class="row">
                                    <label class="label col col-4">Preferred Location</label>
                                    <?php $prefLocation = explode(",", $MemberPersonal->preferred_location);?>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                            <select name="Memberpersonal[preferred_location][]" class="invalid" multiple style="height: 200px;" required>
                                                <option selected value="">Select</option>    
                                                <?php $states = State::model()->findAll('status=:status', array(':status' => 1));
                                                foreach ($states as $key => $value) { ?>
                                                    <optgroup label="<?php echo '---' . $value->name . '---'; ?>">
                                                        <?php $city = City::model()->findAll('state_id=:state_id AND status=:status', array(':state_id' => $value->id, ':status' => 1)); ?>
                                                        <?php foreach ($city as $key1 => $value1) { ?>
                                                            <option value="<?php echo $value1->id; ?>" <?php if(in_array($value1->id,$prefLocation)){ ?> selected <?php } ?>><?php echo $value1->name; ?></option>                                                                                                       
                                                        <?php } ?>                                                 
                                                    </optgroup>                                             
                                                <?php } ?>                                      
                                            </select>                                            
                                        </label>
                                    </div>
                                </div>
                            </section>                            
                        </fieldset>
                        <footer>
                            <input type="hidden" name="PersonalId" value="<?php echo $MemberPersonal->id; ?>"> 
                            <button type="submit" class="btn-u pull-right">Submit & Continue</button>
                        </footer>
                          
                    <!-- End Reg-Form -->
                </div>

                <!-- Login-Form -->
                <div class="col-md-6 sky-form">  
                        <fieldset>                  
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Industry</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                            <select name="Memberpersonal[industry]" class="invalid" required>
                                                <option selected value="" >Select</option>    
                                                <?php $category = Category::model()->findAll('status=:status', array(':status' => 1));
                                                foreach ($category as $key => $value) { ?>
                                                    <optgroup label="<?php echo '---' . $value->name . '---'; ?>">
                                                        <?php $subcategory = Subcategory::model()->findAll('cat_id=:cat_id AND status=:status', array(':cat_id' => $value->id, ':status' => 1)); ?>
                                                        <?php foreach ($subcategory as $key1 => $value1) { ?>
                                                            <option value="<?php echo $value1->id; ?>" <?php if($value1->id==$MemberPersonal->industry) { ?> selected <?php } ?>><?php echo $value1->name; ?></option>                                                                                                       
                                                        <?php } ?>                                                 
                                                    </optgroup>                                             
                                                <?php } ?>                                      
                                            </select>     
                                             <i></i>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Functional Area</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                            <select name="Memberpersonal[functional_area]" class="invalid" required>
                                                <option selected value="">Select</option>    
                                                <?php $skillmain = Skillmain::model()->findAll('status=:status', array(':status' => 1));
                                                foreach ($skillmain as $key => $value) { ?>
                                                    <optgroup label="<?php echo '---' . $value->name . '---'; ?>">
                                                        <?php $skillsub = Skillsub::model()->findAll('skillmain_id=:skillmain_id AND status=:status', array(':skillmain_id' => $value->id, ':status' => 1)); ?>
                                                        <?php foreach ($skillsub as $key1 => $value1) { ?>
                                                            <option value="<?php echo $value1->id; ?>" <?php if($value1->id==$MemberPersonal->functional_area) { ?> selected <?php } ?>><?php echo $value1->name; ?></option>                                                                                                       
                                                        <?php } ?>                                                 
                                                    </optgroup>                                             
                                                <?php } ?>                                      
                                            </select>  
                                             <i></i>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Notice Period</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                        <select name="Memberpersonal[notice_period]" class="invalid" required>
                                            <option selected value="">Select</option>
                                            <option value="1" <?php if($MemberPersonal->notice_period == 1){ ?> selected <?php }?>>Immediately Available</option>
                                            <option value="2" <?php if($MemberPersonal->notice_period == 2){ ?> selected <?php }?>>1 month</option>  
                                            <option value="3" <?php if($MemberPersonal->notice_period == 3){ ?> selected <?php }?>>3 months</option>  
                                            <option value="4" <?php if($MemberPersonal->notice_period == 4){ ?> selected <?php }?>>6 months</option> 
                                        </select>
                                        <i></i>
                                    </label>
                                    </div>
                                </div>
                            </section>   
                           <section>
                                <div class="row">
                                    <label class="label col col-4">Experience</label>
                                    <div class="col col-8">
                                        <div class="col-md-6">
                                            <label class="select state-error">
                                                <select name="Memberpersonal[expyear]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=0;$i<=30;$i++){?>
                                                            <option  value="<?php echo $i;?>" <?php if($i==$MemberPersonal->expyear) { ?> selected <?php } ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                             <option  value="30+">30+</option>
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="select state-error">
                                                <select name="Memberpersonal[expmonth]" class="invalid" required>
                                                    <option selected value="">MM</option>
                                                    <?php for($i=0;$i<=11;$i++){?>
                                                            <option  value="<?php echo $i;?>" <?php if($i==$MemberPersonal->expmonth) { ?> selected <?php } ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>  
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Annual Salary (INR)(in lakhs/year)</label>
                                    <div class="col col-8">
                                        <div class="col-md-6">
                                            <label class="select state-error">
                                                <select name="Memberpersonal[current_salary]" class="invalid" required>
                                                    <option selected value="">Select</option>
                                                    <?php for($i=1;$i<=30;$i++){?>
                                                            <option  value="<?php echo $i;?>" <?php if($i==$MemberPersonal->current_salary) { ?> selected <?php } ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                             <option  value="30+">30+</option>
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                             <label class="checkbox"><input type="checkbox" name="Memberpersonal[current_salary_confidential]" <?php if($MemberPersonal->current_salary_confidential==1) { ?> checked <?php } ?> id="terms"><i></i>Confidential </label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>  
                          
                             <section>
                                <div class="row">
                                    <label class="label col col-4">Expected Salary (INR) (INR)(in lakhs/year)</label>
                                    <div class="col col-8">
                                        <div class="col-md-6">
                                            <label class="select state-error">
                                                <select name="Memberpersonal[expected_salary]" class="invalid" required>
                                                    <option selected value="">Select</option>
                                                    <?php for($i=1;$i<=30;$i++){?>
                                                            <option  value="<?php echo $i;?>" <?php if($i==$MemberPersonal->expected_salary) { ?> selected <?php } ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                             <option  value="30+">30+</option>
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                             <label class="checkbox"><input type="checkbox" name="Memberpersonal[expected_salary_negotiable]" <?php if($MemberPersonal->expected_salary_negotiable==1) { ?> checked <?php } ?>id="terms"><i></i>Negotiable  </label>
                                        </div>
                                        
                                    </div>
                                </div>
                            </section>
                        </fieldset>
                        
                   
                </div>
                 </form> 
                <!-- End Login-Form -->
            </div>
            
            
            <?php } ?>
        </div>

        <!-- End Content -->
    </div>          
</div><!--/container--> 

</div><!--/End Wrapepr-->