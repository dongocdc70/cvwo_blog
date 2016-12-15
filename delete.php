<?php
    require 'authenticate.php';
    require_once 'database.php';
    $post_id = 0;

    if (!empty($_GET['post_id'])) {
        $post_id = $_REQUEST['post_id'];
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // find post owner
        $sql = "SELECT `USERNAME`
                FROM data.posts JOIN data.users
                ON data.posts.`USER_ID` = data.users.`USER_ID`
                WHERE POST_ID = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($post_id));
        $username = ($q->fetch())['USERNAME'];

        // delete data
        if($username==$_SESSION['username']) {
            $sql = "DELETE FROM data.posts  WHERE post_id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($post_id));
            Database::disconnect();
        }

        header("Location: index.php");

    }

?>
