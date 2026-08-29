<?php
include "../Controller/auth.php";
include "../Controller/ProfileController.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Profile</title>
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
        <h1>Manage Profile</h1>

        <?php if (!empty($message)): ?>
            <p class="lead" style="color:#2b8a3e;"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="post" action="" onsubmit="return validateProfile()">
            <fieldset>
                <legend>My Information</legend>
                <table>
                    <tr>
                        <td><label for="pname">Full Name:</label></td>
                        <td><input type="text" id="pname" name="pname" value="<?php echo htmlspecialchars($user["name"]); ?>"></td>
                        <td><p class="error" id="pnameError"></p></td>
                    </tr>
                    <tr>
                        <td><label>Email:</label></td>
                        <td><input type="text" value="<?php echo htmlspecialchars($user["email"]); ?>" readonly></td>
                        <td><span class="appt-meta">Email can't be changed</span></td>
                    </tr>
                    <tr>
                        <td><label for="pphone">Phone:</label></td>
                        <td><input type="text" id="pphone" name="pphone" value="<?php echo htmlspecialchars($user["phone"] ?? ""); ?>"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label for="pspecialty">Specialty:</label></td>
                        <td><input type="text" id="pspecialty" name="pspecialty" value="<?php echo htmlspecialchars($user["specialty"] ?? ""); ?>" placeholder="Doctors only"></td>
                        <td><span class="appt-meta">Role: <?php echo htmlspecialchars($user["role"]); ?></span></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input class="btn" type="submit" value="Save Changes">
                            <a class="btn btn-danger" href="../Controller/ProfileController.php?action=delete" onclick="return confirm('Delete your account permanently? This cannot be undone.')">Delete Account</a>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
