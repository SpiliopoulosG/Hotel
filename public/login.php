
<?php
    require __DIR__.'/../boot/boot.php';

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
    <link rel="stylesheet" href="assets/css/login.css">

    <!-- =========== Title ============= -->
    <title>Hotel-Login</title>
</head>

<body>

    <!-- ================Header================= -->

    <?php include 'header.php' ?>

    <!-- ================Content================= -->

    <div id="content">
        <div class="container">
            <form id="form" action="actions/login.php" method="post">
                <h1>Sign In</h1>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="email@gmail.com"
                    required>
                <div id="email_error">Must be a valid email address!</div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••••" required>
                <div id="pass_error">Password must be more than 8 characters!</div>
                <div class="search-box">
                    <input type="submit" class="search-btn" value="Log In">
                </div>
            </form>
        </div>
    </div>

    <!-- ================Footer================= -->

    <?php include 'footer.php' ?>

    <script type="text/javascript" src="assets/js/signin.js"></script>

</body>

</html>
