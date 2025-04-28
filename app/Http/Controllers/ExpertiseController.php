<?php

namespace App\Http\Controllers;

use App\Models\DataAhliTani;  // Menggunakan model DataAhliTani
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpertiseController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model DataAhliTani
        $dataAhliTani = DataAhliTani::all();
        return view('expertises.index', compact('dataAhliTani'));  // Menyesuaikan dengan nama view
    }

    public function create()
    {
        return view('expertises.create');  // Menyesuaikan dengan nama view
    }

    public function store(Request $request)
    {
        // Validasi input: Pastikan certificate wajib di-upload
        $request->validate([
            'status' => 'required|string|max:255',
            'certificate' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',  // Pastikan certificate wajib
            'yoe' => 'nullable|numeric',
        ]);

        // Menyimpan data yang divalidasi
        $data = $request->only('status', 'yoe');

        // Menangani file sertifikat jika ada
        if ($request->hasFile('certificate')) {
            // Menyimpan file sertifikat ke folder 'public/certificates'
            $data['certificate'] = $request->file('certificate')->store('certificates', 'public');
        }

        // Menambahkan nilai default untuk expired_certificate jika tidak ada
        $data['expired_certificate'] = $data['expired_certificate'] ?? NULL;  // Ganti dengan NULL atau tanggal default yang sesuai

        // Menyimpan data ke dalam database
        DataAhliTani::create($data);

        return redirect()->route('expertises.index')->with('success', 'Data ahli tani berhasil ditambahkan.');
    }

    public function edit(DataAhliTani $dataAhliTani)
    {
        return view('expertises.edit', compact('dataAhliTani'));  // Menyesuaikan dengan nama view
    }

    public function update(Request $request, DataAhliTani $dataAhliTani)
    {
        // Validasi input
        $request->validate([
            'status' => 'required|string|max:255',
            'certificate' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',  // Bisa opsional saat update
            'yoe' => 'nullable|numeric',
        ]);

        // Menyimpan data yang divalidasi
        $data = $request->only('status', 'yoe');

        // Menangani file sertifikat jika ada
        if ($request->hasFile('certificate')) {
            // Hapus sertifikat lama jika ada
            if ($dataAhliTani->certificate && Storage::disk('public')->exists($dataAhliTani->certificate)) {
                Storage::disk('public')->delete($dataAhliTani->certificate);
            }

            // Menyimpan sertifikat baru
            $data['certificate'] = $request->file('certificate')->store('certificates', 'public');
        }

        // Menambahkan nilai default untuk expired_certificate jika tidak ada
        $data['expired_certificate'] = $data['expired_certificate'] ?? NULL;  // Ganti dengan NULL atau tanggal default yang sesuai

        // Memperbarui data ahli tani
        $dataAhliTani->update($data);

        return redirect()->route('expertises.index')->with('success', 'Data ahli tani berhasil diperbarui.');
    }

    public function destroy(DataAhliTani $dataAhliTani)
    {
        // Hapus file sertifikat jika ada
        if ($dataAhliTani->certificate && Storage::disk('public')->exists($dataAhliTani->certificate)) {
            Storage::disk('public')->delete($dataAhliTani->certificate);
        }

        // Hapus data ahli tani
        $dataAhliTani->delete();

        return redirect()->route('expertises.index')->with('success', 'Data ahli tani berhasil dihapus.');
    }
}
