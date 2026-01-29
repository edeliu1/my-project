<?php

if(!isset($_SESSION['user'])){
    header("Location: ../login.php");
    exit;
}
if(strtolower((string)($_SESSION['user']['role'] ?? '')) !== 'admin'){
    header("Location: ../index.php");
    exit;
}
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';
require __DIR__ . '/_csrf.php';

$error ='';
$success ='';


$id = (int)($_GET['id'] ?? 0);
if($id <= 0){
    header("Location: news_admin.php");
    exit;
}

$stmt = $pdo->prepare("SELECT id, title, body FROM news WHERE id = ?");
$stmt ->execute([$id]);
$news= $stmt->fetch(PDO::FETCH_ASSOC);

if(!$news){
    header("Location: news_admin.php?err=notfound");
    exit;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    csrf_check();

    $title = trim($_POST['title'] ?? '');
    $body = trim($_POST['body'] ?? '');

    if($title === '' || $body === ''){
        $error = 'Fill in the title and content!';
    }else{
        $stmt = $pdo->prepare("UPDATE news SET title = ?, body = ? WHERE id = ?");
        $stmt ->execute([$title, $body, $id]);

        $success = 'News updated successfully!';

        $news['title'] = $title;
        $news['body'] = $body;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit News</title>
  <link rel="stylesheet" href="../admin/dashboard.css">
</head>
<body>
    <div class="faqja">
        <div class="karta-header">
            <h2>Edit News</h2>
                <p class="welcome">Editing ID: <strong><?php echo (int)$news['id']; ?></strong></p>
        </div>

        <div class="forma-kartes">
            <?php if($error): ?>
                <div class="alert error"><?php echo htmlspecialchars($error);?></div>
                    <?php endif;?>

                    <?php if($success):?>
                        <div class="alert success"><?php echo htmlspecialchars($success);?></div>
                        <?php endif;?>

                        <form method="post">
                            <?php csrf_input();?>

                            <label for="title">Title</label>
                            <input id="title" type="text" name="title" value="<?php echo htmlspecialchars($news['title']);?>" required>

                            <label for="body">Content</label>
                            <textarea id="body" name="body" required><?php echo htmlspecialchars($news['body']); ?></textarea>

                            <div class="row">
                                <button class="butoni" type="submit">Save Changes</button>
                                <a class="buton i-dyte" href="news_admin.php">Back</a>
                    </div>
                    </form>
                    </div>
                    </div>
                    </body>
                    </html>
