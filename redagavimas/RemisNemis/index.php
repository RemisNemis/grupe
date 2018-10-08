<link rel="stylesheet" href="style.css">

<?php

//Tušti stringai;
$from_file =  $sarasas = $text_area = $paveiksliukas = $pranesimas = $pranesimas1 
= $pranesimas2 = $pranesimas3 = $katalogas1 = $katalogas0 = $vien_katalogai = '';

$problem2 = '<img src="./paveiksliukai/problem2.jpg">';

  //POST Nuskaitymo forma
  if (isset($_POST['nuskaityti'])){
    switch(1){
  
      //YRA FAILO PAV IR EGZISTUOJA
      case (!empty($_POST['file_name']) && file_exists(__DIR__ . './tekstas/'.$_POST['file_name'].'.txt') ):
        //jeigu rado txt
          $from_file = file_get_contents(__DIR__ . './tekstas/'.$_POST['file_name'].'.txt');     //HELPAS//$json = file_get_contents(__DIR__ . '/../validate/edit.json');
          //isechojina ka gavo;
          $text_area = '<h3>'.$_POST['file_name'].'</h3><form action="" method = "post">
          <textarea type="text" name="message" style="width:300px; height:200px;" >'.$from_file.'</textarea>
          <br>
          <input type="submit" name="button" value="Įrašyti">
          <input  type="text" name="file_name" value="./tekstas/'.$_POST['file_name'].'.txt" hidden>
          <br><br><a id="pavojus" style="text-color:red;" href="?trinti=./tekstas/'.$_POST['file_name'].'.txt">Ištrinti</a><br><br>
          </form>  ';
        break;

        //Jeigu rado JPG
        case(!empty($_POST['file_name']) && file_exists('./paveiksliukai/'.$_POST['file_name'].'.jpg')):
          $paveiksliukas = '<h3>'.$_POST['file_name'].'.jpg'.'</h3><img  src="./paveiksliukai/'.$_POST['file_name'].'.jpg'.'">';
          $text_area = ' ';
          break;
      
      //TUŠČIAS PAVADINIMAS
      case empty($_POST['file_name']):
        $pranesimas =  '<span id="pranesimas"> Įveskite failo pavadinimą! </span>';
        $text_area = $problem2;
        break;
      
      //NEEGZISTUOJA
      case (!file_exists($_POST['file_name'].'.txt') || !file_exists($_POST['file_name'].'.jpg') ):
      $pranesimas =  '<span id="pranesimas"> Tokio failo neradome. <br/> Rinkitės iš pateikiamo sąrašo ir veskite be failo galūnės! </span>';
      $text_area = $problem2;
      break;
    
      }
    }

  //POST->failo įrašymo forma
  if (!empty($_POST['button']) && !empty($_POST['message']) && !empty($_POST['file_name']) ) {
    
    $current = $_POST['message'];
    $file = $_POST['file_name'];
    file_put_contents(__DIR__ . './'.$file, $current);
    
    $from_file = file_get_contents(__DIR__ . './'.$file);
    $text_area = '<h3>'.$file.'</h3><form action="" method = "post">
    <textarea type="text" name="message" style="width:300px; height:200px;" >'.$from_file.'</textarea><br>
    <input type="submit" name="button" value="Įrašyti">
    <input  type="text" name="file_name" value="'.$file.'" hidden>
    <br><br><a id="pavojus" style="text-color:red;" href="?trinti='.$file.'">Ištrinti</a><br><br>
</form>';

  }
 
  //POST ->Naujo failo kūrimo forma
 if (!empty($_POST['new_name']) && !empty($_POST['newFile'])) {
    $fileName = $_POST['new_name']; 
    $newFile = $fileName.'.txt';   //sukuria tuscia faila tik su .txt. nenuskaito ivesto pavadinimo.
    $text = '';
    file_put_contents(__DIR__ . './tekstas/'.$newFile, $text);
    $text_area = ' ';

  }elseif ( isset($_POST['new_name']) && empty($_POST['new_name'])){
    $pranesimas1 =  '<span id="pranesimas"> Failo pavadinimas negali būti tuščias. </span>';
    $text_area = $problem2;

  }

  //POST FILES ->Failo įkėlimo forma
  if ( isset($_POST['ikeliamas_failas'])){
    switch (1){
      //PAVADINIMAS
      case empty($_FILES['fileToUpload']['name']):
        $pranesimas2 = '<span id="pranesimas"> Prašome pasirinkti failą iš kompiuterio <br/></span>';
        $text_area = $problem2;
        break;
      case ($_POST['select_catalogas'] == '- - -'):
        $pranesimas2 = '<span id="pranesimas"> Prašome pasirinkti katalogą į kurį kelsite <br/></span>';
        $text_area = $problem2;
        break;
      //DYDIS
      case ($_FILES['fileToUpload']['size'] > 1000000):
        $text_area = $problem2;
        $pranesimas2 = '<span id="pranesimas"> Failas turi užimti ne daugiau nei 1 MB dydį </span>';
        break;
      //FAILO TIPAS
      case (substr($_FILES['fileToUpload']['type'], -4 , 4) !== 'jpeg'):
        $pranesimas2 = '<span id="pranesimas"> Kolkas priimame tik JPEG tipo failus. </span>';
        $text_area = $problem2;
        break;
      //SERVO KLAIDOS
      case ($_FILES['fileToUpload']['error'] !== 0):
        $pranesimas2 = '<span id="pranesimas"> Serverio klaida, bandykite iš naujo. </span>';
        $text_area = $problem2;
        break;
      //TOKS PAT FAILAS
      case (file_exists(__DIR__ . './'.$_POST['select_catalogas'].'/'.$_FILES['fileToUpload']['name'])  ):
        $text_area = $problem2;
        $pranesimas2 = '<span id="pranesimas"> Tokio pavadinimo ('.$_FILES['fileToUpload']['name'].') paveiksliukas jau yra. Pasirinkite kitą.  </span>';
        break;
      //ĮKĖLIMAS
      case (!empty($_FILES['fileToUpload']['name'])):
        //Failo įkėlimo tolimesnis kodas;
        $ikelimui_direktorija = __DIR__ . './'.$_POST['select_catalogas'].'/'.$_FILES['fileToUpload']['name'];
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $ikelimui_direktorija);
        
        $pranesimas2 = '<span style="color: green; text-size: 20px"> Failas priimtas. </span>';
        $paveiksliukas = '<h3>'.$_POST['select_catalogas'].'/'.$_FILES['fileToUpload']['name'].'</h3><img  src="./'.$_POST['select_catalogas'].'/'.$_FILES['fileToUpload']['name'].'">
        <br><br><a id="pavojus" style="text-color:red;" href="?trinti=./'.$_POST['select_catalogas'].'/'.$_FILES['fileToUpload']['name'].'">Ištrinti</a><br><br>';
        $text_area = ' ';
        break;

    }
  }

  if ( isset($_POST['newCatalog'])){
    switch (1){
      //PAVADINIMAS
      case empty($_POST['new_catalog_name']):
        $pranesimas3 =  '<span id="pranesimas"> Failo pavadinimas negali būti tuščias. </span>';
        $text_area = $problem2;
        break;
      case file_exists($_POST['new_catalog_name']):
        $pranesimas3 =  '<span id="pranesimas"> Toks katalogas jau yra sukurtas. </span>';
        $text_area = $problem2;
        break;
      case !empty($_POST['new_catalog_name']):
        mkdir(__DIR__.'./'.$_POST['new_catalog_name'], 0777);
        $pranesimas3 = '<span style="color: green; text-size: 20px"> Katalogas sukurtas </span>';
        break;
    }
  }


