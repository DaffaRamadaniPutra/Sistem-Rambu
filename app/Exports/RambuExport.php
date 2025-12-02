<?php

namespace App\Exports;

use App\Models\Rambu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class RambuExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Rambu::select('nama_rambu','jenis','lokasi','koordinat_gps','kondisi','created_at')->get();
    }

    public function headings(): array
    {
        return ['Nama Rambu','Jenis','Lokasi','GPS','Kondisi','Tanggal'];
    }

    public function map($r): array
    {
        return [
            $r->nama_rambu,
            $r->jenis,
            $r->lokasi,
            $r->koordinat_gps ?? '-',
            $r->kondisi,
            $r->created_at->format('d/m/Y')
        ];
    }
}