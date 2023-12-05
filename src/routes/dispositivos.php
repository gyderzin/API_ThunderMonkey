<?php
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Dispositivo;
use App\Models\Circuito;

$app->group('/api/dispositivo', function () {
    $this->get('/recuperar_dispositivo/numero_serie/{nSerie}', function ($resquest, $response, $args) {
        // rota responsavel retornar um dispositivo com base no seu numero de serie
        $nSerie = $args['nSerie'];
        $dp = Dispositivo::where('nSerie', $nSerie)->get();
        return $response->withJson($dp);
    });
    $this->get('/recuperar_dispositivo/id/{id}', function ($resquest, $response, $args) {
        // rota responsavel retornar um dispositivo com base no seu id
        $id = $args['id'];
        $dp = Dispositivo::where('id', $id)->get();
        return $response->withJson($dp);
    });
    $this->patch('/atualizar_dispositivo/senha', function ($request, $response) {
        // rota responsavel atualizar a senha de um dispositivo
        $dados = $request->getParsedBody();
        $senha = $dados['senha'];
        $id = $dados['id'];
        Dispositivo::where('id', $id)->update([
            'senha' => $senha
        ]);        
    });
    $this->patch('/atualizar_dispositivo/primeiro_acesso', function ($request, $response) {   
        // rota responsavel atualizar o primeiro acesso
       $dados = $request->getParsedBody();
       $id = $dados['id'];
        Dispositivo::where('id', $id)->update([
            'primeiro_acesso' => false
        ]);
    });
});
