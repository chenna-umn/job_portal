<!--=== Job Img ===-->

<div class="job-img margin-bottom-30">
    <div class="col-md-9"> </div>
    <div class="col-md-3 recruiter">
        <a href="<?php echo Yii::app()->request->baseUrl . '/Recruiter/index'; ?>" target="_blank"> <button type="button" class="btn-u btn-u-lg btn-u-dark pull-right grow" style="top: 40px; right: 5px; padding-right: 50px; font-size: 26px; padding-left: 50px;">Recruiters</button>  </a>              
    </div>
    <div class="job-banner pull-right" id="registerform" style="margin-right: 20px;">

        <h2>Get Started! Register here</h2> 
        <form action="<?php echo Yii::app()->request->baseUrl . '/Member/index'; ?>" method="post">
            <div class="margin-bottom-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                    <input type="email" name="registeremail" id="register_email" placeholder="Email" class="form-control">                           
                </div>
                <lable id="emailalert"></lable>
            </div>    
            <div class="margin-bottom-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input type="password" name="registerpassword" placeholder="password" class="form-control">
                </div>
            </div> 
            <div class="margin-bottom-10 row">
                <div class="col-md-6">
                    <button type="submit" class="btn-u btn-block btn-u-blue"> Register</button>
                </div>
                <div class="col-md-6">
                    <a href="javascript:void(0);" onclick="displaylogin()">Login</a>
                </div>
            </div>
        </form>
    </div> 
    <div class="job-banner pull-right" id="loginform" style="margin-right: 20px;min-width: 320px;display: none;">
        <h2>Jobseeker Login</h2> 
        <form action="<?php echo Yii::app()->request->baseUrl . '/site/login'; ?>" method="post">
            <div class="margin-bottom-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                    <input type="email" name="LoginForm[username]" placeholder="Email" class="form-control">
                </div>
            </div>    
            <div class="margin-bottom-10">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                    <input type="password" name="LoginForm[password]" placeholder="password" class="form-control">
                    <input type="hidden" name="LoginForm[user_type]" value="4" class="invalid">
                </div>
            </div> 
            <div class="margin-bottom-10 row">
                <div class="col-md-6">
                    <button type="submit" class="btn-u btn-block btn-u-blue"> Login</button>
                </div>
                <div class="col-md-6">
                    <a href="<?php echo Yii::app()->request->baseUrl . '/site/ForgotPassword'; ?>">Forgot Password</a>
                </div>
            </div>
        </form>
        <div class="margin-bottom-10 row" >
            <div class="col-md-3">                      
            </div>
            <div class="col-md-6">               
                New User? <a href="javascript:void(0);"  onclick="displayregister()">Register</a>     
            </div>

            <div class="col-md-3">                      
            </div>
        </div>
    </div> 
    <script type="text/javascript">
        function displaylogin(){                    
            document.getElementById("registerform").style.display = "none";  
            $('#loginform').fadeIn('normal');
                    
            //document.getElementById("loginform").style.display ="";                             
        }
        function displayregister(){                     
            document.getElementById("loginform").style.display = "none";
            $('#registerform').fadeIn('normal');
            //document.getElementById("registerform").style.display = "";
        }
    </script>
    <div class="job-img-inputs">
        <form action="<?php echo Yii::app()->request->baseUrl . '/site/searchJob'; ?>" method="post">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 md-margin-bottom-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                            <input type="text" placeholder="what job you are looking for" class="form-control" name="keyword" required>
                        </div>
                    </div>    
                    <div class="col-sm-4 md-margin-bottom-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" list="list" placeholder="where would you like to work" class="form-control" name="location">
                            <datalist id="list">
                                <?php
                                $cityArray = City::model()->findAll('status=:status', array(':status' => 1));
                                if (isset($cityArray) && !empty($cityArray)) {
                                    foreach ($cityArray as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['name']; ?>" ></option>
    <?php }
} ?>
                            </datalist>

<!--                            <input type="text" placeholder="where would you like to work" class="form-control">-->
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <button type="submit" class="btn-u btn-block btn-u-dark"> Search Job</button>
                        <a class="pull-right" data-toggle="modal" data-target="#responsive" style="text-decoration: none;cursor: pointer;"> Advanced Search</a>
                    </div>
                </div>
            </div>
        </form>
    </div>    
