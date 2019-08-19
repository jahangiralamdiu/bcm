<?php
/**
 * Created by PhpStorm.
 * User: jahangir
 * Date: 8/19/19
 * Time: 10:11 PM
 */
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'mobile' => '01700111111',
            'email' => 'admin@bcm.com',
            'password' => '$2y$10$dtG9GCG.kjdBETxlM/0cdun6qhKM69Bo5twH6nyCAxMfnM0wyFnw.',
        ]);
    }
}