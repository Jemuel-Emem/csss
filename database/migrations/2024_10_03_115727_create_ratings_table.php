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
            $table->string('age');
            $table->string('sex');
            $table->string('region');
            $table->string('agency_visited');
            $table->string('service_availed');
            $table->string('customer_type');
            $table->integer('cc1');
            $table->integer('cc2');
            $table->integer('cc3');
            $table->string('sd');
            $table->string('d');
            $table->string('nad');
            $table->string('a');
            $table->string('sa');
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
