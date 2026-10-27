<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
<<<<<<< HEAD
   public function run(): void
    {
    $this->call([
        RolSeeder::class,
        UsuarioFijoSeeder::class,
    ]);
=======
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
>>>>>>> d606654 (proyecto de la puta cabra del fortnite)
    }
}
