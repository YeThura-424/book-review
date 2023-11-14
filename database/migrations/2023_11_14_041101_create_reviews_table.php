<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('review');
            $table->unsignedInteger('rating');
            $table->foreignId('user_id')->reference('id')->on('users')->onDelete('cascade');
            $table->foreignId('book_id')->reference('id')->on('books')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'book_id']); // Ensure one review per user per book

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
