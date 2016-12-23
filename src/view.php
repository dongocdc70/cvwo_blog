<?php
require 'helpers/database.php';
require 'helpers/authenticate.php';
require 'helpers/time_elapsed.php';

// must provide param after view.php
if (!empty($_GET['post_id'])) {
	$post_id = $_REQUEST['post_id'];
	$pdo = Database::connect();
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	//check if post_id exists
	$sql = "SELECT *
					FROM data.posts JOIN data.users
					ON data.posts.`USER_ID` = data.users.`USER_ID`
					WHERE `POST_ID` = ? LIMIT 1";
	$q = $pdo->prepare($sql);
	$q->execute(array($post_id));
	$res = $q->fetch();
	if(!empty($res)) {
		$sqlcomment = $pdo->prepare('SELECT *
																 FROM data.comments JOIN data.users
																 ON data.comments.`USER_ID` = data.users.`USER_ID`
																 WHERE `POST_ID` = ?
																 ORDER BY data.comments.`COMMENT_ID` DESC');
		$sqlcomment->execute(array($post_id));
		$rowcomments = $sqlcomment->fetchAll();


	}

	else {
		header("Location: index.php");
		Database::Disconnect();
	}


}

// if no param after view.php
else {
	header("Location: index.php");
	Database::Disconnect();
}


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/clean-blog.css" rel="stylesheet">
	<link href="css/view.css" rel="stylesheet">
	<link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
	<script src="js/jquery-3.1.1.min.js"></script>
	<title><?php echo $res['TITLE']; ?></title>
</head>
<body>
	<!-- Page Header -->
	<!-- Set your background image for this header on the line below. -->
	<header class="intro-header" style="background-image: url('img/post-bg.jpg')">
	    <div class="container">
	        <div class="row">
	        		<div class="col-xs-4 col-sm-2">
	        			<div class="post-heading" style="padding: 100px 0">

	        				<a href="index.php"><img class="img-responsive" src="img/back.png" style="cursor: pointer; cursor: hand;" alt="back button"></a>
	        			</div>
	        		</div>
	            <div class="col-xs-8 col-sm-8">
	                <div class="post-heading" style="padding: 100px 0">
	                		<?php
	                		echo '<h1>'.$res['TITLE'].'</h1>';
	                		echo '<span class="meta">Posted by <a href="#">'.$res['USERNAME'].'</a> on '.date("F d, Y", strtotime($res['DATE_POSTED'])).'</span>';
	                		?>
	                </div>
	            </div>
	        </div>
	    </div>
	</header>

	<!-- Post Content -->
	<article>
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
	                <p><?php echo $res['CONTENT'] ?></p>
	            </div>
	        </div>
	    </div>
	</article>

	<hr>

	<div class="container">
	  <div class="row">
	    <div class="col-md-12">
	      <div class="panel panel-info">
	        <div class="panel-heading">
	          Comments
	        </div>
	        <div class="panel-body comments">
	          <form method='post' action="" onsubmit="return post();">
	          	<textarea id="cmt" class="form-control" placeholder="Write your comment" rows="5" required></textarea>
	          	<br>
	          	<input type="submit" value="Submit Comment">
	          </form>

	          <div class="clearfix"></div>
	          <hr>
	          <ul class="media-list" id="all-comments">
	            <?php if(empty($rowcomments)) {

	            	echo '<li class="media" id="no-comment">';
	            	  echo '<div class="comment">';
	            	    echo '<div class="media-body">';
	            	      echo '<p>';
	            	        echo 'No comments yet.';
	            	      echo '</p>';
	            	    echo '</div>';
	            	    echo '<div class="clearfix"></div>';
	            	  echo '</div>';
	            	echo '</li>';
	            }

	            else {
	            	foreach($rowcomments as $rowcomment) {
	            		echo '<li class="media">';
	            		  echo '<div class="comment">';
	            		    echo '<div class="media-body">';
	            		      echo '<strong class="text-success">'.$rowcomment['USERNAME'].'&nbsp;</strong>';
	            		      echo '<span class="text-muted">';
	            		      echo '<small class="text-muted">'.time_elapsed_string($rowcomment['DATE_COMMENTED']).'</small>';
	            		      echo '</span>';
	            		      echo '<p>';
	            		        echo $rowcomment['COMMENT_CONTENT'];
	            		      echo '</p>';
	            		    echo '</div>';
	            		    echo '<div class="clearfix"></div>';
	            		  echo '</div>';
	            		echo '</li>';
	            	}
	            }
	            ?>


	          </ul>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
</body>
<script type="text/javascript">
var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function post()
{
  var cmt = document.getElementById("cmt").value;
  if(cmt)
  {
    $.ajax
    ({
      type: 'post',
      url: 'comment.php',
      data:
      {
      	post_id: getUrlParameter('post_id'),
      	comment: cmt
      },
      success: function (response)
      {
      console.log('success!');
	    document.getElementById("all-comments").innerHTML=response+document.getElementById("all-comments").innerHTML;
	    document.getElementById("cmt").value="";
	    if($('#no-comment')) {
	    	$('#no-comment').remove();
	    }

      },
      error: function (xhr, ajaxOptions, thrownError) {
      	document.getElementById("cmt").value="";
        alert('Comment got problem!');
      }
    });
  }

  return false;
}
</script>
</html>
