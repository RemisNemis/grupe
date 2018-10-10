<?php

function narsykle($direktorija){

       $katalogas0 = $katalogas1 = $vien_katalogai= '';

       $main_folder = scandir($direktorija, 0); //(variable,ASC0/DESC1) 
       foreach ($main_folder as $key => $pav) {
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
           
           case (stripos($pav, '.') > 0):
             $katalogas0 .=  '<li> <a  href="?failas='.$pav.'">'.$pav.'</a></li>';   //$pav.'            - failas<br/>';
             break;
           case ( !is_dir($pav)):
             $katalogas0 .= '<li> <a style="color:red;"  href="?failas='.$pav.'">'.$pav.' |-> Nei failas nei katalogas</a></li>';   //'<b>'.$pav.'            - NEATPAŽINTAS OBJEKTAS</b><br/>';
             break;
           case (stripos($pav, '.') == 0):
           $katalogas1 .= '<li><b> <a  href="?katalogas='.$pav.'">'.$pav.'</a></b></li><ul>';   //'<br/><b>'.$pav.'          - katalogas<br/></b>';
             $vien_katalogai .= '<option value="'.$pav.'"> - '.$pav.'</option>';   //failų selectui

              narsykle($direktorija.'/'.$pav);
              
         }
       }

       $sarasas = $katalogas0.$katalogas1;

       return($sarasas);
}