//Jei GET' YRA ir yra nuoroda
if( isset($_GET) && empty($_POST)){
  switch (1) {
    //Jei TXT atvaizduoja
    case (isset($_GET['failas']) && substr($_GET['failas'], -4, 4) == '.txt'):
      $from_file = file_get_contents(__DIR__.'./' . $_GET['failas']);
      $text_area = '<h3>'.$_GET['failas'].'</h3><form action="" method = "post">
      <textarea type="text" name="message" style="width:300px; height:200px;" >'.$from_file.'</textarea><br>
      <input type="submit" name="button" value="Įrašyti">
      <input  type="text" name="file_name" value="'.$_GET['failas'].'" hidden>
      <br><br><a id="pavojus" style="text-color:red;" href="?trinti=./tekstas/'.$_GET['failas'].'">Ištrinti</a><br><br>
      </form>';
      break;
    //Jei JPG atvaizduoja
    case (isset($_GET['failas']) &&  (substr($_GET['failas'], -4, 4) == '.jpg' || substr($_GET['failas'], -4, 4) == '.JPG')):
      $paveiksliukas = '<h3>'.$_GET['failas'].'</h3><img  src="./'.$_GET['failas'].'">
      <br><br><a id="pavojus" style="text-color:red;" href="?trinti=./'.$_GET['failas'].'">Ištrinti</a><br><br>';
      $text_area = ' ';
      break;
    case (isset($_GET['katalogas'])):
      $paveiksliukas = '<h3>Katalogas: "'.$_GET['katalogas'] .'"</h3><img  src="./paveiksliukai/folder.jpg">
      <br><br><a id="pavojus" style="text-color:red;" href="?naikinti='.$_GET['katalogas'].'">Ištrinti</a><br><br>';
      $text_area = ' ';
      break;
    //prašo trynimo
    case (isset($_GET['trinti'])):
      unlink($_GET['trinti']);
      //header("Location: http://www.briedis.test");
      break;
    case (isset($_GET['naikinti']) !== 'tekstas' ):
      rmdir($_GET['naikinti']);
      //header("Location: http://www.briedis.test");
      break;
    case (isset($_GET['naikinti']) == 'tekstas'):
      $text_area = '<span id="pranesimas"> Žmogau, tu nori panaikinti tekstų katalogą. Negerai taip!</span>';
      break;
      
    default:
          //Kad esant failams būtų ištrinti mygtukas;
        //  $text_area = '<a id="pavojus" style="text-color:red;" href="?trinti=./'.$_GET['failas'].'">Ištrinti</a>';
      break;
  }
}


