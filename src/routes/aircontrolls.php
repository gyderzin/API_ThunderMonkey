<?php 
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Dispositivo;
use App\Models\Circuito;
use App\Models\Aircontroll;

$app->group('/api/aircontroll', function () { 

    $this->get('/recuperar_controles/{id_dp}/{plataforma}', function($resquest, $response, $args) {
        $id_dp = $args['id_dp'];
        if($args['plataforma'] == 'esp32') {
            $controles = Aircontroll::select('controles', 'marca')->where('id_dp', $id_dp)->get();
        } else {
            $controles = Aircontroll::where('id_dp', $id_dp)->get();
        }
        return $response->withJson($controles);
    });

});