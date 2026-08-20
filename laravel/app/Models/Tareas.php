<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    use Notifiable, SoftDeletes;
    protected $table = 'tareas';
    protected $primaryKey = 'id';
    protected $fillable = ['titulo', 'descripcion', 'categoria_id', 'usuario_id'];

    function categoria()
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
   
}
