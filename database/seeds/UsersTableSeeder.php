<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'thongnq0906@gmail.com',
            'password' => Hash::make('nqt123'),
            'role' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'nqt',
            'email' => 'quocthonght95@gmail.com',
            'password' => Hash::make('ttthhh'),
            'role' => 1,
        ]);
    }
}
