<?php
// Routes
use Slim\Http\Request;
use Slim\Http\Response;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

require __DIR__ . '/routes/dispositivos.php';
require __DIR__ . '/routes/circuitos.php';
require __DIR__ . '/routes/agendamentos.php';
require __DIR__ . '/routes/rotinas.php';
require __DIR__ . '/routes/controlls.php';

// Catch-all route to serve a 404 Not Found page if none of the routes match
// NOTE: make sure this route is defined last
$app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function($req, $res) {
    $handler = $this->notFoundHandler; // handle using the default Slim page not found handler
    return $handler($req, $res);
});