<?php
    require 'helpers/database.php';
    require 'helpers/authenticate.php';
    $post_id = 0;

    //must provide param for delete
    if (!empty($_GET['post_id'])) {
        $post_id = $_REQUEST['post_id'];
        $pdo = Database::connect();
        $dbName = Database::$dbName;
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // find post owner
        $sql = "SELECT `USERNAME`
                FROM $dbName.posts JOIN $dbName.users
                ON $dbName.posts.`USER_ID` = $dbName.users.`USER_ID`
                WHERE POST_ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($post_id));
        $username = ($q->fetch())['USERNAME'];

        // delete data
        if($username==$_SESSION['username']) {
            $sql = "DELETE FROM $dbName.posts  WHERE post_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($post_id));
            Database::disconnect();
        }

        header("Location: index.php");

    }

    else {
        header("Location: index.php");
    }

?>
