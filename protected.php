<?php
require 'functions.php';

$headers = getallheaders();
$authHeader = $headers['Authorization'] ?? '';
$token = str_replace('Bearer ', '', $authHeader);

$decoded = decodeToken($token);
if ($decoded) {
    echo json_encode(['message' => 'Access granted']);
} else {
    http_response_code(401);
    echo json_encode(['message' => 'Access denied']);
}
