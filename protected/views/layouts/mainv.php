<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Job Portal</title>

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
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/image-hover/css/img-hover.css">

    <!-- CSS Page Style -->    
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/css/pages/page_job.css">

    <!-- CSS Theme -->    
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/css/theme-colors/default.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/css/custom.css">

    <!-- JS Global Compulsory -->           
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/jquery/jquery-migrate.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <!-- JS Implementing Plugins -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/jquery.parallax.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/image-hover/js/modernizr.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/image-hover/js/touch.js"></script>
    <!-- JS Customization -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/custom.js"></script>
    <!-- JS Page Level -->           
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/app.js"></script>
    <script type="text/javascript">
    jQuery(document).ready(function() {
        App.init();
        App.initParallaxBg();      
    });
</script>
<!--[if lt IE 9]>
    <script src="assets/plugins/respond.js"></script>
    <script src="assets/plugins/html5shiv.js"></script>
    <script src="assets/js/plugins/placeholder-IE-fixes.js"></script>
<![endif]-->

</head> 	
<body class="header-fixed">     
    <?php $this->renderPartial('//layouts/headerv'); ?>
    <?php echo $content;?>
    