<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Job Portal- Admin Panel</title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/css/style.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/scrollbar/src/perfect-scrollbar.css">

    <!-- CSS Page Style -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/css/pages/profile.css">
     <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/css/pages/page_log_reg_v1.css">    
    <!-- CSS Theme -->    
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/css/theme-colors/default.css">

    
    
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/sky-forms/version-2.0.1/css/demo.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/sky-forms/version-2.0.1/css/font-awesome.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/sky-forms/version-2.0.1/css/sky-forms.css">
    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/css/custom.css">

    <!-- JS Global Compulsory -->           
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
<!-- JS Implementing Plugins -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/back-to-top.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/counter/waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/counter/jquery.counterup.min.js"></script> 
<!-- Datepicker Form -->
<script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/sky-forms/version-2.0.1/js/jquery-ui.min.js"></script>
<!-- Scrollbar -->
<script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/scrollbar/src/jquery.mousewheel.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/scrollbar/src/perfect-scrollbar.js"></script>
<!-- JS Customization -->
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/custom.js"></script>
<!-- JS Page Level -->           
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/app.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/plugins/datepicker.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initCounter();
        Datepicker.initDatepicker();      
    });
</script>
<script>
    jQuery(document).ready(function ($) {
        "use strict";
        $('.contentHolder').perfectScrollbar();
    });
</script>
<!--[if lt IE 9]>
    <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/respond.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/html5shiv.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</head> 	
<body>     
    <?php $this->renderPartial('//layouts/adminheader'); ?>
    <?php echo $content;?>
    