//Jei nėra nei GET nei POST

//Tėvinėj direktorijoj;
$main_folder = scandir(__DIR__, 0);
  foreach ($main_folder as $key => $pav) {
    switch (1) {
      case ($pav == '..'):
      case ($pav == '.'):
      case (substr($pav, -3,3) == 'php'):
      case (substr($pav, -3,3) == 'css'):
      case (substr($pav, -4,4) == 'html'):
        break;
      
      case (stripos($pav, '.') > 0):
        $katalogas0 .=  '<li> <a  href="?failas='.$pav.'">'.$pav.'</a></li>';   //$pav.'            - failas<br/>';
        break;
      case ( !is_dir($pav)):
        $katalogas0 .= '<li> <a style="color:red;"  href="?failas='.$pav.'">'.$pav.' |-> Nei failas nei katalogas</a></li>';   //'<b>'.$pav.'            - NEATPAŽINTAS OBJEKTAS</b><br/>';
        break;
      case (stripos($pav, '.') == 0):
        $katalogas1 .= '<li><b> <a  href="?katalogas='.$pav.'">'.$pav.'</a></b></li><ul>';   //'<br/><b>'.$pav.'          - katalogas<br/></b>';
        $vien_katalogai .= '<option value="'.$pav.'"> - '.$pav.'</option>';   //failų selectui
        
        $sub_folder = scandir(__DIR__.'/'.$pav, 1);
        //JEI TAI KATALOGAS LENDA Į SUBFOLDERĮ
        foreach ($sub_folder as $sub_key => $sub_pav) {
          switch (2) {
            case ($sub_pav == '..'):
            case ($sub_pav == '.'):
            case (substr($pav, -3,3) == 'php'):
            case (substr($pav, -3,3) == 'css'):
            case (substr($pav, -4,4) == 'html'):
              break;

            case (stripos($sub_pav, '.') > 0):
              $katalogas1 .=  '<li> <a  href="?failas='.$pav.'/'.$sub_pav.'">'.$sub_pav.'</a></li>';   //'   '.$sub_pav.'            - kataloge failas <br/>';
              break;
            case ( !is_dir($sub_pav)):
              $katalogas1 .=  '<li> <a  style="color:red;" href="?failas='.$pav.'/'.$sub_pav.'">'.$sub_pav.' |-> Nei failas nei katalogas</a></li>';   //'   <b>'.$sub_pav.'            - NEATPAŽINTAS OBJEKTAS</b><br/>';
              break;
            case (stripos($sub_pav, '.') == 0):
              $katalogas1 .=  '<li><b> <a  href="?katalogas='.$pav.'/'.$sub_pav.'">'.$sub_pav.'</a></b></li>';   //'<br/><b>'.$sub_pav.'<b>          - kataloge katalogas <br/></b>';
              $vien_katalogai .= '<option value="'.$pav.'/'.$sub_pav.'">'.$sub_pav.'</option>';   //failų selectui
              //$sub_sub_folder = scandir(__DIR__.'/'.$pav.'/'.$sub_pav, 1);
              break;
          }
        }
        $katalogas1 .= '</ul>';
        break;
     }
  }

  $sarasas = $katalogas0.$katalogas1;
  empty($text_area) ? $text_area = '<img src="./paveiksliukai/problem2.jpg">' : '';
  



