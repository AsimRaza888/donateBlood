<?php
session_start();
  $loggedin=false;
if(isset($_SESSION['userid']))
{
    $loggedin=true;
}
?>
<!DOCTYPE html>
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if (gt IE 8)]><!--> <html lang="en"> <!--<![endif]-->

<!-- Mirrored from bootstrap.oxygenna.com/smartbox/pricing.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Jun 2015 13:27:43 GMT -->
<head>
  <meta charset="utf-8">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <title></title>
  <meta content="Bootsrap based theme" name="description">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="yes" name="apple-mobile-web-app-capable">
  <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <script src="javascripts/PIE.js"></script>
  <![endif]-->
  <link href="favicon.ico" rel="shortcut icon">
  <link href="apple-touch-icon-144x144-precomposed.png" rel="apple-touch-icon-precomposed" sizes="144x144">
  <link href="apple-touch-icon-114x114-precomposed.png" rel="apple-touch-icon-precomposed" sizes="114x114">
  <link href="apple-touch-icon-72x72-precomposed.png" rel="apple-touch-icon-precomposed" sizes="72x72">
  <link href="apple-touch-icon-57x57-precomposed.png" rel="apple-touch-icon-precomposed">
  <link href="stylesheets/bootstrap.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="stylesheets/responsive.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="stylesheets/font-awesome-all.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="stylesheets/fancybox.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="stylesheets/theme.css" media="screen" rel="stylesheet" type="text/css" />
  <link href="stylesheets/fonts.css" media="screen" rel="stylesheet" type="text/css" />
</head>
<body>
  <div class="wrapper">
<!-- Page Header -->
    <header id="masthead">
      <nav class="navbar navbar-static-top">
        <div class="navbar-inner">
          <div class="container-fluid">
            <a class="btn btn-navbar" data-target=".nav-collapse" data-toggle="collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </a>
            <h1 class="brand">
              <a href="#">
                Donate<span class="light">Blood</span></a>

            </h1>
            <div class="nav-collapse collapse">
              <ul class="nav pull-right">
                <li class=""><a href="index.php">Home</a></li>
                <li class=""><a href="benefits.php">Donation Benefits</a></li>
                <li class=""><a href="donor.php">Donor</a></li>
                <li class=""><a href="patient.php">Patient</a></li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#">Blood Bank</a>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="quantity.php">Blood Qunatity</a>
                    </li>
                    <li>
                      <a href="bldbank.php">Blood Bank Information</a>
                    </li>
                    
                  </ul>
                </li>
                <?php 
                  if ($loggedin) {
                    echo '<li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">'. $_SESSION['username']. '</a>
                            <ul class="dropdown-menu">
                              <li>
                                <a href="profile.php">View Profile</a>
                              </li>
                              <li>
                                <a href="profile_edit.php">Edit Profile</a>
                              </li>
                              <li>
                                <a href="logout.php">Logout</a>
                              </li>
                            </ul>
                          </li>';
                    }else{
                      echo '<li class=""><a href="login.php">Login</a></li>';
                    }

                ?>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <!-- Main Content -->
    <div id="content" role="main">
      <!-- What you get -->
      <section class="section section-padded">
        <div class="container-fluid">
          <div class="section-header">
            <h1>
              Why
              <small class="light">Give Blood?</small>
            </h1>
          </div>
          <div class="row-fluid">
            <div class="span3">
              <div class="round-box box-big">
                <span class="box-inner">
                  <img alt="some image" class="img-circle" src="images/assets/landscapes/landscape-3-300x300.jpg">
                  
                </span>
              </div>
            </div>
            <div class="span9">
              <h2>Red cells, plasma and platelets</h2>
              <p class="lead">
                Red cells are used predominantly in treatments for cancer and blood diseases, as well as for treating anaemia and in surgeries for transplants and burns. Plasma provides proteins, nutrients and a clotting agent that is vital to stop bleeding - it is the most versatile component of your blood. Platelets are tiny cells used to help patients at a high risk of bleeding. They also contribute to the repair of damaged body tissue.
              </p>
            </div>
          </div>
          <hr>
          <div class="row-fluid">
            <div class="span3">
              <div class="round-box box-big">
                <span class="box-inner">
                  <img alt="some image" class="img-circle" src="images/assets/landscapes/landscape-1-300x300.jpg">
                 
                </span>
              </div>
            </div>
            <div class="span9">
              <h2>Short shelf-life</h2>
              <p class="lead">
                Maintaining a regular supply of blood to all the people who need it is not easy. Blood components have a short shelf life and predicting demand can be difficult. By giving blood, every donor is contributing to a nation-wide challenge to provide life-saving products whenever and wherever they are needed.
                <strong>Red cells - up to 35 days. Plasma - up to one year. Platelets - up to seven days</strong>
              </p>
            </div>
          </div>
          <hr>
          <div class="row-fluid">
            <div class="span3">
              <div class="round-box box-big">
                <span class="box-inner">
                  <img alt="some image" class="img-circle" src="images/assets/landscapes/landscape-2-e-300x300.jpg">
                  
                </span>
              </div>
            </div>
            <div class="span9">
              <h2>Balancing blood types</h2>
              <p class="lead">
                We sometimes need to target specific blood types to increase stock levels. This is particularly true of O Rh negative blood, which is rare but essential because it is the only blood type that can be given to anyone, regardless of their blood type. Donors with the blood group B Rh negative are more often found in black and south Asian minority ethnic communities. Because only 2 per cent of the population have this blood group, we often appeal for more B- donors.
              </p>
            </div>
          </div>
        </div>
      </section>
      
      
  <script src="javascripts/jquery.min.js" type="text/javascript"></script>
  <script src="javascripts/bootstrap.js" type="text/javascript"></script>
  <script src="javascripts/jquery.flexslider-min.js" type="text/javascript"></script>
  <script src="javascripts/jquery.tweet.js" type="text/javascript"></script>
  <script src="javascripts/jquery.fancybox.pack.js" type="text/javascript"></script>
  <script src="javascripts/jquery.fancybox-media.js" type="text/javascript"></script>
  <script src="javascripts/script.js" type="text/javascript"></script>
  <script src="javascripts/switcher.js" type="text/javascript"></script>
<script type="text/javascript">
if (typeof gaJsHost == 'undefined') {
  var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
  document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
}
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-209441-49");
pageTracker._trackPageview();
} catch(err) {}</script>
</body>
