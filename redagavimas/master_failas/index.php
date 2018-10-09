<?php
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="This is my homepage, this text is for search engines">
    <meta name="author" content="">
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">

    <title></title>
</head>
  <body>
<?php

require_once 'bootstrap.php';
// if (isset($_GET['action']) && $_GET['action'] == 'logout'){
//     session_destroy();
// }

// paspaustas mygtukas LOGIN
if(isset($_POST['login'])) {
    if ($_POST['username'] == $settings['name'] && $_POST['password'] == $settings['password']) {
        $_SESSION['login'] = 1;
    }
}
// tikriname sesijoje 
if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
    header('Location: '.$settings['uri'].'engine.php');
    die();
}


?>
<div class="bg">
<h1>BŪK GERIAUSIAS!<br> PRISIJUNK PRIE BALTIJOS TALENTŲ KOMANDOS!</h1>
<form action="" method="post" class = "container">
<p>Name:<p> <input type="text" name="username">
<p>Password:<p> <input type="password" name="password">
<input type="submit" name="login" value="LOGIN" class = "btn">
    <?php 
    if (isset($_POST['login']) && (!isset($_SESSION['login']) || $_SESSION['login'] != 1)) {
        echo '<span style="color:red">Prisijungimas nepavyko! Neteisingas vartotojo vardas arba slaptažodis.</span>';
    }
    ?>
</form>
</div>
</body>

