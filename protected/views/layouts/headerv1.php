<div class="wrapper">
    <!--=== Header ===-->    
    <div class="header header-sticky" style="background: #333">
        <!-- Topbar -->
        <div class="topbar">
            
        </div>
        <!-- End Topbar -->
    
        <!-- Navbar -->
        <div class="navbar navbar-default mega-menu" role="navigation">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl.'/Member/jobFeed';?>">
                        <img id="logo-header" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/logo1-default.png" alt="Logo">
                    </a>
                </div>
                <?php
                $Categories = Category::model()->findAllByAttributes(
                array(                   
                    'display_on_top' => 1
                ),
                array(
                    'order' => 'name asc',                                 
                )); 
                ?>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav col-md-8" style="float: left !important;padding-right: 0px;">  
                        <?php if(isset($Categories) && !empty($Categories)) {
                                foreach($Categories as $key=>$category) {?>
                        <li class="dropdown dropdown1" >
                            <a href="javascript:void(0);" data-toggle="dropdown" class="dropdown-toggle menudynamic" style="font-size: 13px;font-weight: 600;color:#fff;">
                                <?php echo $category->name;?>
                            </a>
                            <ul class="dropdown-menu">
                                        <?php
                                        $subcat = Subcategory::model()->getSubcategoryByCat($category->id,15);
                                        if (isset($subcat) && !empty($subcat)) {
                                            foreach ($subcat as $key1 => $value) {
                                                ?>                    
                                                <li><a href="<?php echo Yii::app()->request->baseUrl . '/searchbysubcat-'.User::model()->seoFriendlyUrl($value->name).'-' . $value->id.'.htm'; ?>"><?php echo $value->name; ?></a></li>                    
                                            <?php }
                                        } ?>  
                                                <?php if(isset(Yii::app()->user->isMember)) {?>
                                       <li><a href="<?php echo Yii::app()->request->baseUrl.'/site/displayActiveList'?>">more</a></li> 
                                       <?php } else{ ?>
                                        <li><a href="<?php echo Yii::app()->request->baseUrl.'/site/index'?>">more</a></li> 
                                      <?php } ?>
                            </ul>
                        </li>
                        
                     <?php } }?>
                        
                        
                        <!-- End Search Block -->
                    </ul>
                    <ul class="nav navbar-nav col-md-0" style="float: left !important;padding-right: 0px;">  
                        <li>
                            <i class="search fa search-btn fa-search"></i>
                            <form action="<?php echo Yii::app()->request->baseUrl.'/site/searchJob';?>" method="post">
                            <div class="search-open" style="display: none;">
                                <div class="input-group animated fadeInDown">
                                    <input type="text" placeholder="Search" name="keyword"  class="form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn-u">Go</button>
                                    </span>
                                </div>
                            </div>    
                           </form>
                        </li>
                        
                    
                        
                        
                        <!-- End Search Block -->
                    </ul>
                    <ul class="nav navbar-nav col-md-2" style="float: right !important;">  
                         <?php if(isset(Yii::app()->user->isMember)){ ?>
                        <li class="dropdown mega-menu-fullwidth pull-right dropdown1">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="javascript:void(0);" style="font-size: 13px;font-weight: 600;color:#fff;">
                                <?php if(isset(Yii::app()->user->isMember) && isset(Yii::app()->user->memberName)){ echo Yii::app()->user->memberName;} else{}?>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="mega-menu-content">
                                        <div class="container">
                                            <div class="row equal-height">
                                                <div class="col-md-2 equal-height-in">
                                                    <ul class="list-unstyled equal-height-list"> 
                                                        <?php if(isset(Yii::app()->user->isMember)){ ?>
                                                        <li><a href="<?php echo Yii::app()->request->baseUrl.'/Member/create1?id='.Yii::app()->user->memberId;?>">Submit Resume</a></li>
                                                        <?php } ?>
                                                        <li><a href="<?php echo Yii::app()->request->baseUrl.'/Member/jobFeed'?>">My Jobfeed</a></li>
                                                        <li><a href="<?php echo Yii::app()->request->baseUrl.'/site/displayActiveList'?>">Personalize</a></li>  
                                                        <li><a href="<?php echo Yii::app()->request->baseUrl.'/site/emailSettings'?>">Settings</a></li>  
                                                        
                                                    </ul>
                                                </div>
                                                <div class="col-md-2 equal-height-in">
                                                    <ul class="list-unstyled equal-height-list">                                                    
                                                        <!-- 2 Columns -->
                                                          <?php if(isset(Yii::app()->user->isMember)){ ?>
                                                        <li><a href="<?php echo Yii::app()->request->baseUrl.'/site/memberAppliedJobs'?>">Applied Jobs</a></li>
                                                        <li><a href="<?php echo Yii::app()->request->baseUrl.'/site/memberSavedJobs'?>">Saved Jobs</a></li>
                                                        <?php } ?>
                                                        <li><a href="<?php echo Yii::app()->request->baseUrl.'/site/changePassword'?>">Change Password</a></li>
                                                        <li><a href="<?php echo Yii::app()->request->baseUrl.'/site/logout'?>">Logout</a></li>                                                       
                                                        <!-- End 3 Columns -->
                                                    </ul>                                
                                                </div>
                                               
                                            </div>
                                        </div>    
                                    </div>    
                                </li>
                                <?php } ?>
                            </ul>
                        </li>
                        <!-- End Search Block -->
                    </ul>
                </div><!--/navbar-collapse-->
            </div>    
        </div>            
        <!-- End Navbar -->
    </div>
    <!--=== End Header ===-->    

  
</div><!--/End Wrapepr-->