<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

if(isset($_POST["submit_button"])){
    $firstname = FormSanitizer::sanitize_form_string($_POST["firstname"]);
    $lastname = FormSanitizer::sanitize_form_string($_POST["lastname"]);
    $username = FormSanitizer::sanitize_form_username($_POST["username"]);
    $email = FormSanitizer::sanitize_form_email($_POST["email"]);
    $confirm_email = FormSanitizer::sanitize_form_email($_POST["confirm_email"]);
    $password = FormSanitizer::sanitize_form_password($_POST["password"]);
    $confirm_password = FormSanitizer::sanitize_form_password($_POST["confirm_password"]);

    $account->validate_first_name($firstname);
    
    

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Clone</title>
    <link rel="stylesheet" href="assets/style/style.css" />
</head>
<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src="assets/images/logo.png" title="Logo" alt="Site Logo" />
                <h3>Sign Up</h3>
                <span>To Continue To Netflix Clone</span>
            </div>
            <form action="" method="post">
                <?php echo $account->get_error("First Name Wrong Length"); ?>
                <input type="text" name="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" placeholder="Last Name" required>
                <input type="text" name="username" placeholder="Your Username" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="email" name="confirm_email" placeholder="Confirm Your Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="submit" name="submit_button" value="Submit">
            
            </form>
            <a href="login.php" class="signInMessage">Already Have An Account? Sign In Here</a>

        </div>

    </div>
    
</body>
</html>