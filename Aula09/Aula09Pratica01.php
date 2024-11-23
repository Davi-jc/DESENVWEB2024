<?php

$notas = [8.5, 7.2, 6.8, 9.0, 7.5];
$faltas = [1, 1, 0, 1, 1, 1, 1, 0, 1, 1];

function calcularMedia($notas) {
    $soma = array_sum($notas);
    $quantidade = count($notas);
    return $quantidade > 0 ? $soma / $quantidade : 0;
}

function verificarAprovacaoPorNota($media) {
    return $media >= 7 ? "Aprovado" : "Reprovado";
}

function calcularFrequencia($faltas) {
    $diasTotais = count($faltas);
    $diasPresentes = array_sum($faltas);
    return $diasTotais > 0 ? ($diasPresentes / $diasTotais) * 100 : 0;
}

function verificarAprovacaoPorFrequencia($frequencia) {
    return $frequencia > 70 ? "Aprovado" : "Reprovado";
}


$media = calcularMedia($notas);
$statusNota = verificarAprovacaoPorNota($media);
$frequencia = calcularFrequencia($faltas);
$statusFrequencia = verificarAprovacaoPorFrequencia($frequencia);

echo "Média das notas: " . number_format($media, 2) . "\n";
echo "Status por nota: " . $statusNota . "\n";
echo "Frequência: " . number_format($frequencia, 2) . "%\n";
echo "Status por frequência: " . $statusFrequencia . "\n";
?>
