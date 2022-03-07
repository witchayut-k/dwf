<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('Alter Table user_roles NOCHECK Constraint All');
        // \DB::unprepared('SET IDENTITY_INSERT user_roles ON');
        \DB::table('user_roles')->truncate();

        $users = User::where('migrate_user_role_id', '<>', null)->get();

        foreach ($users as $user) {
            \DB::table('user_roles')->insert(array(
                [
                    'role_id' => $user->migrate_user_role_id,
                    'model_type' => 'App\\Models\\User',
                    'model_id' => $user->id
                ]
            ));
        }
    }
}
