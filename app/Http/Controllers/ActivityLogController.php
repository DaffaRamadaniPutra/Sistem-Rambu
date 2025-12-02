<?php

namespace App\Http\Controllers;

use App\Models\Activity; // Pakai model custom jika dibuat
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::with('causer')->latest();

        // Filter opsional berdasarkan tanggal (dari query string, misalnya ?start=2023-01-01&end=2023-12-31)
        if ($request->has('start') && $request->has('end')) {
            $query->whereBetween('created_at', [$request->start, $request->end]);
        }

        $activities = $query->paginate(20);

        return view('logs.index', compact('activities'));
    }
}