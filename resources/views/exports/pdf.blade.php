<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Laporan Rambu Lalu Lintas - Dishub Kota Cirebon</title>
    <style>
        @page {
            size: 216mm 330mm;
            margin: 20mm 15mm 25mm 15mm;
        }

        body { 
            font-family: Arial, Helvetica, sans-serif; 
            margin: 0; 
            padding: 0;
            font-size: 11.5px;
            line-height: 1.6;
            color: #000000 !important;
        }

        .header { 
            text-align: center; 
            margin-bottom: 25px; 
            border-bottom: 4px double #000000; 
            padding-bottom: 20px; 
        }
        .logo { 
            width: 92px; 
            height: 92px; 
            border-radius: 50%; 
            object-fit: contain;
            border: 4px solid #000000;
            box-shadow: 0 4px 12px rgba(0,0,0,0.25);
        }
        .title { 
            font-size: 19px; 
            font-weight: bold; 
            margin: 12px 0 4px;
            color: #000000;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .subtitle { 
            font-size: 17px; 
            font-weight: bold; 
            color: #000000;
            margin-bottom: 8px;
        }
        .alamat {
            font-size: 11px;
            color: #000000;
            line-height: 1.5;
        }

        h2 {
            text-align: center;
            margin: 20px 0 6px 0;
            font-size: 23px;
            font-weight: bold;
            color: #000000;
            text-transform: uppercase;
            letter-spacing: 1.2px;
        }

        .info-cetak {
            text-align: center;
            font-size: 12.5px;
            margin: 0 0 12px 0;
            color: #000000;
            font-weight: normal;
        }

        table { 
            width: 100%; 
            border-collapse: collapse;
            margin-top: 6px;
        }
        th, td { 
            border: 1.8px solid #000000; 
            padding: 9px 7px; 
            text-align: center; 
            vertical-align: middle; 
            font-size: 10.8px;
            color: #000000 !important;
        }
        th { 
            background: #ffffff; 
            color: #000000 !important;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .foto { 
            width: 68px; 
            height: 68px; 
            object-fit: cover; 
            border-radius: 8px; 
            border: 1px solid #000;
        }
        .no-foto { 
            width: 68px; height: 68px; 
            background:#f8f8f8; 
            border: 2px dashed #999; 
            border-radius: 8px; 
            display: flex;
            align-items: center;
            justify-content: center;
            color: #666;
            font-size: 8.5px;
        }
        .qr { width: 65px; height: 65px; border-radius: 6px; }

        .kondisi { 
            padding: 5px 14px; 
            border-radius: 30px; 
            color: white; 
            font-weight: bold; 
            font-size: 10px; 
            display: inline-block;
        }
        .baik { background: #10b981; }
        .rusak { background: #ef4444; }
        .perlu { background: #f59e0b; color: #000; }

        .jenis { 
            background: #3b82f6; 
            color: white; 
            padding: 5px 13px; 
            border-radius: 30px; 
            font-size: 10px; 
            font-weight: bold;
            display: inline-block;
        }

        .text-left { text-align: left !important; }
        .text-small { font-size: 9.5px; color: #000000; }

        .footer { 
            margin-top: 100px; 
            text-align: right; 
        }
        .signature { 
            width: 280px; 
            margin: 35px auto 0; 
            text-align: center;
            line-height: 1.9;
        }
    </style>
</head>
<body>

<div class="header">
    <table width="100%">
        <tr>
            <td width="15%" align="center" valign="middle">
                <img src="{{ public_path('images/logo_dishub.png') }}" class="logo" alt="Logo Dishub Cirebon">
            </td>
            <td width="70%" align="center">
                <div class="title">PEMERINTAH KOTA CIREBON</div>
                <div class="subtitle">DINAS PERHUBUNGAN</div>
                <div class="alamat">
                    Jl. Terusan Pemuda No.8, Sunyaragi, Kec. Kesambi, Kota Cirebon, Jawa Barat 45132<br>
                    Telp. (0231) 208445 | Email: dishub@cirebonkota.go.id
                </div>
            </td>
            <td width="15%"></td>
        </tr>
    </table>
</div>

<h2>LAPORAN DATA RAMBU LALU LINTAS</h2>
<div class="info-cetak">
    <strong>Nomor Surat:</strong> {{ $nomorSurat }} &nbsp;&nbsp;|&nbsp;&nbsp; 
    <strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
</div>

<table>
    <thead>
        <tr>
            <th width="4%">NO</th>
            <th width="10%">FOTO</th>
            <th width="18%">NAMA RAMBU</th>
            <th width="8%">JENIS</th>
            <th width="20%">LOKASI</th>
            <th width="9%">KONDISI</th>
            <th width="10%">TANGGAL DIBUAT</th>
            <th width="10%">PETUGAS</th>
            <th width="11%">QR CODE</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rambus as $i => $r)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>
                @if($r->foto && file_exists(storage_path('app/public/' . $r->foto)))
                    <img src="{{ storage_path('app/public/' . $r->foto) }}" class="foto" alt="Foto Rambu">
                @else
                    <div class="no-foto">Tidak Ada Foto</div>
                @endif
            </td>
            <td class="text-center" style="font-weight:bold;">{{ $r->nama_rambu }}</td>
            <td><span class="jenis">{{ $r->jenis }}</span></td>
            <td class="text-left" style="font-size:10.5px;">{{ $r->lokasi }}</td>
            <td>
                @php
                    $kelas = match($r->kondisi) {
                        'Baik' => 'baik',
                        'Rusak' => 'rusak',
                        default => 'perlu'
                    };
                @endphp
                <span class="kondisi {{ $kelas }}">{{ $r->kondisi }}</span>
            </td>
            <td>
                <div style="font-weight:bold;">{{ $r->created_at->format('d/m/Y') }}</div>
                <div class="text-small">{{ $r->created_at->format('H:i') }} WIB</div>
            </td>
            <td style="font-size:10.5px;">{{ $r->user?->name ?? '-' }}</td>
            <td>
                @if($r->qr_code)
                    <img src="data:image/svg+xml;base64,{{ base64_encode($r->qr_code) }}" class="qr" alt="QR Code">
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="footer">
    <div style="float:right; text-align:center; width:250px; font-size:10.8px; line-height:1.4;">
        <p style="margin:0 0 20px 0;">
            <strong>Cirebon, {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</strong>
        </p>
        <p style="margin:0 0 30px 0; font-size:10.5px;">
            Kepala Dinas Perhubungan<br>Kota Cirebon
        </p>

        <div style="margin-top:0;">
            @if(file_exists(public_path('images/ttd-kadis.png')))
                <img src="{{ public_path('images/ttd-kadis.png') }}" width="155" alt="TTD Kadis">
            @endif
            <div style="margin-top:5px;">
                <strong><u>DAFFA RAMADANI PUTRA</u></strong><br>
                <small style="font-size:9px;">NIP. 123456789012345678</small>
            </div>
        </div>
    </div>
    <div style="clear:both;"></div>
</div>

</body>
</html>