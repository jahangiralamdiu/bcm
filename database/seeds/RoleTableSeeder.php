<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => 'MEMBER',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => 'ADMIN',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => 'MANAGER',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => 'ACCOUNTANT',
                ),
            4 =>
                array (
                    'id' => 5,
                    'name' => 'AUTHORITY',
                ),
        ));
    }
}
