<?php

namespace Database\Seeders;

use App\Models\Categori;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Categori::create([
            'name' => 'Aliment',
            'slug' => Str::slug('aliment','_')
        ]);

        Categori::create([
            'name' => 'Santé',
            'slug' => Str::slug('santé','_')
        ]);

        Categori::create([
            'name' => 'Sport',
            'slug' => Str::slug('sport','_')
        ]);

        Categori::create([
            'name' => 'Technologie',
            'slug' => Str::slug('technologie','_')
        ]);

        Categori::create([
            'name' => 'Culture',
            'slug' => Str::slug('culture','_')
        ]);
        
        User::create([
            'name' => 'Admin',
            'email' => 'admin21@gmail.com',
            'password' => bcrypt('admin21'),
            'role' => 'admin', // Assigning the admin role
        ]);

    }
}
