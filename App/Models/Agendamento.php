<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = [
        'id', 'id_dp', 'circuitos', 'nome', 'hora', 'intervalo_dias', 'dia_controle', 'updated_at'
    ];
}