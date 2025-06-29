<?php
$host = 'aps.pregps.cl';
$user = 'root';
$pass = 'FTGK2ZMzDjGqYT97eBRr';
$dbname = 'ecommerce';

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$result = $conn->query("SHOW TABLES");

echo "<h3>Tablas en la base de datos '$dbname'</h3><ul>";
while ($row = $result->fetch_array()) {
    echo "<li>{$row[0]}</li>";
}
echo "</ul>";

$conn->close();
?>
