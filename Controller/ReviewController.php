<?php
/*
 * Controller/ReviewController.php
 * Patient submits a rating + review for a doctor they visited.
 */
include "../Model/db.php";
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION["logged_in"]) || $_SESSION["role"] !== "patient") {
    header("Location: ../View/login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $patient_id = (int)$_SESSION["user_id"];
    $doctor_id  = (int)($_POST["rdoctor"] ?? 0);
    $rating     = (int)($_POST["rating"] ?? 0);
    $review     = trim($_POST["review"] ?? "");
    if ($doctor_id > 0 && $rating >= 1 && $rating <= 5) {
        $database   = new db();
        $connection = $database->connection();
        $database->insertReview($connection, $patient_id, $doctor_id, $rating, $review);
    }
}
header("Location: ../View/rate_doctor.php?saved=1");
exit();
?>
