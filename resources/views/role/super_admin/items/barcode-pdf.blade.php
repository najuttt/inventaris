<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Barcode {{ $item->name }}</title>
    <style>
        body { font-family: sans-serif; text-align: center; }
        .barcode { margin-top: 20px; }
    </style>
</head>
<body>
    <h3>{{ $item->name }}</h3>
    <p>Kode: {{ $item->code }}</p>
    <div class="barcode">
        <img src="data:image/png;base64,{{ (new \Milon\Barcode\DNS1D)->getBarcodePNG($item->code, 'C128', 2, 60) }}" alt="barcode">
    </div>
</body>
</html>
