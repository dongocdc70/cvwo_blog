<?php
require_once('authenticate.php');
unset($_SESSION['username']);
session_destroy();
echo "<script type='text/javascript'>
				alert('You have successfully logged out!');
				document.location='login.php';
			</script>";

?>
