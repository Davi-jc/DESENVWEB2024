<?php
session_start();
require_once 'database.php';


if (!isset($_SESSION['dispositivo_id'])) {
    header("Location: dispositivo.php"); 
    exit;
}

$dispositivo_id = $_SESSION['dispositivo_id'];
$setor_id = $_SESSION['setor_id']; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $perguntas = array_map('intval', $_POST['perguntas']);
    $respostas = array_map('intval', $_POST['respostas']);
    $feedbacks = $_POST['feedbacks'];  

  
    $data_avaliacao = date('Y-m-d H:i:s');

   
    $stmt = $pdo->prepare("INSERT INTO avaliacoes (setor_id, dispositivo_id, data_hora) VALUES (?, ?, ?) RETURNING id");
    $stmt->execute([$setor_id, $dispositivo_id, $data_avaliacao]);
    $avaliacao_id = $stmt->fetchColumn();

    
    $stmt = $pdo->prepare("INSERT INTO respostas (avaliacao_id, pergunta_id, resposta, feedback) VALUES (?, ?, ?, ?)");
    foreach ($perguntas as $index => $pergunta_id) {
        $resp = $respostas[$index];
        $fb = isset($feedbacks[$index]) ? htmlspecialchars(trim($feedbacks[$index])) : null;
        $stmt->execute([$avaliacao_id, $pergunta_id, $resp, $fb]);
    }

   
    header("Location: back.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agradecimento</title>
    <link rel="stylesheet" href="styles.css">
    <script>
       
        setTimeout(function() {
            window.location.href = 'front.php'; 
        }, 10000); 
    </script>
</head>
<body>
    <div class="container">
        <h1>Obrigado pela sua avaliação!</h1>
        <p>O Hospital Regional Alto Vale (HRAV) agradece sua resposta e ela é muito importante para nós, pois nos ajuda a melhorar continuamente nossos serviços.</p>
    </div>
    <script>
       
        var timeLeft = 3;
        var timerElement = document.getElementById('timer');
        var countdown = setInterval(function() {
            timeLeft--;
            timerElement.textContent = timeLeft;
            if (timeLeft <= 0) {
                clearInterval(countdown);
            }
        }, 1000); 
    </script>
</body>
</html>