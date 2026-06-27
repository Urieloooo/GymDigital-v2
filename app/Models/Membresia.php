<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membresia extends Model
{
    protected $table = 'membresias';

    protected $fillable = [
        'nombre',
        'duracion_dias',
        'precio',
        'descripcion',
    ];

    public function clientes()
    {
        return $this->hasMany(Cliente::class, 'membresia_id');
    }

    public function pagos()
    {
        return $this->hasMany(Pago::class, 'membresia_id');
    }
}