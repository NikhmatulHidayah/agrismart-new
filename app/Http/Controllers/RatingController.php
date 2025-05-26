<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RatingController extends Controller
{
    public function store(Request $request){
        DB::table('rating')->insert([
            'star' => $request->input('star'),
            'feedback' => $request->input('feedback'),
            'id_ahli_tani' => $request->input('id_ahli_tani'),
            'id_petani' => $request->input('id_petani'),
            'id_order_meet' => $request->input('id_order_meet'),
        ]);
    
        return redirect()->back()->with('success', 'Ulasan berhasil dikirim. Terima kasih!');
    }
}
