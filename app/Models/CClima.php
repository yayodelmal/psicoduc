<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CClima extends Model
{
    use HasFactory;
    protected $table = 'cuestionario_clima';
	protected $primaryKey  = 'id_clima';
}
