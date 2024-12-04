<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rental PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat img {
            max-height: 80px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
        }
        .signature {
            position: absolute;
            right: 100px;
            bottom: 10px;
            max-width: 100px; /* Sesuaikan ukuran gambar jika perlu */
        }
    </style>
</head>
<body>
    <!-- Kop Surat -->
    <div class="kop-surat">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo Perusahaan">
        <h1>Mitra Copierindo</h1>
        <p>Jl. KH. HASYIM ASHARI NO.90, JAKARTA PUSAT 10140<br>Telp: (021) 63860575 | Email: info@mitracopierindo.com</p>
        <hr>
    </div>

    <!-- Judul Laporan -->
    <h2 style="text-align: center;">Rental Detail</h2>

    <!-- Tabel Data Rental -->
    <table>
        <tr>
            <th>ID Rental</th>
            <td>{{ $rental->id }}</td>
        </tr>
        <tr>
            <th>Nama Perangkat</th>
            <td>{{ $rental->device->name }}</td>
        </tr>
        <tr>
            <th>Nama Pengguna</th>
            <td>{{ $rental->atas_nama }}</td>
        </tr>
        <tr>
            <th>Tanggal Rental</th>
            <td>{{ \Carbon\Carbon::parse($rental->rental_date)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Tanggal Akhir Rental</th>
            <td>{{ \Carbon\Carbon::parse($rental->return_date)->format('d-m-Y') }}</td>
        </tr>
        <tr>
            <th>Status Rental</th>
            <td>{{ ucfirst($rental->status) }}</td>
        </tr>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Laporan ini dihasilkan pada {{ date('d-m-Y') }}</p>
    </div>

 
   <div class="signature">
        <img src="{{ public_path('images/ttdmanager.png') }}" alt="Tanda Tangan Manager">
    </div>
</body>
</html>
