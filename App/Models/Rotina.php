<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Rotina extends Model
{
    protected $fillable = [
        'id', 'id_dp', 'circuitos', 'nome', 'updated_at'
	];

    function criar_rotinas($dados, $db)  {
        foreach ($dados as $key => $circuito) {
            $stmt = $db->prepare(
                "INSERT INTO `rotinas`(`id_dp`, `circuitos`) VALUES (:id_dp, :circuitos)"
            );
            $stmt->bindValue('id_dp', $circuito['id_dp']);
            $stmt->bindValue('circuitos', $circuito['circuitos']);
            $stmt->execute();
        }
    }
}
?>