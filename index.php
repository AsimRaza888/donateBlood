<?php
session_start();
  $loggedin=false;
if(isset($_SESSION['userid']))
{
    $loggedin=true;
}

//DB Connection        
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "bloodbank";
        $conn = new mysqli($serverName, $userName, $password, $dbName);
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        $query = "SELECT COUNT(*) as numberOfDonor FROM donor;";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $numberOfDonor =  $row["numberOfDonor"];

        $query = "SELECT COUNT(*) as numberOfPatient FROM patient;";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $numberOfPatient =  $row["numberOfPatient"];

        $query = "SELECT COUNT(*) as numberOfBloodbank FROM bloodbank;";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $numberOfBloodbank =  $row["numberOfBloodbank"];

        $query = "SELECT total FROM blood_quantity;";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $numberOfBloodbag=$row["total"];
        while($row = $result->fetch_assoc()) {
        $numberOfBloodbag+=$row["total"];
          }
        }

        $query = "SELECT COUNT(DISTINCT city) as numberOfArea FROM address;";
        $result = $conn->query($query);
        $row = $result->fetch_assoc();
        $numberOfArea =  $row["numberOfArea"];

?>
<!DOCTYPE html>
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if (gt IE 8)]><!--> <html lang="en"> <!--<![endif]-->

<!-- Mirrored from bootstrap.oxygenna.com/smartbox/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Jun 2015 13:23:59 GMT -->
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
      <!-- Promo Section -->
      <section class="section section-alt">
        <div class="row-fluid">
          <div class="flexslider" data-flex-animation="slide" data-flex-controlsalign="center" data-flex-controlsposition="inside" data-flex-directions="hide" data-flex-speed="7000" id="intro">
            <ul class="slides">
              <li>
                <div class="super-hero-unit">
                  <figure>
                    <img alt="some image" src="images/assets/landscapes/landscape-3-1250x420.jpg">
                  </figure>
                </div>
              </li>
              <li>
                <div class="super-hero-unit">
                  <figure>
                    <img alt="some image" src="images/assets/landscapes/landscape-2-1250x420.png">
                    <figcaption class="flex-caption">
                    
                  </figure>
                </div>
              </li>
              <li>
                <div class="super-hero-unit">
                  <figure>
                    <img alt="some image" src="images/assets/landscapes/landscape-1-1250x420.png">
                    
                  </figure>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </section>
      <!-- Our Services -->
      <section class="section section-padded">
        <div class="container-fluid">
          <div class="row-fluid">
            <div class="section-header">
              <h1>
                What
                <small class="light">happens to donated blood?</small>
              </h1>
            </div>
            <ul class="unstyled row-fluid">
              <li class="span3">
                <div class="round-box round-medium">
                  <span class="box-inner">
                    <img alt="some image" class="img-circle" src="images/assets/landscapes/processing.jpg">
                    
                  </span>
                </div>
                <h3 class="text-center">
                  Processing
                </h3>
                <p>
                  Donated blood is scanned into a computer database.Most blood is spun in centrifuges to separate the transfusable components – red cells, platelets, and plasma.
                </p>
                
              </li>
              <li class="span3">
                <div class="round-box round-medium">
                  <span class="box-inner">
                    <img alt="some image" class="img-circle" src="images/assets/landscapes/testing.jpg">
                    
                  </span>
                </div>
                <h3 class="text-center">Testing</h3>
                <p>
                  A dozen tests are performed on each unit of donated blood – to establish the blood type and test for infectious diseases.Test results are transferred electronically to the manufacturing facility within 24 hours.
                </p>
                
              </li>
              <li class="span3">
                <div class="round-box round-medium">
                  <span class="box-inner">
                    <img alt="some image" class="img-circle" src="images/assets/landscapes/storage.jpg">
                    
                  </span>
                </div>
                <h3 class="text-center">Storage</h3>
                <p>
                  When test results are received, units suitable for transfusion are labeled and stored.Red Cells are stored in refrigerators at 6ºC for up to 42 days.
                </p>
                
              </li>
              <li class="span3">
                <div class="round-box round-medium">
                  <span class="box-inner">
                    <img alt="some image" class="img-circle" src="images/assets/landscapes/distribution.jpg">
                    
                  </span>
                </div>
                <h3 class="text-center">Distribution</h3>
                <p>
                  Blood is available to be shipped to hospitals 24 hours a day, 7 days a week.
                </p>
                
              </li>
            </ul>
          </div>
        </div>
      </section>
      <!-- Our work -->
      <section class="section section-alt section-padded">
        <div class="container-fluid">
          <div class="section-header">
            <h1>
              Who
              <small class="light">can donate?</small>
            </h1>
          </div>
          <div class="row-fluid">
            <div class="span6">
              <div class="flexslider margin-bottom" data-flex-directions="hide" data-flex-speed="10000" id="work">
                <ul class="slides">
                  <li>
                    <img alt="some image" src="images/assets/devices/giveblood.png">
                  </li>
                  <li>
                    <img alt="some image" src="images/assets/devices/donorpic.jpg">
                  </li>
                  <li>
                    <img alt="some image" src="images/assets/devices/hero.jpg">
                  </li>
                </ul>
              </div>
            </div>
            <div class="span6">
              <ul class="icons">
                <li>
                  <h4>
                    
                      <i class="icon-heart"></i>
                      Age
                    
                  </h4>
                  <p>
                    You must be at least 17 years old to donate to the general blood supply.There is no upper age limit for blood donation as long as you are well with no restrictions or limitations to your activities.
                  </p>
                </li>
                <li>
                  <h4>
                    
                      <i class="icon-heart"></i>
                      Weight/Height
                    
                  </h4>
                  <p>
                    You must weigh at least 110 lbs to be eligible for blood donation. Donors 18 years of age or younger must also meet additional height and weight requirements for whole blood donation (applies to girls shorter than 5'6" and boys shorter than 5').
                  </p>
                </li>
                <li>
                  <h4>
                    
                      <i class="icon-heart"></i>
                     Donation Intervals
                    
                  </h4>
                  <p>
                    Wait at least 8 weeks between whole blood (standard) donations.
