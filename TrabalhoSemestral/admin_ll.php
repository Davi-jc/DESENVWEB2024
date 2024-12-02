<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit;
}
require_once 'database.php';


if (isset($_POST['add_device'])) {
    $nome = htmlspecialchars(trim($_POST['nome']));
    $status = $_POST['status'] === 'ativo' ? 'ativo' : 'inativo';
    $setor_id = intval($_POST['setor_id']);
    $stmt = $pdo->prepare("INSERT INTO dispositivos (nome, status, setor_id) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $status, $setor_id]);
    header("Location: admin_ll.php");
    exit;
}


if (isset($_POST['edit_device'])) {
    $id = intval($_POST['id']);
    $nome = htmlspecialchars(trim($_POST['nome']));
    $status = $_POST['status'] === 'ativo' ? 'ativo' : 'inativo';
    $setor_id = intval($_POST['setor_id']);
    $stmt = $pdo->prepare("UPDATE dispositivos SET nome = ?, status = ?, setor_id = ? WHERE id = ?");
    $stmt->execute([$nome, $status, $setor_id, $id]);
    header("Location: admin_ll.php");
    exit;
}


$editing_device = false;
if (isset($_GET['edit'])) {
    $editing_device = true;
    $id = intval($_GET['edit']);
    $stmt = $pdo->prepare("SELECT * FROM dispositivos WHERE id = ?");
    $stmt->execute([$id]);
    $dispositivo_edit = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (isset($_GET['disable'])) {
    $id = intval($_GET['disable']);
    $stmt = $pdo->prepare("UPDATE dispositivos SET status = 'inativo' WHERE id = ?");
    $stmt->execute([$id]);
    header("Location: admin_ll.php");
    exit;
}


$stmt = $pdo->prepare("SELECT d.*, s.nome AS setor_nome FROM dispositivos d JOIN setores s ON d.setor_id = s.id ORDER BY d.id ASC");
$stmt->execute();
$dispositivos = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt = $pdo->prepare("SELECT * FROM setores WHERE status = 'ativo' ORDER BY nome ASC");
$stmt->execute();
$setores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Gerenciar Dispositivos - HRAV</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Gerenciar Dispositivos</h1>
        <a href="dashboard.php">Voltar ao Dashboard</a>

        <h2><?php echo $editing_device ? "Editar Dispositivo" : "Adicionar Novo Dispositivo"; ?></h2>
        <form action="admin_ll.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $editing_device ? $dispositivo_edit['id'] : ''; ?>">
            <div class="question">
                <label for="nome">Nome do Dispositivo:</label>
                <input type="text" id="nome" name="nome" required value="<?php echo $editing_device ? htmlspecialchars($dispositivo_edit['nome']) : ''; ?>">
            </div>
            <div class="question">
                <label for="setor_id">Setor:</label>
                <select id="setor_id" name="setor_id" required>
                    <?php foreach ($setores as $setor): ?>
                        <option value="<?php echo $setor['id']; ?>" <?php echo $editing_device && $dispositivo_edit['setor_id'] == $setor['id'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($setor['nome']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="question">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="ativo" <?php echo $editing_device && $dispositivo_edit['status'] === 'ativo' ? 'selected' : ''; ?>>Ativo</option>
                    <option value="inativo" <?php echo $editing_device && $dispositivo_edit['status'] === 'inativo' ? 'selected' : ''; ?>>Inativo</option>
                </select>
            </div>
            <button type="submit" name="<?php echo $editing_device ? 'edit_device' : 'add_device'; ?>">
                <?php echo $editing_device ? 'Salvar Alterações' : 'Adicionar Dispositivo'; ?>
            </button>
        </form>

        <h2>Lista de Dispositivos</h2>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Setor</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($dispositivos as $dispositivo): ?>
                    <tr>
                        <td><?php echo $dispositivo['id']; ?></td>
                        <td><?php echo htmlspecialchars($dispositivo['nome']); ?></td>
                        <td><?php echo htmlspecialchars($dispositivo['setor_nome']); ?></td>
                        <td><?php echo $dispositivo['status']; ?></td>
                        <td>
                            <a href="admin_ll.php?edit=<?php echo $dispositivo['id']; ?>">Editar</a> |
                            <a href="admin_ll.php?disable=<?php echo $dispositivo['id']; ?>" onclick="return confirm('Tem certeza que deseja desabilitar este dispositivo?');">Desabilitar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
