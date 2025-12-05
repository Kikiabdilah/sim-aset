<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usulan_aset_id');
            $table->date('tgl_maintenance');
            $table->string('jenis');
            $table->integer('biaya')->nullable();
            $table->text('catatan')->nullable();
            $table->string('bukti')->nullable(); // foto atau dokumen
            $table->timestamps();

            $table->foreign('usulan_aset_id')->references('id')->on('usulan_asets')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
