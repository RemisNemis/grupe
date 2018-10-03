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
  
  }elseif(isset($_POST['nuskaityti']) ){ //Jei ne pradinis įrašymas tai reikia esamam redaguoti
      $file = $_POST['file_name'].'.txt';
      $from_file = file_get_contents($file);
  
  }elseif (!empty($_POST['newFile_name'])) {
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
    echo '<img style="width:300px" src="/folder/'.$_GET['failas'].'">';
    }
}
//Jei nėra nei GET nei POST
else{
  $text_area = '<form action="" method = "post">
  <textarea type="text" name="message" style="width:400px; height:200px;" >'.$from_file.'</textarea><br>
  <input type="submit" name="button" value="Įrašyti">
  <input style="width:100px" type="text" name="file_name" value="'.$file.'" hidden>
  <br><br><br>
  </form>';
  echo $text_area;
}

  
// //uzduotis 4
// if ($handle = opendir('.')) {
//   while (false !== ($entry = readdir($handle))) {
//         if (substr($entry, -4, 4) == '.txt' ) {
//           $sarasas .= '<li>'.$entry. '</li>';
//         }
    
//   }
//   closedir($handle);
// }


//RANDA TXT
$dir = __DIR__;
if (is_dir($dir)) {
  if ($handle = opendir($dir)) {
  while (($entry = readdir($handle)) !==false) {
      if ( substr($entry, -4, 4) == '.txt'|| substr($entry, -4, 4) == '.txt') {
        $sarasas .= '<li><a href="?failas='.$entry.'" >'.$entry.'</a> </li>';
       }
    }
  } closedir($handle);
}


// RANDA JPG
$dir_p = __DIR__.'/folder';
echo $dir_p;

if (is_dir($dir_p)) {
  if ($handle_p = opendir($dir_p)) {
  while (($entry_p = readdir($handle_p)) !==false) {
      if ( substr($entry_p, -4, 4) == '.txt'|| substr($entry_p, -4, 4) == '.jpg') {
        $sarasas .= '<li><a href="?failas='.$entry_p.'" >'.$entry_p.'</a> </li>';
       }
    }
  } closedir($handle_p);
}

//JPG FAILO ISTRYNIMAS (neistrina is folderio 'folder, bet is direktorijos DaivaU)
if (is_dir($dir_p)) {
  if ($handle_p = opendir($dir_p)) {
  while (($entry_p = readdir($handle_p)) !==false) {
      if (substr($entry_p, -4, 4) == '.jpg') {
        if (isset($_POST['delete'])) {
          unlink($entry_p);
        }
      }
    }
  } closedir($handle_p);
}

// TUSCIU FOLDERIU KURIMAS
$newFolder = __DIR__;
if (!empty($_POST['newFolder_name'])) {
    $folderName = $_POST['newFolder_name'];
  if (!mkdir($newFolder.'/'.$folderName)) {
    mkdir($newFolder.'/'.$folderName);
   }
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
    <br><br><br>
</form>
<form action="" method = "post">
    <input type="submit" name="delete" value="Istrinti paveiksla">
    <br><br><br>
</form>
<form action="" method = "post">
<input style="width:100px" type="text" name="newFolder_name" value="">
    <br>
    <input type="submit" name="newFolder" value="Kurti tuscia folderi">
    <br><br><br>
</form>


<?php
?>
