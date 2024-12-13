<?php

namespace Database\Seeders;

use App\Models\Ticket;
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

        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $group = 'd422ac76-5d86-4d32-943b-5a6769af8e98';

        for ($i = 0; $i < 4; $i++) {
            Ticket::factory()->create([
                'group' => $group,
                'number' => Str::uuid(),
                'user_id' => $user->id,
            ]);
        }
    }
}
