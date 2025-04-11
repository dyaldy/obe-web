<?php

namespace App\Http\Controllers;

use App\Filters\V1\DosenFilter;
use App\Http\Resources\V1\DosenCollection;
use App\Models\Dosen;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $query = Dosen::query();

        // Search filter (name, nidn, or email)
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%")
                    ->orWhere('nidn', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%");
            });
        }

        // Jabatan filter
        if ($request->has('jabatan') && $request->jabatan != '') {
            $query->where('jabatan', $request->jabatan);
        }

        // Prodi filter
        if ($request->has('prodi') && $request->prodi != '') {
            $query->where('prodi', $request->prodi);
        }

        $dosens = $query->paginate(10);

        // Get unique values for dropdowns
        $jabatans = Dosen::select('jabatan')->distinct()->pluck('jabatan');
        $prodis = Dosen::select('prodi')->distinct()->pluck('prodi');

        return view('dosen.index', compact('dosens', 'jabatans', 'prodis'));
    }

    public function create()
    {
        return view('dosen.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn' => 'required|unique:dosens,nidn',
            'nama' => 'required',
            'gelar' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'nullable|email',
            'kontak' => 'nullable|numeric',
            'jabatan' => 'required',
            'kompetensi' => 'required',
            'prodi' => 'required',
        ]);

        Dosen::create($validated);

        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan.');
    }

    public function edit(Dosen $dosen)
    {
        return view('dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        $validated = $request->validate([
            'nidn' => 'required|unique:dosens,nidn,' . $dosen->id,
            'nama' => 'required',
            'gelar' => 'required',
            'jenis_kelamin' => 'required',
            'email' => 'nullable|email',
            'kontak' => 'numeric|nullable',
            'jabatan' => 'required',
            'kompetensi' => 'required',
            'prodi' => 'required',
        ]);

        $dosen->update($validated);
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus.');
    }
}
