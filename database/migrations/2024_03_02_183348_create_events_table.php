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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('place');
            $table->date('date');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('organizer_id');
            $table->foreign('organizer_id')->references('id')->on('users');
            $table->integer('availablePlaces');
            $table->boolean('auto_confirmation')->default(false);
            $table->boolean('valid')->default(false);
            $table->timestamps();
        });
    }
};

