
<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'ecommerce');
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
            header("Location: products.php");
            exit();
        }
    }
    echo "<script>alert('Credenciales inválidas');</script>";
}
?>
<!DOCTYPE html><html><head><title>Login</title>
<link rel='stylesheet' href='style_auth.css'>
</head><body>
<form method="post">
  <h2>Iniciar Sesión</h2>
  <input type="text" name="username" placeholder="Usuario" required>
  <input type="password" name="password" placeholder="Contraseña" required>
  <button type="submit">Ingresar</button>
  <a href="register.php">Crear una cuenta</a>
</form>
</body></html>