Wait at least 7 days between platelet (pheresis) donations.
Wait at least 16 weeks between double red cell (automated) donations.
                  </p>
                </li>
                <li>
                  <h4>
                    
                      <i class="icon-heart"></i>
                     Medications
                    
                  </h4>
                  <p>
                    A donor with an acute infection should not donate. The reason for antibiotic use must be evaluated to determine if the donor has a bacterial infection that could be transmissible by blood.
                  </p>
                </li>
                <li>
                  <h4>
                    
                      <i class="icon-heart"></i>
                      Blood Pressure
                    
                  </h4>
                  <p>
                    High Blood Pressure - Acceptable as long as your blood pressure is below 180 systolic and below 100 diastolic at the time of donation. 

Low Blood Pressure - Acceptable as long as you feel well when you come to donate, and your blood pressure is at least 80/50 (systolic/diastolic).

                  </p>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </section>
      
      <!-- Our Clients -->
      <section class="section section-alt section-padded">
        <div class="container-fluid">
          <div class="section-header">
            <h1>
              
              <small class="light"></small>
            </h1>
          </div>
          <div class="flexslider fadein-links" data-flex-animation="slide" data-flex-controls="hide" data-flex-directions-position="outside" data-flex-directions-type="fancy" data-flex-itemwidth="250" data-flex-slideshow="false" id="client">
            <ul class="slides">
              <li>
               <a href="#">
                  <h3 align ="center" style="color:red;"><?php echo $numberOfDonor?></h3><h3 align ="center" >registered <br> Donors</h3>
                </a>
              </li>
              <li>
                <a href="#">
                  <h3 align ="center" style="color:red;"><?php echo $numberOfPatient?></h3><h3 align ="center" >registered <br> Patients</h3>
                </a>
              </li>
              <li>
                <a href="#">
                  <h3 align ="center" style="color:red;"><?php echo $numberOfBloodbank?></h3><h3 align ="center" >registered <br> Bloodbanks</h3>
                </a>
              </li>
              <li>
                <a href="#">
                  <h3 align ="center" style="color:red;"><?php echo $numberOfBloodbag?></h3><h3 align ="center" >Bloodbags <br> Available</h3>
                </a>
              </li>
              <li>
                <a href="#">
                  <h3 align ="center" style="color:red;"><?php echo $numberOfArea?></h3><h3 align ="center" >Areas <br> Listed</h3>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </section>
    </div>
  </div>
 
  
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
