<?php

function narsykle2($direktorija){

  $failas = $vidus = $katalogas1 = $vien_katalogai= '';

       $content = scandir($direktorija, 0); //(variable,ASC0/DESC1) 
       foreach ($content as $key => $pav) {

        //$direktorija = $direktorija.'/'.$pav;

        switch (1) {
          case ($pav == '..'):
          case ($pav == '.'):
          //case (substr($pav, -3,3) == 'php'):
          //case (substr($pav, -3,3) == 'css'):
          //case (substr($pav, -4,4) == 'html'):
          //case ($pav == 'auto.jpg'):
          //case ($pav == 'problem2.jpg'):
          //case ($pav == 'folder.jpg'):
          break;
          
          
          case ( !is_dir($pav)):
            $failas .= '<li> <a style="color:red; width:300px"  href="?failas='.$pav.'">'.$pav.' </a></li>';   //'<b>'.$pav.'            - NEATPAŽINTAS OBJEKTAS</b><br/>';
            break;

          case (is_dir($pav)):
          $katalogas1 .= '<li><b> <a  href="?katalogas='.$pav.'">'.$pav.'</a></b></li>';   //'<br/><b>'.$pav.'          - katalogas<br/></b>';
            $vien_katalogai .= '<option value="'.$pav.'"> - Čia katalogas '.$pav.'</option>';   //failų selectui

            //$direktorija = $direktorija.'/'.$pav;
            $vidus = narsykle2($direktorija);
          break;
          
          /*
          case (stripos($pav, '.') > 0):
            $failas .=  '<li> <a  href="?failas='.$pav.'">'.$pav.'</a></li>';   //$pav.'            - failas<br/>';
            break;
          */

          }
      }

       $sarasas = $failas.$katalogas1.$vidus;

       return($sarasas);
}






