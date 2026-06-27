<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MembresiasSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('membresias')->insert([
            [
                'nombre'        => 'Acceso por día',
                'duracion_dias' => 1,
                'precio'        => 50.00,
                'descripcion'   => 'Acceso al gimnasio por un solo día',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nombre'        => 'Mensual',
                'duracion_dias' => 30,
                'precio'        => 300.00,
                'descripcion'   => 'Acceso ilimitado durante un mes',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nombre'        => 'Semestral',
                'duracion_dias' => 180,
                'precio'        => 1500.00,
                'descripcion'   => 'Acceso ilimitado durante seis meses',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'nombre'        => 'Anual',
                'duracion_dias' => 365,
                'precio'        => 2500.00,
                'descripcion'   => 'Acceso ilimitado durante un año',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ]);
    }
}