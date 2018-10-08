<link rel="stylesheet" href="style.css">

<?php

//Tušti stringai;
$from_file = $file = $sarasas = $text_area = $paveiksliukas = $pranesimas = $pranesimas1 
= $pranesimas2 =  '';


//Jei galioja betkuri iš trijų formų;
if(!empty($_POST)) {

  //->failo įrašymo forma
  if (!empty($_POST['button']) && !empty($_POST['message']) && !empty($_POST['file_name']) ) {
    $file = $_POST['file_name']; 
    $current = $_POST['message'];
    
    file_put_contents(__DIR__ . './tekstas/'.$file, $current);

    $from_file = file_get_contents(__DIR__ . './tekstas/'.$file);
    $text_area = '<h3>'.$file.'</h3><form action="" method = "post">
    <textarea type="text" name="message" style="width:300px; height:200px;" >'.$from_file.'</textarea><br>
    <input type="submit" name="button" value="Įrašyti">
    <input  type="text" name="file_name" value="'.$file.'" hidden>
    <br><br><br>
    </form>';

  }
 
  //Nuskaitymo forma
  if (isset($_POST['nuskaityti'])){
  switch(1){

    //YRA FAILO PAV IR EGZISTUOJA
    case (!empty($_POST['file_name']) && (file_exists(__DIR__ . './tekstas/'.$_POST['file_name'].'.txt') || file_exists('./paveiksliukai/'.$_POST['file_name'].'.jpg'))):
      $file = $_POST['file_name'];
      //jeigu rado txt
      if(file_exists(__DIR__ . './tekstas/'.$_POST['file_name'].'.txt')){
        $from_file = file_get_contents(__DIR__ . './tekstas/'.$file.'.txt');     //HELPAS//$json = file_get_contents(__DIR__ . '/../validate/edit.json');
        //isechojina ka gavo;
        $text_area = '<h3>'.$file.'</h3><form action="" method = "post">
        <textarea type="text" name="message" style="width:300px; height:200px;" >'.$from_file.'</textarea>
        <br>
        <input type="submit" name="button" value="Įrašyti">
        <input  type="text" name="file_name" value="'.$file.'" hidden>
        <br><br><br>
        </form>';
      //Jeigu rado JPG
      }elseif(file_exists('./paveiksliukai/'.$_POST['file_name'].'.jpg')){
        $paveiksliukas = '<h3>'.$_POST['file_name'].'.jpg'.'</h3><img  src="./paveiksliukai/'.$_POST['file_name'].'.jpg'.'">';
      }
      break;
    
    //TUŠČIAS PAVADINIMAS
    case empty($_POST['file_name']):
      $pranesimas =  '<span id="pranesimas"> Įveskite failo pavadinimą! </span>';
      break;
    
    //NEEGZISTUOJA
    case (!file_exists($_POST['file_name'].'.txt') || !file_exists($_POST['file_name'].'.jpg') ):
    $pranesimas =  '<span id="pranesimas"> Tokio failo neradome. <br/> Rinkitės iš pateikiamo sąrašo ir veskite be failo galūnės! </span>';
    break;
  
    }
  }

 }

  //Naujo failo kūrimo forma
 if (!empty($_POST['new_name']) && !empty($_POST['newFile'])) {
    $fileName = $_POST['new_name']; 
    $newFile = $fileName.'.txt';   //sukuria tuscia faila tik su .txt. nenuskaito ivesto pavadinimo.
    $text = '';
    file_put_contents(__DIR__ . './tekstas/'.$newFile, $text);

  }elseif ( isset($_POST['new_name']) && empty($_POST['new_name'])){
    $pranesimas1 =  '<span id="pranesimas"> Failo pavadinimas negali būti tuščias. </span>';
  }

  //Failo įkėlimo forma
  if ( isset($_POST['ikeliamas_failas'])){
    switch (1){
      //PAVADINIMAS
      case empty($_FILES['fileToUpload']['name']):
        $pranesimas2 = '<span id="pranesimas"> Prašome pasirinkti failą iš kompiuterio <br/>'.$_FILES['fileToUpload']['name'].'</span>';
        break;
      //DYDIS
      case ($_FILES['fileToUpload']['size'] > 1000000):
        $pranesimas2 = '<span id="pranesimas"> Failas turi užimti ne daugiau nei 1 MB dydį </span>';
        break;
      //FAILO TIPAS
      case (substr($_FILES['fileToUpload']['type'], -4 , 4) !== 'jpeg'):
        $pranesimas2 = '<span id="pranesimas"> Kolkas priimame tik JPEG tipo failus. </span>';
        break;
      //SERVO KLAIDOS
      case ($_FILES['fileToUpload']['error'] !== 0):
        $pranesimas2 = '<span id="pranesimas"> Serverio klaida, bandykite iš naujo. </span>';
        break;
      //TOKS PAT FAILAS
      case (file_exists(__DIR__ . './paveiksliukai/'.$_FILES['fileToUpload']['name'])  ):
        $pranesimas2 = '<span id="pranesimas"> Tokio pavadinimo ('.$_FILES['fileToUpload']['name'].') paveiksliukas jau yra. Pasirinkite kitą.  </span>';
        break;
      //ĮKĖLIMAS
      case (!empty($_FILES['fileToUpload']['name'])):
        //Failo įkėlimo tolimesnis kodas;
        $ikelimui_direktorija = __DIR__ . './paveiksliukai/'.$_FILES['fileToUpload']['name'];
        move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $ikelimui_direktorija);
        
        $pranesimas2 = '<span style="color: green; text-size: 20px"> Failas priimtas. </span>';
        break;

    }
  }




