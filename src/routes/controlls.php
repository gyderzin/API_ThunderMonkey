<?php 
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Dispositivo;
use App\Models\Circuito;
use App\Models\Controll;

$app->group('/api/controll', function () { 

    $this->get('/recuperar_controles/{id_dp}/{plataforma}', function($resquest, $response, $args) {
        $id_dp = $args['id_dp'];
        if($args['plataforma'] == 'esp32') {
            $controles = Controll::select('id','controles', 'marca', 'tipo')->where('id_dp', $id_dp)->get();
        } else {
            $controles = Controll::where('id_dp', $id_dp)->get();
        }
        return $response->withJson($controles);
    });
    
    $this->post('/novo_controle', function($resquest, $response) {
        $dados    = $resquest->getParsedBody();
        $id_dp    = $dados['id_dp'];
        $nome     = $dados['nome'];
        $tipo     = $dados['tipo'];
        $marca    = $dados['marca'];
        $controle = $dados['controle'];

        Controll::insert([
            'id_dp'     => $id_dp,
            'nome'      => $nome,
            'controles' => $controle,
            'tipo'      => $tipo,
            'marca'     => $marca
        ]);
    });

    $this->patch('/atualizar_controle', function($resquest, $response) {
        $dados = $resquest->getParsedBody();
        $id_controle = $dados['id_controle'];
        $controle = $dados['controle'];
        Controll::where('id', $id_controle)->update([
            'controles' => $controle
        ]);
    });



});