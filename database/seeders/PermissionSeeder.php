<?php

namespace Database\Seeders;

use App\Enums\PermissionEnum;
use App\Enums\UserRoleEnum;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();
        // \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::unprepared('SET IDENTITY_INSERT permissions ON');
        \DB::statement('Alter Table permissions NOCHECK Constraint All');
        \DB::table('permissions')->truncate();

        foreach (PermissionEnum::getKeys() as $item) {
            \DB::table('permissions')->insert([
                [
                    'id' => PermissionEnum::getValue($item),
                    'name' => PermissionEnum::getDescription(PermissionEnum::getValue($item)),
                    'guard_name' => 'web',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
        \DB::unprepared('SET IDENTITY_INSERT permissions OFF');

        // \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::statement('Alter Table roles NOCHECK Constraint All');
        \DB::unprepared('SET IDENTITY_INSERT roles ON');
        \DB::table('roles')->truncate();
        \DB::table('roles')->insert(array(
            [
                'id' => UserRoleEnum::USER,
                'name' => UserRoleEnum::getDescription(UserRoleEnum::USER),
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'id' => UserRoleEnum::ADMIN,
                'name' => UserRoleEnum::getDescription(UserRoleEnum::ADMIN),
                'guard_name' => 'web',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ));
        \DB::unprepared('SET IDENTITY_INSERT roles OFF');

        // \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::statement('Alter Table user_roles NOCHECK Constraint All');
        // \DB::unprepared('SET IDENTITY_INSERT user_roles ON');
        \DB::table('user_roles')->truncate();
        \DB::table('user_roles')->insert(array(
            [
                'role_id' => UserRoleEnum::ADMIN,
                'model_type' => 'App\\Models\\User',
                'model_id' => 1
            ],
            [
                'role_id' => UserRoleEnum::USER,
                'model_type' => 'App\\Models\\User',
                'model_id' => 2
            ],
        ));
        // \DB::unprepared('SET IDENTITY_INSERT user_roles OFF');

        // \DB::statement('SET FOREIGN_KEY_CHECKS=0');
        \DB::statement('Alter Table role_permissions NOCHECK Constraint All');
        // \DB::unprepared('SET IDENTITY_INSERT role_permissions ON');
        \DB::table('role_permissions')->truncate();

        // Admin
        foreach (PermissionEnum::getKeys() as $item) {
            \DB::table('role_permissions')->insert([
                ['role_id' => UserRoleEnum::ADMIN, 'permission_id' => PermissionEnum::getValue($item)]
            ]);
        }

        
        // \DB::unprepared('SET IDENTITY_INSERT role_permissions OFF');


    }
}
