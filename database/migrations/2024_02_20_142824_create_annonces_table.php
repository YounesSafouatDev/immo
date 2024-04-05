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
        Schema::create('annonces', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type',['Vente','Location']);
            $table->string('city');
            $table->string('address');
            $table->string('map')->nullable();
            $table->enum('status',['Neuf','Occasion','Vide','Meublé'])->nullable();
            $table->string('price');
            $table->integer('surface');
            $table->integer('bedroom')->nullable();
            $table->integer('bathroom')->nullable();
            $table->boolean('is_valid')->default(false)->nullable();
            $table->boolean('is_premium')->default(false)->nullable();
            $table->foreignId('user_id')->default(1)->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annonces');
    }
};
