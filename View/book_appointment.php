<?php
$required_role = "patient";
include "../Controller/auth.php";
include "../Model/db.php";
$database   = new db();
$connection = $database->connection();
$doctors    = $database->getActiveDoctors($connection);
$preselect  = (int)($_GET["doctor_id"] ?? 0);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Book Appointment</title>
    <link rel="stylesheet" href="../Design/Style.css">
    <script src="../Javascript/Script.js"></script>
</head>
<body>
    <div class="header">
        <h2>🏥 MediBook</h2>
        <p>Doctor Appointment &amp; Clinic Booking System</p>
    </div>
    <div class="topnav">
      <a href="patient_dashboard.php">Dashboard</a>
      <a href="search_doctors.php">Search Doctors</a>
      <a href="book_appointment.php">Book Appointment</a>
      <a href="my_appointments.php">My Appointments</a>
      <a href="rate_doctor.php">Rate Doctor</a>
      <a href="profile.php">Profile</a>
      <a href="change_password.php">Change Password</a>
      <a class="right" href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h1>Book Appointment</h1>
        <form method="post" action="../Controller/BookingController.php" onsubmit="return validateBooking()">
            <fieldset>
                <legend>Appointment Details</legend>
                <table>
                    <tr>
                        <td><label for="doctor_id">Doctor:</label></td>
                        <td>
                            <select id="doctor_id" name="doctor_id">
                                <option value="">-- Select a doctor --</option>
                                <?php if ($doctors) while ($d = $doctors->fetch_assoc()): ?>
                                    <option value="<?php echo $d['id']; ?>" <?php echo ($preselect == $d['id']) ? "selected" : ""; ?>>
                                        <?php echo htmlspecialchars($d['name']); ?><?php echo $d['specialty'] ? " — ".htmlspecialchars($d['specialty']) : ""; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </td>
                        <td><p class="error" id="doctorError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="date">Date:</label></td>
                        <td><input type="date" id="date" name="date"></td>
                        <td><p class="error" id="dateError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="slot">Time Slot:</label></td>
                        <td>
                            <select id="slot" name="slot">
                                <option value="">-- Select a slot --</option>
                                <option>10:00 AM</option>
                                <option>11:00 AM</option>
                                <option>12:00 PM</option>
                                <option>04:00 PM</option>
                                <option>05:00 PM</option>
                            </select>
                        </td>
                        <td><p class="error" id="slotError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="reason">Reason:</label></td>
                        <td><textarea id="reason" name="reason" rows="3" cols="24" style="resize:none"></textarea></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input class="btn" type="submit" value="Confirm Booking">
                            <a class="btn btn-alt" href="my_appointments.php">View My Appointments</a>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </form>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
