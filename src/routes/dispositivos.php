<?php
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Dispositivo;
use App\Models\Circuito;

$app->group('/api', function () {
    $this->get('/dispositivo/{nSerie}', function ($resquest, $response, $args) {
        $nSerie = $args['nSerie'];
        $dp = Dispositivo::where('nSerie', $nSerie)->get();
        return $response->withJson($dp);
    });
    $this->get('/dispositivoID/{id}', function ($resquest, $response, $args) {
        $id = $args['id'];
        $dp = Dispositivo::where('id', $id)->get();
        return $response->withJson($dp);
    });
    $this->put('/dispositivo/senha', function ($request, $response) {
        $dados = $request->getParsedBody();
        $senha = $dados['senha'];
        $id = $dados['id'];
        Dispositivo::where('id', $id)->update([
            'senha' => $senha
        ]);        
    });
    $this->put('/dispositivo/changePrimeiroAcesso', function ($request, $response) {        
       $dados = $request->getParsedBody();
       $id = $dados['id'];
        Dispositivo::where('id', $id)->update([
            'primeiro_acesso' => 'false'
        ]);
    });
    $this->get('/circuito/{idDP}', function($request, $response, $args) {
        $idDP = $args['idDP'];
        $circuito = Circuito::where('id_dp', $idDP)->get();
        return $response->withJson($circuito);
    });
    $this->put('/circuito/state', function ($request, $response) {
        $dados = $request->getParsedBody();
        $state = $dados['state'];
        $idDP = $dados['id_dp'];
        Circuito::where('id_dp', $idDP)->update([
            'estado' => $state
        ]);  
        return $response->withJson($dados);
    });
});
