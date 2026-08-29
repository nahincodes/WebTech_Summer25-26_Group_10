<?php
/*
 * Controller/SearchController.php
 * AJAX endpoint. Receives a search term (POST "q") and returns a
 * JSON array of matching approved doctors.
 */
include "../Model/db.php";
if (session_status() === PHP_SESSION_NONE) session_start();
header("Content-Type: application/json");

// only logged-in users; otherwise return an empty list (never HTML)
if (empty($_SESSION["logged_in"])) {
    echo json_encode(array());
    exit();
}

$q = $_POST["q"] ?? "";
$database   = new db();
$connection = $database->connection();
$result     = $database->searchDoctors($connection, $q);

$doctors = array();
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $doctors[] = $row;
    }
}
echo json_encode($doctors);
?>
