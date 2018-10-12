<?php

echo '<pre>';
print_r ( scandir(__DIR__));
echo '<br/>';
print_r ( scandir(__DIR__.'/'.'Daivute'));
echo '</pre>';

print_r(narsykle(scandir(__DIR__)));

function narsykle($struktura){
      $sarasas = [];
      foreach($struktura as $key => $value ){
            
            if ( is_dir(__DIR__.'/'.$value) && is_array(scandir(__DIR__.'/'.$value))){ //jei katalogas tada einam gylyn

            echo '<div style="padding-left:20px">'.$key;
            //$sarasas[$key] .= $value;
            //čia reiktų įmest array su katalogais;
            
            //narsykle(scandir(__DIR__.'/'.$value));
            
            echo '</div>';

            }else{ //jeigu failas
                  echo '<div style="padding-left:20px">'.$value.'</div>';
                  $sarasas = [];
            }
      }

      return $sarasas;
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

