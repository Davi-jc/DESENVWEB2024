<?php
session_start();
require_once 'database.php';


if (!isset($_SESSION['dispositivo_id'])) {
    header("Location: dispositivo.php"); 
    exit;
}

$dispositivo_id = $_SESSION['dispositivo_id'];
$setor_id = $_SESSION['setor_id'];


$stmt = $pdo->prepare("SELECT * FROM perguntas WHERE status = 'ativa' ORDER BY ordem ASC");
$stmt->execute();
$perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Avaliação de Serviços - HRAV</title>
</head>
<body>
    <h1>Avaliação de Serviços - HRAV</h1>

    <form id="evaluation-form" action="back.php" method="POST">
        <?php foreach ($perguntas as $index => $pergunta) { ?>
            <div class="question" id="question_<?php echo $index; ?>" style="display: <?php echo $index === 0 ? 'block' : 'none'; ?>;">
                <label for="pergunta_<?php echo $pergunta['id']; ?>">
                    <?php echo htmlspecialchars($pergunta['texto']); ?>
                </label>
                <input type="hidden" name="perguntas[]" value="<?php echo $pergunta['id']; ?>">
                <div class="rating-buttons">
                    <?php for ($i = 0; $i <= 10; $i++) { ?>
                        <button type="button" class="btn-<?php echo $i; ?>" onclick="setRating(<?php echo $index; ?>, <?php echo $i; ?>)">
                            <?php echo $i; ?>
                        </button>
                    <?php } ?>
                </div>
                <input type="hidden" name="respostas[]" id="resposta_<?php echo $index; ?>" value="">

                <div class="feedback-section">
                    <label for="feedback_<?php echo $index; ?>">Observações (opcional):</label>
                    <textarea id="feedback_<?php echo $index; ?>" name="feedbacks[]" rows="4" placeholder="Escreva aqui seus comentários..."></textarea>
                </div>
                
               
                <?php if ($index < count($perguntas) - 1) { ?>
                    <button type="button" onclick="showNextQuestion(<?php echo $index; ?>)">Próxima</button>
                <?php } else { ?>
                    <button type="submit">Enviar Avaliação</button>
                <?php } ?>
            </div>
        <?php } ?>

        <p id="selected-rating" style="text-align: center; font-size: 18px; margin-top: 10px;">Nenhuma avaliação selecionada.</p>
    </form>
    
    
    <!-- Botão de logout -->
    <form action="logout_dispositivo.php" method="POST">
        <button type="submit" id="sair">Sair</button>

    <script>
        function setRating(perguntaIndex, ratingValue) {
            document.getElementById('resposta_' + perguntaIndex).value = ratingValue;
            document.getElementById('selected-rating').textContent = "Você selecionou a nota " + ratingValue + " para a pergunta " + (perguntaIndex + 1);
        }

        function showNextQuestion(currentIndex) {
        
            document.getElementById('question_' + currentIndex).style.display = 'none';

  
            var nextIndex = currentIndex + 1;
            var nextQuestion = document.getElementById('question_' + nextIndex);
            if (nextQuestion) {
                nextQuestion.style.display = 'block';
            }

            var feedbackField = document.getElementById('feedback_' + nextIndex);
            if (feedbackField) {
                feedbackField.value = '';  
            }
        }
    </script>
</body>
</html>
