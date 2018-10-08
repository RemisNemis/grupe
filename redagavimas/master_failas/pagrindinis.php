<?php
require_once 'bootstrap.php';
// tikriname sesijoje 
if (!isset($_SESSION['login']) || $_SESSION['login'] != 1) {
    header('Location: '.$settings['uri'].'login.php');
    die();
}
?>

<h1>viskas gerai</h1>
