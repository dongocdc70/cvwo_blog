<?php
require 'helpers/authenticate.php';
require_once 'helpers/database.php';
include_once 'helpers/paging.php';

$pdo = Database::connect();
$paginate = new paginate($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Blog</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/clean-blog.css">
	<script src="js/jquery-3.1.1.min.js"></script>
	<script language="javascript" type="text/javascript">
	$(document).ready(function(){
	    $("a.delete").click(function(e){
	        if(!confirm('Are you sure?')){
	            e.preventDefault();
	            return false;
	        }
	        return true;
	    });
	});
	</script>

</head>
<body>
	<div class="container">
		<div class="row">
			<h1>Welcome, <?php echo $_SESSION['username'] ?></h1>
		</div>
		<div class="row">
			<p>
				<a href="create.php" class="btn btn-success">Create</a>
				<a href="logout.php" class="btn btn-danger">Log out</a>
			</p>
		</div>

		<div class="row">
			<div class="col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1">
					<?php
					$query = 'SELECT *
										FROM data.posts JOIN data.users
										ON data.posts.`USER_ID` = data.users.`USER_ID`
										ORDER BY `POST_ID`';
					$records_per_page = 3;
					$newquery = $paginate->paging($query,$records_per_page);
					$paginate->dataview($newquery);
					?>
      </div>
		</div>
		<?php
    $paginate->paginglink($query,$records_per_page);
		Database::disconnect();
		?>

	</div>
</body>
</html>



