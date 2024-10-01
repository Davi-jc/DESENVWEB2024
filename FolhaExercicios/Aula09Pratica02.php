<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Divisível por 2</title>
</head>
<body>
    <form method="post">
        Número: <input type="number" name="numero" required><br>
        <input type="submit" value="Verificar">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $numero = $_POST['numero'];

        if ($numero % 2 == 0) {
            echo "<p>Valor divisível por 2</p>";
        } else {
            echo "<p>O valor não é divisível por 2</p>";
        }
    }
    ?>
</body>
</html>
