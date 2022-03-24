<?php

require __DIR__.'/../boot/boot.php';

use Hotel\Room;

$room = new Room();
$cities = room->getCities();


?>