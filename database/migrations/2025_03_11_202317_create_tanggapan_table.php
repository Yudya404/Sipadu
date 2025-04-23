<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tanggapan', function (Blueprint $table) {
            $table->id(); // int(11) AUTO_INCREMENT PRIMARY KEY
            $table->unsignedBigInteger('id_pengaduan'); // int(11) NOT NULL (Foreign Key)
            $table->string('kode_formulir', 20); // varchar(20) NOT NULL
            $table->unsignedBigInteger('id_users'); // int(11) NOT NULL (Foreign Key)
            $table->text('isi_tanggapan'); // TEXT NOT NULL
            $table->timestamp('tgl_ditanggapi')->useCurrent(); // DATETIME DEFAULT CURRENT_TIMESTAMP
			$table->boolean('via_wa')->default(false); // tinyint(1) default 0
			$table->string('wa_message_id', 100)->nullable(); // ID pesan WhatsApp
			$table->boolean('is_auto_reply')->default(false); // tinyint(1) default 0

            // Foreign Key Constraints
            $table->foreign('id_pengaduan')->references('id')->on('pengaduan')->onDelete('cascade');
            $table->foreign('id_users')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tanggapan');
    }
};

