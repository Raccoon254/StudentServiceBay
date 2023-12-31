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
        Schema::create('scam_alerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_provider')->constrained('service_providers');
            $table->text('description');
            $table->date('date_reported')->useCurrent();
            $table->string('location_area');
            $table->foreignId('reported_by')->constrained('users');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scam_alerts');
    }
};
