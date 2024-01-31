<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Controll extends Model
{
    protected $fillable = [
        'id', 'id_dp', 'nome','controles', 'marca', 'tipo', 'updated_at'
    ];
}