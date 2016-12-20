<!-- include_once 'paging.php'; -->
<!-- $paginate = new paginate($DB_con); -->

<?php
class paginate {
	private $db;

	function __construct($DB_con) {
		$this->db = $DB_con;
	}

	public function dataview($query) {
		$statement = $this->db->prepare($query);
		$statement->execute();

		if($statement->rowCount() > 0) {
			while($row=$statement->fetch(PDO::FETCH_ASSOC)) {
				echo '<div class="post-preview">';
						// IMPT *********************
				    echo '<a href="view.php?post_id='.$row['POST_ID'].'">';
				    // IMPT *********************
				        echo '<h2 class="post-title">';
				            echo $row['TITLE'];
				        echo '</h2>';
				        echo '<h3 class="post-subtitle">';
				        		if(strlen($row['CONTENT']) < 300) {
				        			echo $row['CONTENT'];
				        		}
				        		else {
				        			echo substr($row['CONTENT'], 0, 300).'...';
				        		}
				        echo '</h3>';
				    echo '</a>';

				    $sqlcomment = $this->db->prepare('SELECT COUNT(*)
				    																 FROM data.comments JOIN data.users
				    																 ON data.comments.`USER_ID` = data.users.`USER_ID`
				    																 WHERE `POST_ID` = ?');
				    $sqlcomment->execute(array($row['POST_ID']));
						$comment = $sqlcomment->fetch()[0];

						$comment_text = null;

				    if($comment == 1) {
				    	$comment_text = $comment.' comment';
				    }
				    elseif($comment > 1) {
				    	$comment_text = $comment.' comments';
				    }
				    else {
				    	$comment_text = 'No comment yet';
				    }


				    // IMPT *********************
				    echo '<p class="post-meta">'.$comment_text.' | Posted by <a href="#">'.$row['USERNAME'].'</a> on '.date("F d, Y", strtotime($row['DATE_POSTED'])).'</p>';
				    // IMPT *********************

				echo '</div>';

				if($row['USERNAME'] == $_SESSION['username']) {
					echo '<a class="btn btn-danger delete" href="delete.php?post_id='.$row['POST_ID'].'">Delete</a>';
				}
				echo '<hr>';




			}
		}
		else {
			echo 'Nothing here yet...';
		}
	}

	public function paging($query, $records_per_page) {
		$starting_position=0;
    if(isset($_GET["page"]))
    {
         $starting_position=($_GET["page"]-1)*$records_per_page;
    }
    $query2=$query." limit $starting_position,$records_per_page";
    return $query2;
	}

	public function paginglink($query,$records_per_page) {
    $self = $_SERVER['PHP_SELF'];

    $statement = $this->db->prepare($query);
    $statement->execute(array($_SESSION['user_id']));

    $total_no_of_records = $statement->rowCount();

    if($total_no_of_records > 0) {
    		$total_no_of_pages = ceil($total_no_of_records/$records_per_page);
        $current_page = 1;
        if(isset($_GET["page"])) {
           $current_page = $_GET["page"];
        }
    		?>
				<nav aria-label="Page navigation" class="text-center">
				  <ul class="pagination">
				  	<?php
				  	if($current_page != 1) {
				  	  $previous = $current_page - 1;
				  	  echo '<li class="page-item">';
				  	}
				  	else {
				  		$previous = 1;
				  		echo '<li class="page-item disabled">';
				  	}
				  	?>

				      <a class="page-link" href='<?php echo $self."?page=".$previous; ?>' aria-label="Previous">
				        <span aria-hidden="true">&laquo;</span>
				        <span class="sr-only">Previous</span>
				      </a>
				    </li>
				    <?php
            for($i=1; $i<=$total_no_of_pages; $i++) {
            	if($i==$current_page) {
                echo '<li class="page-item active"><a class="page-link" href="'.$self."?page=".$i.'">'.$i.'</a></li>';
            	}
    	        else {
    	          echo '<li class="page-item"><a class="page-link" href="'.$self."?page=".$i.'">'.$i.'</a></li>';
    	        }
       			}
				    ?>

				    <?php
				  	if($current_page != $total_no_of_pages) {
				  	  $next = $current_page + 1;
				  	  echo '<li class="page-item">';
				  	}
				  	else {
				  		$next = $total_no_of_pages;
				  		echo '<li class="page-item disabled">';
				  	}
				  	?>
				      <a class="page-link" href='<?php echo $self."?page=".$next; ?>' aria-label="Next">
				        <span aria-hidden="true">&raquo;</span>
				        <span class="sr-only">Next</span>
				      </a>
				    </li>
				  </ul>
				</nav>
    		<?php



  	}
	}
}

?>
