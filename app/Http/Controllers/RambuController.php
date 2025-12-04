<?php

namespace App\Http\Controllers;

use App\Models\Rambu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RambuController extends Controller
{
    public function index(Request $request)
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

        if ($request->filled('user_id') && Auth::user()->isAdmin()) {
            $query->where('user_id', $request->user_id);
        }
    
        $rambus = $query->with('user')->oldest()->paginate(15)->withQueryString();
    
        $users = Auth::user()->isAdmin() ? \App\Models\User::all() : collect();
    
        return view('rambu.index', compact('rambus', 'users'));
    }

    public function create() { return view('rambu.create'); }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_rambu'     => 'required|string|max:255',
            'jenis'          => 'required|in:Larangan,Peringatan,Petunjuk,Perintah',
            'lokasi'         => 'required|string',
            'koordinat_gps'  => 'nullable|string',
            'kondisi'        => 'required|in:Baik,Rusak,Perlu Perbaikan',
            'foto'           => 'required|image|mimes:jpg,jpeg,png|max:3048', 
        ]);
    
        $data['user_id'] = Auth::id();
    
        if ($request->hasFile('foto')) {
            if (isset($rambu) && $rambu->foto) {
                Storage::disk('public')->delete($rambu->foto);
            }
        
            $file = $request->file('foto');
            
            $request->validate([
                'foto' => 'required|image|mimes:jpg,jpeg,png|max:3048'
            ]);
        
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('fotos', $filename, 'public');
        
            $data['foto'] = $path;
        }
    
        Rambu::create($data);
    
        return redirect()->route('rambu.index')->with('success', 'Rambu berhasil ditambah!');
    }

    public function show(Rambu $rambu) { return view('rambu.show', compact('rambu')); }

    public function edit(Rambu $rambu)
    {
        if ($rambu->user_id !== Auth::id() && Auth::user()->role !== 'admin') abort(403);
        return view('rambu.edit', compact('rambu'));
    }

    public function update(Request $request, Rambu $rambu)
    {
        if ($rambu->user_id !== Auth::id() && Auth::user()->role !== 'admin') abort(403);
    
        $rules = [
            'nama_rambu'     => 'required|string|max:255',
            'jenis'          => 'required|in:Larangan,Peringatan,Petunjuk,Perintah',
            'lokasi'         => 'required|string',
            'koordinat_gps'  => 'nullable|string',
            'kondisi'        => 'required|in:Baik,Rusak,Perlu Perbaikan',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:3048', 
        ];

        if (!$rambu->foto) {
            $rules['foto'] = 'required|image|mimes:jpg,jpeg,png|max:3048';
        }
    
        $data = $request->validate($rules);
    
        if ($request->hasFile('foto')) {
            if ($rambu->foto) Storage::delete('public/' . $rambu->foto);
            $data['foto'] = $request->file('foto')->store('fotos', 'public');
        }
    
        $rambu->update($data);
    
        return redirect()->route('rambu.index')->with('success', 'Rambu berhasil diperbarui!');
    }

    public function destroy(Rambu $rambu)
    {
        if ($rambu->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        if ($rambu->foto) {
            Storage::delete('public/' . $rambu->foto);
        }
    
        $rambu->delete();
    
        return redirect()->route('rambu.index')
                         ->with('success', 'Rambu berhasil dihapus!');
    }

    public function peta()
    {
        $rambus = Rambu::whereNotNull('koordinat_gps')->get();
        return view('rambu.peta', compact('rambus'));
    }

    public function restore($id)
    {
        $rambu = Rambu::onlyTrashed()->findOrFail($id);

        if (Auth::user()->role !== 'admin' && $rambu->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak!');
        }
    
        $rambu->restore();
    
        return back()->with('success', 'Rambu berhasil dipulihkan!');
    }

    public function deleted()
    {
        $deletedRambus = Rambu::onlyTrashed()
            ->with('user')
            ->latest('deleted_at')
            ->paginate(10);

        return view('rambu.deleted', compact('deletedRambus'));
    }

    public function forceDelete($id)
    {
        $rambu = Rambu::onlyTrashed()->findOrFail($id);

        if (!Auth::user()->isAdmin()) {
            abort(403);
        }

        if ($rambu->foto) {
            Storage::delete('public/' . $rambu->foto);
        }

        $rambu->forceDelete();

        return back()->with('success', 'Rambu dihapus permanen dari sistem!');
    }
}