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
            <a href="<?php echo Yii::app()->request->baseUrl . '/Member/create1?id='.$user_id; ?>" ><button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Personal Details</button></a>
        </div>
        <div class="col-md-2"> 
            <a href="<?php echo Yii::app()->request->baseUrl . '/Member/create2?id='.$user_id; ?>"> <button class="btn-u btn-u-sm rounded-2x  btn-u-brown" type="button">Education Details</button></a>
        </div>
        <div class="col-md-2">
            <a href="javascript:void(0);"> <button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Professional Details</button></a>
        </div>
        <div class="col-md-2">
            <a href="javascript:void(0);"><button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Resume Uploads</button></a>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <div class="row">

        
          
            <?php if(empty($Membereducation)) {?>
            <div class="row margin-bottom-40">
                <form action="<?php echo Yii::app()->request->baseUrl . '/Member/create2?id='.$user_id; ?>" id="sky-form4" class="sky-form" method="post">
                <div class="col-md-8" >
                    <!-- Reg-Form -->
                    
                        <header>Education</header>
                        <div id="edudiv">
                        <fieldset id="edu">   
                            <input type="hidden" name="educount" id="educount" value="1">
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Institute</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="Membereducation[institute][]" placeholder="name" class="invalid" required>
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                        </label>
                                    </div>
                                </div>
                            </section>        
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Batch</label>
                                    <div class="col col-8">
                                        <div class="col-md-6" style="padding-left: 0px;">
                                            <label class="select state-error">
                                                <select name="Membereducation[batchfrom][]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=2015;$i>=1970;$i--){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                            
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 0px;">
                                            <label class="select state-error">
                                                <select name="Membereducation[batchto][]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=2015;$i>=1970;$i--){?>
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
                                    <label class="label col col-4">Course Type</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                        <select name="Membereducation[coursetype][]" class="invalid" required>
                                            <option selected value="">Select</option>
                                            <option value="1">Full Time</option>
                                            <option value="2">Part Time</option>  
                                            <option value="3">Distance Learning program</option>  
                                            <option value="4">Executive Program</option> 
                                        </select>
                                        <i></i>
                                    </label>
                                    </div>
                                </div>
                            </section>                         
                            <section>
                                <div class="row">
                                    <?php $degree = Degree::model()->findAll('status=:status',array(':status'=>1));?>
                                    <label class="label col col-4">Degree</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                        <select name="Membereducation[degree_id][]" class="invalid" required>
                                            <option selected value="">Select</option>
                                            <?php foreach($degree as $key=>$value) { ?> 
                                                    <option value="<?php echo $value->id;?>"><?php echo $value->name;?></option>
                                            <?php } ?>
                                        </select>
                                        <i></i>
                                    </label>
                                    </div>
                                </div>
                            </section>                
                        </fieldset>
                            </div>
                        <footer>                            
                            <button type="button" class="btn-u btn-u-dark pull-right" onclick="addmore()">Add +</button>
                        </footer>
                        <footer>
                            <input type="hidden" name="create" value="create"> 
                            <button type="submit" class="btn-u pull-right">Submit & Continue</button>
                        </footer>
                          
                    <!-- End Reg-Form -->
                </div>

                <!-- Login-Form -->
                <div class="col-md-4 sky-form">  
                        
                        
                   
                </div>
                 </form> 
                <!-- End Login-Form -->
            </div><!--/end row-->      
            <?php } else{ ?>
             <div class="row margin-bottom-40">
                <form action="<?php echo Yii::app()->request->baseUrl . '/Member/create2?id='.$user_id; ?>" id="sky-form4" class="sky-form" method="post">
                <div class="col-md-8" >
                    <!-- Reg-Form -->
                    
                        <header>Education</header>
                        <div id="edudiv">
                       <input type="hidden" name="educount" id="educount" value="1">
          <?php  foreach($Membereducation as $key=>$value){ ?>             
                              <fieldset id="eduup<?php echo $value->id;?>"> 
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Institute</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="Membereducation[institute][]" placeholder="name" class="invalid" required value="<?php echo $value->institute;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                        </label>
                                    </div>
                                </div>
                            </section>        
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Batch</label>
                                    <div class="col col-8">
                                        <div class="col-md-6" style="padding-left: 0px;">
                                            <label class="select state-error">
                                                <select name="Membereducation[batchfrom][]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=2015;$i>=1970;$i--){?>
                                                            <option  value="<?php echo $i;?>" <?php if($i==$value->batchfrom) { ?>selected <?php } ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                            
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-6" style="padding-right: 0px;">
                                            <label class="select state-error">
                                                <select name="Membereducation[batchto][]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=2015;$i>=1970;$i--){?>
                                                            <option  value="<?php echo $i;?>" <?php if($i==$value->batchto) { ?>selected <?php } ?>><?php echo $i;?></option>
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
                                    <label class="label col col-4">Course Type</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                        <select name="Membereducation[coursetype][]" class="invalid" required>
                                            <option selected value="">Select</option>
                                            <option value="1" <?php if($value->coursetype==1){ ?> selected <?php } ?>>Full Time</option>
                                            <option value="2" <?php if($value->coursetype==2){ ?> selected <?php } ?>>Part Time</option>  
                                            <option value="3" <?php if($value->coursetype==3){ ?> selected <?php } ?>>Distance Learning program</option>  
                                            <option value="4" <?php if($value->coursetype==4){ ?> selected <?php } ?>>Executive Program</option> 
                                        </select>
                                        <i></i>
                                    </label>
                                    </div>
                                </div>
                            </section>                         
                            <section>
                                <div class="row">
                                    <?php $degree = Degree::model()->findAll('status=:status',array(':status'=>1));?>
                                    <label class="label col col-4">Degree</label>
                                    <div class="col col-8">
                                        <label class="select state-error">
                                        <select name="Membereducation[degree_id][]" class="invalid" required>
                                            <option selected value="">Select</option>
                                            <?php foreach($degree as $key=>$value1) { ?> 
                                                    <option value="<?php echo $value1->id;?>" <?php if($value1->id==$value->degree_id) { ?>selected <?php } ?>><?php echo $value1->name;?></option>
                                            <?php } ?>
                                        </select>
                                        <i></i>
                                    </label>
                                    </div>
                                </div>
                            </section> 
                                  <footer><div class="col-md-6"></div><div class="col-md-6"><button type="button" class="btn-u btn-u-red pull-left" onclick="deleteup(<?php echo $value->id;?>)">Delete</button></div>
                                    </footer>
                         </fieldset>
            
            <?php } ?>
           
                            </div>
                        <footer>                            
                            <button type="button" class="btn-u btn-u-dark pull-right" onclick="addmore()">Add +</button>
                        </footer>
                        <footer>
                            <input type="hidden" name="EducationId" value="<?php echo $user_id;?>"> 
                            <button type="submit" class="btn-u pull-right">Submit & Continue</button>
                        </footer>
                          
                    <!-- End Reg-Form -->
                </div>

                <!-- Login-Form -->
                <div class="col-md-4 sky-form">  
                        
                        
                   
                </div>
                 </form> 
                <!-- End Login-Form -->
            </div>
            
            <?php }?>
        </div>

        <!-- End Content -->
    </div>          
