<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;

class UsersTableSeederTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(0, 9999) as $i) {
            User::factory()
            ->state([
                'email' => 'test'.$i.'@example.com',
                'password' => Hash::make("password"),
            ])
            ->has(Service::factory()->count(1000))
            ->create();
        }
    }
}
