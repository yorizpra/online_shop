<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class adminseeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Admin::create([
            'nama' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
        \App\Models\Admin::create([
            'nama' => 'admin',
            'email' => 'sasa@gmail.com',
            'password' => bcrypt('sasa123')
        ]);
        
    }
}
