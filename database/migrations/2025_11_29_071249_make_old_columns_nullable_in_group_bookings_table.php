<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use raw SQL to modify columns to nullable
        // First, set any empty strings to NULL, then modify the column
        $columns = [
            'origin',
            'destination',
            'trip',
            'seat',
            'adult',
            'child',
            'infants',
            'cabin_baggage',
            'checked_baggage',
            'additional_info',
            'login_id',
        ];

        foreach ($columns as $column) {
            if (Schema::hasColumn('group_bookings', $column)) {
                // Set empty strings to NULL first
                \DB::statement("UPDATE `group_bookings` SET `{$column}` = NULL WHERE `{$column}` = ''");
                // Then modify column to nullable
                \DB::statement("ALTER TABLE `group_bookings` MODIFY COLUMN `{$column}` VARCHAR(255) NULL");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_bookings', function (Blueprint $table) {
            // Revert old columns to not nullable (if needed)
            $oldColumns = [
                'origin',
                'destination',
                'trip',
                'seat',
                'adult',
                'child',
                'infants',
                'cabin_baggage',
                'checked_baggage',
                'additional_info',
                'login_id',
            ];

            foreach ($oldColumns as $column) {
                if (Schema::hasColumn('group_bookings', $column)) {
                    $table->string($column)->nullable(false)->change();
                }
            }
        });
    }
};
