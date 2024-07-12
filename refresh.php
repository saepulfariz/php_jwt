<?php
require 'functions.php';

$input = json_decode(file_get_contents('php://input'), true);
$refreshToken = $input['refreshToken'] ?? '';

$refreshToken = ($refreshToken) ? $refreshToken : ($_REQUEST['refreshToken'] ?? '');

$decoded = decodeToken($refreshToken);
if ($decoded) {
    $username = $decoded->data->username;
    $accessToken = createToken(['username' => $username], ACCESS_TOKEN_EXPIRY);

    echo json_encode([
        'accessToken' => $accessToken
    ]);
} else {
    http_response_code(401);
    echo json_encode(['message' => 'Invalid refresh token']);
}
