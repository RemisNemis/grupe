<?php
define('PATH', __DIR__);
require_once 'function.php';



if(!empty('post.php')){
       require_once 'post.php';
       exit;
}

?>

<div style="padding:40px">
 <a href="?view=create" >Sukurti </a>
</div>

<?php


require_once 'view.php';




