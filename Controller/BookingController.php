<?php
/*
 * Controller/BookingController.php
 *  - POST  -> create a new appointment (Pending)
 *  - GET   -> BookingController.php?action=cancel&id=X  (patient cancels)
 */
include "../Model/db.php";
if (session_status() === PHP_SESSION_NONE) session_start();

// only a logged-in patient
if (empty($_SESSION["logged_in"]) || $_SESSION["role"] !== "patient") {
    header("Location: ../View/login.php");
    exit();
}

$patient_id = (int)$_SESSION["user_id"];
$database   = new db();
$connection = $database->connection();

// ---- cancel an appointment ----
if (($_GET["action"] ?? "") === "cancel") {
    $id = (int)($_GET["id"] ?? 0);
    if ($id > 0) {
        $database->cancelAppointment($connection, $id, $patient_id);
    }
    header("Location: ../View/my_appointments.php");
    exit();
}

// ---- create a new booking ----
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $doctor_id = (int)($_POST["doctor_id"] ?? 0);
    $date      = trim($_POST["date"] ?? "");
    $time      = trim($_POST["slot"] ?? "");
    $reason    = trim($_POST["reason"] ?? "");

    if ($doctor_id > 0 && $date !== "" && $time !== "") {
        $database->insertAppointment($connection, $patient_id, $doctor_id, $date, $time, $reason);
    }
    header("Location: ../View/my_appointments.php");
    exit();
}

header("Location: ../View/patient_dashboard.php");
exit();
?>
