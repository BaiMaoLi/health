<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'first_name'=>"bai",
            'last_name' =>'maoli',
            'email' => 'baimaoli9@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
