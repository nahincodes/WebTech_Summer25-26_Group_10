<?php
/*
 * Controller/PasswordController.php
 * Included at the top of View/change_password.php.
 * Verifies the current password, then updates to the new one.
 */
include "../Model/db.php";
if (session_status() === PHP_SESSION_NONE) session_start();
if (empty($_SESSION["logged_in"])) {
    header("Location: ../View/login.php");
    exit();
}

$uid     = (int)$_SESSION["user_id"];
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $current = $_POST["current"] ?? "";
    $newpass = $_POST["newpass"] ?? "";
    $confirm = $_POST["confirmpass"] ?? "";

    $database   = new db();
    $connection = $database->connection();
    $user       = $database->getUserById($connection, $uid)->fetch_assoc();

    if (!$user || !password_verify($current, $user["password"])) {
        $message = "Your current password is incorrect.";
    } else if (strlen($newpass) < 5) {
        $message = "New password must be at least 5 characters.";
    } else if ($newpass !== $confirm) {
        $message = "New passwords do not match.";
    } else {
        $database->updatePassword($connection, $uid, password_hash($newpass, PASSWORD_DEFAULT));
        $message = "Password updated successfully.";
    }
}
?>
