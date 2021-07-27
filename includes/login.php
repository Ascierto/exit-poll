<?php
 session_start();
include __DIR__ . '/Users.php';

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header('Location: http://localhost:8888/exit-poll/login.php');
    exit;
}


$loggedInUser=\ExitPoll\Users::loginUser($_POST);



$_SESSION['userId'] = $loggedInUser['id'];
$_SESSION['email'] = $loggedInUser['email'];
$_SESSION['name'] = $loggedInUser['name'];
$_SESSION['surname'] = $loggedInUser['surname'];
$_SESSION['is_admin'] = $loggedInUser['is_admin'];
header('Location: http://localhost:8888/exit-poll');
exit;

?>