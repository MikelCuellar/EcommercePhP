<?php
$host = 'aps.pregps.cl';
$user = 'root';
$pass = 'FTGK2ZMzDjGqYT97eBRr';
$dbname = 'ecommerce';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$result = $conn->query("DESCRIBE users");

echo "<h3>Columnas de la tabla 'users'</h3><ul>";
while ($row = $result->fetch_assoc()) {
    echo "<li>{$row['Field']} ({$row['Type']})</li>";
}
echo "</ul>";

$conn->close();
?>
