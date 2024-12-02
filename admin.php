<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once 'database.php';


if (isset($_POST['add_question'])) {
    $texto = htmlspecialchars(trim($_POST['texto']));
    $ordem = intval($_POST['ordem']);
    $stmt = $pdo->prepare("INSERT INTO perguntas (texto, ordem) VALUES (?, ?)");
    $stmt->execute([$texto, $ordem]);
    header("Location: admin.php");
    exit;
}


if (isset($_POST['edit_question'])) {
    $id = intval($_POST['id']);
    $texto = htmlspecialchars(trim($_POST['texto']));
    $ordem = intval($_POST['ordem']);
    $status = $_POST['status'] === 'ativa' ? 'ativa' : 'inativa';
    $stmt = $pdo->prepare("UPDATE perguntas SET texto = ?, ordem = ?, status = ? WHERE id = ?");
    $stmt->execute([$texto, $ordem, $status, $id]);
    header("Location: admin.php");
    exit;
}


if (isset($_GET['disable'])) {
    $id = intval($_GET['disable']);
    $stmt = $pdo->prepare("UPDATE perguntas SET status = 'inativa' WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin.php");
    exit;
}


$stmt = $pdo->prepare("SELECT * FROM perguntas ORDER BY ordem ASC");
$stmt->execute();
$perguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);


$editing_question = false;
if (isset($_GET['edit'])) {
    $editing_question = true;
    $id = intval($_GET['edit']);
    $stmt = $pdo->prepare("SELECT * FROM perguntas WHERE id = ?");
    $stmt->execute([$id]);
    $pergunta_edit = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Perguntas - HRAV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciar Perguntas</h1>
        <a href="dashboard.php">Voltar ao Dashboard</a>
        <h2><?php echo $editing_question ? "Editar Pergunta" : "Adicionar Nova Pergunta"; ?></h2>
        <form action="admin.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $editing_question ? $pergunta_edit['id'] : ''; ?>">
            <div class="question">
                <label for="texto">Texto da Pergunta:</label>
                <textarea id="texto" name="texto" rows="3" required><?php echo $editing_question ? htmlspecialchars($pergunta_edit['texto']) : ''; ?></textarea>
            </div>
            <div class="question">
                <label for="ordem">Ordem:</label>
                <input type="number" id="ordem" name="ordem" min="1" required value="<?php echo $editing_question ? $pergunta_edit['ordem'] : ''; ?>">
            </div>
            <div class="question">
                <label for="status">Status:</label>
                <select id="status" name="status">
                    <option value="ativa" <?php echo $editing_question && $pergunta_edit['status'] === 'ativa' ? 'selected' : ''; ?>>Ativa</option>
                    <option value="inativa" <?php echo $editing_question && $pergunta_edit['status'] === 'inativa' ? 'selected' : ''; ?>>Inativa</option>
                </select>
            </div>
            <button type="submit" name="<?php echo $editing_question ? 'edit_question' : 'add_question'; ?>">
                <?php echo $editing_question ? 'Salvar Alterações' : 'Adicionar Pergunta'; ?>
            </button>
        </form>

        <h2>Lista de Perguntas</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Texto</th>
                    <th>Ordem</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($perguntas as $pergunta): ?>
                    <tr>
                        <td><?php echo $pergunta['id']; ?></td>
                        <td><?php echo htmlspecialchars($pergunta['texto']); ?></td>
                        <td><?php echo $pergunta['ordem']; ?></td>
                        <td><?php echo $pergunta['status']; ?></td>
                        <td>
                            <a href="admin.php?edit=<?php echo $pergunta['id']; ?>">Editar</a> |
                            <a href="admin.php?disable=<?php echo $pergunta['id']; ?>" onclick="return confirm('Tem certeza que deseja desabilitar esta pergunta?');">Desabilitar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>