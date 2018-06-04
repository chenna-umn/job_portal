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
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms.css">
        <!-- CSS Page Style -->    
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/css/pages/page_job.css">
      <!-- CSS Page Style -->    
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/css/pages/page_search_inner.css">
        
    <!--[if lt IE 9]>
        <link rel="stylesheet" href="assets/plugins/sky-forms/version-2.0.1/css/sky-forms-ie8.css">
    <![endif]-->
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

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
    <!-- Login Form -->
    <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/sky-forms/version-2.0.1/js/jquery.form.min.js"></script>
    <!-- Validation Form -->
    <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/sky-forms/version-2.0.1/js/jquery.validate.min.js"></script>
    <!-- JS Customization -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/custom.js"></script>
    <!-- JS Page Level -->           
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/forms/reg.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/forms/login.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/forms/contact.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/forms/comment.js"></script>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            App.init();
            RegForm.initRegForm();
            LoginForm.initLoginForm();
            ContactForm.initContactForm();
            CommentForm.initCommentForm();      
        });
    </script>
    <!--[if lt IE 9]>
        <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/respond.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/html5shiv.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/plugins/placeholder-IE-fixes.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/sky-forms/version-2.0.1/js/sky-forms-ie8.js"></script>
    <![endif]-->

    <!--[if lt IE 10]>
        <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/sky-forms/version-2.0.1/js/jquery.placeholder.min.js"></script>
    <![endif]-->        

    <!--[if lt IE 9]>
        <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/respond.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/plugins/html5shiv.js"></script>
        <script src="<?php echo Yii::app()->request->baseUrl.'/jp_assets/';?>assets/js/plugins/placeholder-IE-fixes.js"></script>
    <![endif]-->

</head> 	
<body class="header-fixed">     
      <?php $this->renderPartial('//layouts/headerv1'); ?>
    <?php echo $content;?>
    