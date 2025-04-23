<?php

namespace App\Exports;

use App\Models\Pengaduan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class PengaduanExport implements FromCollection, WithHeadings, WithMapping, WithEvents, WithTitle
{
    public function collection()
    {
        return Pengaduan::with(['instansi', 'tanggapan.user'])
            ->whereIn('status', ['Selesai', 'Tidak Diproses'])
            ->get();
    }

    // Judul sheet pada Excel
    public function title(): string
    {
        return 'Laporan Pengaduan';
    }

    // Tambahkan kop surat dan heading tabel
    public function headings(): array
    {
        return [
            ['PEMERINTAH KABUPATEN PASURUAN'],
            ['PANITIA PELAKSANA SELEKSI PENERIMAAN CALON KOMISARIS PT. JALAN TOL KABUPATEN PASURUAN'],
            ['Sekretariat: Kompleks Perkantoran Pemerintah Kabupaten Pasuruan, Jalan Raya Raci Km. 9 Pasuruan'],
            [''], // Baris kosong untuk pemisah kop surat dan tabel
            // Header tabel utama
            ['ID', 'Kode Formulir', 'NIK', 'Nama Pelapor', 'Judul Laporan', 'Isi Laporan', 'Instansi', 'Tanggal Diajukan', 'Isi Tanggapan', 'Tanggal Ditanggapi', 'Status', 'Nama Petugas']
        ];
    }

    // Format data agar relasi dapat diambil dengan benar
    public function map($pengaduan): array
{
    $tanggapan = $pengaduan->tanggapan->first();

    return [
        $pengaduan->id,
        $pengaduan->kode_formulir,
        "'".$pengaduan->nik, // Menghindari format ilmiah
        $pengaduan->nama,
        $pengaduan->judul,
        strip_tags($pengaduan->isi), // Hilangkan tag HTML
        $pengaduan->instansi ? $pengaduan->instansi->nama : 'Tidak Ada',
        optional($pengaduan->tgl_buat)->format('d-m-Y') ?? '-',
        $tanggapan ? strip_tags($tanggapan->isi_tanggapan) : 'Belum ada tanggapan',
        $tanggapan && $tanggapan->tgl_ditanggapi ? $tanggapan->tgl_ditanggapi->format('d-m-Y') : '-',
        $pengaduan->status,
        $tanggapan && $tanggapan->user ? $tanggapan->user->nama : 'Tidak Ada Petugas' // ✅ FIXED
    ];
}


    // Atur styling agar header lebih rapi
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet;

                // Merge kop surat agar tampil rapi
                $sheet->mergeCells('A1:L1');
                $sheet->mergeCells('A2:L2');
                $sheet->mergeCells('A3:L3');

                // Styling kop surat
                $sheet->getStyle('A1:A3')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14],
                    'alignment' => ['horizontal' => 'center'],
                ]);

                // Merge heading tabel utama
                $sheet->getStyle('A5:L5')->applyFromArray([
                    'font' => ['bold' => true],
                    'alignment' => ['horizontal' => 'center'],
                    'borders' => ['allBorders' => ['borderStyle' => 'thin']],
                ]);

                // Atur lebar kolom agar lebih rapi
                foreach (range('A', 'L') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }
            },
        ];
    }
}
