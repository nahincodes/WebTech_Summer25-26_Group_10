<?php
/*
 * Controller/SpecialtyController.php
 *  - POST                -> add a specialty
 *  - GET ?action=delete  -> delete a specialty
 */
include "../Model/db.php";
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION["logged_in"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../View/login.php");
    exit();
}

$database   = new db();
$connection = $database->connection();

if (($_GET["action"] ?? "") === "delete") {
    $id = (int)($_GET["id"] ?? 0);
    if ($id > 0) $database->deleteSpecialty($connection, $id);
} else if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST["specname"] ?? "");
    if ($name !== "") $database->addSpecialty($connection, $name);
}

header("Location: ../View/manage_specialties.php");
exit();
?>
