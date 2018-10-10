<?php

$servername = 'localhost';
$username = 'root';
$password = '123';

// Prisijungiam prie serverio
$conn = mysqli_connect($servername, $username, $password, 'baze');

// Patikrinam prisijungimą
if (!$conn) {
   die('Connection failed: ' . mysqli_connect_error());
}




function create()
{

}

function show()
{
    ?>
    Antanas Macdonaldsas <a href="?view=edit&id=1">Redaguoti</a>
    <?php
}


function edit($id)
{

    return [
        'firstname' => 'Antanas',
        'lastname' => 'Macdonaldsas',
        'email' => 'antanas@anton.com',
        'password' => 'antanas9',
    ];


}  