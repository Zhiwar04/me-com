<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //calling the user table seeder class & factory
        $this->call(
            [UserTableSeeder::class]
        );
        $this->call(
            [AdminTableSeeder::class]
        );
        $this->call(
            [VendorTableSeeder::class]
        );
         \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}