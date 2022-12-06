<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intervencion extends Model
{
    use HasFactory;
    protected $table = 'intervencion';
	protected $primaryKey  = 'id_intervencion';
}
