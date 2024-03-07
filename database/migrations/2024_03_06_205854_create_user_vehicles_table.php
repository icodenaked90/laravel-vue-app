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
        Schema::create('user_vehicles', function (Blueprint $table) {
            $table->id(); // You may use 'bigIncrements' instead of 'id' if you want a big integer auto-incrementing primary key.
            $table->unsignedBigInteger('owner'); // Assuming the owner is a user ID, adjust the data type accordingly.
            $table->string('vehname');
            $table->decimal('vehiclecost', 10, 2); // Adjust precision and scale based on your requirements.
            $table->timestamps();

            // Foreign key relationship with the users table (assuming 'id' is the primary key of the 'users' table).
            $table->foreign('owner')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_vehicles');
    }
};
