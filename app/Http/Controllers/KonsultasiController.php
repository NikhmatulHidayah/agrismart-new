<?php

namespace App\Http\Controllers;

use App\Models\OrderKonsultasi;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    // Menampilkan form untuk membuat konsultasi baru
    public function create()
    {
        // Langsung tampilkan form tanpa cek orderId
        return view('konsultasi.create');
    }

    // Menyimpan konsultasi
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'question' => 'required|string|max:255',
            'deskripsi' => 'required|string|max:500',
            'gambar_masalah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Ambil user petani dan ahli tani yang ada di database
        $userPetani = \App\Models\User::where('role', 'farmer')->first();
        $userAhli = \App\Models\User::where('role', 'expert')->first();
        if (!$userPetani || !$userAhli) {
            return redirect()->back()->withErrors(['msg' => 'User petani atau ahli tani tidak ditemukan di database.']);
        }
        $orderKonsultasi = new \App\Models\OrderKonsultasi();
        $orderKonsultasi->id_petani = $userPetani->id;
        $orderKonsultasi->id_ahli_tani = $userAhli->id;
        $orderKonsultasi->question = $request->question;
        $orderKonsultasi->feedback = $request->deskripsi;
        $orderKonsultasi->is_payment = true;
        $orderKonsultasi->is_done = false;
        $orderKonsultasi->amount = 0;
        if ($request->hasFile('gambar_masalah')) {
            $imagePath = $request->file('gambar_masalah')->store('gambar_masalah', 'public');
            $orderKonsultasi->picture_question = $imagePath;
        }
        $orderKonsultasi->save();
        return redirect()->route('konsultasi.index')->with('success', 'Konsultasi berhasil disimpan!');
    }

    // Menampilkan daftar konsultasi
    public function index()
    {
        // Untuk debug: tampilkan semua data konsultasi
        $konsultasi = \App\Models\OrderKonsultasi::all();
        return view('konsultasi.index', compact('konsultasi'));
    }
}









