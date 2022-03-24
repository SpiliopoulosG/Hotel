<?php

require __DIR__.'/../boot/boot.php';

use Hotel\User;

// Check for existing logged in user
if (!empty(User::getCurrentUserId())) {
    header('Location: /CollegeLinkProject/public/assets'); die;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!-- =========== Font Awesome Kit =========== -->
    <script src="https://kit.fontawesome.com/069349f420.js" crossorigin="anonymous"></script>

    <!-- =========== Font Google =========== -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!--========== CSS Stylesheets ===========-->
    <link rel="stylesheet" href="assets/css/header_footer.css">
    <link rel="stylesheet" href="assets/css/signup.css">

    <!-- =========== Title ============= -->
    <title>Hotel-Sign Up</title>
</head>

<body>

    <!-- ================Header================= -->

    <?php include 'header.php' ?>

    <!-- ================Content================= -->


    <div id="content">
        <div class="container">
            <div class="register">
                <form class="" action="actions/register.php" method="post">
                    <h1>Register</h1>
                    <label for="name">Name</label>
                    <input id="name" type="text" name="name" placeholder="Name" required>
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" placeholder="Email" required>
                    <label for="email_repeat">Confirm Email</label>
                    <input id="email_repeat" type="email" name="email_repeat" placeholder="Verify Email" required>
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" placeholder="••••••••••" required>
                    <div class="search-box">
                        <input type="submit" class="search-btn" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================Footer================= -->

    <?php include 'footer.php' ?>

</body>

</html>