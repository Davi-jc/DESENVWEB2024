

document.getElementById('evaluationForm').addEventListener('submit', function(e) {
    const respostas = document.querySelectorAll('input[type="number"]');
    let valid = true;
    respostas.forEach(function(input) {
        const value = parseInt(input.value);
        if (isNaN(value) || value < 0 || value > 10) {
            valid = false;
            input.style.borderColor = 'red';
        } else {
            input.style.borderColor = '';
        }
    });

    if (!valid) {
        e.preventDefault();
        alert('Por favor, insira valores válidos entre 0 e 10 para todas as perguntas.');
    }

});
