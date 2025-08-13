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
        Schema::create('emergency_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('assigned_vet_id')->nullable();
            $table->string('species');
            $table->string('breed');
            $table->string('weight');
            $table->string('symptoms');
            $table->string('description');
            $table->string('status')->default('pending');

            $table->timestamp('sent_at')->useCurrent();
            $table->timestamps();
            $table->foreign('client_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_vet_id')->references('id')->on('users')->onDelete('set null');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emergency_requests');
    }
};
