<?php

use App\Panel\Enums\PanelEnum;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')
                ->index()
                ->unique();

            $table->string('first_name')
                ->index();

            $table->string('last_name')
                ->nullable()
                ->index();

            $table->string('phone')
                ->nullable()
                ->index()
                ->unique();

            $table->string('email')
                ->index()
                ->unique();

            $table->string('position')
                ->nullable();

            $table->string('company_name')
                ->nullable();

            $table->enum('panel_id', PanelEnum::values())
                ->default('user');

            $table->string('password')
                ->nullable();

            $table->string('provider')
                ->nullable();

            $table->string('social_id')
                ->nullable();

            $table->rememberToken();

            // Timestamps
            $table->timestamp('email_verified_at')
                ->nullable();

            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')
                ->primary();

            $table->string('token');

            $table->timestamp('created_at')
                ->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')
                ->primary();

            $table->foreignId('user_id')
                ->nullable()
                ->index();

            $table->string('ip_address', 45)
                ->nullable();

            $table->text('user_agent')
                ->nullable();

            $table->longText('payload');

            $table->integer('last_activity')
                ->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
