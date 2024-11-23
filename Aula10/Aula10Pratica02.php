<?php
session_start();

if (!isset($_COOKIE['usuario']) || !isset($_COOKIE['inicio_sessao'])) {
    echo "<script>alert('Os dados da sessão foram perdidos. Faça login novamente.');</script>";
    exit();
}

$horaAtual = date('Y-m-d H:i:s');
$tempoSessao = strtotime($horaAtual) - strtotime($_SESSION['inicio_sessao']);
$_SESSION['ultima_requisicao'] = $horaAtual;
$_SESSION['tempo_sessao'] = $tempoSessao;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sessão do Usuário</title>
</head>
<body>
    <h2>Sessão do Usuário</h2>
    <p><strong>Usuário (via Cookie):</strong> <?php echo htmlspecialchars($_COOKIE['usuario']); ?></p>
    <p><strong>Data/hora início da sessão (via Cookie):</strong> <?php echo htmlspecialchars($_COOKIE['inicio_sessao']); ?></p>
    <p><strong>Data/hora da última requisição:</strong> <?php echo $_SESSION['ultima_requisicao']; ?></p>
    <p><strong>Tempo de sessão (segundos):</strong> <?php echo $_SESSION['tempo_sessao']; ?></p>
</body>
</html>
