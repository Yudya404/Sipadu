<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // int(11) AUTO_INCREMENT PRIMARY KEY
            $table->bigInteger('nip')->unique(); // bigint(20) NOT NULL (NIP harus unik)
            $table->string('nama', 100); // VARCHAR(100) NOT NULL
            $table->string('telp', 20); // VARCHAR(20) NOT NULL
            $table->string('email', 50)->unique(); // VARCHAR(50) NOT NULL, harus unik
            $table->string('alamat', 255); // VARCHAR(255) NOT NULL
            $table->unsignedBigInteger('id_instansi'); // int(11) NOT NULL, foreign key
            $table->string('jabatan', 50); // VARCHAR(50) NOT NULL
            $table->enum('role', ['Super user', 'Kepala', 'Operator', 'Admin']); // ENUM NOT NULL
            $table->string('foto', 255); // VARCHAR(255) NOT NULL
            $table->bigInteger('username')->unique(); // bigint(20) NOT NULL, harus unik
            $table->string('password', 255); // VARCHAR(255) NOT NULL
            $table->timestamp('tgl_buat')->useCurrent(); // datetime DEFAULT current_timestamp()
            $table->timestamp('aktivitas_login')->useCurrent(); // datetime DEFAULT current_timestamp()
            
            // Foreign key
            $table->foreign('id_instansi')->references('id')->on('instansi')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
