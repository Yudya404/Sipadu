<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('migrations', function (Blueprint $table) {
            $table->increments('id'); // int(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY
            $table->string('migration', 255); // VARCHAR(255) NOT NULL
            $table->integer('batch'); // INT(11) NOT NULL
        });
    }

    public function down()
    {
        Schema::dropIfExists('migrations');
    }
};
