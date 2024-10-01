<?php
// Definindo o array conforme a estrutura dada
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

// Função recursiva para gerar a árvore
function criarArvore($array, $nivel = 0) {
    foreach ($array as $chave => $valor) {
        // Adiciona o recuo baseado no nível
        echo str_repeat("-", $nivel) . " ";
        
        if (is_array($valor)) {
            // Se a chave for um índice associativo
            echo $chave . "<br>";
            // Chama a função recursivamente para o próximo nível
            criarArvore($valor, $nivel + 2);
        } else {
            // Caso contrário, imprime o valor
            echo $valor . "<br>";
        }
    }
}

// Chama a função para imprimir a árvore
criarArvore($pasta);
?>
