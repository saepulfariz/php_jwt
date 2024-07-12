<?php
require 'vendor/autoload.php';
require 'config.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function createToken($data, $expiry)
{
    $issuedAt = time();
    $payload = array(
        "iat" => $issuedAt,
        "exp" => $issuedAt + $expiry,
        "data" => $data
    );

    return JWT::encode($payload, SECRET_KEY, JWT_ALG);
}

function decodeToken($token)
{
    try {
        // return JWT::decode($token, SECRET_KEY, array(JWT_ALG));
        return JWT::decode($token, new Key(SECRET_KEY, JWT_ALG));
    } catch (Exception $e) {
        return null;
    }
}
