<?php
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';
require __DIR__ . '/_csrf.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    csrf_check();

    $title = trim($_POST['title'] ?? '');
    $body  = trim($_POST['body'] ?? '');

    if ($title === '' || $body === '') {
        $error = 'Fill in the title and content!';
    } else {
        $stmt = $pdo->prepare("
            INSERT INTO news (title, body, created_by, created_at)
            VALUES (?, ?, ?, NOW())
        ");
        $stmt->execute([
            $title,
            $body,
            (int)$_SESSION['user']['id']
        ]);

        header("Location: news_admin.php?ok=1");
        exit;
    }
}

if (isset($_GET['ok'])) {
    $success = 'The news was added successfully!';
}

$rows = $pdo->query("
    SELECT id, title, created_at
    FROM news
    ORDER BY id DESC
")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage News</title>
  <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="permbajtja-admin">
        <div class="shiriti-navigimit">
            <h2>Manage News</h2>
            <div class="lidhjet">
                <a href="dashboard.php">Dashboard</a>
                <a href="../logout.php">Logout</a>
            </div>
        </div>

            <?php if ($error): ?>
                <div class="njoftim gabim"><?= htmlspecialchars($error)?></div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="njoftim sukses"><?= htmlspecialchars($success)?></div>
            <?php endif; ?>

            <div class="kartela">
                <h3>Add News</h3>
                <form method="post">
                    <?php csrf_input();?>

                    <label>Title</label>
                    <input type="text" name="title" required>

                    <label>Content</label>
                    <textarea name="body" rows="5" required></textarea>

                    <button type="submit">Add</button>
                </form>
            </div>

            <div class="kartela">
                <h3>Existing News</h3>
                <table class="tabela-admin">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php foreach ($rows as $r):?>
                    <tr>
                        <td><?= (int)$r['id'] ?></td>
                        <td><?= htmlspecialchars($r['title']) ?></td>
                        <td><?= htmlspecialchars($r['created_at'] ?? '') ?></td>
                        
                        <td class="veprimet">
                            <a class="button" href="news_edit.php?id=<?= (int)$r['id'] ?>">Edit</a>

                            <form method="post" action="news_delete.php" style="display:inline">
                                <?php csrf_input(); ?>
                                <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                                <button class="button rrezik" type="submit" onclick="return confirm('Are you sure you want to delete this news?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>
