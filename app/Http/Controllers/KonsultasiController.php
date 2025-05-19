<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataAhliTani;

class KonsultasiController extends Controller
{
    // Menampilkan halaman pemilihan ahli tani
    public function index()
    {
        $ahliTaniList = DataAhliTani::all();
        return view('ahli_tani', compact('ahliTaniList'));
    }

    // Menampilkan halaman detail ahli tani berdasarkan ID
    public function pilihAhliTani($id)
    {
        // Mengambil data ahli tani dari tabel data_ahli_tani berdasarkan id_ahli_tani
        $ahliTani = DataAhliTani::where('id_ahli_tani', $id)->with('user')->first();

        // Jika ahli tani tidak ditemukan, redirect kembali ke halaman konsultasi
        if (!$ahliTani) {
            return redirect()->route('konsultasi.index')->with('error', 'Ahli tani tidak ditemukan!');
        }

        // Kirim data ahli tani ke view pembayaran
        return view('konsultasi.pembayaran', ['ahliTani' => $ahliTani]);
    }

    // Menampilkan halaman pembayaran setelah memilih ahli tani
    public function pembayaran($id)
    {
        // Ambil data ahli tani berdasarkan ID
        $ahliTani = User::find($id);

        // Jika ahli tani tidak ditemukan, redirect kembali ke halaman konsultasi
        if (!$ahliTani) {
            return redirect()->route('konsultasi.index')->with('error', 'Ahli tani tidak ditemukan!');
        }

        // Kirim data ahli tani ke view pembayaran
        return view('pembayaran', compact('ahliTani'));
    }

    // Proses pembayaran setelah pengguna memilih metode pembayaran
    public function prosesPembayaran(Request $request)
    {
        // Validasi input
        $request->validate([
            'ahli_tani_id' => 'required|exists:users,id', // Pastikan ID ahli tani ada di database
            'metode_pembayaran' => 'required|string', // Metode pembayaran yang dipilih
            'jumlah' => 'required|numeric|min:1', // Jumlah yang dibayar
        ]);

        // Ambil data ahli tani berdasarkan ID yang dipilih
        $ahliTani = User::find($request->ahli_tani_id);

        // Proses pembayaran (misalnya, simpan transaksi di database atau kirim ke API pembayaran)
        // Anda bisa menambahkan logika untuk menyimpan data transaksi pembayaran

        // Contoh proses pembayaran (simpan ke database, kirim ke API, dll)
        // Misalnya, kita simpan data pembayaran
        // Pembayaran::create([...]);

        // Redirect ke halaman konfirmasi pembayaran
        return redirect()->route('pembayaran_sukses')->with('success', 'Pembayaran berhasil!');
    }

    public function formKonsultasi()
    {
        return view('konsultasi.form_konsultasi');
    }

    public function submitKonsultasi(Request $request)
    {
        $request->validate([
            'topik' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $data = [
            'topik' => $request->topik,
            'deskripsi' => $request->deskripsi,
        ];
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('konsultasi', 'public');
            $data['foto'] = $fotoPath;
        }
        // Simpan data konsultasi ke database jika perlu
        // ...
        return redirect()->route('konsultasi_sukses')->with('konsultasi', $data);
    }

    public function konsultasiSukses(Request $request)
    {
        $konsultasi = session('konsultasi');
        return view('konsultasi.konsultasi_sukses', compact('konsultasi'));
    }
}