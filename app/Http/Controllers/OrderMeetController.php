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
        //dd("puki");
        $orders = DB::table('order_meet')
            ->join('users', 'order_meet.id_ahli_tani', '=', 'users.id')
            ->where('order_meet.id_petani', Auth::id())
            ->select('order_meet.*', 'users.name as ahli_name')
            ->orderByDesc('order_meet.created_at')
            ->get();

        //dd($orders);
        return view('ordermeet.index', compact('orders'));
    }

    // Petani: form buat order meet
    public function create()
    {
        //dd('puki');
        // Ambil ahli tani yang statusnya approved, sekaligus ambil data usernya
        $expertList = DataAhliTani::with('user')
            ->where('status', 'Approved')
            ->get();

        return view('ordermeet.create', compact('expertList'));
    }

    // Petani: simpan order meet
    public function store(Request $request)
    {
        $request->validate([
            'id_expert' => 'required',
            'amount' => 'required|integer|min:1',
            'topic' => 'nullable|string|max:255',
            'date' => 'required|date',
        ]);

        // Redirect to payment page with the order details
        $expert = DataAhliTani::with('user')->where('id_ahli_tani', $request->id_expert)->first();
        
        return view('ordermeet.payment', [
            'expert' => $expert->user,
            'amount' => $request->amount,
            'date' => $request->date,
            'topic' => $request->topic ?? '-'
        ]);
    }

    // Process payment and create order
    public function processPayment(Request $request)
    {
        $request->validate([
            'id_expert' => 'required',
            'amount' => 'required|integer|min:1',
            'date' => 'required|date',
            'topic' => 'nullable|string|max:255',
            'metode_pembayaran' => 'required|string',
        ]);

        OrderMeet::create([
            'id_petani' => Auth::id(),
            'id_ahli_tani' => $request->id_expert,
            'amount' => $request->amount,
            'topic' => $request->topic,
            'date' => $request->date,
            'is_payment' => true, // Set payment status to true since payment is done
            'is_done' => false,
            'is_confirmation' => false,
            'payment_ahli' => false,
        ]);

        return redirect()->route('ordermeet.payment_success');
    }

    // Show payment success page
    public function paymentSuccess()
    {
        return view('ordermeet.payment_success');
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

    public function markAsDone($id)
    {
        $order = OrderMeet::findOrFail($id);
        $order->is_done = 1;
        $order->save();

        return back()->with('success', 'Order berhasil diselesaikan.');
    }
}
