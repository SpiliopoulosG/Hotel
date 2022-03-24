<?php 

namespace Hotel;

use PDO;
use Hotel\BaseService;

class RoomType extends BaseService
{
    public function getAllTypes()
    {
        // Get All Room Types
        return $this->fetchAll('SELECT * from room_type');
    }

}