<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DataAhliTani;
use App\Models\OrderKonsultasi;
use Illuminate\Support\Facades\Auth;

class KonsultasiController extends Controller
{
    // Menampilkan halaman pemilihan ahli tani
    public function index()
    {
        $ahliTaniList = DataAhliTani::with('user')->where('status', 'Approved')->get();
        return view('konsultasi.ahli_tani', compact('ahliTaniList'));
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

        // Redirect ke halaman konfirmasi pembayaran dengan parameter di URL path
        return redirect()->route('pembayaran_sukses', [
            'id_ahli_tani' => $request->ahli_tani_id,
            'amount' => $request->jumlah
        ])->with('success', 'Pembayaran berhasil!');
    }

    public function formKonsultasi(Request $request)
    {
        // Ambil parameter dari URL query string seperti semula
        $id_ahli_tani = $request->query('id_ahli_tani');
        $amount = $request->query('amount');

        // Tambahkan validasi untuk id_ahli_tani
        if (empty($id_ahli_tani)) {
             return redirect()->route('konsultasi.index')->with('error', 'Data ahli tani tidak ditemukan untuk konsultasi.');
        }

        // Ambil data ahli tani untuk ditampilkan di view (opsional, tapi baik untuk konfirmasi)
        $ahliTaniUser = User::find($id_ahli_tani);

        return view('konsultasi.form_konsultasi', compact('id_ahli_tani', 'amount', 'ahliTaniUser'));
    }

    public function submitKonsultasi(Request $request)
    {
        $request->validate([
            'topik' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'id_ahli_tani' => 'required|exists:users,id',
        ]);
        $data = [
            'question' => $request->topik,
            'amount' => $request->amount ?? 0,
            'id_petani' => Auth::id(),
            'id_ahli_tani' => $request->id_ahli_tani,
            'is_payment' => true,
            'is_done' => false,
            'payment_ahli' => false,
            'feedback' => null,
            'picture_feedback' => null,
        ];
        $data['picture_question'] = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('konsultasi', 'public');
            $data['picture_question'] = $fotoPath;
        }
        // Simpan data konsultasi ke tabel order_konsultasi
        OrderKonsultasi::create($data);
        return redirect()->route('konsultasi_sukses')->with('konsultasi', $data);
    }

    public function konsultasiSukses(Request $request)
    {
        $konsultasi = session('konsultasi');
        return view('konsultasi.konsultasi_sukses', compact('konsultasi'));
    }

    /**
     * Menampilkan daftar konsultasi petani.
     */
    public function farmerConsultations()
    {
        $farmerId = Auth::id();
        $konsultasis = OrderKonsultasi::where('id_petani', $farmerId)
                                     ->with('ahliTani')
                                     ->orderByDesc('created_at')
                                     ->get();

        return view('konsultasi.farmer_consultations', compact('konsultasis'));
    }

    /**
     * Menampilkan halaman detail konsultasi untuk petani.
     */
    public function showFarmerConsultationDetail($id)
    {
        // Ambil data konsultasi berdasarkan ID dan pastikan milik petani yang sedang login
        $konsultasi = OrderKonsultasi::where('id', $id)
                                     ->where('id_petani', Auth::id())
                                     ->with('ahliTani.dataAhliTani') // Load related expert and their profile data
                                     ->first();

        // Jika konsultasi tidak ditemukan atau bukan milik petani ini
        if (!$konsultasi) {
            return redirect()->route('konsultasi.index')->with('error', 'Konsultasi tidak ditemukan atau Anda tidak memiliki akses.');
        }

        // Tampilkan view detail konsultasi petani
        return view('konsultasi.farmer_detail', compact('konsultasi'));
    }
}