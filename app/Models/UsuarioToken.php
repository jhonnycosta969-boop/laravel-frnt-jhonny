<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use app\Models\Usuario;

class UsuarioToken extends Model
{
    protected $table = 'usuario_token';

    protected $fillable = [
        'usuario_id',
        'token',
        'valido_ate',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }
}
