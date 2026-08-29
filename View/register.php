<?php include "../Controller/RegisterValidation.php"; ?>
<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MediBook | Register</title>
    <link rel="stylesheet" href="../Design/Style.css">
    <script src="../Javascript/Script.js"></script>
</head>
<body>
    <div class="header">
        <h2>🏥 MediBook</h2>
        <p>Doctor Appointment &amp; Clinic Booking System</p>
    </div>

    <div class="topnav">
      <a href="index.php">Home</a>
      <a href="login.php">Login</a>
      <a href="register.php">Register</a>
    </div>

    <div class="container">
        <h1>Create Your Account</h1>

        <?php if (!empty($message)): ?>
            <p class="error"><?php echo $message; ?></p>
        <?php endif; ?>

        <form method="post" action="" onsubmit="return validateRegister()">
            <fieldset>
                <legend>User Information</legend>
                <table>
                    <tr>
                        <td><label for="name">Full Name:</label></td>
                        <td><input type="text" id="name" name="name"></td>
                        <td><p class="error" id="nameError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="email">Email:</label></td>
                        <td><input type="email" id="email" name="email"></td>
                        <td><p class="error" id="emailError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="phone">Phone:</label></td>
                        <td><input type="text" id="phone" name="phone"></td>
                        <td><p class="error" id="phoneError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="role">Register as:</label></td>
                        <td>
                            <select id="role" name="role">
                                <option value="">-- Select role --</option>
                                <option value="patient">Patient</option>
                                <option value="doctor">Doctor</option>
                            </select>
                        </td>
                        <td><p class="error" id="roleError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="specialty">Specialty:</label></td>
                        <td><input type="text" id="specialty" name="specialty" placeholder="Doctors only"></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td><label for="password">Password:</label></td>
                        <td><input type="password" id="password" name="password"></td>
                        <td><p class="error" id="passwordError"></p></td>
                    </tr>
                    <tr>
                        <td><label for="confirm">Confirm Password:</label></td>
                        <td><input type="password" id="confirm" name="confirm"></td>
                        <td><p class="error" id="confirmError"></p></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <input type="checkbox" id="terms" name="terms" value="1">
                            <label for="terms">I agree to the Terms &amp; Conditions</label>
                            <p class="error" id="termsError"></p>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3"><input class="btn" type="submit" value="Register"></td>
                    </tr>
                </table>
            </fieldset>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
    <?php include "footer.php"; ?>
</body>
</html>
