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
		$statement->execute(array($_SESSION['user_id']));

		if($statement->rowCount() > 0) {
			while($row=$statement->fetch(PDO::FETCH_ASSOC)) {
				echo '<tr class="success">';
				echo '<td>'.$row['USERNAME'].'</td>';
				echo '<td>'.$row['CONTENT'].'</td>';
				echo '<td>'.$row['DATE_POSTED'].'</td>';
				echo '<td style="background-color: white; border-color: transparent;">';
				echo '<a class="btn btn-primary" style="margin-right:10px;" href="comment.php?post_id='.$row['POST_ID'].'">Comment</a>';
				if($row['USERNAME'] == $_SESSION['username']) {
					echo '<a class="btn btn-danger delete" href="delete.php?post_id='.$row['POST_ID'].'">Delete</a>';
				}
				echo '</td>';
				echo '</tr>';

				$sqlcomment = $this->db->prepare('SELECT *
																				 FROM data.comments JOIN data.users
																				 ON data.comments.`USER_ID` = data.users.`USER_ID`
																				 WHERE `POST_ID` = ?');
				$sqlcomment->execute(array($row['POST_ID']));

				$rowcomments = $sqlcomment->fetchAll();

				echo '<tr>';
				if(empty($rowcomments)) {
					echo '<td colspan="3"><em>No comments yet.</em></td>';
				}
				else {
					echo '<td colspan="3">';
					echo '<h4>Comments</h4>';
					echo '<ul>';
					foreach($rowcomments as $rowcomment) {
						echo '<li>'.$rowcomment['COMMENT_CONTENT'].' | '.$rowcomment['USERNAME'].' | '.$rowcomment['DATE_COMMENTED'].'</li>';
					}
					echo '</ul>';
					echo '</td>';
				}
				echo '</tr>';
			}
		}
		else {
			echo '<tr><td>Nothing here...</td></tr>';
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
        echo '<tr>';
        echo '<td><strong>Go to page</strong></td>';
        echo '<td colspan="2" style="text-align: center;">';

        $total_no_of_pages=ceil($total_no_of_records/$records_per_page);
        $current_page=1;

        if(isset($_GET["page"])) {
           $current_page=$_GET["page"];
        }

        if($current_page!=1) {
           $previous =$current_page-1;
           echo "<a href='".$self."?page=1'>First</a>&nbsp;&nbsp;";
           echo "<a href='".$self."?page=".$previous."'>Previous</a>&nbsp;&nbsp;";
        }

        for($i=1;$i<=$total_no_of_pages;$i++) {
        	if($i==$current_page) {
            echo "<strong><a href='".$self."?page=".$i."' style='color:red;text-decoration:none'>".$i."</a></strong>&nbsp;&nbsp;";
        	}
	        else {
	          echo "<a href='".$self."?page=".$i."'>".$i."</a>&nbsp;&nbsp;";
	        }
   			}

				if($current_page != $total_no_of_pages) {
				    $next=$current_page+1;
				    echo "<a href='".$self."?page=".$next."'>Next</a>&nbsp;&nbsp;";
				    echo "<a href='".$self."?page=".$total_no_of_pages."'>Last</a>&nbsp;&nbsp;";
				}

   		  echo '</td></tr>';
  	}
	}
}

?>
