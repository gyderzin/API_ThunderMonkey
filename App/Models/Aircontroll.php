<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Aircontroll extends Model
{
    protected $fillable = [
        'id', 'id_dp', 'nome','controles', 'marca', 'updated_at'
    ];
}