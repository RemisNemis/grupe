<?php

if(!defined('PATH')){
       exit;
}

if(isset($_GET['view']) && $_GET['view'] == 'create'){
       
}

echo '      <form action="" method = "post">
Vartotojo duomenys:<br/><br/>
Vardas: <input  type="text" name="vardas" value="" placeholder="Vardas"> </br>
El. paštas: <input  type="text" name="vardas" value="" placeholder="El. paštas"></br>
Slaptažodis: <input  type="text" name="vardas" value="" placeholder="Slaptažodis"></br>
  <br>
  <input type="submit" name="nuskaityti" value="Nuskaityti">
 <br>
</form> ';

