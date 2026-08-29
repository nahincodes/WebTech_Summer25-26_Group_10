<?php
$required_role = "doctor";
include "../Controller/auth.php";
include "../Model/db.php";
$database   = new db();
$connection = $database->connection();
$appts      = $database->getDoctorAppointments($connection, (int)$_SESSION["user_id"]);

function badge_class($s) {
    if ($s === "Accepted" || $s === "Confirmed") return "ok";
    if ($s === "Completed") return "done";
    if ($s === "Pending")   return "wait";
    return "no";
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Doctor Appointments</title>
    <link rel="stylesheet" href="../Design/Style.css">
    <script src="../Javascript/Script.js"></script>
</head>
<body>
    <div class="header">
        <h2>🏥 MediBook</h2>
        <p>Doctor Appointment &amp; Clinic Booking System</p>
    </div>
    <div class="topnav">
      <a href="doctor_dashboard.php">Dashboard</a>
      <a href="doctor_appointments.php">Appointments</a>
      <a href="manage_availability.php">Availability</a>
      <a href="write_notes.php">Prescription Notes</a>
      <a href="doctor_reviews.php">Reviews</a>
      <a href="profile.php">Profile</a>
      <a href="change_password.php">Change Password</a>
      <a class="right" href="logout.php">Logout</a>
    </div>

    <div class="container">
        <h1>Appointment Requests</h1>
        <p class="lead">Accept, reject, or complete a request. Your choice instantly updates what the patient sees.</p>

        <ul class="appt-list">
            <?php if ($appts && $appts->num_rows > 0): ?>
                <?php while ($a = $appts->fetch_assoc()): $s = $a['status']; ?>
                    <li>
                        <div class="appt-main">
                            <strong><?php echo htmlspecialchars($a['patient_name']); ?></strong>
                            <div class="appt-meta">📅 <?php echo htmlspecialchars($a['appt_date']); ?> &nbsp; 🕒 <?php echo htmlspecialchars($a['appt_time']); ?><?php echo $a['reason'] ? " &nbsp;·&nbsp; ".htmlspecialchars($a['reason']) : ""; ?></div>
                        </div>
                        <div class="appt-side">
                            <span class="badge <?php echo badge_class($s); ?>"><?php echo htmlspecialchars($s); ?></span>
                            <?php if ($s === "Pending"): ?>
                                <a class="btn small" href="../Controller/AppointmentController.php?action=accept&id=<?php echo $a['id']; ?>">Accept</a>
                                <a class="btn small btn-danger" href="../Controller/AppointmentController.php?action=reject&id=<?php echo $a['id']; ?>">Reject</a>
                            <?php elseif ($s === "Accepted"): ?>
                                <a class="btn small" href="../Controller/AppointmentController.php?action=complete&id=<?php echo $a['id']; ?>">Complete</a>
                                <a class="btn small" href="write_notes.php">Write Notes</a>
                            <?php endif; ?>
                        </div>
                    </li>
                <?php endwhile; ?>
            <?php else: ?>
                <li class="empty">No appointment requests yet.</li>
            <?php endif; ?>
        </ul>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
