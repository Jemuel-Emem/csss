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
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('office_id');
            $table->unsignedBigInteger('service_id');
            $table->string('name');
            $table->string('age');
            $table->string('sex');
            $table->string('region');
            $table->string('customer_type');
            $table->integer('cc1');
            $table->integer('cc2');
            $table->integer('cc3');
            $table->integer('sd');
            $table->integer('d');
            $table->integer('nad');
            $table->integer('a');
            $table->integer('sa');
            $table->text('remarks')->nullable();
            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ratings');
    }
};
