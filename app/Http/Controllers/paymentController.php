<?php

namespace App\Http\Controllers;

use App\Models\OrderKonsultasi;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // Menampilkan form pembayaran
    public function showPaymentForm()
    {
        // Jika pengguna belum login, redirect ke halaman login
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');
        }

        // Menampilkan form pembayaran
        return view('payment.create');
    }

    // Menyimpan data pembayaran
    public function storePayment(Request $request)
    {
        // Validasi input untuk pembayaran
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',  // Jumlah pembayaran harus lebih dari 0
        ]);

        // Mendapatkan pengguna yang sedang login
        $user = auth()->user();

        try {
            // Menyimpan data pembayaran untuk orderKonsultasi
            $orderKonsultasi = new OrderKonsultasi();
            $orderKonsultasi->id_petani = $user->id;  // ID pengguna yang sedang login
            $orderKonsultasi->is_payment = true;  // Pembayaran sudah dilakukan
            $orderKonsultasi->amount = $validated['amount'];  // Jumlah pembayaran
            $orderKonsultasi->save();

            // Menyimpan orderId ke session untuk digunakan saat membuat konsultasi
            session(['orderId' => $orderKonsultasi->id]);

            // Redirect ke halaman konsultasi setelah pembayaran
            return redirect()->route('konsultasi.create')->with('success', 'Pembayaran berhasil. Silakan lanjutkan ke konsultasi.');
        } catch (\Exception $e) {
            // Menangani error penyimpanan
            return back()->with('error', 'Terjadi kesalahan saat menyimpan data pembayaran. Silakan coba lagi.');
        }
    }
}
