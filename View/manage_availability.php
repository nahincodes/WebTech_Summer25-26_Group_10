<?php
$required_role = "doctor";
include "../Controller/auth.php";
include "../Model/db.php";
$database   = new db();
$connection = $database->connection();
$slots      = $database->getDoctorSlots($connection, (int)$_SESSION["user_id"]);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Manage Availability</title>
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
        <h1>Manage Availability / Slots</h1>

        <form method="post" action="../Controller/AvailabilityController.php" onsubmit="return validateAvailability()">
            <fieldset>
                <legend>Add a Time Slot</legend>
                <table>
                    <tr>
                        <td><label for="adate">Date:</label></td>
                        <td><input type="date" id="adate" name="adate"></td>
                        <td><p class="error" id="adateError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="start">Start Time:</label></td>
                        <td><input type="time" id="start" name="start"></td>
                        <td><p class="error" id="startError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="end">End Time:</label></td>
                        <td><input type="time" id="end" name="end"></td>
                        <td><p class="error" id="endError"></p></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input class="btn" type="submit" value="Add Slot"></td>
                    </tr>
                </table>
            </fieldset>
        </form>

        <h3>My Current Slots</h3>
        <table class="data">
            <tr><th>Date</th><th>Start</th><th>End</th><th>Action</th></tr>
            <?php if ($slots && $slots->num_rows > 0): ?>
                <?php while ($s = $slots->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($s['slot_date']); ?></td>
                        <td><?php echo htmlspecialchars($s['start_time']); ?></td>
                        <td><?php echo htmlspecialchars($s['end_time']); ?></td>
                        <td><a class="btn small btn-danger" href="../Controller/AvailabilityController.php?action=delete&id=<?php echo $s['id']; ?>" onclick="return confirm('Delete this slot?')">Delete</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="4" class="empty">No slots added yet.</td></tr>
            <?php endif; ?>
        </table>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
