<?php
require 'helpers/authenticate.php';
require_once 'helpers/database.php';
require_once 'helpers/paging.php';

$pdo = Database::connect();
$paginate = new paginate($pdo);
$dbName = Database::$dbName;
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>My Blog</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/clean-blog.css">
	<link rel="stylesheet" href="css/search.css">
	<script src="js/jquery-3.1.1.min.js"></script>
	<script src="js/search.js"></script>
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
			<h1>
				Welcome, <?php echo $_SESSION['username']; ?>!
				<hr>
			</h1>
			<h1 id='page-title'>
				<?php
				if(isset($_GET['user'])) {
					echo 'All posts by '.$_GET['user'];
					echo '<a href="index.php" style="float: right;" class="btn btn-warning">Back to homepage</a>';
				}
				else {
					echo 'All posts';
				}
				?>
			</h1>


		</div>
		<div class="row" style="padding-top: 10px;">

			<div class="col-md-3" style="padding: 0">
				<a href="create.php" class="btn btn-success" style="padding: 15px 20px">Create</a>
				<a href="logout.php" class="btn btn-danger" style="padding: 15px 20px">Logout</a>
			</div>
			<?php if(!isset($_GET['user'])) { ?>
				<div id="custom-search-input" class="col-md-9">
	          <div class="input-group" style="margin-top: 3px;">
	              <input type="text" id="search-box" class="search-query form-control input-lg" placeholder="Search" />
	              <span class="input-group-btn">
	                  <button class="btn btn-danger" type="button">
	                      <span class=" glyphicon glyphicon-search"></span>
	                  </button>
	              </span>
	          </div>
	      </div>
      <?php } ?>
		</div>

		<div class="row">
			<div class="col-md-10 col-md-offset-1" id="result">
				<img class="center-block" id="loading-gif" src="img/loader.gif" alt="loading" style="padding-top: 20px; display: none">
			</div>
		</div>

		<div class="row" id="preload">
			<div class="col-md-10 col-md-offset-1">
					<?php
					$records_per_page = 3;
					if(isset($_GET['user'])) {
						$query = "SELECT *
											FROM $dbName.posts JOIN $dbName.users
											ON $dbName.posts.`USER_ID` = $dbName.users.`USER_ID`
											WHERE $dbName.users.`USERNAME` = ?
											ORDER BY `POST_ID` DESC";
						$newquery = $paginate->paging($query,$records_per_page,$_GET['user']);
						$paginate->dataview($newquery,$_GET['user']);
					}
					else {
						$query = "SELECT *
											FROM $dbName.posts JOIN $dbName.users
											ON $dbName.posts.`USER_ID` = $dbName.users.`USER_ID`
											ORDER BY `POST_ID` DESC";
						$newquery = $paginate->paging($query,$records_per_page);
						$paginate->dataview($newquery);
					}

					// public function paginglink($query,$records_per_page, $param=null, $file=null, $param_file=null)
					// *** $param     : parameter to be put in sql execute
					// *** $file      : e.g. 'search.php'
					// *** $param_file: e.g. 'user=dongocduc'
		  		if(isset($_GET['user'])) {
		      	$paginate->paginglink($query,$records_per_page,$_GET['user'],null,'user='.$_GET['user']);
		      }

		      else {
		      	$paginate->paginglink($query,$records_per_page);
		      }
		  		Database::disconnect();
					?>
      </div>
		</div>
	</div>
</body>
</html>
