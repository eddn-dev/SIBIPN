<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('Usuario', function (Blueprint $table) {
            $table->timestamp('email_verified_at')->nullable()->after('passwordHash');
        });
    }

    public function down(): void
    {
        Schema::table('Usuario', function (Blueprint $table) {
            $table->dropColumn('email_verified_at');
        });
    }
};
