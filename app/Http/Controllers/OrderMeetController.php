<?php

namespace App\Http\Controllers;

use App\Models\OrderMeet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderMeetController extends Controller
{
    // Petani: lihat daftar order mereka
    public function index()
    {
        $orders = OrderMeet::with('expert')
            ->where('id_petani', Auth::id())
            ->latest()
            ->get();

        return view('ordermeet.index', compact('orders'));
    }

    // Petani: form buat order meet
    public function create()
    {
        // Kamu bisa ambil daftar ahli tani dari database untuk dropdown
        $ahliTaniList = \App\Models\User::where('role', 'ahli_tani')->get();

        return view('ordermeet.create', compact('ahliTaniList'));
    }

    // Petani: simpan order meet
    public function store(Request $request)
    {
        $request->validate([
            'id_ahli_tani' => 'required|exists:users,id',
            'amount' => 'required|integer|min:1',
            'topic' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        OrderMeet::create([
            'id_petani' => Auth::id(),
            'id_ahli_tani' => $request->id_ahli_tani,
            'amount' => $request->amount,
            'topic' => $request->topic,
            'date' => $request->date,
            'is_payment' => false,
            'is_done' => false,
            'is_confirmation' => false,
            'payment_ahli' => false,
        ]);

        return redirect()->route('ordermeet.index')->with('success', 'Permintaan pertemuan berhasil dibuat.');
    }

    // Ahli Tani: lihat dan kelola order meet yang ditujukan kepadanya
    public function manage()
    {
        $orders = OrderMeet::with('petani')
            ->where('id_ahli_tani', Auth::id())
            ->latest()
            ->get();

        return view('ordermeet.manage', compact('orders'));
    }

    // Ahli Tani: konfirmasi dan tambahkan link meet
    public function confirm(Request $request, $id)
    {
        $request->validate([
            'link_meet' => 'required|url|max:255',
        ]);

        $order = OrderMeet::where('id', $id)
            ->where('id_ahli_tani', Auth::id())
            ->firstOrFail();

        $order->update([
            'is_confirmation' => true,
            'link_meet' => $request->link_meet,
        ]);

        return back()->with('success', 'Pertemuan telah dikonfirmasi.');
    }
}
