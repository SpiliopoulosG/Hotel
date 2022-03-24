<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

//Register Autoload function
spl_autoload_register(function ($class) {
    $class = str_replace("\\", "/", $class);
    require_once sprintf(__DIR__.'/../app/%s.php', $class);
});

use Hotel\User;

$user = new User();

$userToken = $_COOKIE['user_token'];
if ($userToken) {
    //Verify User
    if ($user->verifyToken($userToken)) {
        //Set User in Memory
        $userInfo = $user->getTokenPayload($userToken);
        User::setCurrentUserId($userInfo['user_id']);
    }
}

?>