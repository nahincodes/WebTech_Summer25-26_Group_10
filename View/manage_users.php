<?php
$required_role = "admin";
include "../Controller/auth.php";
include "../Model/db.php";
$database   = new db();
$connection = $database->connection();
$users      = $database->getAllUsers($connection);

function ubadge($s) {
    if ($s === "active")  return "ok";
    if ($s === "pending") return "wait";
    return "no"; // inactive / rejected
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Manage Users</title>
    <link rel="stylesheet" href="../Design/Style.css">
    <script src="../Javascript/Script.js"></script>
</head>
<body>
    <div class="header">
        <h2>🏥 MediBook</h2>
        <p>Doctor Appointment &amp; Clinic Booking System</p>
    </div>
    <?php include "nav.php"; ?>

    <div class="container">
        <h1>Manage Users</h1>
        <p class="lead">Activate or deactivate an account, or remove it entirely.</p>

        <table class="data">
            <tr><th>Name</th><th>Role</th><th>Email</th><th>Status</th><th>Actions</th></tr>
            <?php if ($users && $users->num_rows > 0): ?>
                <?php while ($u = $users->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($u["name"]); ?></td>
                        <td><?php echo htmlspecialchars($u["role"]); ?></td>
                        <td><?php echo htmlspecialchars($u["email"]); ?></td>
                        <td><span class="badge <?php echo ubadge($u["status"]); ?>"><?php echo htmlspecialchars($u["status"]); ?></span></td>
                        <td>
                            <?php if ($u["status"] === "active"): ?>
                                <a class="btn small" href="../Controller/AdminController.php?action=deactivate&id=<?php echo $u["id"]; ?>">Deactivate</a>
                            <?php else: ?>
                                <a class="btn small" href="../Controller/AdminController.php?action=activate&id=<?php echo $u["id"]; ?>">Activate</a>
                            <?php endif; ?>
                            <a class="btn small btn-danger" href="../Controller/AdminController.php?action=remove&id=<?php echo $u["id"]; ?>" onclick="return confirm('Remove this user permanently?')">Remove</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5" class="empty">No users found.</td></tr>
            <?php endif; ?>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
