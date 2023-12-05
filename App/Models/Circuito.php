<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Circuito extends Model
{
    protected $fillable = [
        'id', 'id_dp', 'numero_circuito', 'nome',  'estado', 'porta', 'icon', 'updated_at'
	];

    function adicionar_circuitos($db, $dados) {
        foreach ($dados as $key => $circuito) {
            $stmt = $db->prepare(
				"INSERT INTO circuitos (id_dp, numero_circuito, nome, porta, icon) VALUES (:id_dp, :numero_circuito, :nome, :porta, :icon)"
			);
            $stmt->bindValue(':id_dp', $circuito['id_dp']);
            $stmt->bindValue(':numero_circuito', $circuito['numero_circuito']);
            $stmt->bindValue(':nome', $circuito['nome']);
            $stmt->bindValue(':porta', $circuito['porta']);
            $stmt->bindValue(':icon', $circuito['icon']);
            $stmt->execute();
        }
    }

    function executar_comando($db, $dados) {
        $stmt = $db->prepare(
            "UPDATE circuitos SET estado = :estado WHERE id_dp = :id_dp AND numero_circuito = :numero_circuito"
        );
        $circuitos = json_decode($dados['circuitos'], true);
        $db->beginTransaction();
        try {
            foreach ($circuitos as $key => $circuito) {
                $stmt->bindValue(':id_dp', $dados['id_dp']);
                $stmt->bindValue(':estado', $circuito['estado']);
                $stmt->bindValue(':numero_circuito', $circuito['circuito']);
                $stmt->execute();
            }
            $db->commit();
        } catch (Exception $e) {
            $db->rollBack();
            echo "Erro: " . $e->getMessage();
        }   
    }
}
?>