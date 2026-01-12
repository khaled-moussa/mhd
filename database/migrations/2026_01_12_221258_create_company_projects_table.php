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
        Schema::create('company_projects', function (Blueprint $table) {
            $table->id();

            $table->uuid('uuid')
                ->unique();

            // Body columns
            $table->string('title');

            $table->longText('description');

            $table->date('delivered_at')
                ->nullable();

            $table->decimal('price_start')
                ->default(0);

            $table->string('address');

            $table->longText('location')
                ->nullable();

            $table->json('images')
                ->nullable();

            $table->string('visibility_state');

            // Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_projects');
    }
};
