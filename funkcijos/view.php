<?php

if(!defined('PATH')){
  exit;
}

if(isset($_GET['view']) && $_GET['view'] == 'create'){
  ?>
  <form action="" method = "post">
    Įveskite vartotojo duomenys:<br/><br/>
    Vardas: <input  type="text" name="vardas" value="" placeholder="Vardas"> </br>
    Pavardė: <input  type="text" name="vardas" value="" placeholder="Pavardė"> </br>
    El. paštas: <input  type="email" name="vardas" value="" placeholder="El. paštas"></br>
    Slaptažodis: <input  type="password" name="vardas" value="" placeholder="Slaptažodis"></br>
    <br>
    <input type="submit" name="nuskaityti" value="Įvesti">
    <br>
  </form>

  <?php
  echo create();
}

if(isset($_GET['view']) && $_GET['view'] == 'edit'){
  echo edit($_GET['id']);

  ?>
  <form action="" method = "post">
    Redaguokite vartotoją:<br/><br/>
    Vardas: <input  type="text" name="vardas" value="" placeholder="Vardas"> </br>
    Pavardė: <input  type="text" name="vardas" value="" placeholder="Pavardė"> </br>
    El. paštas: <input  type="email" name="vardas" value="" placeholder="El. paštas"></br>
    Slaptažodis: <input  type="password" name="vardas" value="" placeholder="Slaptažodis"></br>
    <br>
    <input type="submit" name="redaguoti" value="Redaguoti">
    <br>
  </form>
<?php
      
}else{
  echo show();
}
