<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('footer', function (Blueprint $table) {
            $table->id(); // int(11) AUTO_INCREMENT PRIMARY KEY
            $table->longText('maps'); // longtext NOT NULL
            $table->string('telp', 20); // varchar(20) NOT NULL
            $table->string('alamat', 255); // varchar(255) NOT NULL
            $table->string('gambar1', 255); // varchar(255) NOT NULL
            $table->string('gambar2', 255); // varchar(255) NOT NULL
            $table->string('gambar3', 255); // varchar(255) NOT NULL
            $table->timestamps(0); // created_at & updated_at dengan default CURRENT_TIMESTAMP
        });
    }

    public function down()
    {
        Schema::dropIfExists('footer');
    }
};
