<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminRole = Role::where('name', 'admin')->first();
        $urbanRole = Role::where('name', 'urban-farmer')->first();
        $ruralRole = Role::where('name', 'rural-farmer')->first();
        $agroRole = Role::where('name', 'agro-company')->first();

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'phone' => '0740204010',
            'national_id' => '00000000',
            'profile_image' => '',
            'description' => 'I am an Admin',
            'password' => Hash::make('password')
        ]);

        $urban = User::create([
            'name' => 'Urban Farmer',
            'email' => 'urban@urban.com',
            'phone' => '070708090605',
            'national_id' => '33333333',
            'profile_image' => '',
            'description' => 'I am an Urban Farmer',
            'password' => Hash::make('password')
        ]);

        $rural = User::create([
            'name' => 'ERural Farmer',
            'email' => 'rural@rural.com',
            'phone' => '0712345678',
            'national_id' => '22222222',
            'profile_image' => '',
            'description' => 'I am a Rural Farmer',
            'password' => Hash::make('password')
        ]);

        $agro = User::create([
            'name' => 'Agro-Company',
            'email' => 'agro@agro.com',
            'phone' => '0740104020',
            'national_id' => '00000001',
            'profile_image' => '',
            'description' => 'I am a Agro Company',
            'password' => Hash::make('password')
        ]);

        $admin->roles()->attach($adminRole);
        $urban->roles()->attach($urbanRole);
        $rural->roles()->attach($ruralRole);
        $agro->roles()->attach($agroRole);
    }
}
