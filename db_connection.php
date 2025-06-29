<?php
$host = 'aps.pregps.cl';
$user = 'root'; // o tu usuario de MySQL
$pass = 'FTGK2ZMzDjGqYT97eBRr';
$dbname = 'ecommerce';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
