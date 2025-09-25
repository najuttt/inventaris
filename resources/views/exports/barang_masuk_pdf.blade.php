<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Barang Masuk ({{ ucfirst($period) }})</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
        }
        .header img {
            width: 100px;
            margin-left: 20%;
        }
        .header .text {
            text-align: center;
            flex-grow: 1;
        }
        .header h1 { margin: 0; font-size: 18px; }
        .header h2 { margin: 0; font-size: 16px; }
        .header p { margin: 5px 0; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background-color: #eee; }
    </style>
</head>
<body>
    <div class="header">
        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNkYPhfDwAChwGA60e6kgAAAABJRU5ErkJggg==" alt="Logo" />
        <div class="text">
            <h1>PEMERINTAH DAERAH PROVINSI JAWA BARAT</h1>
            <h2>DINAS KESEHATAN</h2>
            <h2>UPTD PELATIHAN KESEHATAN</h2>
            <p>Jalan Pasteur No. 31 Telepon (022) 4238422</p>
            <p>Website: upelkes.jabarprov.go.id Email: upelkes@jabarprov.go.id</p>
            <p>Bandung -- 40171</p>
        </div>
    </div>
    <h2>Laporan Barang Masuk ({{ ucfirst($period) }})</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga Satuan</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $i => $itemIn)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $itemIn->item->name ?? '-' }}</td>
                    <td>{{ $itemIn->quantity }}</td>
                    <td>Rp {{ number_format($itemIn->item->price, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($itemIn->total_price, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>