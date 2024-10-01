<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Parcelas Juquinha (Juros Compostos)</title>
</head>
<body>
    <?php
    $valorVista = 8654.00;
    $parcelas = [24, 36, 48, 60];
    $taxaInicial = 2.0 / 100; // 2%

    foreach ($parcelas as $n) {
        $taxa = $taxaInicial + (($n - 24) / 12 * 0.003);
        $montante = $valorVista * pow(1 + $taxa, $n);
        $valorParcela = $montante / $n;
        echo "<p>Valor da parcela para $n vezes: R$ " . number_format($valorParcela, 2, ',', '.') . "</p>";
    }
    ?>
</body>
</html>