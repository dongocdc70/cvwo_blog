<?php
require 'helpers/authenticate.php';
unset($_SESSION['username']);
unset($_SESSION['user_id']);
session_destroy();
echo "<script type='text/javascript'>
				document.location='login.php';
			</script>";

?>
