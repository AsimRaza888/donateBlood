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
              <small class="light">Profile of </small><?php echo $_SESSION['username'] ?>
              
            </h1>
          </div>
          <div class="row-fluid">
            <div class="span3">
              <div class="round-box box-big">
                <span class="box-inner">
                  <img alt="some image" class="img-circle" src="images/assets/landscapes/landscape-3-300x300.jpg">
                  <i class="icon-heart"></i>
                </span>
              </div>
            </div>
            <div class="span9">
              <p class="lead">
              <form class="contact-form" id="contactForm" novalidate="" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                 <?php
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "bloodbank";
        $conn = new mysqli($serverName, $userName, $password, $dbName);
        if($conn->connect_error){
            die("Connection failed: " . $conn->connect_error);
        }

        $userid = $_SESSION['userid'];

        if($_SESSION['userType']=="donor" ){
        $dinfo = "SELECT * FROM donor,address,user,user_disease_list where  donor.donor_id= '$userid' and address.address_id= '$userid'and user.user_id= '$userid'";
        $dresult = $conn->query($dinfo);
        
        if ($dresult->num_rows > 0) {
            $row = $dresult->fetch_assoc();
                echo "<strong>Name</strong> " .$row["donor_name"]
                ."<br></br>";
                echo "<strong>Age</strong> ".$row["donor_age"].
                "<br></br>";
                echo "<strong>Gender</strong> ".$row["donor_gender"]
                ."<br></br>";
                echo "<strong>Blood Group</strong> ".$row["donor_bloodgroup"].
                "<br></br>";
                echo "<strong>Height</strong> " .$row["donor_height"]
                ."<br></br>";
                echo "<strong>Weight</strong> ".$row["donor_weight"].
                "<br></br>";
                echo "<strong>Blood Pressure</strong> " .$row["donor_bp"]
                ."<br></br>";
                echo "<strong>Contact</strong> ".$row["donor_contact"].
                "<br></br>";
                echo "<strong>Address</strong> "." House No: ".  $row["house_no"]. " Road No: ".  $row["road_no"]. " Street: ".  $row["street"]. " City: ".  $row["city"].
                "<br></br>";

}
   else {
    echo "0 results";
}
}
else if($_SESSION['userType']=="patient" ){
        $pinfo = "SELECT * FROM patient,address,user,user_disease_list where  patient.patient_id= '$userid' and address.address_id= '$userid'and user.user_id= '$userid'";
        $presult = $conn->query($pinfo);
        
if ($presult->num_rows > 0) {
     $row2 = $presult->fetch_assoc();
                echo "<strong>Name</strong> " .$row2["patient_name"]
                ."<br></br>";
                echo "<strong>Age</strong> ".$row2["patient_age"].
                "<br></br>";
                echo "<strong>Gender</strong> ".$row2["patient_gender"]
                ."<br></br>";
                echo "<strong>Blood Group</strong> ".$row2["patient_bloodgroup"].
                "<br></br>";
                echo "<strong>Height</strong> " .$row2["patient_height"]
                ."<br></br>";
                echo "<strong>Weight</strong> ".$row2["patient_weight"].
                "<br></br>";
                echo "<strong>Blood Pressure</strong> " .$row2["patient_bp"]
                ."<br></br>";
                echo "<strong>Contact</strong> ".$row2["patient_contact_no"].
                "<br></br>";
                echo "<strong>Address</strong> "." House No: ".  $row2["house_no"]. " Road No: ".  $row2["road_no"]. " Street: ".  $row2["street"]. " City: ".  $row2["city"].
                "<br></br>";


} else {
    echo "0 results";
}
}
else if($_SESSION['userType'] == "bloodbank" ){
        $binfo = "SELECT * FROM bloodbank, address, user where  bloodbank.bloodbank_id = '$userid' and address.address_id= '$userid'and user.user_id= '$userid'";
       
        $bresult = $conn->query($binfo);
        
if ($bresult->num_rows > 0) {
     $row3 = $bresult->fetch_assoc();
                echo "<strong>Blood Bank Name</strong>      <input type = \"text\" value=  ".$row3["bloodbank_name"]." \"<br></br>";
                echo "<strong>Blood Contact No</strong>      <input type = \"text\" value=  ".$row3["bloodbank_contact_no"]." \"<br></br>";
                echo "<strong>Blood Incharge</strong>      <input type = \"text\" value=  ".$row3["bloodbank_incharge"]." \"<br></br>";
                echo "<br></br><strong>Blood Bank Address</strong><br></br>";
                echo "<strong>House No</strong>      <input type = \"text\" value=  ".$row3["house_no"]." \"<br></br>";
                echo "<strong>Road No</strong>      <input type = \"text\" value=  ".$row3["road_no"]." \"<br></br>";
                echo "<strong>Street No</strong>      <input type = \"text\" value=  ".$row3["street"]." \"<br></br>";
                echo "<strong>City</strong>      <input type = \"text\" value=  ".$row3["city"]." \"<br></br>";
                echo "<strong>Zip Code</strong>      <input type = \"text\" value=  ".$row3["zip_code"]." \"<br></br>";

} else {
    echo "0 results";
}
}
$conn->close();
        ?>
                <br></br>
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
