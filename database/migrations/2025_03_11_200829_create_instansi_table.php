<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('instansi', function (Blueprint $table) {
            $table->id(); // Otomatis membuat kolom id INT(11) AUTO_INCREMENT PRIMARY KEY
            $table->string('nama', 255); // VARCHAR(255) NOT NULL
			$table->string('induk', 255); // VARCHAR(255) NOT NULL
			$table->string('tipe', 255); // VARCHAR(255) NOT NULL
            $table->timestamps(); // Menambahkan created_at dan updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('instansi');
    }
};
