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
  <?php
    
    $email=$password=$userType=$userid=$username="";
    $emailErr=$passwordErr=$userTypeErr=$userNotFoundErr="";
    $valid = true;
    
    if (empty($_POST["email"])) {
     $emailErr = "Email is required";
     $valid = false;
   } else {
     $email = test_input($_POST["email"]);
     // check if e-mail address is well-formed
     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $emailErr = "Invalid email format";
       $valid = false; 
     }
   }
     
   if (empty($_POST["password"])) {
     $passwordErr = "password is required";
     $valid = false;
   } else {
     $password = test_input($_POST["password"]);
   }
    if (empty($_POST["userType"])) {
     $userTypeErr = "User Type is Required";
     $valid = false;
    } else {
     $userType = test_input($_POST["userType"]);
    }
    //Cheking if user exists in DB
    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "bloodbank";

    // Create connection
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
    if ($userType=="donor"){
      $sql = "SELECT * FROM user WHERE user_mail = '$email'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              if($row["user_password"] == $password){
               $userid = $row["user_id"];
               $username = $row["user_name"];
             }
             else{
                $userNotFoundErr = "Password doesn't match!";
                $valid = false;
             }
          }
    } else {
        $userNotFoundErr = "No User with that Credential is available!";
        $valid = false;
    }
  }
      elseif ($userType=="patient") {
      $sql = "SELECT * FROM user WHERE user_mail = '$email'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              if($row["user_password"] == $password){
               $userid = $row["user_id"];
               $username = $row["user_name"];
             }
             else{
                $userNotFoundErr = "Password doesn't match!";
                $valid = false;
             }
          }
    } else {
        $userNotFoundErr = "No User with that Credential is available!";
        $valid = false;
    }
  }
elseif ($userType=="bloodbank") {
      $sql = "SELECT * FROM user WHERE user_mail = '$email'";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              if($row["user_password"] == $password){
               $userid = $row["user_id"];
               $username = $row["user_name"];
             }
             else{
                $userNotFoundErr = "Password doesn't match ma nigga!";
                $valid = false;
             }
          }
    } else {
        $userNotFoundErr = "No User with that Credential is available!";
        $valid = false;
    }
    } else {
       
    }
if($valid){
   $_SESSION["email"] = $email;
   $_SESSION["password"] = $password;
   $_SESSION["userid"] = $userid;
   $_SESSION["username"] = $username;
   $_SESSION["userType"] = $userType;
   header('Location: index.php'); 
}

    function test_input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
  }
  ?>
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
        <div id="map"></div>
      </section>
      <!-- 404 content -->
      <section class="section section-padded">
        <div class="container-fluid">
          <div class="section-header">
            <h1>
              Login
              <?php echo "<small>".$userNotFoundErr."</small>"  ?>
              <?php 
        if (isset($_GET['login'])) {
   echo "<div class=\"alert alert-warning\">
   <button class=\"close\" data-dismiss=\"alert\" type=\"button\">×</button>
   <strong>You need to be logged in to view this page!</strong> Please Login to continue.
   </div>";
        }
       
       ?>
            </h1>
          </div>
          <hr>
          <div class="row-fluid">
            <div class="span6">
              <form class="contact-form" id="contactForm" novalidate=""method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="controls controls-row">
                  <div class="control-group span8">
                    <input type="text" name="email" value="<?php echo $email;?>" placeholder="Email Address">
                    <span class="error"><?php echo $emailErr;?>
                  </div>
                </div>
                <div class="controls controls-row">
                  <div class="control-group span6">
                    <input type="password" name="password" value="<?php echo $password;?>" placeholder="Password">
                    <span class="error"><?php echo $passwordErr;?>
                  </div>
                </div>
                <div class="controls controls-row">
                  <div class="control-group span12">
                    
                  </div>
                </div>
              <button class="btn btn-primary" name="submit" type="submit">
                      Login
            </button>
              <div id="messages"></div>
            </div>
            <div class="span6 contact-details">
              <ul class="icons">
                <li>
                  <h4>
                    <i class="icon-user"></i>
                    Login As
                  </h4>
                  <br> <span class="error"><?php echo $userTypeErr . "<br>";?>
                  <input type="radio" name="userType" <?php if (isset($userType) && $userType=="donor") echo "checked";?>  value="donor"> Donor
                  <br>
                  <br>
                  <input type="radio" name="userType" <?php if (isset($userType) && $userType=="patient") echo "checked";?>  value="patient"> Patient
                  <br>
                  <br>
                  <input type="radio" name="userType" <?php if (isset($userType) && $userType=="bloodbank") echo "checked";?>  value="bloodbank"> Blood Bank
                  <br>
                  <br>
                </li>
              </ul>
            </div>
            </form>
          </div>
        </div>
      </section>
      <!-- More Questions -->
      <section class="section section-alt section-padded">
        <div class="container-fluid">
          <div class="section-header">
            <h1>
              Or
            </h1>
          </div>
          <p class="lead text-center">
            Register An Account
          </p>
          <div class="text-center">
            <a href="register.php"><div class="btn btn-large btn-primary">
              Register
            </div>
            </a>
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
