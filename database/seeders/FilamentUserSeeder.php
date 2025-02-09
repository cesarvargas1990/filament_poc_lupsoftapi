<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class FilamentUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Verifica si ya existe un usuario con este correo
        $user = User::where('email', 'admin@example.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('password'), 
                
            ]);
        }
    }
}
