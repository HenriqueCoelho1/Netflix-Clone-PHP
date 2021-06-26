<?php 
    if(isset($_POST["submit_button"])){
        

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
            <h3>Sign Up</h3>
            <span>To Continue To Netflix Clone</span>
        </div>
            <form action="" method="post">
                <input type="text" name="firstname" placeholder="First Name" required>
                <input type="text" name="lastname" placeholder="Last Name" required>
                <input type="text" name="username" placeholder="Your Username" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <input type="email" name="email2" placeholder="Confirm Your Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                <input type="submit" name="submit_button" value="Submit">
            
            </form>

        </div>

    </div>
    
</body>
</html>