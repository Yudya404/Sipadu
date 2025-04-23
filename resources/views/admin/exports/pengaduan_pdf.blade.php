<!DOCTYPE html>
<html>
<head>
    <title>Laporan Pengaduan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .header {
            text-align: center;
            margin-bottom: 10px;
            padding-bottom: 5px;
            border-bottom: 2px solid black;
        }
        .logo {
            width: 80px;
            margin-bottom: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 5px;
            font-size: 12px;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('img/logoPemkab.png') }}" class="logo" alt="Logo Pemerintah Kabupaten Pasuruan">
        <h2>PEMERINTAH KABUPATEN PASURUAN</h2>
        <h3>LAPORAN PENGADUAN PELAYANAN PUBLIK</h3>
        <p>Sekretariat: Kompleks Perkantoran Pemerintah Kabupaten Pasuruan</p>
        <p>Jalan Raya Raci Km. 9 Pasuruan</p>
    </div>

    <h3>Laporan Pengaduan Pelayanan Publik</h3>

   <table>
    <thead>
        <tr>
            <th>Kode Formulir</th>
            <th>Judul Laporan</th>
            <th>Isi Laporan</th>
            <th>Instansi</th>
            <th>Tanggal Diajukan</th>
            <th>Tanggapan</th>
            <th>Tanggal Ditanggapi</th>
            <th>Status Laporan</th>
            <th>Nama Petugas</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($report as $data)
        <tr>
            <td align="center">{{ $data->kode_formulir }}</td>
            <td align="center">{{ $data->judul }}</td>
            <td align="center">{{ $data->isi }}</td>
            <td align="center">{{ $data->instansi ? $data->instansi->nama : 'Tidak ada instansi' }}</td>
            <td align="center">{{ \Carbon\Carbon::parse($data->tgl_buat)->translatedFormat('d F Y') }}</td>

            <!-- Tanggapan -->
            <td align="center">
                @if ($data->tanggapan->isNotEmpty())
                    {{-- Ambil tanggapan pertama --}}
                    {{ $data->tanggapan->first()->user ? $data->tanggapan->first()->user->isi_tanggapan : 'Belum Ada Tanggapan' }}
                @else
                    Belum Ada Tanggapan
                @endif
            </td>

            <!-- Tanggal Ditanggapi -->
            <td align="center">
                @if ($data->tanggapan->isNotEmpty())
                    {{ \Carbon\Carbon::parse($data->tanggapan->first()->tgl_ditanggapi)->translatedFormat('d F Y') }}
                @else
                    -
                @endif
            </td>

            <!-- Status -->
            <td align="center">{{ $data->status == 'Selesai' ? 'Selesai' : 'Tidak Diproses' }}</td>

            <!-- Nama Petugas -->
            <td align="center">
                @if ($data->tanggapan->isNotEmpty())
                    {{ $data->tanggapan->first()->user ? $data->tanggapan->first()->user->nama : 'Belum Ada Tanggapan' }}
                @else
                    -
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


</body>
</html>
