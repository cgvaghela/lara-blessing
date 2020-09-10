<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('admin')->delete();
        $admin = array(
            array(
                'role' => 'main',
                'email' => 'vaghelac@gmail.com',
                'username' => 'admin',
                'password' => Hash::make('123456'),
                'created_at' => new DateTime,
                'updated_at' => new DateTime
            )
        );

        DB::table('admin')->insert($admin);
    }
}
