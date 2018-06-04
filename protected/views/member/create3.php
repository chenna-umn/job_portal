<div class="container content" style="padding-top: 0px;">
    <div class="row" style="margin-top: 20px;">
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
            <a href="<?php echo Yii::app()->request->baseUrl . '/Member/create2?id='.$user_id; ?>"> <button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Education Details</button></a>
        </div>
        <div class="col-md-2">
            <a href="<?php echo Yii::app()->request->baseUrl . '/Member/create3?id='.$user_id; ?>"> <button class="btn-u btn-u-sm rounded-2x  btn-u-brown" type="button">Professional Details</button></a>
        </div>
        <div class="col-md-2">
            <a href="javascript:void(0);" ><button class="btn-u btn-u-sm rounded-2x btn-u-default" type="button">Resume Uploads</button></a>
        </div>
        <div class="col-md-2">

        </div>
    </div>
    <div class="row">

        <div class="col-md-12">
            
          
            <?php if(empty($Memberprofessional)) { ?>
            <div class="row margin-bottom-40">
                <form action="<?php echo Yii::app()->request->baseUrl . '/Member/create3?id='.$user_id; ?>" id="sky-form4" class="sky-form" method="post">
                <div class="col-md-10" >
                    <!-- Reg-Form -->                    
                        <header>Professional Details</header>
                        <div id="profdiv">
                            <section>
                                    <div class="row">
                                        <div class="col col-6">
                                             <input type="hidden" name="prfoexp" id="prfoexp" value="1">
                                             <label class="checkbox"><input type="checkbox" name="Memberprofessional[hasexp]" onclick="showhide();"><i></i>I do not have any prior work experience</label>
                                        </div>
                                        <div class="col col-6">
                                           
                                        </div>
                                    </div>
                                </section>
                        <fieldset id="prof">   
                            <input type="hidden" name="profcount" id="profcount" value="1">
                            
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Designation</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="Memberprofessional[designation][]" placeholder="Designation" class="invalid" required>
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                        </label>
                                    </div>
                                </div>
                            </section>    
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Organization</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="Memberprofessional[organization][]" placeholder="Organization" class="invalid" required>
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Time Period</label>
                                    <div class="col col-8">
                                        <div class="col-md-3" style="padding-left: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[fromyear][]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=2015;$i>=1970;$i--){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                            
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-2" style="padding-right: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[frommonth][]" class="invalid" required>
                                                    <option selected value="">MM</option>
                                                    <?php for($i=1;$i<=12;$i++){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                             
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <label class="label col col-2" style="font-weight:bold;">To</label>
                                        <div class="col-md-3" style="padding-left: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[toyear][]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=2020;$i>=1970;$i--){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                            
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-2" style="padding-right: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[tomonth][]" class="invalid" required>
                                                    <option selected value="">MM</option>
                                                    <?php for($i=1;$i<=12;$i++){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                             
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
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
                <form action="<?php echo Yii::app()->request->baseUrl . '/Member/create3?id='.$user_id; ?>" id="sky-form4" class="sky-form" method="post">
                <div class="col-md-8" >
                    <!-- Reg-Form -->
                               
                        <header>Professional Details</header>
                        <fieldset id="prof" style="display:none;">   
                            <input type="hidden" name="profcount" id="profcount" value="1">
                            
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Designation</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="Memberprofessional[designation][]" placeholder="Designation" class="invalid" required>
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                        </label>
                                    </div>
                                </div>
                            </section>    
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Organization</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="Memberprofessional[organization][]" placeholder="Organization" class="invalid" required>
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Time Period</label>
                                    <div class="col col-8">
                                        <div class="col-md-3" style="padding-left: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[fromyear][]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=2015;$i>=1970;$i--){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                            
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-2" style="padding-right: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[frommonth][]" class="invalid" required>
                                                    <option selected value="">MM</option>
                                                    <?php for($i=1;$i<=12;$i++){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                             
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <label class="label col col-2" style="font-weight:bold;">To</label>
                                        <div class="col-md-3" style="padding-left: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[toyear][]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=2020;$i>=1970;$i--){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                            
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-2" style="padding-right: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[tomonth][]" class="invalid" required>
                                                    <option selected value="">MM</option>
                                                    <?php for($i=1;$i<=12;$i++){?>
                                                            <option  value="<?php echo $i;?>"><?php echo $i;?></option>
                                                    <?php } ?>
                                                             
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </section>    
                        </fieldset>
                        <div id="profdiv">
                      
          <?php  foreach($Memberprofessional as $key=>$value){ ?>  
                       <section>
                                    <div class="row">
                                        <div class="col col-6">
                                             <input type="hidden" name="prfoexp" id="prfoexp" value="<?php echo $value->hasexp;?>">
                                             <label class="checkbox"><input type="checkbox" name="Memberprofessional[hasexp]" onclick="showhide();" <?php if($value->hasexp == 0){ ?> checked <?php } ?> ><i></i>I do not have any prior work experience</label>
                                        </div>
                                        <div class="col col-6">
                                           
                                        </div>
                                    </div>
                                </section>
                       <fieldset id="profup<?php echo $value->id;?>">   
                            <input type="hidden" name="profcount" id="profcount" value="1">
                            
                            <?php if($value->hasexp <> 0) {?>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Designation</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="Memberprofessional[designation][]" placeholder="Designation" class="invalid" required value="<?php echo $value->designation;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                        </label>
                                    </div>
                                </div>
                            </section>    
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Organization</label>
                                    <div class="col col-8">
                                        <label class="input">
                                            <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="Memberprofessional[organization][]" placeholder="Organization" class="invalid" required value="<?php echo $value->organization;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the name</b>
                                        </label>
                                    </div>
                                </div>
                            </section>
                            <section>
                                <div class="row">
                                    <label class="label col col-4">Time Period</label>
                                    <div class="col col-8">
                                        <div class="col-md-3" style="padding-left: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[fromyear][]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=2015;$i>=1970;$i--){?>
                                                            <option  value="<?php echo $i;?>" <?php if($i==$value->fromyear) { ?> selected <?php } ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                            
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-2" style="padding-right: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[frommonth][]" class="invalid" required>
                                                    <option selected value="">MM</option>
                                                    <?php for($i=1;$i<=12;$i++){?>
                                                            <option  value="<?php echo $i;?>" <?php if($i==$value->frommonth) { ?> selected <?php } ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                             
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <label class="label col col-2" style="font-weight:bold;">To</label>
                                        <div class="col-md-3" style="padding-left: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[toyear][]" class="invalid" required>
                                                    <option selected value="">YYYY</option>
                                                    <?php for($i=2020;$i>=1970;$i--){?>
                                                            <option  value="<?php echo $i;?>" <?php if($i==$value->toyear) { ?> selected <?php } ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                            
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                        <div class="col-md-2" style="padding-right: 0px;">
                                            <label class="select state-error">
                                                <select name="Memberprofessional[tomonth][]" class="invalid" required>
                                                    <option selected value="">MM</option>
                                                    <?php for($i=1;$i<=12;$i++){?>
                                                            <option  value="<?php echo $i;?>" <?php if($i==$value->tomonth) { ?> selected <?php } ?>><?php echo $i;?></option>
                                                    <?php } ?>
                                                             
                                                </select>
                                                <i></i>
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </section> 
                            <footer><div class="col-md-6"></div><div class="col-md-6"><button type="button" class="btn-u btn-u-red pull-left" onclick="deleteup(<?php echo $value->id;?>)">Delete</button></div>
                                    </footer>
                            <?php } ?>
                        </fieldset>                              
            
            <?php } ?>
           
                            </div>
                        <footer>                            
                            <button type="button" class="btn-u btn-u-dark pull-right" onclick="addmore()">Add +</button>
                        </footer>
                        <footer>
                            <input type="hidden" name="professionId" value="<?php echo $user_id;?>"> 
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
    function showhide(){
       
        var x = parseInt(document.getElementById("prfoexp").value);  
       
        if(x==1){
             document.getElementById('prof').style.display = "none";
             document.getElementById("prfoexp").value=0;
        }else{
            document.getElementById('prof').style.display = "";
            document.getElementById("prfoexp").value=1;
        }
    }
    function addmore(){
        var x = parseInt(document.getElementById("profcount").value);        
        var prof='<fieldset id="prof'+x+'">\n\
<section><div class="row"><label class="label col col-4">Designation</label><div class="col col-8"><label class="input"><i class="icon-append fa fa-user"></i><input type="text" name="Memberprofessional[designation][]" placeholder="Designation" class="invalid" required><b class="tooltip tooltip-bottom-right">Needed to enter the name</b></label></div></div></section>\n\
<section><div class="row"><label class="label col col-4">Organization</label><div class="col col-8"><label class="input"><i class="icon-append fa fa-user"></i><input type="text" name="Memberprofessional[organization][]" placeholder="Organization" class="invalid" required><b class="tooltip tooltip-bottom-right">Needed to enter the name</b></label></div></div></section>\n\
<section><div class="row"><label class="label col col-4">Time Period</label><div class="col col-8"><div class="col-md-3" style="padding-left: 0px;"><label class="select state-error"><select name="Memberprofessional[fromyear][]" class="invalid" required><option selected value="">YYYY</option><?php for($i=2015;$i>=1970;$i--){?><option  value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?></select><i></i></label></div><div class="col-md-2" style="padding-right: 0px;"><label class="select state-error"><select name="Memberprofessional[frommonth][]" class="invalid" required><option selected value="">MM</option><?php for($i=1;$i<=12;$i++){?><option  value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?></select><i></i></label></div><label class="label col col-2" style="font-weight:bold;">To</label><div class="col-md-3" style="padding-left: 0px;"><label class="select state-error"><select name="Memberprofessional[toyear][]" class="invalid" required><option selected value="">YYYY</option><?php for($i=2015;$i>=1970;$i--){?><option  value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?></select><i></i></label></div><div class="col-md-2" style="padding-right: 0px;"><label class="select state-error"><select name="Memberprofessional[tomonth][]" class="invalid" required><option selected value="">MM</option><?php for($i=1;$i<=12;$i++){?><option  value="<?php echo $i;?>"><?php echo $i;?></option><?php } ?></select><i></i></label></div></div></div></section>\n\
<footer><div class="col-md-6"></div><div class="col-md-6"><button type="button" class="btn-u btn-u-red pull-left" onclick="deletemore('+x+')">Delete</button></div></footer></fieldset>';       
        x+=parseInt(1);       
        document.getElementById("profcount").value=x;
//        var div = document.getElementById('edudiv');
//        div.innerHTML = div.innerHTML +edu;
        $("#profdiv").append(prof);
        
    }
    function deletemore(id){
        document.getElementById('prof'+id).innerHTML = "";
        document.getElementById('prof'+id).style.display = "none";
    }
    function deleteup(id){
        document.getElementById('profup'+id).innerHTML = "";
        document.getElementById('profup'+id).style.display = "none";
    }
</script>
</div><!--/End Wrapepr-->