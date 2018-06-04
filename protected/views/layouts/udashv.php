<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
   <?php if(!isset($_SESSION['bmtitle'])){
    $_SESSION['bmtitle']='Big Matrimony- Made for Matches | Best Matrimony Services | free indian matrimonial';
    } 
    if(!isset($_SESSION['description'])){
    $_SESSION['description']='Big Matrimony - Made for Matches. Find your life partner today. Register and enjoy free matrimonial services. Self Horoscope generation and view social and professional profiles of other members';
    } 
    if(!isset($_SESSION['keywords'])){
    $_SESSION['keywords']='Best Matrimony Services,free indian matrimonial,Matchmaking online free';
    }
    ?>
    <title><?php echo $_SESSION['bmtitle'];?></title>

    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php echo $_SESSION['description'];?>">
    <meta name="keywords" content="<?php echo $_SESSION['keywords'];?>">
    <meta name="author" content="">

    <!-- Favicon -->
     <link href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>css/tooltip.css" rel="stylesheet"/>
    <link rel="shortcut icon" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>img/logo1.png">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/bootstrap/css/datepicker3.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/style.css">

    <!-- CSS Implementing Plugins -->
    <?php
             $u_agent = $_SERVER['HTTP_USER_AGENT'];             
             // Next get the name of the useragent yes seperately and for good reason
             if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) { ?> 
                 <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/firefox.css">
                 <?php } elseif (preg_match('/Firefox/i', $u_agent)) { ?>
                 <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/firefox.css">
            <?php  } elseif (preg_match('/Chrome/i', $u_agent)) { ?>
                 <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/chrome.css">
            <?php  } elseif (preg_match('/Safari/i', $u_agent)) { ?>
                 <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/firefox.css">
             <?php } elseif (preg_match('/Opera/i', $u_agent)) { ?>
                 <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/firefox.css">
            <?php  } elseif (preg_match('/Netscape/i', $u_agent)) { ?>
                 <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/firefox.css">
             <?php }
             ?>
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/sky-forms/version-2.0.1/css/custom-sky-forms-orginal.css">
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/scrollbar/src/perfect-scrollbar.css">
     <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/owl-carousel/owl-carousel/owl.carousel.css">
      <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/owl-carousel/owl-carousel/owl.theme.css">
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/pages/profile.css">

    <!-- CSS Theme -->    
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/theme-colors/default.css">
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/pages/blog.css">
    <!-- CSS Customization -->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/css/custom.css">
    <script>
         (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
         (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
         m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
         })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

         ga('create', 'UA-55626076-1', 'auto');
         ga('send', 'pageview');

    </script>
    <!-- JS Global Compulsory -->           
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/jquery/jquery-migrate.min.js"></script>
    <!--<script type="text/javascript" src="<?php // echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/bootstrap/js/bootstrap.js"></script>--> 
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/bootstrap/js/bootstrap-datepicker.js"></script>
    <!-- JS Implementing Plugins -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/back-to-top.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/counter/waypoints.min.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/counter/jquery.counterup.min.js"></script> 
   

    <!-- Scrollbar -->
    <script src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/scrollbar/src/jquery.mousewheel.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/scrollbar/src/perfect-scrollbar.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/plugins/owl-carousel/owl-carousel/owl.carousel.js"></script>
    <!-- JS Customization -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/js/custom.js"></script>
    <!-- JS Page Level -->           
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/js/plugins/datepicker.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl.'/ecom_assets/';?>assets/js/plugins/owl-carousel.js"></script>
   
    <script type="text/javascript">
        jQuery(document).ready(function() {
            startTime();
            App.init();            
            Datepicker.initDatepicker();
            OwlCarousel.initOwlCarousel();
        });
    </script>
    <script>
        
        function startTime() 
        {
            var today=new Date();
            var h=today.getHours();
            var m=today.getMinutes();
            var s=today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);                             
            document.getElementById('clock').innerHTML = h+":"+m+":"+s;
            var t = setTimeout(function(){startTime()},500);
        }
        function checkTime(i) 
        {
            if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
            return i;
        }

    </script>
</head>	
<body class="">
    <?php $this->renderPartial('//layouts/headerdashv'); ?>
    <?php echo $content;?>