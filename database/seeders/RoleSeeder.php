<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $deletePatientPermission = Permission::create(['name' => 'delete patient']);
        $addPrescriberPermission = Permission::create(['name' => 'add prescriber']);
        $managePrescriberIformationsPermission = Permission::create(['name' => 'manage prescriber informations']);
        $checkDashboardPermission = Permission::create(['name' => 'check dashboard']);
        $checkInsightsPermission = Permission::create(['name' => 'check insights']);

        $adminRole = Role::create(['name' => 'admin']);
        // $accountantRole = Role::create(['name' => 'editor']);

        $adminRole->givePermissionTo($deletePatientPermission, $addPrescriberPermission, $managePrescriberIformationsPermission, $checkDashboardPermission, $checkInsightsPermission);

        // Attribution de rôles à un utilisateur (exemple)
        $user = \App\Models\User::find(1); 
        if ($user) {
            $user->assignRole('admin');
        }
    }
}
