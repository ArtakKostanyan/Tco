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
        $manager = \App\Models\User::firstOrCreate([
            'email' => 'manager@email.com',
        ], [
            'password' => bcrypt('123456'),
            'name'     => 'Manager',
        ]);
        $manager->assignRole('manager');

        $developer = \App\Models\User::firstOrCreate([
            'email' => 'developer@email.com',
        ], [
            'password' => bcrypt('123456'),
            'name'     => 'Developer',
        ]);
        $developer->assignRole('developer');

        $developer = \App\Models\User::firstOrCreate([
            'email' => 'test@email.com',
        ], [
            'password' => bcrypt('123456'),
            'name'     => 'Test',
        ]);
        $developer->assignRole('developer');
    }
}
