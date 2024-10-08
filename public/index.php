<?php
declare(strict_types=1);

use Core\Session;
use Core\ValidationException;

const BASE_PATH = __DIR__.'/../';

session_start();

require BASE_PATH . 'vendor/autoload.php';
require BASE_PATH . 'Core/functions.php';
require BASE_PATH . 'bootstrap.php';

// Load .env variables
try {
    $dotenv = Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->load();
} catch (Exception $e) {
    echo 'Error loading .env: ' . $e->getMessage();
}

//boostrap the database
DB::$host = $_ENV['DB_HOST'];
DB::$dbName = $_ENV['DB_NAME'];
DB::$user = $_ENV['DB_USER'];
DB::$password = $_ENV['DB_PASS'];

$router = new \Core\Router();
require BASE_PATH . 'routes.php';

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

try {
    $router->route($uri, $method);
} catch (ValidationException $exception) {
    Session::flash('errors', $exception->errors);
    Session::flash('old', $exception->old);

    return redirect($router->previousUrl());
}

Session::unflash();


