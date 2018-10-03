<?php


// echo '<pre>';
// print_r($_POST);
// echo '</pre> <br/>';

$from_file = $file = $sarasas =  '';


if(!empty($_POST)) {
  if (!empty($_POST['button']) && !empty($_POST['message'])) {
    if(!empty($_POST['file_name'])){
      $file = $_POST['file_name']; //jei buvo kazkas - kuria kazka;
      $current = $_POST['message'];
    }
    else{
      $file = 'people.txt'; //likučiai nuo pirmos užduoties jeinėra nieko kuria people.txt
      $current = $_POST['message'];
    }
    file_put_contents($file, $current);

  }elseif(isset($_POST['nuskaityti'])){ //Jei ne pradinis įrašymas tai reikia esamam redaguoti
    //Ar githubas dirba, kaip gDrive?
    $file = $_POST['file_name'].'.txt';
    $from_file = file_get_contents($file);

  }elseif (!empty($_POST['newFile_name'])) {
    $fileName = $_POST['newFile_name']; 
    $newFile = $fileName.'.txt';   //sukuria tuscia faila tik su .txt. nenuskaito ivesto pavadinimo.
    $text = '';
    file_put_contents($newFile, $text);
  }

}

if ($handle = opendir('.')) {
  while (false !== ($entry = readdir($handle))) {
        if (substr($entry, -4, 4) == '.txt' ) {
          $sarasas .= '<li>'.$entry. '</li>';
        }
    
  }
  closedir($handle);
}


?>


<form action="" method = "post">
    <textarea type="text" name="message" style="width:600px; height:300px;" ><?= $from_file ?></textarea>
    <br>
    <input type="submit" name="button" value="Įrašyti">
    <input style="width:100px" type="text" name="file_name" value="<?= $file ?>" hidden>

    <br><br><br>
</form>
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

