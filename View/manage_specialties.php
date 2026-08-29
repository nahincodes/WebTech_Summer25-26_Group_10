<?php
$required_role = "admin";
include "../Controller/auth.php";
include "../Model/db.php";
$database   = new db();
$connection = $database->connection();
$specs      = $database->getSpecialties($connection);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Manage Specialties</title>
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
        <h1>Manage Specialties</h1>

        <form method="post" action="../Controller/SpecialtyController.php" onsubmit="return validateSpecialty()">
            <fieldset>
                <legend>Add Specialty</legend>
                <table>
                    <tr>
                        <td><label for="specname">Specialty Name:</label></td>
                        <td><input type="text" id="specname" name="specname"></td>
                        <td><input class="btn" type="submit" value="Add"></td>
                    </tr>
                    <tr><td colspan="3"><p class="error" id="specnameError"></p></td></tr>
                </table>
            </fieldset>
        </form>

        <h3>Existing Specialties</h3>
        <table class="data">
            <tr><th>Specialty</th><th>Action</th></tr>
            <?php if ($specs && $specs->num_rows > 0): ?>
                <?php while ($s = $specs->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($s['name']); ?></td>
                        <td><a class="btn small btn-danger" href="../Controller/SpecialtyController.php?action=delete&id=<?php echo $s['id']; ?>" onclick="return confirm('Delete this specialty?')">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="2" class="empty">No specialties yet.</td></tr>
            <?php endif; ?>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
