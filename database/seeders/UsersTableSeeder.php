<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Create Admin User
         $adminRole = Role::where('slug', 'admin')->first();

         $adminUser = new User();
         $adminUser->name = 'Admin';
         $adminUser->email = 'admin@admin.com';
         $adminUser->password = bcrypt('1234');
         $adminUser->role()->associate($adminRole);
         $adminUser->save();

         // Create Customer User
         $customerRole = Role::where('slug', 'customer')->first();

         $customerUser = new User();
         $customerUser->name = 'Customer';
         $customerUser->email = 'customer@customer.com';
         $customerUser->password = bcrypt('1234');
         $customerUser->role()->associate($customerRole);
         $customerUser->save();
    }
}
