<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Categoria extends Model
{
    use SoftDeletes;
    protected $table = 'categoria';
    protected $primaryKey = 'id';
    protected $fillable = ['nombre', 'usuario_id'];

    protected $casts = [
        'usuario_id' => 'integer',
    ];

    public function tareas()
    {
        return $this->hasMany(Tareas::class, 'categoria_id');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}