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
        //以下を追加します
        DB::table('users')->insert([
        'username' => '菊池',
        'mail' => 'kikuchi@yahoo.co.jp',
        'password' => bcrypt('kikuchi') ,//後ほど調べる
        ]);
    }
}
