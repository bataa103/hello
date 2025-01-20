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
        // Create the 'plans' table
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Plan name
            $table->string('description')->nullable(); // Plan description
            $table->integer('price'); // Plan price
            $table->timestamps();
        });

        // Add columns to the 'users' table
        Schema::table('users', function (Blueprint $table) {
            $table->string('plan')->nullable(); // Plan type (free, plus, gold)
            $table->date('status_start_date')->nullable(); // Plan start date
            $table->date('status_end_date')->nullable(); // Plan end date
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the 'plans' table
        Schema::dropIfExists('plans');

        // Drop the added columns from the 'users' table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['plan', 'status_start_date', 'status_end_date']);
        });
    }
};

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('plans', function (Blueprint $table) {
//             $table->id();
//             $table->string('name');
//             $table->string('description');
//             $table->integer('price');
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('plans');
//     }
// };
