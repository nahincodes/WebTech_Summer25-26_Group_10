<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Welcome</title>
    <link rel="stylesheet" href="../Design/Style.css">
    <script src="../Javascript/Script.js"></script>
</head>
<body>
    <div class="header">
        <h2>🏥 MediBook</h2>
        <p>Doctor Appointment &amp; Clinic Booking System</p>
    </div>

    <div class="topnav">
      <a href="index.php">Home</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </div>

    <div class="container">
        <h1>Welcome to MediBook</h1>
        <p class="lead">Find a doctor by specialty, book an available time slot online, and manage
        your appointments — all in one place.</p>

        <div class="actions">
            <a class="btn" href="login.php">Login</a>
            <a class="btn btn-alt" href="register.php">Create an Account</a>
        </div>

        <hr>
        <!-- Demo shortcuts: let the evaluator explore each role before the backend/login is wired.
             These will be replaced by a session-based redirect after successful login. -->
        <h3>Explore the dashboards (demo)</h3>
        <div class="actions">
            <a class="btn small" href="patient_dashboard.php">Patient view</a>
            <a class="btn small" href="doctor_dashboard.php">Doctor view</a>
            <a class="btn small" href="admin_dashboard.php">Admin view</a>
        </div>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
