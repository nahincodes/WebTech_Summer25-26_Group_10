<?php
/*
 * Controller/RegisterValidation.php
 * Included at the top of View/register.php (class pattern).
 * Validates the form, hashes the password, inserts the user,
 * then redirects to the login page.
 */
include "../Model/db.php";
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name     = trim($_POST["name"] ?? "");
    $email    = trim($_POST["email"] ?? "");
    $phone    = trim($_POST["phone"] ?? "");
    $role     = $_POST["role"] ?? "";
    $specialty= trim($_POST["specialty"] ?? "");
    $password = $_POST["password"] ?? "";
    $confirm  = $_POST["confirm"] ?? "";

    // ---- server-side (PHP) validation ----
    $valid = true;
    if (strlen($name) < 5)                { $message .= "Name must be at least 5 characters. ";  $valid = false; }
    if (strpos($email, "@") === false)    { $message .= "Enter a valid email. ";                 $valid = false; }
    if (strlen($phone) != 11)             { $message .= "Phone must be 11 digits. ";             $valid = false; }
    if ($role != "patient" && $role != "doctor") { $message .= "Please choose a role. ";        $valid = false; }
    if (strlen($password) < 5)            { $message .= "Password must be at least 5 characters. "; $valid = false; }
    if ($password !== $confirm)           { $message .= "Passwords do not match. ";             $valid = false; }

    if ($valid) {
        $database   = new db();
        $connection = $database->connection();

        // stop duplicate emails
        $check = $database->getUserByEmail($connection, $email);
        if ($check && $check->num_rows > 0) {
            $message = "This email is already registered.";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT); // Basic Web Security

            // doctors need admin approval, so they start as 'pending'
            if ($role == "doctor") {
                $status        = "pending";
                $specialtyToDb = $specialty;
            } else {
                $status        = "active";
                $specialtyToDb = null;
            }

            $result = $database->signup($connection, $name, $email, $hash, $phone, $role, $specialtyToDb, $status);
            if ($result) {
                header("Location: ../View/login.php?registered=1");
                exit();
            } else {
                $message = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
