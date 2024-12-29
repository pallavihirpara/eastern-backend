<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ];
        Role::insert($data); 
        User::create([
            'email' => 'admin@gmail.com',
            'password' => Hash::make('123456'),
            'role_id' => 1,
        ]);

        $user = User::find(1);
        $user->roles()->attach(1,['created_at' => now(),'updated_at' => now()]);
    }
}
