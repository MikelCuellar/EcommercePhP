<?php
session_start();
$conn = new mysqli('aps.pregps.cl', 'root', 'FTGK2ZMzDjGqYT97eBRr', 'ecommerce');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $stmt = $conn->prepare("SELECT id, password FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;  
            header("Location: products_view.php");
            exit();
        }
    }
    echo "<script>alert('Credenciales inválidas');</script>";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-wrapper">
  <div class="login-image">
    <img src="img/portada.jpg" alt="Imagen login">
  </div>

  <div class="login-form-container">
    <div class="simple-navbar">
      <a href="products_view.php" class="logo-centered">DEPORTIVA</a>
    </div>

    <form method="post">
      <h2>Iniciar Sesión</h2>
      <input type="text" name="username" placeholder="Usuario" required>
      <input type="password" name="password" placeholder="Contraseña" required>
      <button type="submit">Ingresar</button>
      <a href="register.php">Crear una cuenta</a>
    </form>
  </div>
</div>

</body>
</html>

