<?php 
session_start();
// kill the session
session_destroy();

// redirect
header('Location: login/login.php');
exit();
 ?>