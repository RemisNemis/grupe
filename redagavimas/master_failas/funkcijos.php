<?php

function browseris($direktorija){

  $failas = $vidus = $katalogas1 = $vien_katalogai= '';

  $content = scandir($direktorija, 0); //(variable,ASC0/DESC1) 
  foreach ($content as $key => $pav) {
  switch (1) {
    case ($pav == '..'):
    case ($pav == '.'):
    case (substr($pav, -3,3) == 'php'):
    case (substr($pav, -3,3) == 'css'):
    case (substr($pav, -4,4) == 'html'):
    case ($pav == 'auto.jpg'):
    case ($pav == 'problem2.jpg'):
    case ($pav == 'folder.jpg'):
    break;

    case (is_dir($direktorija.'/'.$pav)):
      echo '<div style="padding-left:30px"> <li><b> <a  href="">'.$pav.'</a> <-> '.$direktorija.'/'.$pav.'</b></li>';   
      
      browseris($direktorija.'/'.$pav);

      echo '</div>';
    break;

    case ( is_file($direktorija.'/'.$pav)):
      echo '<li> <a style="color:darkblue;"  href="?failas='.$pav.'">'.$pav.'</a> <-> '.$direktorija.'/'.$pav.' </li>';   
      break;
    }
  }
}






