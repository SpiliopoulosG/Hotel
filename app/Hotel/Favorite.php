<?php

namespace Hotel;

use PDO;
use DateTime;
use Hotel\BaseService;

class Favorite extends BaseService
{
   public function isFavorite($roomId, $userId)
   {
    $parameters = [
        ':room_id' => $roomId,
        ':user_id' => $userId
    ];
    $favorite = $this->fetch('SELECT * FROM favorite WHERE room_id = :room_id AND user_id = :user_id ', $parameters);

    return !empty($favorite);
    }

   public function addFavorite($roomId, $userId)
   {

     // Prepare parameters
     $parameters = [
         ':room_id' => $roomId,
         ':user_id' => $userId,
     ];

     $rows = $this->execute('INSERT IGNORE INTO favorite(room_id, user_id) VALUES (:room_id , :user_id)', $parameters);

     return $rows = 1;
   }

   public function removeFavorite()
   {

     // Prepare parameters
     $parameters = [
         ':room_id' => $roomId,
         ':user_id' => $userId,
     ];

     $rows = $this->execute('DELETE FROM favorite WHERE room_id = :room_id AND user_id = :user_id)', $parameters);

     return $rows = 1;
   }

}
