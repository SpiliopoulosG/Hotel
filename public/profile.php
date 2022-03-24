<?php
    require __DIR__.'/../boot/boot.php';
    use Hotel\Room;
    use Hotel\RoomType;

    // Get Cities
    $room=new Room();
    $cities = $room->getCities();

    // Get Types
    $type = new RoomType();
    $allTypes = $type->getAllTypes();

    // Get Page Parameters
    $selectedCity = $_REQUEST['city'];
    $selectedTypeId = $_REQUEST['room_type'];
    $checkInDate=$_REQUEST['check_in_date'];
    $checkOutDate=$_REQUEST['check_out_date'];

    // Search for Room
    $allAvailableRooms = $room->search($checkInDate, $checkOutDate, $selectedCity, $selectedTypeId);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http - equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <!--===========Font Awesome Kit===========-->
    <script src="https://kit.fontawesome.com/069349f420.js" crossorigin="anonymous">
    </script>
    <!--===========Font Google===========-->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!--==========CSS Stylesheets===========-->
    <link rel="stylesheet" href="assets/css/header_footer.css">
    <link rel="stylesheet" href="assets/css/profile.css">

    <!--===========Title=============-->
    <title>List</title>
</head>

<body>
    <!--================Header=================-->

    <?php include 'header.php' ?>

    <!--================Content=================-->
    <div class="container">
        <div class="left">
            <h1>Favorites</h1>
            <h4>1. Favorite Room Name</h4>
            <?php if (count($allFavorites) == 0) { ?>
            <h4>You dont have any favorite Hotels!</h4>
            <?php } ?>

            <h1>Reviews</h1>
            <h4>1. Review Room Name</h4>
            <span>
            <?php
                $roomAvgReview = $roomInfo['avg_reviews'];
                for ($i = 1; $i <= 5; $i++){
                    if ($roomAvgReview >= $i) {
                        ?> <i class="fas fa-star"></i> <?php
                    } else {
                        ?> <i class="far fa-star"></i> <?php
                    }
                }
            ?>
            </span>
            <?php if (count($allReviews) == 0) { ?>
            <h4>You haven't made any reviews yet!</h4>
            <?php } ?>
        </div>
        <div class="right">
        <h1>My Booking</h1>
        <?php if (count($allAvailableRooms) == 0) { ?>
        <h1>You dont have any Bookings</h1>
        <?php } ?>

        <?php  foreach($allAvailableRooms as $availableRoom) { ?>
        <div class="room">
            <div class="firstLine">
                <div class="img-frame fill">
                    <img src="assets/images/images/rooms/<?php echo $availableRoom['photo_url'] ?>" alt="">
                </div>
                <div class="title">
                    <h3> <?php echo $availableRoom['name'] ?> </h3>
                    <h6> <?php echo $availableRoom['city'],' ' , $availableRoom['area'] ?> </h6>
                    <p> <?php echo $availableRoom['description_short'] ?> </p>
                </div>
            </div>
            <div class="secondLine">
                <h6>Per Night: <?php echo $availableRoom['price'], '€' ?> </h6>
                <h6>Count of Guests: <?php echo $availableRoom['count_of_guests'] ?> </h6>
                <h6>Type of Room:
                    <?php
                    if ($availableRoom['type_id'] == 1) {echo "Single Room";}
                    else if ($availableRoom['type_id'] == 2) {echo "Double Room";}
                    else if ($availableRoom['type_id'] == 3) {echo "Triple Room";}
                    else {echo "Fourfold Room";}
                    ?>
                </h6>
                <a href="">Go to Room Page</a>
            </div>
            <hr>
        </div>
        <?php } ?>
    </div>
    </div>
    <!--================Footer=================-->

    <?php include 'footer.php' ?>
</body>

</html>