?>

<table >
  <tr>
    <td >
      <h3>Pasirinkite failą:</h3><ul><?= $sarasas ?></ul>
    </td>
    <td colspan="2"    style="text-align: center;" > 
      <?= $text_area?> <?= $paveiksliukas?>     
    </td>
    <td>


    </td>
  </tr>
  <tr>
    <td>
      <form action="" method = "post">
        Nuskaitykite tekstinį dokumentą <br/> iš katalogo "tekstas": <br/><br/>
          <input  type="text" name="file_name" value="">
          <br><br/>
          <input type="submit" name="nuskaityti" value="Nuskaityti">
         <br><?=$pranesimas?>
      </form>
      
    </td>
    <td> 
      <form action="" method = "post">
          Sukurkite naują tekstinį dokumentą:<br/><br/>
          <input  type="text" name="new_name" value="">
          <br><br/>
          <input type="submit" name="newFile" value="Naujas .txt failas be galūnės">
          <br/> <?=$pranesimas1?>
      </form>
    </td>
    <td> 
      <form action="" method="post" enctype="multipart/form-data">
        Pasirinkite katalogą ir JPEG paveiksliuką: <br/><br/>
        <select name="select_catalogas"> <option value="- - -">- - -</option><?=$vien_katalogai?></select>
        <br/><br/>
        <input type="file" name="fileToUpload"  pattern=""><br/><br/>
        <input type="submit" name="ikeliamas_failas" value="Įkelti" >
        <br/> <?=$pranesimas2?>
      </form>
    </td>
    <td> 
      <form action="" method = "post">
          Sukurkite naują katalogą: <br/><br/>
          <input  type="text" name="new_catalog_name" value="" pattern="[a-zA-Z0-9]{3,}" title="Pavadnimas bent iš trijų raidžių ir skaičių.">
          <br><br/>
          <input type="submit" name="newCatalog" value="Kurti naują katalogą">
          <br/> <?=$pranesimas3?>
      </form>
    </td>


</tr>

</table>
<?php
echo '<pre> <ul>';
echo '<br/><br/> POST:<br/>';
print_r($_POST);
echo '<br/><br/>GET:<br/>';
print_r($_GET);
echo '<br/><br/>FILES:<br/>';
print_r($_FILES);
echo '<br/><br/>scandir():<br/>';
print_r(scandir(__DIR__, 1));
echo '</pre> <br/>';



