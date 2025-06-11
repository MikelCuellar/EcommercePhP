
<?php
// Inicia la sesión del usuario
session_start();

// Conecta con la base de datos
$conn = new mysqli('aps.pregps.cl', 'root', 'FTGK2ZMzDjGqYT97eBRr', 'ecommerce');

// Si el formulario fue enviado por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Captura los datos del formulario
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encripta la contraseña
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Prepara la consulta SQL para insertar el usuario
    $stmt = $conn->prepare("INSERT INTO users (username, password, fullname, email, phone, address) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $password, $fullname, $email, $phone, $address);
    $stmt->execute(); // Ejecuta la consulta

    // Redirige al login con mensaje de éxito
    echo "<script>alert('Usuario registrado exitosamente'); window.location='login.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="style_auth.css">
    <script>
    // Función para validar que todos los campos estén llenos
    function validarRegistro() {
        const campos = ['username', 'password', 'fullname', 'email', 'phone', 'address'];
        for (let campo of campos) {
            if (document.forms['regForm'][campo].value.trim() === '') {
                alert('Por favor completa todos los campos.');
                return false;
            }
        }
        return true;
    }
    </script>
</head>
<body>
<form name="regForm" method="post" onsubmit="return validarRegistro()">
  <h2>Registro</h2>
  <input type="text" name="username" placeholder="Usuario" required>
  <input type="password" name="password" placeholder="Contraseña" required>
  <input type="text" name="fullname" placeholder="Nombre completo" required>
  <input type="email" name="email" placeholder="Correo electrónico" required>
  <input type="text" name="phone" placeholder="Teléfono" required>
  <input type="text" name="address" placeholder="Dirección" required>
  <button type="submit">Registrarse</button>
  <a href="login.php">¿Ya tienes cuenta?</a>
</form>
</body>
</html>
