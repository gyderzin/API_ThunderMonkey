<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Circuito extends Model
{
    protected $fillable = [
        'id', 'id_DP', 'numerop_circutio', 'estado', 'updated_at'
	];
}
?>