let expressao = '';

function inserir(valor) {
    expressao += valor;
    document.getElementById('resultado').value = expressao;
}

function operacao(operador) {
    expressao += ' ' + operador + ' ';
    document.getElementById('resultado').value = expressao;
}

function calcular() {
    try {
        let resultado = eval(expressao);
        exibirResultado(resultado);
        expressao = resultado.toString();
    } catch (error) {
        exibirResultado('Erro');
        expressao = '';
    }
}

function limpar() {
    expressao = '';
    document.getElementById('resultado').value = '';
    document.getElementById('resultado').style.backgroundColor = '#fff';
}

function exibirResultado(resultado) {
    const campoResultado = document.getElementById('resultado');
    campoResultado.value = resultado;
    if (resultado < 0) {
        campoResultado.style.backgroundColor = 'red';
    } else if (resultado > 0) {
        campoResultado.style.backgroundColor = 'green';
    } else if (resultado == 0) {
        campoResultado.style.backgroundColor = 'gray';
    } else {
        campoResultado.style.backgroundColor = 'white';
    }
}
