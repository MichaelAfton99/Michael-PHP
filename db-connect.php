<?php

$conn = mysqli_connect('localhost','Michael','icode1234','oos_database');

if(!$conn){
    echo 'Connection error: ' . mysqli_connect_error();
}
?>