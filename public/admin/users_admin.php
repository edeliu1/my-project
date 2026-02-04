<?php
require __DIR__ . '/_guard.php';
require __DIR__ . '/_db.php';
require __DIR__ . '/_csrf.php';

$users = $pdo->query("
    SELECT id, name, email, role, is_active, created_at
    FROM users
    ORDER BY id DESC
")->fetchAll(PDO::FETCH_ASSOC);

$myId = (int)($_SESSION['user']['id'] ?? 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Management</title>
    <link rel="stylesheet" href="users_admin.css">
</head>
<body>

<header class="topbar">
  <div class="brand">Admin Dashboard</div>
  <nav class="nav">
    <a href="news_admin.php">News</a>
    <a href="messages_admin.php">Messages</a>
    <a class="active" href="users_admin.php">Users</a>
    <a href="../index.php">Home</a>
  </nav>
</header>


<main class="wrap">
    <div class="header-row">
        <h1>Users</h1>
        <div class="hint">
            Manage user roles, activation status and deletion.
        </div>
    </div>

    <div class="card">
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th class="actions-col">Actions</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (!$users): ?>
                    <tr>
                        <td colspan="7" class="empty">No users found.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($users as $u): ?>
                    <?php
                        $id = (int)$u['id'];
                        $isMe = ($id === $myId);
                        $active = ((int)$u['is_active'] === 1);
                        $role = strtolower((string)$u['role']);
                    ?>
                    <tr class="<?php echo $active ? '' : 'row-disabled'; ?>">
                        <td><?php echo htmlspecialchars((string)$u['id']); ?></td>
                        <td><?php echo htmlspecialchars((string)$u['name']); ?></td>
                        <td><?php echo htmlspecialchars((string)$u['email']); ?></td>
                        <td>
                            <span class="badge <?php echo $role === 'admin' ? 'badge-admin' : 'badge-user'; ?>">
                                <?php echo $role; ?>
                            </span>
                        </td>
                        <td>
                            <span class="badge <?php echo $active ? 'badge-ok' : 'badge-off'; ?>">
                                <?php echo $active ? 'active' : 'disabled'; ?>
                            </span>
                        </td>
                        <td><?php echo htmlspecialchars((string)$u['created_at']); ?></td>
                        <td class="actions">

                            <form class="inline" method="post" action="user_role_update.php">
                                <?php csrf_input(); ?>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <select name="role" <?php echo $isMe ? 'disabled' : ''; ?>>
                                    <option value="user" <?php echo $role === 'user' ? 'selected' : ''; ?>>
                                        user
                                    </option>
                                    <option value="admin" <?php echo $role === 'admin' ? 'selected' : ''; ?>>
                                        admin
                                    </option>
                                </select>
                                <button class="btn" type="submit" <?php echo $isMe ? 'disabled' : ''; ?>>
                                    Save
                                </button>
                            </form>

                            <form class="inline" method="post" action="user_toggle_active.php">
                                <?php csrf_input(); ?>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button
                                    class="btn <?php echo $active ? 'btn-warn' : 'btn-ok'; ?>"
                                    type="submit"
                                    <?php echo $isMe ? 'disabled' : ''; ?>
                                >
                                    <?php echo $active ? 'Disable' : 'Enable'; ?>
                                </button>
                            </form>

                            <form
                                class="inline"
                                method="post"
                                action="user_delete.php"
                                onsubmit="return confirm('Are you sure you want to delete this user?');"
                            >
                                <?php csrf_input(); ?>
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <button
                                    class="btn btn-danger"
                                    type="submit"
                                    <?php echo $isMe ? 'disabled' : ''; ?>
                                >
                                    Delete
                                </button>
                            </form>

                            <?php if ($isMe): ?>
                                <span class="me-note">This is you</span>
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</main>

</body>
</html>
