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
$nameErr = $usernameErr = $emailErr = $passwordErr = $genderErr = $ageErr = $bloodgroupErr = $weightErr = $heightErr = $bpErr = $houseErr = $roadErr = $streetErr = $cityErr = $areaCodeErr = $contactErr =$disease= $intensity = "";
$name  = $username = $email = $password = $gender = $age = $bloodgroup = $weight = $height = $medication = $bp = $house = $road = $street = $city = $areaCode = $contact = $imageErr = $path = $intensityErr = "";
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
     
   if (empty($_POST["password"])) {
     $passwordErr = "Password is required.";
     $valid = false;
   } else {
     $password = test_input($_POST["password"]);
   }

   if (empty($_POST["gender"])) {
     $genderErr = "Gender is required";
     $valid = false;
   } else {
     $gender = test_input($_POST["gender"]);
   }
   if (empty($_POST["intensity"])) {
     $intensityErr = "Intensity is required";
     $valid = false;
   } else {
     $intensity = test_input($_POST["intensity"]);
   }

  if (empty($_POST["age"])) {
     $ageErr = "Age is required";
     $valid = false;
   } else {
     $age = test_input($_POST["age"]);
   // check if age only contains numbers
     if (!preg_match("/^[1-9][0-9]*$/",$age)) {
       $ageErr = "Only numbers allowed"; 
       $valid = false;
     }
   }

   if (empty($_POST["bloodgroup"])) {
     $bloodgroupErr = "bloodgroup is required";
     $valid = false;
   } else {
     $bloodgroup = test_input($_POST["bloodgroup"]);
   }

   if (empty($_POST["weight"])) {
     $weightErr = "weight is required";
     $valid = false;
   } else {
     $weight = test_input($_POST["weight"]);
   
   // check if age only contains numbers
     if (!preg_match("/^[1-9][0-9]*$/",$weight)) {
       $weightErr = "Only numbers allowed"; 
       $valid = false;
     }
   }
   if (empty($_POST["disease"])) {
     $disease = "";
     $valid = false;
   } else {
     $disease = test_input($_POST["disease"]);
   }

    if (empty($_POST["medication"])) {
     $medication = "";
     $valid = false;
   } else {
     $medication = test_input($_POST["medication"]);
   }

  if (empty($_POST["height"])) {
     $heightErr = "height is required";
     $valid = false;
   } else {
     $height = test_input($_POST["height"]);
   // check if height only contains numbers
     if (!preg_match("/^[\d]+(|\.[\d]+)$/",$height)) {
       $heightErr = "Only numbers allowed"; 
       $valid = false;
     }
   }

   if (empty($_POST["weight"])) {
     $weightErr = "weight is required";
     $valid = false;
   } else {
     $weight = test_input($_POST["weight"]);
   // check if weight only contains numbers
     if (!preg_match("/^[1-9][0-9]*$/",$weight)) {
       $weightErr = "Only numbers allowed"; 
       $valid = false;
     }
   }

   if (empty($_POST["bp"])) {
     $bpErr = "bp is required";
     $valid = false;
   } else {
     $bp = test_input($_POST["bp"]);
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
       $contactErr = "Only numbers allowed"; 
       $valid = false;
    }
  }

   if (empty($_POST["contact"])) {
     $contactErr = "contact is required";
     $valid = false;
   } else {
     $contact = test_input($_POST["contact"]);
   // check if contact only contains numbers
     if (!preg_match("/^[\d]+(|\.[\d]+)$/",$contact)) {
       $contactErr = "Only numbers allowed"; 
       $valid = false;
     }
   }
   //Image Checking
  if ($_FILES["file"]["error"] > 0)
  {
    echo "no file";
  }else
  {
    $valid_exts = array('jpeg', 'jpg', 'png', 'gif');
    $image_upload=true;
  }

   if($valid){
    if($image_upload === true){
            $path = image_retouch();
    }
    //If valid then setup db connection
  $dbservername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "bloodbank";

  $user_id = uniqid();
  $disease_id = uniqid();

  try {
    $conn = new PDO("mysql:host=$dbservername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO user (user_id, user_mail, user_name, user_password)
    VALUES ('$user_id', '$email', '$username', '$password')";
    $conn->exec($sql);
    $sql = "INSERT INTO address (address_id, house_no, road_no, street, city, zip_code)
    VALUES ('$user_id', '$house', '$road', '$street', '$city', '$areaCode')";
    $conn->exec($sql);
    $sql = "INSERT INTO patient (patient_id, patient_name, patient_gender, patient_age, patient_bloodgroup, patient_height, patient_weight, patient_bp, patient_disease, patient_medication, patient_contact_no, patient_img_path, patient_intensity)  
    VALUES ('$user_id', '$name', '$gender', '$age', '$bloodgroup', '$height', '$weight', '$bp', '$disease','$medication', '$contact', '$path', '$intensity')";
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
//Resize And Upload Image
function image_retouch(){
    $height = 300;
    $width = 300;
    /* Get original image x y*/
  list($w, $h) = getimagesize($_FILES['file']['tmp_name']);
    $ratio = max($width/$w, $height/$h);
    $h = ceil($height / $ratio);
    $x = ($w - $width / $ratio) / 2;
    $w = ceil($width / $ratio);
     /* new file name */
    $path = 'propic/'.$_FILES['file']['name'];
    /* read binary data from image file */
    $imgString = file_get_contents($_FILES['file']['tmp_name']);
    /* create image from string */
    $image = imagecreatefromstring($imgString);
    $tmp = imagecreatetruecolor($width, $height);
    imagecopyresampled($tmp, $image,
    0, 0,
    $x, 0,
    $width, $height,
    $w, $h);
    /* Save image */
    switch ($_FILES['file']['type']) {
    case 'image/jpeg':
      imagejpeg($tmp, $path, 100);
      break;
    case 'image/png':
      imagepng($tmp, $path, 0);
      break;
    case 'image/gif':
      imagegif($tmp, $path);
      break;
      default:
      exit;
      break;
    }
    return $path;
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
              <form class="contact-form" id="contactForm" novalidate=""method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
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
                    Gender:
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?>  value="female">Female
   <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?>  value="male">Male
   <span class="error">* <?php echo $genderErr;?>
                  </div>
                </div>
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Age: <input type="text" name="age" value="<?php echo $age;?>">
   <span class="error">* <?php echo $ageErr;?>
                  </div>
                </div>
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Bloodgroup: <input type="text" name="bloodgroup" value="<?php echo $bloodgroup;?>">
   <span class="error">* <?php echo $bloodgroupErr;?>
                  </div>
                </div>
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Height: <input type="text" name="height" value="<?php echo $height;?>">
   <span class="error">* <?php echo $heightErr;?>
                  </div>
                </div>
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Weight: <input type="text" name="weight" value="<?php echo $weight;?>">
   <span class="error">* <?php echo $weightErr;?>
                  </div>
                </div>
<div class="controls controls-row">
                  
                </div>
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Current Diseases
   <input type="textarea" name="disease" value="<?php echo $disease;?>">
                  </div>
                </div>
               <div class="controls controls-row">
                  <div class="control-group span6">
                    Current Medication
   <input type="textarea" name="medication" value="<?php echo $medication;?>">
                  </div>
                </div>
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Blood Pressure: <input type="text" name="bp" value="<?php echo $bp;?>">
   <span class="error">* <?php echo $bpErr;?>
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
                <div class="controls controls-row">
                  <div class="control-group span6">
                    Patient Intensity:
   <input type="radio" name="intensity" <?php if (isset($intensity) && $intensity=="urgent") echo "checked";?>  value="urgent">Urgent
   <input type="radio" name="intensity" <?php if (isset($intensity) && $intensity=="average") echo "checked";?>  value="average">Average
   <input type="radio" name="intensity" <?php if (isset($intensity) && $intensity=="moderate") echo "checked";?>  value="moderate">Moderate
   <span class="error">* <?php echo $intensityErr;?>
                  </div>
                </div>
               <div class="controls controls-row">
                <div class="control-group span12">
                  <label for="file">Upload Your Picture(JPG or GIF):</label><?php echo $imageErr;?>
                  <input type="file" name="file" id="file"><br><br>
                </div>
                </div>
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