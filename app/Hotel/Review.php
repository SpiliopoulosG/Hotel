<?php

namespace Hotel;

use Hotel\BaseService;

class Review extends BaseService
{
  public function insert($roomId, $userId, $rate, $comment)
  {
    $parameters = [
        ':user_id' => $userId,
        ':room_id' => $roomId,
        ':rate' => $rate,
        ':comment' => $comment,
    ];
    return $this->execute('INSERT INTO review (room_id, user_id, rate, comment) VALUES (:room_id, :user_id, :rate, :comment)', $parameters);
  }

   public function getReviewsByRoom($roomId)
   {
    $parameters = [
        ':room_id' => $roomId,
    ];
    return $this->fetchAll('SELECT review.*, user.name as user_name FROM review INNER JOIN user ON review.user_id = user.user_id WHERE room_id = :room_id ORDER BY create_time ASC', $parameters);
    }
}
