<?php
require_once 'helpers/authenticate.php';
require_once 'helpers/database.php';
require_once 'helpers/paging.php';
require_once 'lib/htmlpurifier/purify_everything.php';

//Function to check if the request is an AJAX request
function is_ajax() {
  return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}


function display_row() {
	if(empty($_GET['q'])) {
		echo 'No result.';
	}
	else {
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$paginate = new paginate($pdo);
		$records_per_page = 3;

		$q = removeHTML($_GET['q']);

		$old_q = $q;

		$q = trim($old_q).'*';

		$query = 'SELECT *
							FROM data.posts JOIN data.users
							ON data.posts.`USER_ID` = data.users.`USER_ID`
							WHERE MATCH(`TITLE`, `CONTENT`) AGAINST (? IN BOOLEAN MODE)';

		$newquery = $paginate->paging($query,$records_per_page,$q);
		$paginate->dataview($newquery,$q);

		// public function paginglink($query,$records_per_page, $param=null, $file=null, $param_file=null)
		// *** $param     : parameter to be put in sql execute
		// *** $file      : e.g. 'search.php'
		// *** $param_file: e.g. 'user=dongocduc'
	  $paginate->paginglink($query,$records_per_page,$q,'search.php','q='.$old_q);

		Database::disconnect();
	}
}


if (is_ajax())
{
    display_row();
}
else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Search results</title>
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
				Search results
				<a href="index.php" style="float: right;" class="btn btn-warning">Back to homepage</a>
			</h1>
		</div>
		<div class="row" style="padding-top: 10px;">

			<div class="col-md-3" style="padding: 0">
				<a href="create.php" class="btn btn-success" style="padding: 15px 20px">Create</a>
				<a href="logout.php" class="btn btn-danger" style="padding: 15px 20px">Logout</a>
			</div>
			<div id="custom-search-input" class="col-md-9">
          <div class="input-group" style="margin-top: 3px;">
              <input type="text" id="search-box" value="<?php echo removeHTML($_GET['q']); ?>" class="search-query form-control input-lg" placeholder="Search" />
              <span class="input-group-btn">
                  <button class="btn btn-danger" type="button">
                      <span class=" glyphicon glyphicon-search"></span>
                  </button>
              </span>
          </div>
      </div>
		</div>

		<div class="row">
			<div class="col-md-10 col-md-offset-1" id="result">

				<?php
				display_row();
				?>
			</div>
		</div>
	</div>
</body>
</html>

<?php
}
?>








