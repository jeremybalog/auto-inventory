<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\AuthController;
use App\Kernel\ViewController;

$uri = $_SERVER['REQUEST_URI'];

preg_match('#/[^\/]+-for-sale-(\d+)$#i', $uri, $vdpMatches);

if ($uri == '/' || preg_match('#^/\?#', $uri)) {
    CarController::index();
} elseif ($uri == '/login') {
    AuthController::index();
} elseif (!empty($vdpMatches)) {
    CarController::get($vdpMatches[1]);
} else {
    http_response_code(404);
    ViewController::render();
}

?>
