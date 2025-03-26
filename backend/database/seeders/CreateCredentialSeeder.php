<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CreateCredentialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'admin',
            'user',
            'manager',
        ];

        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
            ]);
        }

        // Create admin user
        User::create(
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => bcrypt(12345678),
                'role_id' => Role::where('name', 'admin')->first()->id,
            ]
        );

    }


}
