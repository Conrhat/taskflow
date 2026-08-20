<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use Notifiable, SoftDeletes;

    protected $table = 'categoria';  
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'descripcion'];
}
