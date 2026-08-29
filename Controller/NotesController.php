<?php
/*
 * Controller/NotesController.php
 * Doctor saves prescription/consultation notes for one of their
 * appointments (this also marks the appointment Completed).
 */
include "../Model/db.php";
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION["logged_in"]) || $_SESSION["role"] !== "doctor") {
    header("Location: ../View/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $doctor_id = (int)$_SESSION["user_id"];
    $appt      = (int)($_POST["appt"] ?? 0);
    $notes     = trim($_POST["notes"] ?? "");
    if ($appt > 0 && $notes !== "") {
        $database   = new db();
        $connection = $database->connection();
        $database->saveNotes($connection, $appt, $doctor_id, $notes);
    }
}
header("Location: ../View/write_notes.php?saved=1");
exit();
?>
