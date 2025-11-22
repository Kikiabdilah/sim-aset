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
        Schema::create('usulan_asets', function (Blueprint $table) {
            $table->id();
            $table->string('kd_usulan')->nullable();
            $table->string('kd_brg')->nullable();
            $table->string('nm_brg')->nullable();
            $table->string('jns_brg')->nullable();
            $table->integer('jmlh_brg')->nullable();
            $table->string('satuan_brg')->nullable();
            $table->double('harga_brg')->nullable();
            $table->integer('masa_manfaat')->nullable();
            $table->text('ket')->nullable();

            // approval manager
            $table->string('stts_approval_mg')->default('pending');
            $table->date('tgl_approval_mg')->nullable();

            // approval direktur
            $table->string('stts_approval_dir')->default('pending');
            $table->date('tgl_approval_dir')->nullable();

            // pengadaan
            $table->string('stts_pengadaan')->default('belum');
            $table->date('tgl_pengadaan')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usulan_asets');
    }
};
