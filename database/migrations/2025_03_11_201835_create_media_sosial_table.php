<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('media_sosial', function (Blueprint $table) {
            $table->id(); // int(11) AUTO_INCREMENT PRIMARY KEY
            $table->string('whatsapp', 50); // varchar(50) NOT NULL
            $table->string('instagram', 50); // varchar(50) NOT NULL
            $table->string('tiktok', 50); // varchar(50) NOT NULL
            $table->string('twitter', 50); // varchar(50) NOT NULL
            $table->string('facebook', 50); // varchar(50) NOT NULL
            $table->string('email', 50); // varchar(50) NOT NULL
            $table->timestamps(); // created_at & updated_at (datetime DEFAULT CURRENT_TIMESTAMP)
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_sosial');
    }
};
