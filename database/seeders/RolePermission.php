<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use DB;
use Spatie\Permission\Models\Role;

class RolePermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = [
            ['name' => 'manage-admin', 'guard_name' => 'admin'],
            ['name' => 'manage-role', 'guard_name' => 'admin'],
            ['name' => 'manage-referral', 'guard_name' => 'admin'],
            ['name' => 'signal', 'guard_name' => 'admin'],
            ['name' => 'manage-plan', 'guard_name' => 'admin'],
            ['name' => 'manage-user', 'guard_name' => 'admin'],
            ['name' => 'manage-ticket', 'guard_name' => 'admin'],
            ['name' => 'manage-gateway', 'guard_name' => 'admin'],
            ['name' => 'payments', 'guard_name' => 'admin'],
            ['name' => 'manage-withdraw', 'guard_name' => 'admin'],
            ['name' => 'manage-deposit', 'guard_name' => 'admin'],
            ['name' => 'manage-theme', 'guard_name' => 'admin'],
            ['name' => 'manage-email', 'guard_name' => 'admin'],
            ['name' => 'manage-setting', 'guard_name' => 'admin'],
            ['name' => 'manage-language', 'guard_name' => 'admin'],
            ['name' => 'manage-logs', 'guard_name' => 'admin'],
            ['name' => 'manage-frontend', 'guard_name' => 'admin'],
            ['name' => 'manage-subscriber', 'guard_name' => 'admin'],
            ['name' => 'manage-report', 'guard_name' => 'admin'],
        ];

        DB::table('permissions')->insert($permission);

        $adminRole = Role::create(['name' => 'Admin','guard_name' => 'admin']);

        $adminRole->givePermissionTo([
            'manage-admin',
            'manage-role',
            'manage-referral',
            'signal',
            'manage-plan',
            'manage-user',
            'manage-ticket',
            'manage-gateway',
            'payments',
            'manage-withdraw',
            'manage-deposit',
            'manage-theme',
            'manage-email',
            'manage-setting',
            'manage-language',
            'manage-logs',
            'manage-frontend',
            'manage-subscriber',
            'manage-report',
        ]);
        $admin = Admin::first();

        $admin->assignRole('Admin');
    }
}
