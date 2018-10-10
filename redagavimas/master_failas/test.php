<?php



function narsykle($struktura){

       foreach($struktura as $key => $value ){
              
              if (is_array($value)){ //jei katalogas tada einam gylyn

                    echo '<div style="padding-left:20px">'.$key; 
                    
                    narsykle($value);

                    echo '</div>';
                    
                    

              }else{ //jeigu failas
                     echo '<div style="padding-left:20px">'.$value.'</div>';
              }
       }

       return ;
}


$struktura = [
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

narsykle($struktura);

//tarsi array yra fodleris, o failas tekstas;
echo '<pre>';
print_r(sizeof($struktura)); echo '</br>';
print_r($struktura);
echo '</pre>';



