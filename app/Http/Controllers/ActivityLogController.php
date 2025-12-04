<?php

namespace App\Http\Controllers;

use App\Models\Activity; 
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $query = Activity::with('causer')->latest();

        if ($request->has('start') && $request->has('end')) {
            $query->whereBetween('created_at', [$request->start, $request->end]);
        }

        $activities = $query->paginate(20);

        return view('logs.index', compact('activities'));
    }

    public function clear(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        if ($request->header('X-Requested-With') !== 'XMLHttpRequest') {
            abort(403);
        }

        if ($request->confirmation !== 'HAPUS SEMUA LOG PERMANEN') {
            return response()->json(['success' => false, 'message' => 'Konfirmasi salah!']);
        }

        Activity::truncate(); 

        return response()->json([
            'success' => true,
            'message' => 'Semua log aktivitas telah dihapus permanen!'
        ]);
    }
}