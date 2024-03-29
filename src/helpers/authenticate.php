<?php
session_start();
$session_key = session_id();

require_once 'database.php';

$pdo = Database::connect();
$dbName = Database::$dbName;
$sql = "SELECT `SESSION_ID` FROM $dbName.sessions WHERE `SESSION_KEY` = ? AND `SESSION_ADDRESS` = ? AND `SESSION_USERAGENT` = ? AND `SESSION_EXPIRES` > NOW()";

$query = $pdo->prepare($sql);
$query->execute(array($session_key, $_SERVER['REMOTE_ADDR'], $_SERVER['HTTP_USER_AGENT']));
$session_id = ($query->fetch(PDO::FETCH_ASSOC))['SESSION_ID'];
if(!isset($_SESSION['username']) || empty($session_id)) {
	Database::disconnect();
	header('Location: login.php');
}

$sql = "UPDATE $dbName.sessions SET `SESSION_EXPIRES` = DATE_ADD(NOW(),INTERVAL 1 HOUR) WHERE `SESSION_ID` = ?";
$query = $pdo->prepare($sql);
$query->execute(array($session_id));
Database::disconnect();

?>
