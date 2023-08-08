<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('12345678');
        $AdminUser = [
            'id'         => 1,
            'name'       => 'admin',
            'type'       => 'admin',
            'mobile'     => '9876543210',
            'email'      => 'ambalavanan@essopl.in',
            'password'   => $password,
            'image'      => '',
            'status'     => 1,
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
        ];
        
        Admin::insert($AdminUser);
    }
}
