<?php
/*
 * Controller/AvailabilityController.php
 *  - POST                -> add a time slot
 *  - GET ?action=delete&id=X -> delete a slot
 */
include "../Model/db.php";
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION["logged_in"]) || $_SESSION["role"] !== "doctor") {
    header("Location: ../View/login.php");
    exit();
}

$doctor_id  = (int)$_SESSION["user_id"];
$database   = new db();
$connection = $database->connection();

if (($_GET["action"] ?? "") === "delete") {
    $id = (int)($_GET["id"] ?? 0);
    if ($id > 0) $database->deleteSlot($connection, $id, $doctor_id);
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $date  = trim($_POST["adate"] ?? "");
    $start = trim($_POST["start"] ?? "");
    $end   = trim($_POST["end"] ?? "");
    if ($date !== "" && $start !== "" && $end !== "") {
        $database->addSlot($connection, $doctor_id, $date, $start, $end);
    }
}

header("Location: ../View/manage_availability.php");
exit();
?>
