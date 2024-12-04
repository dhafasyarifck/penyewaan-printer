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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('quantity');
            $table->date('rental_date');
            $table->date('return_date');
            // Hapus atau komentari baris berikut jika sudah ada di database
            $table->date('delivery_date')->nullable();
            $table->time('delivery_time')->nullable();
            $table->string('status')->default('pending');
            $table->string('alamat'); // Untuk alamat pengiriman
            $table->string('no_telp'); // Nomor telepon kontak
            $table->string('atas_nama'); // Nama pemesan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
