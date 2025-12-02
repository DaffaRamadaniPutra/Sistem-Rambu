<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rambus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nama_rambu');
            $table->enum('jenis', ['Larangan', 'Peringatan', 'Petunjuk', 'Perintah']);
            $table->text('lokasi');
            $table->enum('kondisi', ['Baik', 'Rusak', 'Perlu Perbaikan'])->default('Baik');
            $table->string('koordinat_gps')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rambus');
    }
};