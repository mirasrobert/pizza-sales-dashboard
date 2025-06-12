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
        Schema::create('pizzas', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('pizza_type_id');
            $table->string('size', 5)->comment('S, M, L, XL, XXL');
            $table->decimal('price', 8, 2);

            $table->index('pizza_type_id');
            $table->foreign('pizza_type_id')
                  ->references('id')
                  ->on('pizza_types')
                  ->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pizzas');
    }
};
