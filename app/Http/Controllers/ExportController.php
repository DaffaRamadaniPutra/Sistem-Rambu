<?php

namespace App\Http\Controllers;

use App\Models\Rambu;
use App\Exports\RambuExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;                           
use Illuminate\Http\Request;                         
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode as QrCodeFacade;

class ExportController extends Controller
{
    public function excel()
    {
        return Excel::download(new RambuExport, 'Rambu_Lalu_Lintas_'.date('Ymd').'.xlsx');
    }

    public function pdf(Request $request)
    {
        $query = Rambu::query();
    
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_rambu', 'LIKE', "%{$search}%")
                  ->orWhere('lokasi', 'LIKE', "%{$search}%");
            });
        }
        if ($request->filled('jenis') && $request->jenis !== 'semua') {
            $query->where('jenis', $request->jenis);
        }
        if ($request->filled('kondisi') && $request->kondisi !== 'semua') {
            $query->where('kondisi', $request->kondisi);
        }
    
        $rambus = $query->with('user')->latest()->get();
    
        $nomorSurat = 'B-' . date('Y') . '/' . str_pad(Rambu::count(), 4, '0', STR_PAD_LEFT);
    
        $rambus = $rambus->map(function ($rambu) {
            $url = route('rambu.show', $rambu);
            $rambu->qr_code = \QrCode::format('svg')->size(200)->generate($url);
            return $rambu;
        });
    
        $pdf = Pdf::loadView('exports.pdf', compact('rambus', 'nomorSurat'))
                   ->setPaper('a4', 'landscape');
    
        return $pdf->stream('Laporan_Rambu_Lalu_Lintas_' . date('d-m-Y') . '.pdf');
    }
}