<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Área do Quadrado</title>
</head>
<body>
    <form method="post">
        Comprimento do lado (m): <input type="number" name="lado" required><br>
        <input type="submit" value="Calcular Área">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $lado = $_POST['lado'];
        $area = $lado * $lado;
        echo "<p>A área do quadrado de lado $lado metros é $area metros quadrados.</p>";
    }
    ?>
</body>
</html>
