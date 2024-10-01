<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Parcelas Paulinho</title>
</head>
<body>
    <?php
    $valorVista = 8654.00;
    $parcelas = [24, 36, 48, 60];
    $taxaInicial = 1.5 / 100; // 1.5%

    foreach ($parcelas as $n) {
        $taxa = $taxaInicial + (($n - 24) * 0.005);
        $juros = $valorVista * $taxa * $n;
        $valorTotal = $valorVista + $juros;
        $valorParcela = $valorTotal / $n;

        echo "<p>Valor da parcela para $n vezes: $valorParcela</p>";
    }
    ?>
</body>
</html>