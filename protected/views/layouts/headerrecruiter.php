<div class="wrapper">
    <!--=== Header ===-->    
    <div class="header header-sticky recheader">
        <!-- Topbar -->
        <div class="topbar">
            <div class="container">
                <!-- Topbar Navigation -->
                
                <!-- End Topbar Navigation -->
            </div>
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
                    <a class="navbar-brand" href="<?php echo Yii::app()->request->baseUrl.'/Recruiter/index';?>">
                        <img id="logo-header" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/img/logo1-default.png" alt="Logo">
                    </a>
                </div>

                
                <div class="collapse navbar-collapse navbar-responsive-collapse">
                    <ul class="nav navbar-nav">
                        <!-- Home -->
                        <li class="active">
                            <a href="<?php echo Yii::app()->request->baseUrl.'/Recruiter/dashboard';?>" style="color:#fff;font-weight: 600;">
                                DashBoard
                            </a>                            
                        </li>
                                             
                        <li class="">
                            <a href="<?php echo Yii::app()->request->baseUrl.'/Recruiter/listjobs';?>" style="color:#fff;font-weight: 600;">
                                My Jobs
                            </a>
                            
                        </li>
                  
                        <li class="">
                            <a href="<?php echo Yii::app()->request->baseUrl.'/Recruiter/createjob';?>" style="color:#fff;font-weight: 600;">
                                Post Jobs
                            </a>
                            
                        </li>
                      
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;font-weight: 600;">
                                Reports
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo Yii::app()->request->baseUrl.'/Recruiter/appliedList'?>">Applied List</a></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl.'/Recruiter/savedList'?>">Saved List</a></li>                                
                            </ul>
                        </li>                   
                        
                       <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;font-weight: 600;">
                                Resume Finder
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo Yii::app()->request->baseUrl.'/Recruiter/resumeFeedSavedSearch'?>">List My Saved Searches</a></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl.'/Recruiter/resumeFinder';?>">Save New Search</a></li>
                                
                            </ul>
                        </li>
                       <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" style="color:#fff;font-weight: 600;">
                                Settings
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="<?php echo Yii::app()->request->baseUrl.'/Recruiter/updateprofile?id='.Yii::app()->user->recId;?>">Update Profile</a></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl.'/site/changePassword'?>">Change Password</a></li>
                                <li><a href="<?php echo Yii::app()->request->baseUrl.'/site/logout'?>">Logout</a></li>
                            </ul>
                        </li>
                        <!-- End Home -->

                        <!-- Pages -->                        
                       
                    </ul>
                </div><!--/navbar-collapse-->
            </div>    
        </div>            
        <!-- End Navbar -->
    </div>
    <!--=== End Header ===-->    

  
</div><!--/End Wrapepr-->