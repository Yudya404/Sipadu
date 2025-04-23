<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tentang_kami', function (Blueprint $table) {
            $table->id(); // int(11) AUTO_INCREMENT PRIMARY KEY
            $table->longText('video'); // LONGTEXT NOT NULL
            $table->longText('deskripsi'); // LONGTEXT NOT NULL
            $table->string('gambar1', 255); // VARCHAR(255) NOT NULL
            $table->string('gambar2', 255); // VARCHAR(255) NOT NULL
            $table->string('ket_gambar1', 255); // VARCHAR(255) NOT NULL
            $table->string('ket_gambar2', 255); // VARCHAR(255) NOT NULL
            $table->timestamps(); // created_at & updated_at (default CURRENT_TIMESTAMP)
        });
    }

    public function down()
    {
        Schema::dropIfExists('tentang_kami');
    }
};
