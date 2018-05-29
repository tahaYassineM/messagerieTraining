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
        for( $i = 0; $i < 4; $i++)
        {
            DB::table('users')->insert([
                'name' => 'Taha Yassine',
                'email' => "taha$i@taha.com",
                'password' => bcrypt('tahataha')
            ]);
        }
    }
}
