<?php


$servername = "localhost";
$username ="root";
$password = "";
$database = "TicoGourmet";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
    die("Conexion fallida: ".$conn->connect_error);
}

echo "Conexion es exitosa";
 
 
