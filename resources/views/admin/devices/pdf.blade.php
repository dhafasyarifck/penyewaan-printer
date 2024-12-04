<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Perangkat</title>
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
    <h2 style="text-align: center;">Daftar Perangkat</h2>

    <!-- Tabel Data -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Perangkat</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Harga per Hari</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($devices as $index => $device)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $device->name }}</td>
                    <td>{{ $device->category }}</td>
                    <td>{{ $device->stock }}</td>
                    <td>Rp{{ number_format($device->price_per_day, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p>Laporan ini dihasilkan pada {{ date('d-m-Y') }}</p>
    </div>
</body>
</html>
