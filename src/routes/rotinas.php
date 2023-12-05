<?php 
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\Dispositivo;
use App\Models\Circuito;
use App\Models\Rotina;

$app->group('/api/rotina', function () { 

    $this->get('/recuperar_rotinas/{id_dp}', function ($request, $response, $args) {
        // rota responsavel por recuperar todas as rotinas de um determinado dp
        $id_dp = $args['id_dp'];
        $rotinas = Rotina::where('id_dp', $id_dp)->get();
        return $response->withJson($rotinas);
    });
    $this->post('/criar_rotinas', function ($request, $response){
        // rota responsavel por criar novas rotinas
        $dados = $request->getParsedBody();
        $id_dp = $dados['id_dp'];
        $circuitos = $dados['circuitos'];
        Rotina::insert([
            'id_dp'     => $id_dp,
            'circuitos' => $circuitos
        ]);
    });
    $this->put('/atualizar_rotina', function ($request, $response) {
        // rota responsavel por atualiazar os dados de uma rotina
        $dados = $request->getParsedBody();
        Rotina::where('id', $dados['id_rotina'])->update([
            'nome'      => $dados['nome'],
            'circuitos' => $dados['circuitos']
        ]);
    });
    $this->delete('/deletar_rotina', function ($request, $response) {
        // rota responsavel por atualiazar os dados de uma rotina
        $dados = $request->getParsedBody();
        $id_rotina = $dados['id_rotina'];
        Rotina::where('id', $id_rotina)->delete();
    });

});