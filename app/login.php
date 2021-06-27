<?php
require_once("includes/config.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Account.php");

$account = new Account($con);

if(isset($_POST["submit_button"])){
    $username = FormSanitizer::sanitize_form_username($_POST["username"]);
    $password = FormSanitizer::sanitize_form_password($_POST["password"]);

    $success = $account->login($username, $password);

    if($success){
        $_SESSION["user_logged"] = $username;
        header("Location: index.php");
    }
}

function get_input_value($name){
    if(isset($_POST[$name])){
        echo $_POST[$name];
    }

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
                <h3>Sign In</h3>
                <span>To Continue To Netflix Clone</span>
            </div>
            <form action="" method="post">
                <?php echo $account->get_error(Constants::$login_failed); ?>
                <input type="text" name="username" placeholder="Your Username" value="<?php get_input_value('username');?>" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="submit_button" value="Submit">
            
            </form>
            <a href="register.php" class="signInMessage">Don't Have An Account? Sign Up Here</a>

        </div>

    </div>
    
</body>
</html>