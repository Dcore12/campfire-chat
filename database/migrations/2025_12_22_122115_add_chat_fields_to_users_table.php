<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            // Tipo de utilizador
            $table->string('role')
                ->default('user')
                ->after('email');

            // Estado no chat
            $table->string('status')
                ->default('offline')
                ->after('role');

            // Avatar custom (opcional)
            $table->string('avatar')
                ->nullable()
                ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role', 'status', 'avatar']);
        });
    }
};
