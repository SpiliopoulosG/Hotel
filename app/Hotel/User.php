<?php

namespace Hotel;

use PDO;
use \Hotel\BaseService;

class User extends BaseService
{

    const TOKEN_KEY = 'asfdhkgjlr;ofijhgbfdklfsadf';

    private static $currentUserId;

   public function getByEmail($email)
    {
      $parameters = [
          ':email' => $email,
      ];
      return $this->fetch('SELECT * FROM user WHERE email = :email', parameters);
    } 

    public function getList()
    {
        return $this->fetchAll('SELECT * FROM user');
    }


    public function insert($name, $email, $password)
    {
        // Hash Password
        $passwordHash = password_hash($password, PASSWORD_BCRYPT);

        // Prepare parameters
        $parameters = [
            ':name' => $name,
            ':email' => $email,
            ':password' => $password,
        ];

        $rows = $this->execute('INSERT INTO user(name, email, password) VALUES (:name, :email ,:password)', $parameters);

        return $rows = 1;
    }

    public function verify($email, $password)
    {
        // Retrieve User
        $user = $this->getByEmail($email);
        
        // Verify User Password
        return password_verify($password, $user['password']);
    }

    public function generateToken($userId)
    {
        // Create Token Payload
        $payload = [
            'user_id' => $userId
        ];
        $payloadEncoded = base64_encode(json_encode($payload));
        $signature = hash_hmac('sha256', $payloadEncoded, self::TOKEN_KEY);

        return sprintf('%s.%s', $payloadEncoded, $signature);
    }

    public function getTokenPayload($token)
    {
        // Get Payload and Signature
        [$payloadEncoded] = explode('.', $token);

        // Get Payload
        return json_decode(base64_decode($payloadEncoded), true);
    }

    public function verifyToken($token)
    {
        // Get Payload
        $payload = getTokenPayload($token);
        $userId = $payload['user_id'];

        // Generate Signature and Verify
        return generateToken($userId) == $token;
    }

    protected function getPdo()
    {
        return $this -> pdo;
    }

    public static function getCurrentUserId()
    {
        return self::$currentUserId;
    }

    public static function setCurrentUserId($userId)
    {
        self::$currentUserId = $userId;
    }
}