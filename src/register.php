<?php
session_start();

require 'helpers/database.php';

if(isset($_SESSION['username'])) {
	header('Location: index.php');
}

else {
	if(!empty($_POST)) {
		$usernameError = null;
		$passwordError = null;

		$username = $_POST['username'];
		$password = $_POST['password'];

		$valid = true;

		if(empty($password)) {
			$passwordError = 'Please enter password';
			$valid = false;
		}

		if(empty($username)) {
			$usernameError = 'Please enter username';
			$valid = false;
		}
		// if username is given
		// if username contains weird characters
		else if(!preg_match('/^[a-zA-Z0-9-_]+$/', $username)) {
			$usernameError = 'Username can contain only alphanumeric characters, dashes or underscores';
			$valid = false;
		}
		// check if username exists already
		else {
			$pdo = Database::connect();
			$dbName = Database::$dbName;

			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			//username is case-insensitive
			$username = strtolower($username);

			$sql = "SELECT * FROM $dbName.users WHERE `USERNAME` = ?";
			$q = $pdo->prepare($sql);
			$q->execute(array($username));
			// check if username exists already
			if(!empty($q->fetch())) {
				$valid = false;
				$usernameError = 'Username already exists';
			}
		}

		if($valid) {
			mkdir('uploads/source/'.$username);
			$password = password_hash($password, PASSWORD_DEFAULT);
			$sql = "INSERT INTO $dbName.users (USERNAME, PASSWORD, DATE_REGISTERED) values(?, ?, NOW())";
			$q = $pdo->prepare($sql);
			$q->execute(array($username, $password));
			Database::disconnect();
			echo '<script type="text/javascript">alert("Account Created!"); window.location.replace("login.php");</script>';
		}
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Create an Account</title>
	<link   href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="container">
		<div class="span10 offset1">
			<div class="row">
				<h3>Create an Account</h3>
			</div>

			<form action="register.php" class="form-horizontal" method="post">
				<div class="form-group <?php echo !empty($usernameError)?'error':''; ?>">
					<label for="username">Username</label>
					<input type="text" class="form-control" name="username" placeholder="Username" value="<?php echo !empty($username)?$username:''; ?>" required>
					<?php if(!empty($usernameError)): ?>
						<span class="help-inline"><?php echo $usernameError ?></span>
					<?php endif; ?>
				</div>

				<div class="form-group <?php echo !empty($passwordError)?'error':''; ?>">
					<label for="password">Password</label>
					<input type="password" class="form-control" name="password" placeholder="Password" value="<?php echo !empty($password)?$password:''; ?>" required>
					<?php if(!empty($passwordError)): ?>
						<span class="help-inline"><?php echo $passwordError ?></span>
					<?php endif; ?>
				</div>

				<div class="form-actions">
					<button type="submit" class="btn btn-success">Create</button>
					<a href="index.php" class="btn">Back</a>
				</div>
			</form>
		</div>
	</div>
</body>
</html>
