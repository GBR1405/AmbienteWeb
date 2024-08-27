<?php


$servername = "localhost";
$username ="root";
$password = "Pacman123";
$database = "TicoGourmet";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
    die("Conexion fallida: ".$conn->connect_error);
}
