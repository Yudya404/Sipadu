<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
	{
		Schema::create('pengaduan', function (Blueprint $table) {
			$table->id(); // int(11) AUTO_INCREMENT PRIMARY KEY
			$table->string('kode_formulir', 20);
			$table->string('nik', 20);
			$table->string('nama', 100);
			$table->string('telp', 15);
			$table->string('email', 50);
			$table->string('alamat', 255);
			$table->enum('jenis_laporan', ['pengaduan', 'aspirasi']);
			$table->text('judul');
			$table->text('isi');
			$table->date('tgl_kejadian');
			$table->unsignedBigInteger('id_instansi');
			$table->enum('kategori', ['Asli', 'Spam']);
			$table->string('bukti', 255);
			$table->enum('status', ['Diajukan', 'Diproses', 'Selesai', 'Tidak diproses', 'Sudah diproses'])->default('Diajukan');
			$table->timestamp('tgl_buat')->useCurrent();
			$table->boolean('via_wa')->default(false); // tinyint(1) default 0
			$table->string('wa_number', 20)->nullable(); // WA pengirim
			$table->string('wa_message_id', 100)->nullable(); // ID pesan WhatsApp

			// Foreign key
			$table->foreign('id_instansi')->references('id')->on('instansi')->onDelete('cascade');
		});
	}

    public function down()
    {
        Schema::dropIfExists('pengaduan');
    }
};
