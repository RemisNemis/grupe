<?php

echo '<pre>';
//print_r ( scandir(__DIR__));
echo '<br/>';
//print_r ( scandir(__DIR__.'/'.'Daivute'));
//echo '</pre>';

print_r(narsykle(__DIR__ ));


function narsykle($direktorija){
      $sarasas = [];
      $struktura = scandir($direktorija);
      foreach($struktura as $key => $value ){
            if ($value == '.' || $value == '..' ) { continue; }

            if ( is_dir($direktorija.'/'.$value) && !empty(scandir($direktorija.'/'.$value  ))){ //jei katalogas tada einam gylyn

            echo '<div style="padding-left:30px">';
            
            echo '<b>'.$value.' </b><br/>';
            
            narsykle($direktorija.'/'.$value);
            
            echo '</div>';

            }else{ //jeigu failas
                  echo '<div style="padding-left:10px">'.$value.'</div>';
            }
      }
}

//print_r($sarasas);

/*$struktura = [
       [
              ['du', 'tekstai'], 
              'blabla tai tekstas'
       ],
       [
              ['keturi', 'tekstukai'], 
              'blabla tai tekstas'
       ],
       'pora tekstu', 'tre2ias tekstas'
];
*/
//narsykle($struktura);

//tarsi array yra fodleris, o failas tekstas;
/*
echo '<pre>';
print_r(sizeof($struktura)); echo '</br>';
print_r($struktura);
echo '</pre>';

*/

