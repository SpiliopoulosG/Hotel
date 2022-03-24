<?php

    use App\Hotel\User;
    use App\Hotel\Favorite;

    //Boot Application
    require __DIR__.'/../../boot/boot.php';

    // Return to home page if not a post request
    if (strtolower($_SERVER['REQUEST_METHOD']) != 'post') {
        header('Location: /');

        return;
    }

    // Return to home page if no user logged in
    if (empty(User::getCurrentUserId())) {
        header('Location: /');

        return;
    }

    //Check if Room  id is given
    $roomId = $_REQUEST['room_id'];
    if (empty($roomId)) {
        header('Location: /');

        return;
    }

    // Add review
    $review = new Review();
    $review->insert($roomId, User::getCurrentUserId(), $_REQUEST['rate'], $_REQUEST['comment']);


    // Add or remove something from favorite
    if (!isFavorite) {
      $favorite->addFavorite($roomId, User::getCurrentUserId());
    } else {
      $favorite->removeFavorite($roomId, User::getCurrentUserId());
    }



    // Return to room page
    header(sprintf('Location: /room.php?room_id=%s', $roomId));


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