//Jei GET' YRA
if( isset($_GET['failas'])){
  //Jei TXT 
  if(substr($_GET['failas'], -4, 4) == '.txt'){
    $file = $_GET['failas'];
    $from_file = file_get_contents(__DIR__ . './tekstas/'.$file);
    $text_area = '<h3>'.$file.'</h3><form action="" method = "post">
    <textarea type="text" name="message" style="width:300px; height:200px;" >'.$from_file.'</textarea><br>
    <input type="submit" name="button" value="Įrašyti">
    <input  type="text" name="file_name" value="'.$file.'" hidden>
    <br><br><br>
    </form>';

  }
  //Jei JPG
  elseif(substr($_GET['failas'], -4, 4) == '.jpg'){
    $paveiksliukas = '<h3>'.$_GET['failas'].'</h3><img  src="./paveiksliukai/'.$_GET['failas'].'">';
  }else{
    $text_area = '';
  }
    
}
//Jei nėra nei GET nei POST


//randa TXT failus;
if ($handle = opendir('./tekstas/')) {
  while (false !== ($entry = readdir($handle))) {
    if (substr($entry, -4, 4) == '.txt' ) {
      //Spalvinam pasirinkta;
      if (isset($_GET['failas']) && $entry == $_GET['failas']  ){
        $sarasas .= '<li> <a id="parinktas_li" href="?failas='.$entry.'">'.$entry.'</a></li>';
      }else{
        $sarasas .= '<li> <a href="?failas='.$entry.'">'.$entry.'</a></li>';
      }
    }
  }
  closedir($handle);
}




//randa JPG failus;
if ($handle_p = opendir('./paveiksliukai/')) {
  while (false !== ($entry_p = readdir($handle_p))) {
    if ( substr($entry_p, -4, 4) == '.jpg' ) {
      if (isset($_GET['failas']) && $entry_p == $_GET['failas'] ){
        $sarasas .= '<li> <a id="parinktas_li" href="?failas='.$entry_p.'">'.$entry_p.'</a></li>';
      }else{
        $sarasas .= '<li> <a href="?failas='.$entry_p.'">'.$entry_p.'</a></li>';
      }
    }
  }
  closedir($handle_p);
}

 // echo ;


?>

<table >
  <tr>
    <td >
      <h3>Jūs galite pasirinkti iš:</h3><ul><?= $sarasas ?></ul>

      <form action="" method = "post">
          <input style="width:100px" type="text" name="file_name" value="">
          <br>
          <input type="submit" name="nuskaityti" value="Nuskaityti">
         <br><?=$pranesimas?>
          <br><br>

      </form>

      <form action="" method = "post">
          <input style="width:100px" type="text" name="new_name" value="">
          <br>
          <input type="submit" name="newFile" value="Naujas .txt failas be galūnės">
          <br/> <?=$pranesimas1?>
      </form>
      <br/><br/>
      <form action="" method="post" enctype="multipart/form-data">
        Pasirinkite JPEG paveiksliuką:
        <input type="file" name="fileToUpload"  pattern="">
        <input type="submit" name="ikeliamas_failas" value="Įkelti" >
        <br/> <?=$pranesimas2?>
      </form>




    </td>
    <td >
    <?= $text_area?> <?= $paveiksliukas?> 
    </td>

</table>
<?php

echo '<pre>';
print_r($_POST);
echo '<br/><br/>';
print_r($_FILES);
echo '</pre> <br/>';
