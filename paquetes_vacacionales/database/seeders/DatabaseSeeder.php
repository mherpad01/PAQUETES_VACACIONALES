<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============================================
        // USUARIOS (6 en total)
        // ============================================
        
        // 1. Admin Principal
        User::factory()->create([
            'name' => 'Admin Principal',
            'email' => 'admin@wanderluxe.com',
            'password' => bcrypt('password'),
            'rol' => 'admin',
        ]);

        // 2. Usuario Avanzado 1
        User::factory()->create([
            'name' => 'María García',
            'email' => 'maria@wanderluxe.com',
            'password' => bcrypt('password'),
            'rol' => 'advanced',
        ]);

        // 3. Usuario Avanzado 2
        User::factory()->create([
            'name' => 'Carlos Rodríguez',
            'email' => 'carlos@wanderluxe.com',
            'password' => bcrypt('password'),
            'rol' => 'advanced',
        ]);

        // 4. Usuario Normal 1
        User::factory()->create([
            'name' => 'Laura Martínez',
            'email' => 'laura@wanderluxe.com',
            'password' => bcrypt('password'),
            'rol' => 'normal',
        ]);

        // 5. Usuario Normal 2
        User::factory()->create([
            'name' => 'David Fernández',
            'email' => 'david@wanderluxe.com',
            'password' => bcrypt('password'),
            'rol' => 'normal',
        ]);

        // 6. Usuario Normal 3
        User::factory()->create([
            'name' => 'Ana López',
            'email' => 'ana@wanderluxe.com',
            'password' => bcrypt('password'),
            'rol' => 'normal',
        ]);

        // Llamar a los demás seeders
        $this->call([
            TipoSeeder::class,
            VacacionSeeder::class,
        ]);
    }
}