<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");

$details_message = "";
$password_message = "";

if(isset($_POST["save_details_button"])){
    
    $account = new Account($con);

    $firstname = FormSanitizer::sanitize_form_string($_POST["firstname"]);
    $lastname = FormSanitizer::sanitize_form_string($_POST["lastname"]);
    $email = FormSanitizer::sanitize_form_email($_POST["email"]);

    if($account->update_details($firstname, $lastname, $email, $user_logged)){
        $details_message = "<div class='alertSuccess'>
                                Details Update Successfully!
                            </div>";
    }else{
        $error_message = $account->get_first_error();

        $details_message = "<div class='alertError'>
                                $error_message
                            </div>";
    }
}

if(isset($_POST["password_button"])){
    
    $account = new Account($con);

    $old_password = FormSanitizer::sanitize_form_password($_POST["old_password"]);
    $new_password = FormSanitizer::sanitize_form_password($_POST["new_password"]);
    $new_password2 = FormSanitizer::sanitize_form_password($_POST["confirm_new_password"]);

    if($account->update_password($old_password, $new_password, $new_password2, $user_logged)){
        $password_message = "<div class='alertSuccess'>
                                Password Update Successfully!
                            </div>";
    }else{
        $error_message = $account->get_first_error();

        $password_message = "<div class='alertError'>
                                $error_message
                            </div>";
    }
}
?>


<div class="settingsContainer column">
    <div class="formSection">
        <form action="" method="post">

            <h2>User details</h2>

            <?php 
            $user = new User($con, $user_logged);

            $firstname = isset($_POST["firstname"]) ? $_POST["firstname"] : $user->get_firstname();
            $lastname = isset($_POST["lastname"]) ? $_POST["lastname"] : $user->get_lastname();
            $email = isset($_POST["email"]) ? $_POST["email"] : $user->get_email();
            

            ?>

            <input type="text" name="firstname" placeholder="Your First name" value="<?php echo $firstname?>" />
            <input type="text" name="lastname" placeholder="Your Last name" value="<?php echo $lastname?>" />
            <input type="email" name="email" placeholder="Your Email" value="<?php echo $email?>" />

            <div class="message">
                <?php echo $details_message ?>
            </div>

            <input type="submit" name="save_details_button" value="Save" />
        
        </form>
    </div>

    <div class="formSection">
        <form action="" method="post">

            <h2>Update password</h2>

            <input type="password" name="old_password" placeholder="Old Password" />
            <input type="password" name="new_password" placeholder="New Password" />
            <input type="password" name="confirm_new_password" placeholder="Your Email" />

            <div class="message">
                <?php echo $password_message ?>
            </div>

            <input type="submit" name="password_button" value="Save" />
        
        </form>
    </div>

    <div class="formSection">
        <h2>Subscription</h2>

        <?php
        if($user->get_subscribed()){
            echo "<h3>Is subscribed! Go to Paypal to cancel</h3>";
        }else{
            echo "<a href='billing.php'>Subscribe to Netflix clone</a>";
        }
        ?>

    </div>
</div>