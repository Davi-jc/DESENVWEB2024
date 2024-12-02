<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once 'database.php';

$stmt = $pdo->prepare("
    SELECT s.nome AS setor, p.texto AS pergunta, AVG(r.resposta) AS media
    FROM respostas r
    JOIN avaliacoes a ON r.avaliacao_id = a.id
    JOIN perguntas p ON r.pergunta_id = p.id
    JOIN setores s ON a.setor_id = s.id
    WHERE s.status = 'ativo' AND p.status = 'ativa'
    GROUP BY s.nome, p.texto, p.ordem
    ORDER BY s.nome, p.ordem
");
$stmt->execute();
$medias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrativo - HRAV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Dashboard Administrativo</h1>
        <a href="admin.php">Gerenciar Perguntas</a> |
        <a href="admin_ll.php">Gerenciar Dispositivos</a> |
        <a href="logout.php">Sair</a>
        <h2>Médias das Avaliações</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>Setor</th>
                    <th>Pergunta</th>
                    <th>Média</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($medias as $media): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($media['setor']); ?></td>
                        <td><?php echo htmlspecialchars($media['pergunta']); ?></td>
                        <td><?php echo number_format($media['media'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
       
    </div>
    <h2>Gráfico de Médias das Avaliações por Setor</h2>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
   
    const labels = [<?php 
        $uniqueSetores = array_unique(array_column($medias, 'setor'));
        foreach ($uniqueSetores as $setor) {
            echo "'".addslashes($setor)."',";
        }
    ?>];
    const data = {
        labels: labels,
        datasets: [{
            label: 'Média das Avaliações',
            data: [<?php 
                foreach ($uniqueSetores as $setor) {
                    $avg = 0;
                    $count = 0;
                    foreach ($medias as $media) {
                        if ($media['setor'] === $setor) {
                            $avg += $media['media'];
                            $count++;
                        }
                    }
                    $average = $count > 0 ? $avg / $count : 0;
                    echo number_format($average, 2).',';
                }
            ?>],
            backgroundColor: 'rgba(40, 167, 69, 0.2)',
            borderColor: 'rgba(40, 167, 69, 1)',
            borderWidth: 1
        }]
    };
    const config = {
        type: 'bar',
        data: data,
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 10
                }
            }
        },
    };
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>
</body>
</html>
