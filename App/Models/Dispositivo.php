<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    protected $fillable = [
        'id', 'nSerie', 'senha', 'primeiro_acesso', 'qtd_circuitos', 'updated_at'
	];
}
?>