</div><!--/container--> 
<script type="text/javascript">
    function addmore(){
        var x = parseInt(document.getElementById("educount").value);        
        var edu='<fieldset id="edu'+x+'">\n\
                    <section>\n\
                        <div class="row">\n\
                            <label class="label col col-4">Institute</label>\n\
                                <div class="col col-8">\n\
                                    <label class="input">\n\
                                        <i class="icon-append fa fa-user"></i>\n\
                                        <input type="text" name="Membereducation[institute][]" placeholder="name" class="invalid" required>\n\
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>\n\
                                    </label>\n\
                                </div>\n\
                        </div>\n\
                    </section>\n\
                    <section>\n\
<div class="row">\n\
<label class="label col col-4">Batch</label>\n\
<div class="col col-8">\n\
<div class="col-md-6" style="padding-left: 0px;">\n\
<label class="select state-error">\n\
<select name="Membereducation[batchfrom][]" class="invalid" required>\n\
<option selected value="">YYYY</option><?php for($i=2015;$i>=1970;$i--){?>\
<option  value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?>\
</select>\n\
<i></i>\n\
</label>\n\
</div>\n\
<div class="col-md-6" style="padding-right: 0px;">\n\
<label class="select state-error">\n\
<select name="Membereducation[batchto][]" class="invalid" required>\n\
<option selected value="">YYYY</option><?php for($i=2015;$i>=1970;$i--){?>\
<option  value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?>\
</select>\n\
<i></i>\n\
</label>\n\
</div>\n\
</div>\n\
</div>\n\
</section>\n\
<section>\n\
<div class="row">\n\
<label class="label col col-4">Course Type</label>\n\
<div class="col col-8">\n\
<label class="select state-error">\n\
<select name="Membereducation[coursetype][]" class="invalid" required>\n\
<option selected value="">Select</option>\n\
<option value="1">Full Time</option>\n\
<option value="2">Part Time</option>\n\
<option value="3">Distance Learning program</option>\n\
<option value="4">Executive Program</option>\n\
</select>\n\
<i></i>\n\
</label>\n\
</div>\n\
</div>\n\
</section>\n\
<section>\n\
<div class="row"><?php $degree = Degree::model()->findAll('status=:status',array(':status'=>1));?>\
<label class="label col col-4">Degree</label>\n\
<div class="col col-8">\n\
<label class="select state-error">\n\
<select name="Membereducation[degree_id][]" class="invalid" required>\n\
<option selected value="">Select</option><?php foreach($degree as $key=>$value) { ?>\
<option  value="<?php echo $value->id;?>"><?php echo $value->name;?></option><?php } ?></select>\n\
<i></i>\n\
</label>\n\
</div>\n\
</div>\n\
</section><footer>\n\<div class="col-md-6"></div><div class="col-md-6"><button type="button" class="btn-u btn-u-red pull-left" onclick="deletemore('+x+')">Delete</button></div>\n\
</footer></fieldset>';       
        x+=parseInt(1);       
        document.getElementById("educount").value=x;
//        var div = document.getElementById('edudiv');
//        div.innerHTML = div.innerHTML +edu;
        $("#edudiv").append(edu);
        
    }
    function deletemore(id){
        document.getElementById('edu'+id).innerHTML = "";
    }
    function deleteup(id){
        document.getElementById('eduup'+id).innerHTML = "";
        document.getElementById('eduup'+id).style.display = "none";
    }
</script>
</div><!--/End Wrapepr-->