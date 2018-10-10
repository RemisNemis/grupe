<?php
define('PATH', __DIR__);

?>
<div style="padding:40px">
<a href="?view=create" >Sukurti naują vartotoją</a>
<a href="?view=rodyti" >Sąrašas </a>
</div>
<?php

require_once 'function.php';

require_once 'view.php';


if(!empty($_POST)){
       require_once 'post.php';
       exit;
}








