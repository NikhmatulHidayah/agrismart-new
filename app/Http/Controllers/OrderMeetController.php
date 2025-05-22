<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\OrderMeet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DataAhliTani;

class OrderMeetController extends Controller
{
    // Petani: lihat daftar order mereka
    public function index()
    {
        $orders = DB::table('order_meet')
            ->join('users', 'order_meet.id_ahli_tani', '=', 'users.id')
            ->where('order_meet.id_petani', Auth::id())
            ->select('order_meet.*', 'users.name as ahli_name')
            ->orderByDesc('order_meet.created_at')
            ->get();

        return view('ordermeet.index', compact('orders'));
    }

    // Petani: form buat order meet
    public function create()
    {
        // Kamu bisa ambil daftar ahli tani dari database untuk dropdown
        $expertList = \App\Models\User::where('role', 'expert')->get();

        return view('ordermeet.create', compact('expertList'));
    }


    // Menampilkan expert yang telah di approve saja
    // public function create()
    // {
    //     // Ambil ahli tani yang statusnya approved, sekaligus ambil data usernya
    //     $expertList = DataAhliTani::with('user')
    //         ->where('status', 'Approved')
    //         ->get();

    //     return view('ordermeet.create', compact('expertList'));
    // }


    // Petani: simpan order meet
    public function store(Request $request)
    {
        $request->validate([
            'id_expert' => 'required',
            'amount' => 'required|integer|min:1',
            'topic' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);
        //dd($request->id_expert);

        OrderMeet::create([
            'id_petani' => Auth::id(),
            'id_ahli_tani' => $request->id_expert,
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
