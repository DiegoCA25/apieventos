<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
       /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\City::factory(6)->create();
        \App\Models\Event::factory(25)->create();

       // User::factory()->create([
         //   'name' => 'Test User',
         //   'email' => 'test@example.com',
        //]);
    }
}
