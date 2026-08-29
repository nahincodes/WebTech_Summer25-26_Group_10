<?php
if (session_status() === PHP_SESSION_NONE) 
    {
    session_start();
}

if (empty($_SESSION["logged_in"])) {
    header("Location: login.php");
    exit();
}

if (isset($required_role) && $_SESSION["role"] !== $required_role) {
    if ($_SESSION["role"] === "admin") {
        header("Location: admin_dashboard.php");
    } 
    else if ($_SESSION["role"] === "doctor") 
        {
        header("Location: doctor_dashboard.php");
    } 
    else {
        header("Location: patient_dashboard.php");
    }
    exit();
}
?>
