<?php

namespace App\Http\Controllers;

use App\Models\DataTanaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DataTanamanController extends Controller
{
    /**
     * Mapping prediksi pupuk dan panen per jenis tanaman.
     */
    public static function getPredictionMapping()
    {
        return [
            'Padi' => ['pupuk1' => 7, 'pupuk2' => 21, 'pupuk3' => 35, 'panen' => 120],
            'Tomat' => ['pupuk1' => 5, 'pupuk2' => 15, 'pupuk3' => 30, 'panen' => 90],
            'Cabai' => ['pupuk1' => 10, 'pupuk2' => 20, 'pupuk3' => 40, 'panen' => 100],
            // Tambahkan tanaman lain jika perlu
        ];
    }

    /**
     * Menampilkan halaman daftar tanaman (Monitoring Tanaman).
     */
    public function index()
    {
        $tanamans = DataTanaman::where('id_petani', 1)->get(); 
        // sementara pakai id_petani = 1 karena belum implementasi Auth login
        return view('tanaman.index', compact('tanamans'));
    }

    /**
     * Menampilkan form tambah tanaman.
     */
    public function create()
    {
        $tanamanList = array_keys(self::getPredictionMapping());
        return view('tanaman.create', compact('tanamanList'));
    }

    /**
     * Menyimpan data tanaman baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_tanaman' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_ditanam' => 'required|date',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('tanaman', 'public');
        }

        DataTanaman::create([
            'nama_tanaman' => $request->nama_tanaman,
            'deskripsi' => $request->deskripsi,
            'tanggal_ditanam' => $request->tanggal_ditanam,
            'picture' => $picturePath,
            'id_petani' => 1, // hardcode sementara
        ]);

        return redirect()->route('tanaman.index')->with('success', 'Data tanaman berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit tanaman.
     */
    public function edit($id)
    {
        $tanaman = DataTanaman::findOrFail($id);
        $tanamanList = array_keys(self::getPredictionMapping());
        return view('tanaman.edit', compact('tanaman', 'tanamanList'));
    }

    /**
     * Mengupdate data tanaman yang sudah ada.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_tanaman' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'tanggal_ditanam' => 'required|date',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $tanaman = DataTanaman::findOrFail($id);

        $picturePath = $tanaman->picture;
        if ($request->hasFile('picture')) {
            // Hapus gambar lama jika ada
            if ($picturePath) {
                Storage::disk('public')->delete($picturePath);
            }
            $picturePath = $request->file('picture')->store('tanaman', 'public');
        }

        $tanaman->update([
            'nama_tanaman' => $request->nama_tanaman,
            'deskripsi' => $request->deskripsi,
            'tanggal_ditanam' => $request->tanggal_ditanam,
            'picture' => $picturePath,
        ]);

        return redirect()->route('tanaman.index')->with('success', 'Data tanaman berhasil diperbarui.');
    }

    /**
     * Menghapus data tanaman.
     */
    public function destroy($id)
    {
        $tanaman = DataTanaman::findOrFail($id);

        if ($tanaman->picture) {
            Storage::disk('public')->delete($tanaman->picture);
        }

        $tanaman->delete();

        return redirect()->route('tanaman.index')->with('success', 'Data tanaman berhasil dihapus.');
    }
}
