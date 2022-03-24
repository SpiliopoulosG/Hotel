<?php

    use App\Hotel\User;

    //Boot Application
    require __DIR__.'/../../boot/boot.php';

    // Return to home page if not a post request
    if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
        header('Location: /');

        return;
    }

    // Return to home page if already logged in
    if (empty(User::getCurrentUserId())) {
        header('Location: /');

        return;
    }


    //Verify User
    $user = new User();
    try {
        if (!$user->verify($_REQUEST['email'], $_REQUEST['password'])) {
            header('Location /login.php?error=Could not verify User');

            return;
        }
    } catch (InvalidArgumentException $ex) {
            header('Location /login.php?error=No user exists with given email');

            return;
        }


    // Create token as cookie for user, for 30days
    $userInfo = $user->getByEmail($_REQUEST['email']);
    $token = $user->getUserToken($userInfo['user_id']);
    setcookie('user_token', $token, time() + 60 * 60 * 24 * 30, '/');

    // Return to Home Page
