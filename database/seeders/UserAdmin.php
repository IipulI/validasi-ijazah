<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserAdmin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@mail.co',
            'password' => Hash::make('12345678')
        ]);

        DB::table('admin')->insert([
            'user_id' => DB::table('users')->where('email', 'admin@mail.co')->first()->id,
            'nama' => 'admin'
        ]);
    }
}
