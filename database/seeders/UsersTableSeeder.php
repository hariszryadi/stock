<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Super Admin',
                'email' => 'super@stock.id',
                'username' => 'superadmin',
                'password' => bcrypt('superadmin'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Admin Cimahi',
                'email' => 'admin_cimahi@stock.id',
                'username' => 'admin_cimahi',
                'password' => bcrypt('admin_cimahi'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'name' => 'Admin Bukittinggi',
                'email' => 'admin_bukittingi@stock.id',
                'username' => 'admin_bukittingi',
                'password' => bcrypt('admin_bukittingi'),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]
        ];

        DB::table('users')->delete();
        DB::table('users')->insert($data);
    }
}
