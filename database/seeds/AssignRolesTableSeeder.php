<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;

class AssignRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      // Roles
      $superAdmin = Role::where('name', '=', 'super-admin')->first();

      $superAdminUser = User::where('name', '=', 'Super Admin User')->first();
      $superAdminUser->attachRole($superAdmin);
    }
}
