<?php
/*
 * Controller/ProfileController.php
 * Included at the top of View/profile.php.
 *  - POST                -> update the profile
 *  - GET ?action=delete  -> delete the account, then log out
 * Provides $user (current data) and $message to the view.
 */
include "../Model/db.php";
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION["logged_in"])) {
    header("Location: ../View/login.php");
    exit();
}

$uid        = (int)$_SESSION["user_id"];
$database   = new db();
$connection = $database->connection();
$message    = "";

// delete account
if (($_GET["action"] ?? "") === "delete") {
    $database->deleteUser($connection, $uid);
    session_unset();
    session_destroy();
    setcookie("remember_email", "", time() - 3600, "/");
    header("Location: ../View/register.php");
    exit();
}

// update profile
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name      = trim($_POST["pname"] ?? "");
    $phone     = trim($_POST["pphone"] ?? "");
    $specialty = trim($_POST["pspecialty"] ?? "");
    if (strlen($name) < 5) {
        $message = "Name must be at least 5 characters.";
    } else {
        $database->updateProfile($connection, $uid, $name, $phone, $specialty);
        $_SESSION["name"] = $name; // keep the greeting in sync
        $message = "Profile updated successfully.";
    }
}

// load current data for the form
$user = $database->getUserById($connection, $uid)->fetch_assoc();
?>
