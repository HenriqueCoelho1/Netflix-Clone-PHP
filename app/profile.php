<?php
require_once("includes/header.php");
require_once("includes/classes/Account.php");
require_once("includes/classes/FormSanitizer.php");
require_once("includes/classes/Constants.php");

if(isset($_POST["save_details_button"])){
    $account = new Account($con);

    $firstname = FormSanitizer::sanitize_form_string($_POST["firstname"]);
    $lastname = FormSanitizer::sanitize_form_string($_POST["lastname"]);
    $email = FormSanitizer::sanitize_form_email($_POST["email"]);

    if($account->update_details($firstname, $lastname, $email, $user_logged)){
        echo "Success";
    }else{
        echo "Failure";
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

            <input type="submit" name="save_details_button" value="Save" />
        
        </form>
    </div>

    <div class="formSection">
        <form action="" method="post">

            <h2>Update password</h2>

            <input type="password" name="old_password" placeholder="Old Password" />
            <input type="password" name="new_password" placeholder="New Password" />
            <input type="password" name="confirm_new_password" placeholder="Your Email" />

            <input type="submit" name="password_button" value="Save" />
        
        </form>
    </div>
</div>