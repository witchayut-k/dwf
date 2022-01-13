<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableNames = config('permission.table_names');
        $columnNames = config('permission.column_names');

        Schema::create($tableNames['permissions'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        Schema::create($tableNames['roles'], function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('guard_name');
            $table->timestamps();
        });

        // user_permissions
        Schema::create($tableNames['model_has_permissions'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('permission_id');

            $table->string('model_type');
            $table->unsignedInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type',]);

            $table->primary(
                ['permission_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_permissions_permission_model_type_primary'
            );

            /**
             * Foreign Keys
             */

            // $table->foreign('permission_id')
            //     ->references('id')->on($tableNames['permissions'])
            //     ->onDelete('no action');

            // $table->foreign('model_id')
            //     ->references('id')->on('users')
            //     ->onDelete('no action');
        });

        // user_roles
        Schema::create($tableNames['model_has_roles'], function (Blueprint $table) use ($tableNames, $columnNames) {
            $table->unsignedInteger('role_id');

            $table->string('model_type');
            $table->unsignedInteger($columnNames['model_morph_key']);
            $table->index([$columnNames['model_morph_key'], 'model_type',]);

            $table->primary(
                ['role_id', $columnNames['model_morph_key'], 'model_type'],
                'model_has_roles_role_model_type_primary'
            );

            /**
             * Foreign Keys
             */

            // $table->foreign('role_id')
            //     ->references('id')->on($tableNames['roles'])
            //     ->onDelete('no action');

            // $table->foreign('model_id')
            //     ->references('id')->on('users')
            //     ->onDelete('no action');
        });

        Schema::create($tableNames['role_has_permissions'], function (Blueprint $table) use ($tableNames) {
            $table->unsignedInteger('permission_id');
            $table->unsignedInteger('role_id');

            // $table->foreign('permission_id')
            //     ->references('id')
            //     ->on($tableNames['permissions'])
            //     ->onDelete('no action');

            // $table->foreign('role_id')
            //     ->references('id')
            //     ->on($tableNames['roles'])
            //     ->onDelete('no action');

            $table->primary(['permission_id', 'role_id']);

            app('cache')->forget('spatie.permission.cache');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableNames = config('permission.table_names');

        Schema::drop($tableNames['role_has_permissions']);
        Schema::drop($tableNames['model_has_roles']);
        Schema::drop($tableNames['model_has_permissions']);
        Schema::drop($tableNames['roles']);
        Schema::drop($tableNames['permissions']);
    }
}
