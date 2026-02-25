<?php
session_start();
header("Content-Type: application/json");

// Caricamento automatico delle classi
foreach (glob(__DIR__ . '/../api/{Entities,Repositories,DTO,Mappers,VO,Controllers,config}/*.php', GLOB_BRACE) as $f) {
    require_once $f;
}

$pdo = Database::getConnection();
$userRepo = new UserRepository($pdo);
$activityRepo = new ActivityRepository($pdo);
$transportRepo = new TransportRepository($pdo);

$authController = new AuthController($userRepo);
$activityController = new ActivityController($activityRepo, $transportRepo);
$transportController = new TransportController($transportRepo);
$dashboardController = new DashboardController($activityRepo);

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
//echo "URI: $uri\n";

switch (true) {
    case $method === 'POST' && $uri === '/api/register':
        $authController->register();
        break;
    case $method === 'POST' && $uri === '/api/login':
        $authController->login();
        break;
    case $method === 'POST' && $uri === '/api/logout':
        $authController->logout();
        break;
    case $method === 'GET' && $uri === '/api/session':
        $authController->session();
        break;
    case $method === 'GET' && $uri === '/api/activities':
        $activityController->index();
        break;
    case $method === 'POST' && $uri === '/api/activities':
        $activityController->create();
        break;
    case $method === 'DELETE' && preg_match('#^/api/activities/(\d+)$#', $uri, $matches):
        $activityController->delete($matches[1]);
        break;
    case $method === 'GET' && $uri === '/api/transports':
        $transportController->index();
        break;
    case $method === 'GET' && $uri === '/api/stats':
        //$dashboardController->stats();
        break;
    default:
        http_response_code(response_code: 404);
        echo json_encode(["error" => "Endpoint non trovato"]);
        exit;
}

function requireAuth()
{
    if (!isset($_SESSION['user_id'])) {
        http_response_code(401);
        echo json_encode(["error" => "Non autenticato"]);
        exit;
    }
}
