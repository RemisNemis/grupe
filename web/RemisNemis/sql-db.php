<?php

$servername = 'localhost';
$username = 'root';
$password = '123';

// Prisijungiam prie serverio
$conn = mysqli_connect($servername, $username, $password, 'user_manager');

// Patikrinam prisijungimą
if (!$conn) {
   die('Connection failed: ' . mysqli_connect_error());
}




function create()
{

}

function show()
{
    global $conn;

    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    // kiekvieną eilutę atskirai
        while($row = mysqli_fetch_assoc($result)) {
            echo "id: " . $row["id"]. " - User: " . $row["firstname"]. " " . $row["lastname"].  " " . $row["email"]. " ".
            '<a href="?view=edit&id='.$row["id"].'">REDAGUOTI</a>'."<br>";
        }
    } else {
    echo "Nera useriu";
    }
}


function edit($id)
{
    
    
    global $conn;
    if(!$id){
        return [];
    }


    //UPDATE `users` SET `firstname` = 'Remigijus asasdasd' WHERE `users`.`id` = 1;
    $sql = "UPDATE `users` SET users WHERE id = $id";

    //var_dump($sql);

    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row;
    }
    else {
       return [];
    }
}

function save($data)
{
    global $conn;

    $sql = "INSERT INTO users (firstname, lastname, email, pass)
    VALUES ('".$data['firstname']."', '".$data['lastname']."', '".$data['email']."', '".$data['password']."')";



    if (mysqli_query($conn, $sql)) {
    //echo "New record created successfully";
    } else {
    //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    header('Location: http://localhost/grupe/web/RemisNemis/index.php?view=show');

}