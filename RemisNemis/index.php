<?php

//likusi bėda - uzkrauti textarea į echo;

// echo '<pre>';
// print_r($_POST);
// echo '</pre> <br/>';

$from_file = $file = $sarasas =  '';



if(!empty($_POST)) {
  //->failo įrašymas
  if (!empty($_POST['button']) && !empty($_POST['message'])) {
    //iesko ar yra įrašyti pavadinimai ir tekstas
    if(!empty($_POST['file_name'])){
      $file = $_POST['file_name']; 
      $current = $_POST['message'];
    }
    //jei neranda - sukuria defaultini people, o message tuscias; irgreiciausiai undefined
    else{
      $file = 'people.txt';
      $current = $_POST['message'];
    }
    file_put_contents($file, $current);

  }
  //->jei spaudzia nuskaityti faila
  elseif(isset($_POST['nuskaityti'])){ 
    
    $file = $_POST['file_name'].'.txt';
    $from_file = file_get_contents($file);

  }
  //->jei nauja faila kuria
  elseif (!empty($_POST['newFile_name'])) {
    $fileName = $_POST['newFile_name']; 
    $newFile = $fileName.'.txt';   //sukuria tuscia faila tik su .txt. nenuskaito ivesto pavadinimo.
    $text = '';
    file_put_contents($newFile, $text);
  }

  //isechojina ka gavo;
  $text_area = '<form action="" method = "post">
  <textarea type="text" name="message" style="width:400px; height:200px;" >'.$from_file.'</textarea>
  <br>
  <input type="submit" name="button" value="Įrašyti">
  <input style="width:100px" type="text" name="file_name" value="'.$file.'" hidden>
  
  <br><br><br>
  </form>';
  echo $text_area;

}
//Jei POSTO NERA TADA GAL GETAS YRA
elseif( isset($_GET['failas'])){
  //Jei TXT 
  if(substr($_GET['failas'], -4, 4) == '.txt'){
    $file = $_GET['failas'];
    $from_file = file_get_contents($file);
    $text_area = '<form action="" method = "post">
    <textarea type="text" name="message" style="width:400px; height:200px;" >'.$from_file.'</textarea><br>
    <input type="submit" name="button" value="Įrašyti">
    <input style="width:100px" type="text" name="file_name" value="'.$file.'" hidden>
    <br><br><br>
    </form>';
    echo $text_area;

  }
  //Jei JPG
  elseif(substr($_GET['failas'], -4, 4) == '.jpg'){
    echo '<img style="width:300px" src="/paveiksliukai/'.$_GET['failas'].'">';
  }
    
}
//Jei nėra nei GET nei POST
else{
  echo $text_area;
}

//randa TXT failus;
if ($handle = opendir('.')) {
  while (false !== ($entry = readdir($handle))) {
    if (substr($entry, -4, 4) == '.txt' ) {
      $sarasas .= '<li> <a href="?failas='.$entry.'">'.$entry.'</a></li>';
    }

  }
  closedir($handle);
}


//randa JPG failus;
if ($handle_p = opendir('./paveiksliukai/')) {
  while (false !== ($entry_p = readdir($handle_p))) {
    if (substr($entry_p, -4, 4) == '.txt' || substr($entry_p, -4, 4) == '.jpg' ) {
      $sarasas .= '<li> <a href="?failas='.$entry_p.'">'.$entry_p.'</a></li>';
    }
  }
  closedir($handle_p);
}

?>



<h3>Jūs galite pasirinkti iš:</h3><ul><?= $sarasas ?></ul>

<form action="" method = "post">
    <input style="width:100px" type="text" name="file_name" value="sad">
    <br>
    <input type="submit" name="nuskaityti" value="Nuskaityti">
    <br><br><br>
</form>
<form action="" method = "post">
    <input style="width:100px" type="text" name="newFile_name" value="">
    <br><br>
    <input type="submit" name="newFile" value="Naujas failas be galūnės">
</form>

<?php

