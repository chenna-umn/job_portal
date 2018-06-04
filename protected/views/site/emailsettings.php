<div class="container content" style="padding-top: 0px;">
    <div class="row">
        <!-- Begin Sidebar Menu -->
        <div class="col-md-4">

        </div>
        <div class="col-md-4"> 

        </div>
        <div class="col-md-4">

        </div>
    </div>
    <div class="row">
        <!-- Begin Sidebar Menu -->
        <div class="col-md-1">

        </div>
        <!-- End Sidebar Menu -->

        <!-- Begin Content -->
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    
                </div>
                <div class="col-md-2">

                </div>
            </div>
            <div class="row margin-bottom-40">
                <div class="col-md-3">                       
                </div>
                <!-- Login-Form -->
                <div class="col-md-6">
                    <form class="sky-form" id="sky-form1" action="<?php echo Yii::app()->request->baseUrl . '/site/emailSettings'; ?>" novalidate="novalidate" method="post">
                         <header>Email notification settings</header>
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
                        <fieldset>        
                            
                            <section>
                            <label class="checkbox"><input type="checkbox" name="Emailsettings[daily_news_jobs]" <?php if(isset($model->daily_news_jobs) && $model->daily_news_jobs == 1){?> checked <?php } ?>><i></i>Daily New Jobs</label>
                        </section>
                            <section>
                            <label class="checkbox"><input type="checkbox" name="Emailsettings[applied_jobs]" <?php if(isset($model->applied_jobs) && $model->applied_jobs == 1){?> checked <?php } ?>><i></i>Applied Jobs</label>
                        </section>
                            <section>
                            <label class="checkbox"><input type="checkbox" name="Emailsettings[recruiter_action]" <?php if(isset($model->recruiter_action) && $model->recruiter_action == 1){?> checked <?php } ?>><i></i>Recruiter Action</label>
                        </section>
                            <section>
                            <label class="checkbox"><input type="checkbox" name="Emailsettings[promotional]" <?php if(isset($model->promotional) && $model->promotional == 1){?> checked <?php } ?>><i></i>Promotional</label>
                        </section>
                            <section>
                            <label class="checkbox"><input type="checkbox" name="Emailsettings[follow_up]" <?php if(isset($model->follow_up) && $model->follow_up == 1){?> checked <?php } ?>><i></i>Follow-up</label>
                        </section>
                             <header style="padding-left: 0px;">Privacy Settings</header>
                            <section>
                            <label class="checkbox"><input type="checkbox" name="Emailsettings[hide_profile]" <?php if(isset($model->hide_profile) &&  $model->hide_profile == 1){?> checked <?php } ?>><i></i> Hide Profile (Only visible against positions you explicitly apply for)</label>
                        </section>                           

                        </fieldset>
                        <footer>
                            <button class="btn-u" type="submit">Submit</button>                                
                        </footer>
                    </form> 
                </div>
                <div class="col-md-3">                       
                </div>
                <!-- End Login-Form -->
            </div><!--/end row-->                
        </div>
        <div class="col-md-1">

        </div>
        <!-- End Content -->
    </div>          
</div><!--/container--> 

</div><!--/End Wrapepr-->
