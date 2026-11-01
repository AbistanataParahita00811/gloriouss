<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('orders')) {
            return;
        }

        $driver = Schema::getConnection()->getDriverName();

        // MySQL: perluas ENUM. PostgreSQL memakai string, tidak perlu ALTER.
        if ($driver === 'mysql') {
            DB::statement("
                ALTER TABLE `orders`
                MODIFY `status` ENUM(
                    'pending',
                    'confirmed',
                    'processed',
                    'shipping',
                    'completed',
                    'cancelled'
                ) NOT NULL DEFAULT 'pending'
            ");
        }
    }

    public function down(): void
    {
        if (! Schema::hasTable('orders')) {
            return;
        }

        $driver = Schema::getConnection()->getDriverName();

        if ($driver === 'mysql') {
            DB::statement("
                ALTER TABLE `orders`
                MODIFY `status` ENUM(
                    'pending',
                    'confirmed',
                    'processed',
                    'cancelled'
                ) NOT NULL DEFAULT 'pending'
            ");
        }
    }
};
