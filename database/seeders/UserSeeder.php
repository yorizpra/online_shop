<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Risnanti',
            'level' => '0',
            'email' => 'risnanti@gmail.com',
            'password' => bcrypt('risnanti123')
        ]);
        User::create([
            'name' => 'Admin',
            'level' => '1',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
    }
}
