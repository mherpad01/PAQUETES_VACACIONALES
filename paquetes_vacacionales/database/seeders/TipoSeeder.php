<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoSeeder extends Seeder
{
    public function run(): void
    {
        $tipos = [
            ['nombre' => 'Playa', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Montaña', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Ciudad', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Aventura', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Cultural', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Romántico', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Familiar', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Lujo', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Económico', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Safari', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Crucero', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Islas', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('tipos')->insert($tipos);
    }
}