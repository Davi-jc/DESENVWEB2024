<?php
$pasta = array(
    "bsn" => array(
        "3a Fase" => array(
            "desenvWeb",
            "bancoDados 1",
            "engSoft 1"
        ),
        "4a Fase" => array(
            "Intro Web",
            "bancoDados 2",
            "engSoft 2"
        )
    )
);

function criarArvore($array, $nivel = 0) {
    foreach ($array as $chave => $valor) {
        echo str_repeat("-", $nivel) . " ";
        
        if (is_array($valor)) {
            echo $chave . "<br>";
            criarArvore($valor, $nivel + 2);
        } else {
            echo $valor . "<br>";
        }
    }
}

criarArvore($pasta);
?>