</div>  
<div class="modal fade" id="responsive" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <form action="<?php echo Yii::app()->request->baseUrl . '/site/searchJobAdvanced'; ?>" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Advance Search</h4>
            </div>
            <div class="modal-body">
               
                <div class="row">
                    <div class="col-md-5">
                        <p class="search-advance">Keywords</p>
                        <p class="search-advance">Location</p>
                        <p class="search-advance">Job Category </p>
                        <p class="search-advance">Key Skills </p>
                        <p class="search-advance">Expected Salary Min</p>
                        <p class="search-advance">Expected Salary Max</p>
                        <p class="search-advance">Work Experience Min</p>
                        <p class="search-advance">Work Experience Max</p>
                    </div>
                    <div class="col-md-7">
                        <p><input type="text" placeholder="Key Words" class="form-control" name="keyword" required>
                        <p><input type="text" list="list" placeholder="Search Location" class="form-control" name="location">
                            <datalist id="list">
                                <?php
                                $cityArray = City::model()->findAll('status=:status', array(':status' => 1));
                                if (isset($cityArray) && !empty($cityArray)) {
                                    foreach ($cityArray as $key => $value) {
                                        ?>
                                        <option value="<?php echo $value['name']; ?>" ></option>
                                    <?php }
                                } ?>
                            </datalist></p>
                        </p>
                        <p><select name="category" class="invalid form-control">
                                <option selected value="" >Select Category</option>    
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
                        </p>

                        <p>
                            <select name="skills" class="invalid form-control">
                                <option selected value="">Select Skills</option>    
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
                        </p>





                        <p>
                            <select name="salmin" class="invalid form-control">
                                <option value="" selected>Min Salary</option>
<?php for ($i = 0; $i <= 99; $i++) { ?>                                       
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

                                <?php } ?>								
                            </select>
                        </p>
                        <p>
                            <select name="salmax" class="invalid form-control">
                                <option value="" selected>Max Salary</option>
<?php for ($i = 0; $i <= 99; $i++) { ?>                                       
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>	
                                <option value="100">100 +</option>
                            </select>

                        </p>




                        <p>
                            <select name="expmin" class="invalid form-control">
                                <option value="" selected>Min Experience</option>
<?php for ($i = 0; $i <= 99; $i++) { ?>                                       
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>

<?php } ?>		
                                <option value="100">100 +</option>
                            </select>
                        </p>

                        <p>
                            <select name="expmax" class="invalid form-control">
                                <option value="" selected>Max Experience</option>
<?php for ($i = 0; $i <= 99; $i++) { ?>                                       
                                    <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>								
                            </select>
                        </p>                                                
                    </div>
                </div>
              
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-u btn-u-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn-u btn-u-primary">Search</button>
            </div>
        </div>
    </div>
        </form>
</div>
<!--=== End Job Img ===-->

<!--=== Content Part ===-->
<div class="container content">      

    <!-- Job Content -->
    <div class="headline"><h2>Job Categories</h2></div>
    <div class="row job-content margin-bottom-40">

                <?php
                if (isset($Categories) && !empty($Categories)) {
                    foreach ($Categories as $key => $category) {
                        ?>
                <div class="col-md-3 col-sm-3 md-margin-bottom-40">
                    <ul class="list-unstyled categories">
                        <h3 class="heading-md"><strong><?php echo $category->name . ' Jobs'; ?></strong></h3>
        <?php
        $subcat = Subcategory::model()->getSubcategoryByCat($category->id, 5);
        if (isset($subcat) && !empty($subcat)) {
            foreach ($subcat as $key1 => $value) {
                ?>                    
                                <li><a href="<?php echo Yii::app()->request->baseUrl . '/searchbysubcat-'.User::model()->seoFriendlyUrl($value->name).'-' . $value->id.'.htm'; ?>" target="_blank"><?php echo $value->name; ?></a></li>                    
                    <?php }
                } ?>

                    </ul>
                </div>
    <?php }
} else { ?>
            <div class="alert alert-info fade in">
                <strong>Oops...!</strong> Currently there are No Categories Available.
            </div>
<?php } ?>

    </div> 
    <!-- End Job Content -->


</div>

<script type="text/javascript">
      
    $('#register_email').on('keyup', function () {
        var email= $('#register_email').val();
        var baseurl = "<?php echo Yii::app()->request->baseUrl; ?>";      
        if(email != null && checkEmail(email)){
            jQuery.ajax({                            
                url: baseurl+'/site/checkemail',
                type: "POST",
                data: {email: email},  
                error: function(){
                    $('#emailalert').html('Please enter email to check availability' ).css('color', 'red');
                },
                success: function(resp){                   
                    if(resp=="registered"){
                        $('#emailalert').html('This email is already registerd with us..please try with another email address.' ).css('color', 'red');
                    }else if(resp=="notregistered"){
                        $('#emailalert').html('Congrats...! this email is available to register').css('color', 'green');
                    }else if(resp=="notset"){
                        $('#emailalert').html('Please enter email to check availability' ).css('color', 'red');
                    }                                        
                }
            });
        } else{
            $('#emailalert').html('Please enter valid email to register...' ).css('color', 'red');
        }
            
    });
    function checkEmail(inputvalue){	
        var pattern=/^([a-zA-Z0-9_.-])+@([a-zA-Z0-9_.-])+\.([a-zA-Z])+([a-zA-Z])+/;
        if(pattern.test(inputvalue)){         
            return true;  
        }else{   
            return false;
        }
    }
</script>
<?php $this->renderPartial('//layouts/footerv'); ?>