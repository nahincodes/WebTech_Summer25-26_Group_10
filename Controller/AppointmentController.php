<?php
include "../Model/db.php";
if (session_status() === PHP_SESSION_NONE) session_start();

if (empty($_SESSION["logged_in"]) || $_SESSION["role"] !== "doctor") {
    header("Location: ../View/login.php");
    exit();
}
$doctor_id = (int)$_SESSION["user_id"];
$action    = $_GET["action"] ?? "";
$id        = (int)($_GET["id"] ?? 0);

$map = array("accept" => "Accepted", "reject" => "Rejected", "complete" => "Completed");

if ($id > 0 && isset($map[$action])) {
    $database   = new db();
    $connection = $database->connection();
    $database->setAppointmentStatus($connection, $id, $doctor_id, $map[$action]);
}

header("Location: ../View/doctor_appointments.php");
exit();
?>
