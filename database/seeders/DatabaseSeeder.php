<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Barang;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\Role::factory()->create(['name' => 'User',]);
        \App\Models\Role::factory()->create(['name' => 'Admin',]);

        \App\Models\User::factory(50)->create();
    }
}
