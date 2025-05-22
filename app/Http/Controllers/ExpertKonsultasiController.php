<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderKonsultasi;
use Illuminate\Support\Facades\Auth;

class ExpertKonsultasiController extends Controller
{
    public function index()
    {
        // Get the authenticated expert's ID
        $expertId = Auth::id();

        // Get consultations for this expert
        $konsultasis = OrderKonsultasi::where('id_ahli_tani', $expertId)->get();

        // Pass the consultations to the view
        return view('expert.konsultasi.index', compact('konsultasis'));
    }

    /**
     * Menampilkan detail konsultasi untuk ahli tani.
     */
    public function show($id)
    {
        $konsultasi = OrderKonsultasi::where('id', $id)
                                     ->where('id_ahli_tani', Auth::id())
                                     ->with('petani') // Load related farmer
                                     ->first();

        if (!$konsultasi) {
            return redirect()->route('expert.konsultasi.index')->with('error', 'Konsultasi tidak ditemukan atau bukan untuk Anda.');
        }

        return view('expert.konsultasi.show', compact('konsultasi'));
    }

    /**
     * Memproses jawaban ahli tani.
     */
    public function submitAnswer(Request $request, $id)
    {
        $request->validate([
            'answer' => 'required|string',
            // Tambahkan validasi jika ada feedback atau gambar feedback
        ]);

        $konsultasi = OrderKonsultasi::where('id', $id)
                                     ->where('id_ahli_tani', Auth::id())
                                     ->first();

        if (!$konsultasi) {
            return redirect()->route('expert.konsultasi.index')->with('error', 'Konsultasi tidak ditemukan atau bukan untuk Anda.');
        }

        // Update data konsultasi dengan jawaban dan status selesai
        $konsultasi->feedback = $request->answer;
        $konsultasi->is_done = true;
        // Tambahkan logika untuk menyimpan feedback atau gambar feedback jika ada
        $konsultasi->save();

        return redirect()->route('expert.konsultasi.index')->with('success', 'Jawaban konsultasi berhasil dikirim.');
    }
}
