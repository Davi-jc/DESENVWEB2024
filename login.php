<?php
session_start();
require_once 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars(trim($_POST['username']));
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios_admin WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($password == $user['senha']){
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $stmt1 = $pdo->prepare("UPDATE usuarios_admin SET senha = ? WHERE username = ?");
    $result = $stmt1->execute([$hashed_password, $username]);
    }

    if ($user && password_verify($password, $user['senha'])) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: dashboard.php");
        exit;
    } else {
        $error = "Credenciais inválidas.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login Administrativo - HRAV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Login Administrativo</h1>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
        <form action="login.php" method="POST">
            <div class="question">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="question">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>