<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('opportunities', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('description');
        $table->string('location')->nullable();
        $table->date('start_date');
        $table->date('end_date')->nullable();
        $table->unsignedBigInteger('organization_id'); // FK to users table
        $table->timestamps();

        $table->foreign('organization_id')->references('id')->on('users')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
