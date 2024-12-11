<?php

namespace Database\Seeders;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Create Roles
        $adminRole = Role::create(['name' => 'Admin']);
        $teacherRole = Role::create(['name' => 'Teacher']);
        $studentRole = Role::create(['name' => 'Student']);


  // Create Permissions
        $permissions = [
            'manage-users',
            'view-classes',
            'manage-classes',
            'view-grades',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign Permissions to Roles
        $adminRole->givePermissionTo(Permission::all());
        $teacherRole->givePermissionTo(['view-classes', 'manage-classes']);
        $studentRole->givePermissionTo(['view-grades']);


    }
}
