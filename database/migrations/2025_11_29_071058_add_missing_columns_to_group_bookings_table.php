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
        Schema::table('group_bookings', function (Blueprint $table) {
            // Add missing columns if they don't exist
            if (!Schema::hasColumn('group_bookings', 'from_city')) {
                $table->string('from_city')->nullable()->after('id');
            }
            if (!Schema::hasColumn('group_bookings', 'to_city')) {
                $table->string('to_city')->nullable()->after('from_city');
            }
            if (!Schema::hasColumn('group_bookings', 'passengers')) {
                $table->string('passengers')->nullable()->after('return_date');
            }
            if (!Schema::hasColumn('group_bookings', 'organization')) {
                $table->string('organization')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('group_bookings', 'requirements')) {
                $table->text('requirements')->nullable()->after('organization');
            }
            if (!Schema::hasColumn('group_bookings', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('requirements');
            }
            if (!Schema::hasColumn('group_bookings', 'user_agent')) {
                $table->text('user_agent')->nullable()->after('ip_address');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('group_bookings', function (Blueprint $table) {
            // Remove columns if they exist
            if (Schema::hasColumn('group_bookings', 'from_city')) {
                $table->dropColumn('from_city');
            }
            if (Schema::hasColumn('group_bookings', 'to_city')) {
                $table->dropColumn('to_city');
            }
            if (Schema::hasColumn('group_bookings', 'passengers')) {
                $table->dropColumn('passengers');
            }
            if (Schema::hasColumn('group_bookings', 'organization')) {
                $table->dropColumn('organization');
            }
            if (Schema::hasColumn('group_bookings', 'requirements')) {
                $table->dropColumn('requirements');
            }
            if (Schema::hasColumn('group_bookings', 'ip_address')) {
                $table->dropColumn('ip_address');
            }
            if (Schema::hasColumn('group_bookings', 'user_agent')) {
                $table->dropColumn('user_agent');
            }
        });
    }
};
