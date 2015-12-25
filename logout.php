<?php
session_start();
    unset($_SESSION["email"]);
	unset($_SESSION["password"]);
    unset($_SESSION["userid"]);
	unset($_SESSION["username"]);
	unset($_SESSION["userType"]);
session_destroy();

header("Location: index.php");
exit;

?>