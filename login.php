<?php

$username = null;
$password = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require_once('database.php');

    if(!empty($_POST["username"]) && !empty($_POST["password"])) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $username = $_POST["username"];
        $password = $_POST["password"];

		$sql = "SELECT `USER_ID` FROM data.users WHERE `USERNAME` = ? and `PASSWORD` = PASSWORD(?)";

		$query = $pdo->prepare($sql);
		$query->execute(array($username,$password));
		$userid = ($query->fetch(PDO::FETCH_ASSOC))['USER_ID'];



        if(!empty($userid)) {
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $userid;
            $session_key = session_id();
            $sql = "INSERT INTO data.sessions (`USER_ID`, `SESSION_KEY`, `SESSION_ADDRESS`, `SESSION_USERAGENT`, `SESSION_EXPIRES`) VALUES (?, ?, ?, ?, DATE_ADD(NOW(), INTERVAL 1 HOUR) )";
            $query = $pdo->prepare($sql);
            $query->execute(array($userid, $session_key, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));
            Database::disconnect();
            header('Location: index.php');
        }
        else {
            Database::disconnect();
            header('Location: login.php?msg=failed');
        }

    } else {
        header('Location: login.php');
    }
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div id="page">
    <!-- [banner] -->
    <header id="banner">
        <hgroup class="text-center">
            <h1>Login</h1>
            <?php if(isset($_GET['msg']) && $_GET['msg'] == 'failed') {
            	echo '<h2 style="color:red;">WRONG USERNAME/PASSWORD</h2>';
            }?>
        </hgroup>
    </header>
    <!-- [content] -->
    <section id="content">
        <div>
        	<div class="row">
        		<div class="col-md-8 col-md-offset-2">
        			<form id="login" method="post">
        			  <div class="form-group">
        			    <label for="username">Username</label>
        			    <input class="form-control" id="username" name="username" placeholder="Username" required>
        			  </div>
        			  <div class="form-group">
        			    <label for="password">Password</label>
        			    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
        			  </div>
        			  <button type="submit" class="btn btn-default">Submit</button>
        			</form>
        		</div>
        	</div>
        </div>
    </section>
    <!-- [/content] -->

</div>
<!-- [/page] -->
</body>
</html>
<?php } ?>
