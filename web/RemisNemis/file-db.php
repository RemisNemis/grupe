<?php

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