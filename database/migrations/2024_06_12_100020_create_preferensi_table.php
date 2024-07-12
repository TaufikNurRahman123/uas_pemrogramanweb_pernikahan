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
        Schema::create('preferensis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kr_id');
            $table->foreign('kr_id')->references('id')->on('kriterias')->onDelete('cascade');
            $table->float('v', 8, 4);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('preferensis');
    }
};
