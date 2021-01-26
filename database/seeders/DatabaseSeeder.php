<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        
        User::create([
            'name' => 'Admin',
            'lastname' => 'Admin',
            'telefono' => '123456789',
            'documento' => '123456789',
            'birthday' => '1999-12-24',
            'email' => 'admin@admin.com',
            'password' => Hash::make('Admin12345678.'),

        ]);
        \App\Models\User::factory(20)->create();
    }
}
