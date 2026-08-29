<?php
$required_role = "patient";
include "../Controller/auth.php";
include "../Model/db.php";
$database   = new db();
$connection = $database->connection();
$docs       = $database->getDoctorsForReview($connection, (int)$_SESSION["user_id"]);
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Rate Doctor</title>
    <link rel="stylesheet" href="../Design/Style.css">
    <script src="../Javascript/Script.js"></script>
</head>
<body>
    <div class="header">
        <h2>🏥 MediBook</h2>
        <p>Doctor Appointment &amp; Clinic Booking System</p>
    </div>
    <?php include "nav.php"; ?>

    <div class="container">
        <h1>Rate &amp; Review Doctor</h1>

        <?php if (isset($_GET["saved"])): ?>
            <p class="lead" style="color:#2b8a3e;">Thanks! Your review has been submitted.</p>
        <?php endif; ?>

        <?php if ($docs && $docs->num_rows > 0): ?>
        <form method="post" action="../Controller/ReviewController.php" onsubmit="return validateReview()">
            <fieldset>
                <legend>Your Feedback</legend>
                <table>
                    <tr>
                        <td><label for="rdoctor">Doctor:</label></td>
                        <td>
                            <select id="rdoctor" name="rdoctor">
                                <option value="">-- Select doctor --</option>
                                <?php while ($d = $docs->fetch_assoc()): ?>
                                    <option value="<?php echo $d['id']; ?>"><?php echo htmlspecialchars($d['name']); ?></option>
                                <?php endwhile; ?>
                            </select>
                        </td>
                        <td><p class="error" id="rdoctorError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="rating">Rating:</label></td>
                        <td>
                            <select id="rating" name="rating">
                                <option value="">-- 1 to 5 --</option>
                                <option value="5">5 - Excellent</option>
                                <option value="4">4 - Good</option>
                                <option value="3">3 - Average</option>
                                <option value="2">2 - Poor</option>
                                <option value="1">1 - Bad</option>
                            </select>
                        </td>
                        <td><p class="error" id="ratingError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="review">Review:</label></td>
                        <td><textarea id="review" name="review" rows="4" cols="24" style="resize:none"></textarea></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input class="btn" type="submit" value="Submit Review"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <?php else: ?>
            <p class="empty">You can review a doctor after a completed appointment. You don't have any completed visits yet.</p>
        <?php endif; ?>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
