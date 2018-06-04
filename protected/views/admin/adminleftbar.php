

    <!--=== Profile ===-->
                    <ul class="list-group sidebar-nav-v1 margin-bottom-40" id="sidebar-nav-1">
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="index") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/index';?>" style="text-decoration:none;"><i class="fa fa-bar-chart-o"></i> Dashboard</a>
                    </li>
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="user") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/usersList';?>" style="text-decoration:none;"><i class="fa fa-user"></i> Users</a>
                    </li> 
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="jobpostings") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/jobPostingsList';?>" style="text-decoration:none;"><i class="fa fa-user"></i> Job Postings</a>
                    </li> 
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="categories") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/categories';?>" style="text-decoration:none;"><i class="fa fa-user"></i> Categories</a>
                    </li> 
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="subcategories") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/Subcategory/index';?>" style="text-decoration:none;"><i class="fa fa-user"></i> Sub Categories</a>
                    </li> 
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="skillmain") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/Skillmain/index';?>" style="text-decoration:none;"><i class="fa fa-user"></i>  Main Skills</a>
                    </li> 
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="skillsub") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/Skillsub/index';?>" style="text-decoration:none;"><i class="fa fa-user"></i> Sub Skills</a>
                    </li> 
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="designation") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/Designation/index';?>" style="text-decoration:none;"><i class="fa fa-user"></i> Designations</a>
                    </li> 
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="company") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/Company/index';?>" style="text-decoration:none;"><i class="fa fa-user"></i> Companies</a>
                    </li> 
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="degree") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/Degree/index';?>" style="text-decoration:none;"><i class="fa fa-user"></i> Degree</a>
                    </li>
                     <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="country") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/Country/index';?>" style="text-decoration:none;"><i class="fa fa-user"></i> Countries</a>
                    </li> 
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="state") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/State/index';?>" style="text-decoration:none;"><i class="fa fa-user"></i> States</a>
                    </li> 
                    <li class="list-group-item <?php if(Yii::app()->user->getState("adminmenu")=="city") { ?>active <?php } ?>">
                        <a href="<?php echo Yii::app()->request->baseUrl.'/City/index';?>" style="text-decoration:none;"><i class="fa fa-user"></i> Cities</a>
                    </li> 
                    
                </ul>                
