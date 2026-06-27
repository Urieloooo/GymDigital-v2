<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';

    protected $fillable = [
        'nombre_completo',
        'edad',
        'telefono',
        'correo',
        'genero',
        'fecha_inscripcion',
        'fecha_vencimiento',
        'estado',
        'membresia_id',
    ];

    protected $casts = [
        'fecha_inscripcion'  => 'date',
        'fecha_vencimiento'  => 'date',
    ];

    public function membresia()
    {
        return $this->belongsTo(Membresia::class, 'membresia_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'cliente_id');
    }

    public function historialEliminacion()
    {
        return $this->hasOne(HistorialEliminacion::class, 'cliente_id');
    }
}