
<?php
    require __DIR__.'/../boot/boot.php';

    use Hotel\Room;
    use Hotel\RoomType;


    // Get Cities
    $room = new Room();
    $cities = $room->getCities();

    // Get all Room Types
    $type = new RoomType();
    $allTypes = $type->getAllTypes();
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
    <link rel="stylesheet" href="assets/css/index.css">

    <!-- =========== Title ============= -->
    <title>Hotel</title>
</head>

<body>
    <!-- ================Header================= -->
    <?php include 'header.php' ?>
    <!-- ================Content================= -->

    <div id="content">
        <div class="container">
            <div class="search-banner-text">
                <form name="searchForm" action="list.php" method="get">
                <label for="City">City:</label>
                    <div title="City" class="formField">
                        <select name="city" class="select" data-placeholder="City">
                            <option>City</option>
                            <?php 
                                foreach ($cities as $city) {
                                ?> 
                                <option value="<?php echo $city; ?>"><?php echo $city; ?></option>    
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div title="Room" class="formField">
                        <label for="check-in">Room Type:</label>
                        <select name="room_type" id="RoomType" class="select">
                            <option>Room Type</option>
                            <?php 
                                foreach ($allTypes as $roomType) {
                                ?> 
                                <option value="<?php echo $roomType['type_id']; ?>"><?php echo $roomType['title']; ?></option>    
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="formField">
                        <label for="check-out">Check-In-Date:</label>
                        <input type="date" name="check_in_date" class=""  placeholder="mm/dd/yyyy" min="2020-07-01" max="2020-07-30" required>
                    </div>
                    <div class="formField">
                        <label for="check-out">Check-Out-Date:</label>
                        <input type="date" name="check_out_date" class="" placeholder="mm/dd/yyyy" min="2020-07-01" max="2020-07-30" required>
                    </div>
                    <div class="search-box">
                        <input type="submit" class="search-btn" value="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================Footer================= -->
    <?php include 'footer.php' ?>
    <!-- ================JavaScript================= -->
    <script type="text/javascript" src="assets/js/index.js"></script>
</body>

</html>