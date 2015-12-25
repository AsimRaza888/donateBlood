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
                <li class=""><a href="donor.php">donor</a></li>
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
              <img alt="some image" src="images/assets/landscapes/patient.jpg">
              <figcaption class="flex-caption">
                <h1 class="super animated fadeinup delayed">
                  Patient List
                </h1>
              </figcaption>
            </figure>
          </div>
        </div>
      </section>
      <section class="section section-padded">
        <div class="container-fluid">
          <div class="row-fluid">
            <div class="span10">
              <section class="section section-padded">
        <div class="container-fluid">

          <div class="row-fluid">
            <div class="span12">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th><th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Age</th>
                    <th>Blood Group</th>
                    <th>Area</th>
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
        
        //Check if search is activated
        if (isset($_POST['areaSearch'])) {
          $area = $_POST["area"];
          $dinfo = "SELECT * FROM patient,address where address.address_id = patient.patient_id and street = '$area'";
          $dresult = $conn->query($dinfo);
        if ($dresult->num_rows > 0) {
    
        while($row = $dresult->fetch_assoc()) {
        echo "<tr>";
        if($row["patient_img_path"]===""){
             echo "<td>
                    <div class=\"round-box box-small\">
                      <a class=\"box-inner\" href=\"#\">
                        <img alt=\"some image\" class=\"img-circle\" src=\"propic/default.jpg\">
                      </a>
                    <td>";
        }else{

              echo "<td>
                    <div class=\"round-box box-small\">
                      <a class=\"box-inner\" href=\"#\">
                        <img alt=\"some image\" class=\"img-circle\" src=" . $row["patient_img_path"] .">
                      </a>
                    <td>";
        }
        echo "<td> " .  $row["patient_name"]. "</td>";
        echo "<td> " .  $row["patient_gender"]. "</td>";
        echo "<td> " .  $row["patient_age"]. "</td>";
        echo "<td> " .  $row["patient_bloodgroup"]. "</td>";
        echo "<td> " .  $row["street"]. "</td>";
        echo "<td> " .  $row["patient_contact_no"]. "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td></td><td>0 results</td></tr>";
}

        }
        elseif (isset($_POST['bloodgroupSearch'])) {
          $bloodgroup = $_POST["bloodgroup"];
          $dinfo = "SELECT * FROM patient,address where address.address_id = patient.patient_id and patient_bloodgroup = '$bloodgroup'";
        $dresult = $conn->query($dinfo);
        if ($dresult->num_rows > 0) {
            // output data of each row
    
        while($row = $dresult->fetch_assoc()) {
        
        //echo "id: " . $row["patient_id"]. " - Name: " . $row["patient_name"]. "- Gender: " . $row["patient_gender"]. "- Age: " . $row["patient_age"]. "- BloodGroup: " . $row["patient_bloodgroup"]. "- Height: " . $row["patient_height"]. "- Weight: " . $row["patient_weight"]. "- BP: " . $row["patient_bp"]. "- Eligibility: " . $row["patient_eligibility"]. "- Medication: " . $row["patient_medication"]. "<br>";
        
        if($row["patient_img_path"]===""){
          echo "<tr>";
             echo "<td>
                    <div class=\"round-box box-small\">
                      <a class=\"box-inner\" href=\"#\">
                        <img alt=\"some image\" class=\"img-circle\" src=\"propic/default.jpg\">
                      </a>
                    <td>";
        }else{
              echo "<tr>";
              echo "<td>
                    <div class=\"round-box box-small\">
                      <a class=\"box-inner\" href=\"#\">
                        <img alt=\"some image\" class=\"img-circle\" src=" . $row["patient_img_path"] .">
                      </a>
                    <td>";
        }
        echo "<td> " .  $row["patient_name"]. "</td>";
        echo "<td> " .  $row["patient_gender"]. "</td>";
        echo "<td> " .  $row["patient_age"]. "</td>";
        echo "<td> " .  $row["patient_bloodgroup"]. "</td>";
        echo "<td> " .  $row["street"]. "</td>";
        echo "<td> " .  $row["patient_contact_no"]. "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td></td><td>0 results</td></tr>";
}
        }
        else{
        
        $dinfo = "SELECT * FROM patient,address where address.address_id = patient.patient_id";
        $dresult = $conn->query($dinfo);
        if ($dresult->num_rows > 0) {
            // output data of each row
    
        while($row = $dresult->fetch_assoc()) {
        
        //echo "id: " . $row["patient_id"]. " - Name: " . $row["patient_name"]. "- Gender: " . $row["patient_gender"]. "- Age: " . $row["patient_age"]. "- BloodGroup: " . $row["patient_bloodgroup"]. "- Height: " . $row["patient_height"]. "- Weight: " . $row["patient_weight"]. "- BP: " . $row["patient_bp"]. "- Eligibility: " . $row["patient_eligibility"]. "- Medication: " . $row["patient_medication"]. "<br>";
        echo "<tr>";
        if($row["patient_img_path"]===""){
             echo "<td>
                    <div class=\"round-box box-small\">
                      <a class=\"box-inner\" href=\"#\">
                        <img alt=\"some image\" class=\"img-circle\" src=\"propic/default.jpg\">
                      </a>
                    <td>";
        }else{

              echo "<td>
                    <div class=\"round-box box-small\">
                      <a class=\"box-inner\" href=\"#\">
                        <img alt=\"some image\" class=\"img-circle\" src=" . $row["patient_img_path"] .">
                      </a>
                    <td>";
        }
        echo "<td> " .  $row["patient_name"]. "</td>";
        echo "<td> " .  $row["patient_gender"]. "</td>";
        echo "<td> " .  $row["patient_age"]. "</td>";
        echo "<td> " .  $row["patient_bloodgroup"]. "</td>";
        echo "<td> " .  $row["street"]. "</td>";
        echo "<td> " .  $row["patient_contact_no"]. "</td>";
        echo "</tr>";
    }
      } else {
          echo "<tr><td></td><td>0 results</td></tr>";
      }
}
?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
            </div>
            <aside class="span2 sidebar">
              <div class="sidebar-widget widget_search">
                <form name="area" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                  <div class="input-append row-fluid">
                  <h4 class="sidebar-header">Search By Area</h4>
                    <input class="span12" name="area" placeholder="search" type="text">
                    <button type="submit" name="areaSearch" class="btn btn-medium btn-primary">
                      <small>Go</small>
                    </button>
                  </div>
                </form>
                <br></br>
                <form name="bloodgroup" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                  <div class="input-append row-fluid">
                  <h4 class="sidebar-header">Search By BloodGroup</h4>
                    <input class="span12" name="bloodgroup" placeholder="search" type="text">
                    <button align="left" type="submit" name="bloodgroupSearch" class="btn btn-medium btn-primary">
                      <small>Go</small>
                    </button>
                  </div>
                </form>
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
