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

<!-- Mirrored from bootstrap.oxygenna.com/smartbox/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 30 Jun 2015 13:29:03 GMT -->
<?php
// define variables and set to empty values
$nameErr = $usernameErr = $emailErr = $passwordErr = $inchargeErr = $houseErr = $roadErr = $streetErr = $cityErr = $areaCodeErr = $contactErr = "";
$name = $username = $email = $password = $incharge = $house = $road = $street = $city = $areaCode = $contact = "";
$valid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   if (empty($_POST["name"])) {
     $nameErr = "Name is required";
     $valid = false;
   } else {
     $name = test_input($_POST["name"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
       $nameErr = "Only letters and white space allowed"; 
       $valid = false;
     }
   }
   if (empty($_POST["username"])) {
     $usernameErr = "Username is required";
     $valid = false;
   } else {
     $username = test_input($_POST["username"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/[A-Za-z0-9]+/",$username)) {
       $usernameErr = "Only letters and numbers allowed"; 
       $valid = false;
     }
   }
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
    if (empty($_POST["incharge"])) {
     $inchargeErr = "Incharge name is required";
     $valid = false;
   } else {
     $incharge = test_input($_POST["incharge"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[a-zA-Z ]*$/",$incharge)) {
       $inchargeErr = "Only letters and white space allowed"; 
       $valid = false;
     }
   }
     
   if (empty($_POST["password"])) {
     $passwordErr = "password chara register korte chao, Bolod naki?";
     $valid = false;
   } else {
     $password = test_input($_POST["password"]);
   }
   if (empty($_POST["house"])) {
     $houseErr = "House Number is required";
     $valid = false;
   } else {
     $house = test_input($_POST["house"]);
   }
   if (empty($_POST["road"])) {
     $roadErr = "Road Number is required";
     $valid = false;
   } else {
     $road = test_input($_POST["road"]);
   }
   if (empty($_POST["street"])) {
     $streetErr = "Street is required";
     $valid = false;
   } else {
     $street = test_input($_POST["street"]);
   }
   if (empty($_POST["city"])) {
     $cityErr = "city is required";
     $valid = false;
   } else {
     $city = test_input($_POST["city"]);
   }
   if (empty($_POST["areaCode"])) {
     $areaCodeErr = "Area Code is required";
     $valid = false;
   } else {
     $areaCode = test_input($_POST["areaCode"]);
     // check if areaCode only contains numbers
     if (!preg_match("/^[1-9][0-9]*$/",$areaCode)) {
       $areaCodeErr = "Only numbers allowed"; 
       $valid = false;
    }
  }

   if (empty($_POST["contact"])) {
     $contactErr = "contact is required";
     $valid = false;
   } else {
     $contact = test_input($_POST["contact"]);
   // check if contact only contains numbers
     
   }

   if($valid){
    //If valid then setup db connection
    $dbservername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "bloodbank";

  $user_id = uniqid();
  
  try {
    $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO user (user_id, user_mail, user_name, user_password)
    VALUES ('$user_id', '$email', '$username', '$password')";
    $conn->exec($sql);
    $sql = "INSERT INTO bloodbank (bloodbank_id, bloodbank_name, bloodbank_contact_no, bloodbank_incharge)
    VALUES ('$user_id', '$name', '$contact', '$incharge')";
    $conn->exec($sql);
    $sql = "INSERT INTO address (address_id, house_no, road_no, street, city, zip_code)
    VALUES ('$user_id', '$house', '$road', '$street', '$city', '$areaCode')";
    $conn->exec($sql);
    $sql = "INSERT INTO blood_quantity (bloodbank_id)
    VALUES ('$user_id')";
    $conn->exec($sql);
    }
  catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

  $conn = null;
    header('Location: register.php?success=true');
    exit();
  }
}

function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>

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
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="benefits.php">Donation Benefits</a>
                  
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="donor.php">Donor</a>
                  
                </li>
                <li class="dropdown">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="patient.php">Patient</a>
                  
                </li>
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
                <li class=""><a href="login.php">Login</a></li>
              </ul>
            </div>
          </div>
        </div>
      </nav>
    </header>
    <!-- Main Content -->
    <div id="content" role="main">
      <!-- Promo Section -->
      <!--<section class="section section-alt">
        <div id="map"></div>
      </section>
      <!-- 404 content -->
      <section class="section section-padded">
        <div class="container-fluid">
          <div class="section-header">
            <h1>
              Register
              
            </h1>
          </div>
          <p class="lead text-center">
            Please enter the informations below.
          </p>
          <hr>
         
          <div class="row-fluid">
            <div class="span12">
              <p><span class="error">* required field.</span></p>
              <form class="contact-form" id="contactForm" novalidate=""method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class="controls controls-row">
                  <div class="control-group span6">
                     Name: <input type="text" name="name" value="<?php echo $name;?>">
   <span class="error">* <?php echo $nameErr;?>
                  </div>
                  
                </div>
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Username: <input type="text" name="username" value="<?php echo $name;?>">
   <span class="error">* <?php echo $usernameErr;?>
                  </div>
                </div>
                <div class="controls controls-row">
                  <div class="control-group span6">
                    E-mail: <input type="text" name="email" value="<?php echo $email;?>">
   <span class="error">* <?php echo $emailErr;?>
                  </div>
                </div>
                
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Password: <input type="password" name="password" value="<?php echo $password;?>">
   <span class="error">* <?php echo $passwordErr;?>
                  </div>
                </div>
                
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Incharge: <input type="text" name="incharge" value="<?php echo $incharge;?>">
   <span class="error">* <?php echo $inchargeErr;?>
                  </div>
                </div>
                
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Address : *
   <br><br>
   &nbsp;&nbsp;&nbsp;&nbsp;House No: <input type="text" name="house" value="<?php echo $house;?>">
   <span class="error"> <?php echo $houseErr;?></span>
   <br><br>
   &nbsp;&nbsp;&nbsp;&nbsp;Road No: <input type="text" name="road" value="<?php echo $road;?>">
   <span class="error"> <?php echo $roadErr;?></span>
   <br><br>
   &nbsp;&nbsp;&nbsp;&nbsp;Street: <input type="text" name="street" value="<?php echo $street;?>">
   <span class="error"> <?php echo $streetErr;?></span>
   <br><br>
   &nbsp;&nbsp;&nbsp;&nbsp;City: <input type="text" name="city" value="<?php echo $city;?>">
   <span class="error"> <?php echo $cityErr;?></span>
   <br><br>
   &nbsp;&nbsp;&nbsp;&nbsp;Zip Code: <input type="text" name="areaCode" value="<?php echo $areaCode;?>">
   <span class="error"> <?php echo $areaCodeErr;?>
                  </div>
                </div>
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Contact: <input type="text" name="contact" value="<?php echo $contact;?>">
   <span class="error"> <?php echo $contactErr;?>
                  </div>
                </div>
                
                
                <!--<div class="controls controls-row">
                  <div class="control-group span12">
                    <textarea class="span12" name="message" placeholder="I want to talk about... " rows="5"></textarea>
                  </div>
                </div>-->
                <div class="controls controls-row">
                  <div class="control-group span12">
                    <button class="btn btn-primary" name="submit" type="submit">
                      Submit
                    </button>
                  </div>
                </div>
                
              </form>
              <div id="messages"></div>
            </div>

            
      </section>
      <!-- More Questions -->
      
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