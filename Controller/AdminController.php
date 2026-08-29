<?php
/*
 * Controller/AdminController.php
 * All admin actions run through here (called as links with ?action=&id=):
 *   approve / reject     -> doctor verification  (back to verify_doctors.php)
 *   activate / deactivate/ remove -> user management (back to manage_users.php)
 */
include "../Model/db.php";
if (session_status() === PHP_SESSION_NONE) session_start();

if (empty($_SESSION["logged_in"]) || $_SESSION["role"] !== "admin") {
    header("Location: ../View/login.php");
    exit();
}

$action     = $_GET["action"] ?? "";
$id         = (int)($_GET["id"] ?? 0);
$database   = new db();
$connection = $database->connection();

$back = "../View/admin_dashboard.php";

if ($id > 0) {
    switch ($action) {
        case "approve":
            $database->updateUserStatus($connection, $id, "active");
            $back = "../View/verify_doctors.php";
            break;
        case "reject":
            $database->updateUserStatus($connection, $id, "rejected");
            $back = "../View/verify_doctors.php";
            break;
        case "activate":
            $database->setUserStatusById($connection, $id, "active");
            $back = "../View/manage_users.php";
            break;
        case "deactivate":
            $database->setUserStatusById($connection, $id, "inactive");
            $back = "../View/manage_users.php";
            break;
        case "remove":
            $database->deleteUser($connection, $id);
            $back = "../View/manage_users.php";
            break;
    }
}

header("Location: ".$back);
exit();
?>
