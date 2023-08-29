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
            [
                'id'         => 2,
                'name'       => 'subadmin1',
                'type'       => 'subadmin',
                'mobile'     => '987653211',
                'email'      => 'subadmin1@test.com',
                'password'   => $password,
                'image'      => '',
                'status'     => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
            [
                'id'         => 3,
                'name'       => 'subadmin2',
                'type'       => 'subadmin',
                'mobile'     => '9876543212',
                'email'      => 'subadmin2@test.com',
                'password'   => $password,
                'image'      => '',
                'status'     => 1,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")
            ],
        ];
        
        Admin::insert($AdminUser);
    }
}
