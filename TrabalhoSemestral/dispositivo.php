<?php
session_start();
require_once 'database.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dispositivo_id = intval($_POST['dispositivo']);
    

    $stmt = $pdo->prepare("SELECT * FROM dispositivos WHERE id = ? AND status = 'ativo'");
    $stmt->execute([$dispositivo_id]);
    $dispositivo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($dispositivo) {

        $_SESSION['dispositivo_id'] = $dispositivo_id;
        $_SESSION['setor_id'] = $dispositivo['setor_id'];
        

        header("Location: front.php");
        exit;
    } else {
        $error = "Dispositivo inválido ou inativo.";
    }
}


$stmt = $pdo->prepare("SELECT * FROM dispositivos WHERE status = 'ativo'");
$stmt->execute();
$dispositivos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Selecionar Dispositivo</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Selecione o Dispositivo</h1>

    <?php if (isset($error)) { ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php } ?>

    <form action="dispositivo.php" method="POST">
        <label for="dispositivo">Dispositivos Ativos:</label>
        <select name="dispositivo" id="dispositivo">
            <?php foreach ($dispositivos as $dispositivo) { ?>
                <option value="<?php echo $dispositivo['id']; ?>">
                    <?php echo htmlspecialchars($dispositivo['nome']); ?>
                </option>
            <?php } ?>
        </select>
        <button type="submit">Selecionar</button>
    </form>
</body>
</html>
