<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Compras de Joãozinho</title>
</head>
<body>
    <form method="post">
        Maçã (R$/kg): <input type="number" name="maca" required><br>
        Melancia (R$/kg): <input type="number" name="melancia" required><br>
        Laranja (R$/kg): <input type="number" name="laranja" required><br>
        Repolho (R$/kg): <input type="number" name="repolho" required><br>
        Cenoura (R$/kg): <input type="number" name="cenoura" required><br>
        Batatinha (R$/kg): <input type="number" name="batatinha" required><br>
        Quantidade (kg): <input type="number" name="quantidade" required><br>
        <input type="submit" value="Calcular Total">
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $precos = [
            'maca' => $_POST['maca'],
            'melancia' => $_POST['melancia'],
            'laranja' => $_POST['laranja'],
            'repolho' => $_POST['repolho'],
            'cenoura' => $_POST['cenoura'],
            'batatinha' => $_POST['batatinha']
        ];
        $quantidade = $_POST['quantidade'];
        $total = 0;

        foreach ($precos as $preco) {
            $total += $preco * $quantidade;
        }

        $dinheiro = 50.00;

        if ($total < $dinheiro) {
            $restante = $dinheiro - $total;
            echo "<p style='color: blue;'>Você ainda pode gastar R$ $restante</p>";
        } elseif ($total > $dinheiro) {
            $falta = $total - $dinheiro;
            echo "<p style='color: red;'>Faltam R$ $falta</p>";
        } else {
            echo "<p style='color: green;'>Saldo para compras esgotado</p>";
        }
    }
    ?>
</body>
</html>
