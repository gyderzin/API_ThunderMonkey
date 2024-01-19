<?php 
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Dispositivo;
use App\Models\Circuito;
use App\Models\Agendamento;

$app->group('/api/agendamento', function () { 
    $this->post('/novo_agendamento', function($request, $response) {
        // rota responsavel por criar e enviar os dados de agendamento para o db
        $dados = $request->getParsedBody();
        Agendamento::insert([
            'id_dp'          => $dados['id_dp'],
            'nome'           => $dados['nome'],
            'circuitos'      => $dados['circuitos'],
            'hora'           => $dados['hora'],
            'intervalo_dias' => $dados['intervalo_dias'],
        ]);
        return $response->withJson($dados);
    });
    $this->get('/recuperar_agendamentos/{id_dp}', function($request, $response, $args) {
        // rota responsavel por recuperar os agendamentos de um determinado dispostivo
        $id_dp = $args['id_dp'];
        $agendamentos = Agendamento::select(['id','id_dp', 'circuitos', 'hora', 'intervalo_dias', 'dia_controle'])->where('id_dp', $id_dp)->get();

        return $response->withJson($agendamentos);
    });
    $this->get('/recuperar_agendamentos/app/{id_dp}', function($request, $response, $args) {
        // rota responsavel por recuperar os agendamentos de um determinado dispostivo
        $id_dp = $args['id_dp'];
        $agendamentos = Agendamento::where('id_dp', $id_dp)->get();

        return $response->withJson($agendamentos);
    });
    $this->put('/atualizar_agendamentos', function($request, $response) {
        // rota responsavel por atualizar um agendamento
        $dados = $request->getParsedBody();
        $id = $dados['id'];
        Agendamento::where('id', $id)->update([
            'nome'           => $dados['nome'],
            'circuitos'       => $dados['circuitos'],
            'hora'           => $dados['hora'],
            'intervalo_dias' => $dados['intervalo_dias']
        ]);

        return $response->withJson($dados);
    });
    $this->delete('/deletar_agendamento', function($request, $response){
        // rota responsavel por deletar um agendamento
        $dados = $request->getParsedBody();
        $id = $dados['id'];
        Agendamento::where('id', $id)->delete();
    });
 });