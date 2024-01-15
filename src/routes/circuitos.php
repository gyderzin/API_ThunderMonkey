<?php 
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Dispositivo;
use App\Models\Circuito;
use App\Models\Agendamento;

$app->group('/api/circuito', function () { 
    $this->get('/recuperar_circuitos/{idDP}/{plataforma}', function($request, $response, $args) {
        // rota responsavel por retornar todos os circuitos de determinado dispositivo
        $idDP = $args['idDP'];
        $circuito = null;
        if($args['plataforma'] == 'esp32') {
            $circuito = Circuito::select(['porta', 'estado'])->where('id_dp', $idDP)->get();
        } else if ($args['plataforma'] == 'app') {
            $circuito = Circuito::where('id_dp', $idDP)->get();
        }
        return $response->withJson($circuito);
    });
    $this->patch('/liga_desliga', function ($request, $response) {
        // rota responsavel por atualizar o estado de um circuito, para ligar ou desligar
        $dados = $request->getParsedBody();
        $state = $dados['state'];
        $idDP = $dados['id_dp'];
        $nCircuito = $dados['circuito'];
        Circuito::where('id_dp', $idDP)->where('numero_circuito', $nCircuito)->update([
            'estado' => $state
        ]);  
    });
    $this->post('/adicionar_circuitos', function($request, $response) {
        // rota responsavel por receber todos os circuitos criados pelo usuario e armazenar no db
        $dados = $request->getParsedBody();
        $circuito = new Circuito();
        $db = $this->get('PDO');
        $retorno  = $circuito->adicionar_circuitos($db, $dados);
        return $response->withJson($retorno);
    });
    $this->post("/novo_circuito", function($request, $response) {
        $dados = $request->getParsedBody();
        Circuito::insert([
            'id_dp' => $dados['0']['idDp'],
            'numero_circuito' => $dados['0']['numero_circuito'],
            'nome' => $dados['0']['nome'],
            'porta' => $dados['0']['porta'],
            'icon' => $dados['0']['icon'],
        ]);
        return $response->withJson($dados);
    });
    $this->put('/atualizar_circuito', function($request, $response) {
        // rota responsavel por atualizar dados de um circuito
        $dados = $request->getParsedBody();
        Circuito::where('id_dp', $dados['id_dp'])->where('numero_circuito', $dados['numero_circuito'])->update([
            'nome' => $dados['nome'],
            'porta' => $dados['porta'],
            'icon' => $dados['icon']
        ]);
    });
    $this->delete('/deletar_circuito', function($request, $response) {
        // rota responsavel por deletar um circuito
        $dados = $request->getParsedBody();
        Circuito::where('id_dp', $dados['id_dp'])->where('numero_circuito', $dados['numero_circuito'])->delete();
    });
    $this->put('/executar_comando/{tipo_comando}', function($request, $response, $args) {
        // rota responsavel por executar um comando de on/off em varios circuitos ao mesmo tempo, podendo ser emitidos a partir do app (atraves das rotinas) ou pelo esp32 (atraves dos agendamentos)
        $dados = $request->getParsedBody();
        $comando = $args['tipo_comando'];
        $circuitos = new Circuito;
        $db = $this->get('PDO');
        $retorno = $circuitos->executar_comando($db, $dados);
        if($comando == 'agendamento') {
            date_default_timezone_set('America/Sao_Paulo');
            $dia_da_semana = date('D');
            Agendamento::where('id', $dados['id_agendamento'])->update([
                'dia_controle' => $dia_da_semana
            ]);
        }    

        return $response->withJson($retorno);
    });
});

?>