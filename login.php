<?php
require 'functions.php';

// Dummy data user
$users = [
    'user1' => 'password1',
    'user2' => 'password2'
];

$input = json_decode(file_get_contents('php://input'), true);
// kirim JSON di body
$username = $input['username'] ?? '';
$password = $input['password'] ?? '';

// biar bisa pake method GET dan POST
$username = ($username) ? $username : ($_REQUEST['username'] ?? '');
$password = ($password) ? $password : ($_REQUEST['password'] ?? '');

if (isset($users[$username]) && $users[$username] === $password) {
    $accessToken = createToken(['username' => $username], ACCESS_TOKEN_EXPIRY);
    $refreshToken = createToken(['username' => $username], REFRESH_TOKEN_EXPIRY);

    echo json_encode([
        'accessToken' => $accessToken,
        'refreshToken' => $refreshToken
    ]);
} else {
    http_response_code(401);
    echo json_encode(['message' => 'Invalid credentials']);
}
