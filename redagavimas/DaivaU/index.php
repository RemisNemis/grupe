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
   
  $text_area = '<form action="" method = "post">
  <textarea type="text" name="message" style="width:400px; height:200px;" >'.$from_file.'</textarea>
  <br>
  <input type="submit" name="button" value="Įrašyti">
  <input style="width:100px" type="text" name="file_name" value="'.$file.'" hidden>
  
  <br><br><br>
  </form>';
  echo $text_area;

}elseif( isset($_GET['failas'])){ //Jei POSTO NERA TADA GAL GETAS YRA

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

  }elseif(substr($_GET['failas'], -4, 4) == '.jpg'){
    echo '<img style="width:300px" src="/folder/'.$_GET['failas'].'">';
  }
    
}else{
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

$dir = __DIR__;
// echo $dir2 = __DIR__.'/folder';

if (is_dir($dir)) {
  if ($dh = opendir($dir)) {
  while (($fileList = readdir($dh)) !==false) {
      if ( substr($fileList, -4, 4) == '.txt'|| substr($fileList, -4, 4) == '.jpg') {
        $sarasas .= '<li><a href="?failas='.$fileList.'" >'.$fileList.'</a> </li>';
       }
    }
  } closedir($dh);
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
?>