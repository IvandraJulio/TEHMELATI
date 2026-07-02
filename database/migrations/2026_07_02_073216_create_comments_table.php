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
        Schema::create('comments', function (Blueprint $table) {
            $table->string('id', 50)->primary();
            $table->string('ticketId', 50);
            $table->string('authorId', 50);
            $table->string('authorName', 100);
            $table->string('authorRole', 50);
            $table->text('text');
            $table->string('timestamp', 50);
            $table->string('type', 50);
            $table->timestamps();

            $table->foreign('ticketId')->references('id')->on('tickets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
