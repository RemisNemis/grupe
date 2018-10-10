<?php
define('PATH', __DIR__);
require_once 'sql-db.php';
if(!empty($_POST)){
    require_once 'post.php';
    exit;
}



require_once 'view.php';