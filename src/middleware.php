<?php
// Application middleware

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', '*')
            ->withHeader('Access-Control-Allow-Methods', '*')
            // ->withHeader('ResponseType', '*')
            // ->withHeader('Accept', '*/*')
            // ->withHeader('Content-Type', 'image/jpeg')
            ; 
});
