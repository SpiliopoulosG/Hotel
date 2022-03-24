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
    <link rel="stylesheet" href="assets/css/list.css">

    <!--===========Title=============-->
    <title>List</title>
</head>

<body>
    <!--================Header=================-->

    <?php include 'header.php' ?>

    <!--================Content=================-->


    <div class="first container">
        <form name="searchForm" action="list.php" method="get">
            <h1> Find the one for You </h1>
            <div class="parameterField">
                <div class="formField">
                    <label for="city">City:</label>
                    <select name="city" class="select" data-placeholder="City" class="select">
                        <option value="">City</option>
                        <?php 
                                foreach ($cities as $city) {
                                ?>
                        <option <?php echo $selectedCity == $city ? 'selected=selected' : ''; ?>  value="<?php echo $city; ?>"><?php echo $city; ?></option>
                        <?php
                            }
                            ?>
                    </select>
                </div>
                <div class="formField">
                <label for="Room"> Room Type:</label>
                    <select name="room_type" id="RoomType" data-placeholder="Room Type" class="select">
                        <option value="">Room Type</option>
                        <?php 
                                foreach ($allTypes as $roomType) {
                                ?>
                        <option <?php echo $selectedTypeId == $roomType['type_id'] ? 'selected=selected' : ''; ?>
                            value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title'];?></option>
                        <?php
                            }
                            ?>
                    </select>
                </div>
                <div class="formField">
                    <label for="check-in">Check-In-Date:</label>
                    <input type="date" id="check-in" name="check_in_date" value="<?php echo $checkInDate; ?>">
                </div>
                <div class="formField">
                    <label for="check-out">Check-Out-Date:</label>
                    <input type="date" id="check-out" name="check_out_date" value="<?php echo $checkOutDate;?>">
                </div>
            </div>
            <div class="search-box">
                <input type="submit" class="search-btn" value="Search">
            </div>
        </form>
    </div>
    <div class="last container">
        <h1>Search Results</h1>
        <?php if (count($allAvailableRooms) == 0) { ?>
        <h1>There are no Available Rooms!</h1>
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
    <!--================Footer=================-->

    <?php include 'footer.php' ?>
</body>

</html>