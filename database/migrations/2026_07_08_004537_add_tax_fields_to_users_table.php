<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('npwp')->nullable()->after('email');
            $table->string('nik')->nullable()->after('npwp');
            $table->string('ptkp_status')->default('TK/0')->after('nik');
            $table->string('pekerjaan')->nullable()->after('ptkp_status');
            $table->boolean('is_admin')->default(false)->after('pekerjaan');
            $table->timestamp('last_active_at')->nullable()->after('is_admin');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['npwp', 'nik', 'ptkp_status', 'pekerjaan', 'is_admin', 'last_active_at']);
        });
    }
};
