<?php
session_start();
  $loggedin=false;
if(isset($_SESSION['userid']))
{
    $loggedin=true;
}else{
  header('Location: login.php?login=false');
}
?>

<!DOCTYPE html>
<!--[if IE 8 ]> <html lang="en" class="ie8"> <![endif]-->
<!--[if (gt IE 8)]><!--> <html lang="en"> <!--<![endif]-->

<!-- Mirrored from bootstrap.oxygenna.com/smartbox/tables.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Jun 2015 13:27:59 GMT -->
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
          <div class="super-hero-unit">
            <figure>
              <img alt="some image" src="images/assets/landscapes/landscape-2-1250x300.jpg">
              
            </figure>
          </div>
        </div>
      </section>
      <section class="section section-alt section-padded">
        <div class="container-fluid">
          <div class="section-header">
          </div>
          <div class="row-fluid">
            <div class="span12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
<!--                    <th>Gender</th>-->
                    <th>In charge</th>
<!--                    <th>Blood Group</th>-->
                    <th>Address</th>
                    <th>Contact Number</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                                           <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "bloodbank";
        $conn = new mysqli($serverName, $userName, $password, $dbName);
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }
        
        $dinfo = "SELECT * FROM bloodbank,address where address.address_id = bloodbank.bloodbank_id";
$dresult = $conn->query($dinfo);
$count = 1;
if ($dresult->num_rows > 0) {
    // output data of each row
    
    while($row = $dresult->fetch_assoc()) {
        
        //echo "id: " . $row["patient_id"]. " - Name: " . $row["patient_name"]. "- Gender: " . $row["patient_gender"]. "- Age: " . $row["patient_age"]. "- BloodGroup: " . $row["patient_bloodgroup"]. "- Height: " . $row["patient_height"]. "- Weight: " . $row["patient_weight"]. "- BP: " . $row["patient_bp"]. "- Eligibility: " . $row["patient_eligibility"]. "- Medication: " . $row["patient_medication"]. "<br>";
        echo "<tr>";
        echo "<td> " .$count. "</td>";
        echo "<td> " .  $row["bloodbank_name"]. "</td>";
        echo "<td> " .  $row["bloodbank_incharge"]. "</td>";
//        echo "<td> " .  $row["bloodbank_bloodgroup"]. "</td>";
        echo "<td> " . " House No: ".  $row["house_no"]. " Road No: ".  $row["road_no"]. " Street: ".  $row["street"]. " City: ".  $row["city"]. "</td>";
        echo "<td> " .  $row["bloodbank_contact_no"]. "</td>";
        echo "</tr>";
        $count++;
    }
} else {
    echo "0 results";
}
$conn->close();
        ?>
                </tbody>
              </table>
            </div>
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
