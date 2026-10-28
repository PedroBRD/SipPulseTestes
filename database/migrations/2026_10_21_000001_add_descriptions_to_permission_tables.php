<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $tables = config('permission.table_names');

        foreach (['roles', 'permissions'] as $tableKey) {
            $tableName = $tables[$tableKey];

            if (Schema::hasTable($tableName) && ! Schema::hasColumn($tableName, 'description')) {
                Schema::table($tableName, function (Blueprint $table): void {
                    $table->text('description')->nullable();
                });
            }
        }
    }

    public function down(): void
    {
        $tables = config('permission.table_names');

        foreach (['roles', 'permissions'] as $tableKey) {
            $tableName = $tables[$tableKey];

            if (Schema::hasTable($tableName) && Schema::hasColumn($tableName, 'description')) {
                Schema::table($tableName, function (Blueprint $table): void {
                    $table->dropColumn('description');
                });
            }
        }
    }
};
