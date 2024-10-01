<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área do Triângulo Retângulo</title>
</head>
<body>
    <form method="post">
        Base (m): <input type="number" name="base" required><br>
        Altura (m): <input type="number" name="altura" required><br>
        <input type="submit" value="Calcular Área">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $base = $_POST['base'];
        $altura = $_POST['altura'];
        $area = ($base * $altura) / 2;
        echo "<p>A área do triângulo retângulo com base $base e altura $altura é $area metros quadrados.</p>";
    }
    ?>
</body>
</html>
