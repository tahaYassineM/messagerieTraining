<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeds extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for( $i = 0; $i < 10; $i++)
        {
            DB::table('users')->insert([
                'name' => "Taha Yassine $i",
                'email' => "taha$i@taha.com",
                'password' => bcrypt('tahataha')
            ]);
        }
    }
}
