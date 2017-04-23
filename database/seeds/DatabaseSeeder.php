<?php

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(AdminsTableSeeder::class);
    }
}
/**
*
*/
class AdminsTableSeeder extends Seeder
{
    public function run()
    {
        $admin = new Admin();
        $admin->email = 'test@gmail.com';
        $admin->name = 'test';
        $admin->password = Hash::make(123456);
        $admin->save();
    }
}
