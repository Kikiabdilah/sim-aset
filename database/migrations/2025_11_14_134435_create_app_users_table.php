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
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->string('username', 25)->unique();
            $table->string('password', 255);
            $table->string('nama_pegawai', 60);
            $table->string('nik', 20);
            $table->tinyInteger('role'); // 1=admin, 2=manager, 3=direktur
            $table->integer('status')->default(1);
            $table->integer('valid')->default(1);
            $table->string('image', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_users');
    }
};
