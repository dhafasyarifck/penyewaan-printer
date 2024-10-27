<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel devices.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama perangkat
            $table->string('paper_size'); // Ukuran kertas
            $table->string('print_resolution'); // Resolusi Cetak
            $table->string('print_speed'); // Kecepatan cetak
            $table->string('print_result'); // Hasil print
            $table->string('capacity'); // Kapasitas cetak per bulan
            $table->string('recommended_volume'); // Volume bulanan yang direkomendasikan
            $table->string('power_consumption'); // Konsumsi daya
            $table->string('connectivity'); // Jenis konektivitas
            $table->integer('stock'); // Stok perangkat
            $table->decimal('rental_price', 10, 2); // Harga sewa
            $table->boolean('available')->default(true); // Status ketersediaan
            $table->string('image')->nullable(); // Kolom gambar
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Rollback migration.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('devices');
    }
}
