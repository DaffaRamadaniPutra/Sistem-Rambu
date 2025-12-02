<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Rambu Lalu Lintas</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; font-size: 12px; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 4px double #000; padding-bottom: 20px; }
        .logo { width: 80px; height: 80px; }
        .title { font-size: 20px; font-weight: bold; margin: 10px 0; }
        .subtitle { font-size: 16px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 10px; text-align: center; vertical-align: middle; }
        th { background-color: #1e40af; color: white; font-weight: bold; }
        .qr { width: 70px; height: 70px; }
        .footer { margin-top: 50px; text-align: right; }
        .signature { width: 200px; margin-top: 60px; }
        .kondisi { padding: 5px 10px; border-radius: 20px; color: white; font-weight: bold; font-size: 11px; }
        .baik { background: #10b981; }
        .rusak { background: #ef4444; }
        .perlu { background: #f59e0b; }
    </style>
</head>
<body>

<div class="header">
    <table width="100%">
        <tr>
            <td width="15%" align="center">
                <img src="{{ public_path('images/logo-cirebon.png') }}" class="logo" alt="Logo">
            </td>
            <td width="70%" align="center">
                <div class="title">PEMERINTAH KOTA CIREBON</div>
                <div class="subtitle">DINAS PERHUBUNGAN</div>
                <div style="margin-top:10px;">
                    Jl. Siliwangi No.75, Cirebon<br>
                    Telp. (0231) 123456 | Email: dishub@cirebon.go.id
                </div>
            </td>
            <td width="15%"></td>
        </tr>
    </table>
</div>

<h2 style="text-align:center; margin:30px 0;">LAPORAN DATA RAMBU LALU LINTAS</h2>
<p style="text-align:center;"><strong>Nomor:</strong> {{ $nomorSurat }} | <strong>Tanggal:</strong> {{ date('d F Y') }}</p>

<table>
    <thead>
        <tr>
            <th width="5%">No</th>
            <th width="12%">Foto</th>
            <th>Nama Rambu</th>
            <th>Jenis</th>
            <th>Lokasi</th>
            <th>Kondisi</th>
            <th>Petugas</th>
            <th>QR Code</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rambus as $i => $r)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($r->foto)
                    <img src="{{ storage_path('app/public/' . $r->foto) }}" width="80" style="border-radius:8px;">
                @else
                    <div style="width:80px; height:80px; background:#eee; border:2px dashed #ccc; border-radius:8px;"></div>
                @endif
            </td>
            <td style="text-align:left;"><strong>{{ $r->nama_rambu }}</strong></td>
            <td>
                <span style="background:#3b82f6; color:white; padding:5px 12px; border-radius:20px;">
                    {{ $r->jenis }}
                </span>
            </td>
            <td style="text-align:left;">{{ $r->lokasi }}</td>
            <td>
                @php
                $kelas = $r->kondisi === 'Baik' ? 'baik' : 
                         ($r->kondisi === 'Rusak' ? 'rusak' : 'perlu');
                @endphp
                <span class="kondisi {{ $kelas }}">
                    {{ $r->kondisi }}
                </span>
            </td>
            <td>{{ $r->user?->name ?? '-' }}</td>
            <td>
                {!! $r->qr_code !!}
                <img src="data:image/svg+xml;base64,{{ base64_encode($r->qr_code) }}" class="qr" alt="QR Code">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    <div style="float:right; text-align:center;">
        <p>Cirebon, {{ date('d F Y') }}</p>
        <p><strong>Kepala Dinas Perhubungan</strong></p>
        <div class="signature">
            <img src="{{ public_path('images/ttd-kadis.png') }}" width="180" alt="TTD">
        </div>
        <br>
        <strong><u>DAFFA RAMADANI PUTRA</u></strong><br>
        NIP. 123456789012345678
    </div>
</div>

</body>
</html>