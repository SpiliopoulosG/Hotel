
<?php
    require __DIR__.'/../boot/boot.php';

    use Hotel\Room;
    use Hotel\Favorite;
    use Hotel\User;

    // Room Service
    $room = new Room();
    $favorite = new Favorite();

    $roomId = $_REQUEST['room_id'];
    if (empty($roomId)) {
        header('Location: index.php');
    }

    //Load Room Info
    $roomInfo = $room->get($roomId); 
    if (empty($roomInfo)) {
        header('Location: index.php');
    }

    $userId = User::getCurrentUserId();

    // Check if room is favorite for current user
    $isFavorite = $favorite->isFavorite($roomId, $userId);
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
    <link rel="stylesheet" href="assets/css/room.css">

    <!-- =========== Title ============= -->
    <title>Room Page</title>
</head>

<body>

    <!-- ================Header================= -->

    <?php include 'header.php' ?>

    <!-- ================Content================= -->

    <div id="content">
        <div class="container">
            <div class="title">
                <?php echo sprintf('%s - %s, %s', $roomInfo["name"], $roomInfo["city"], $roomInfo["area"]) ?>
            </div>
            <div class="rev-cost">
                <div class="reviews">
                    <span>Reviews:</span>
                    <?php
                        $roomAvgReview = $roomInfo['avg_reviews'];
                        for ($i = 1; $i <= 5; $i++){
                            if ($roomAvgReview > $i) {
                                ?> <i class="fas fa-star"></i> <?php
                            } else {
                                ?> <i class="far fa-star"></i> <?php
                            }
                        }
                    ?>
                <i class="fas fa-grip-lines-vertical" style="color: white;"></i>
                <form name="favoriteForm" method="post" id="favoriteForm" class="favoriteForm" action="actions/favorite.php">
                    <input type="hidden" name="room_id" value="<?php echo $roomId; ?>">
                    <input type="hidden" name="is_favorite" value="<?php echo $isFavorite ? '1' : '0'; ?>">
                    <i class="fa<?php echo $isFavorite ? 'r' : 's';   ?> fa-heart"></i>
                </form>
            </div>
                <div class="cost">Per Night: <?php echo $roomInfo['price'] ?>€</div>
            </div>
            <div class="img-frame fill">
                <img src="assets/images/images/rooms/<?php echo $roomInfo['photo_url'] ?>" alt="">
            </div>
        </div>
    </div>

    <!-- ================Footer================= -->

    <?php include 'footer.php' ?>

</body>

</html>