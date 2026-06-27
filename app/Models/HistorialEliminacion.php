<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialEliminacion extends Model
{
    protected $table = 'historial_eliminaciones';

    protected $fillable = [
        'cliente_id',
        'motivo',
        'fecha_eliminacion',
        'eliminado_por',
    ];

    protected $casts = [
        'fecha_eliminacion' => 'date',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

    public function eliminadoPor()
    {
        return $this->belongsTo(User::class, 'eliminado_por');
    }
}