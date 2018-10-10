<?php
if(!defined('PATH')){
    exit;
}


?>
<div style="padding:40px;">
<a href="?view=show">Sąrašas</a></br>
<a href="?view=create">Sukurti naują naudotoją</a></br>

</div>
<?php

if(isset($_GET['view'])&&$_GET['view']=='create'){
    ?>
    
    <form action="index.php" method="post">
    First name:<br>
    <input type="text" name="firstname"><br>
    Last name:<br>
    <input type="text" name="lastname"><br>
    Email:<br>
    <input type="text" name="email"><br>
    Password:<br>
    <input type="password" name="password"><br>
    <input type="submit" name="create" value="Create User"><br>
    </form>

    <?php
}
elseif(isset($_GET['view'])&&$_GET['view']=='edit'){
    
    $edit= edit($_GET['id']??0);// tikrinam ar yra setintas, jeigu ne priskiriam 0
    ?>
    

    <form>
    First name:<br>
    <input type="text" name="firstname" value="<?=$edit['firstname']?>"><br>
    Last name:<br>
    <input type="text" name="lastname" value="<?=$edit['lastname']?>"><br>
    Email:<br>
    <input type="text" name="email" value="<?=$edit['email']?>"><br>
    Password:<br>
    <input type="password" name="password" value="<?=$edit['pass']?>"><br>
    <input type="hidden" value="<?=$edit['id']?>">
    <input type="submit" name="update" value="Edit User"><br>
    </form>

    <?php


    
    
}
else{
    ?>
    <h2>Vartotojų sąrašas</h2>
 

    <?php
    show();
}