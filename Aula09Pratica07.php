<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Juros Mariazinha</title>
</head>
<body>
    <?php
    $valorAVista = 22500.00;
    $parcelas = 60;
    $valorParcela = 489.65;
    $totalFinanciado = $valorParcela * $parcelas;
    $juros = $totalFinanciado - $valorAVista;

    echo "<p>Valor gasto em juros: R$ $juros</p>";
    ?>
</body>
</html>