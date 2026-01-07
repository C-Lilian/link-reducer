<?php

require __DIR__ . '/../src/database.php';
require __DIR__ . '/../src/reducer.php';

header("Access-Control-Allow-Origin: http://localhost:3000");   // Autorise React
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");     // Méthodes autorisées
header("Access-Control-Allow-Headers: Content-Type");           // Autorise JSON
header("Content-Type: application/json");                       // Force JSON

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$method = $_SERVER['REQUEST_METHOD']; // GET ou POST
$uri = trim($_SERVER['REQUEST_URI'], '/'); // Récupère l'URI sans slashes

$reducer = new Reducer();

// Endpoint pour raccourcir une URL
if ($method === 'POST' && $uri === 'reduce') {
    $data = json_decode(file_get_contents('php://input'), true);
    
    // Vérifier que la clé "url" existe
    if (!isset($data['url'])) {
        http_response_code(400);
        echo json_encode(['error' => 'URL missing']);
        exit;
    }
    
    $url = trim($data['url']);
    
    // Vérifier que c'est une URL valide
    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid URL']);
        exit;
    }
    
    // Limiter la longueur maximale
    if (strlen($url) > 2048) {
        http_response_code(400);
        echo json_encode(['error' => 'URL too long']);
        exit;
    }
    
    $code = $reducer->reduce($url);
    echo json_encode([
        'short_url' => "http://localhost:8000/$code"
    ]);
    exit;
}

// Endpoint pour redirection via le code
if ($method === 'GET' && strlen($uri) === 25) {
    $url = $reducer->resolve($uri);
    
    if ($url) {
        header("Location: $url"); // Redirection HTTP
        exit;
    }
    
    http_response_code(404);
    echo json_encode(['error' => 'Link not found']);
    exit;
}

// Tout autre endpoint renvoie 404
http_response_code(404);
echo json_encode(['error' => 'Not found']);