<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ManageRecapController extends Controller
{
    // public function manageRecap()
    // {
    //     $experts = User::where('role', 'expert')
    //         ->whereHas('dataAhliTani', function ($query) {
    //             $query->where('status', 'approved');
    //         })
    //         ->withAvg('ratingsAsAhli as average_rating', 'star')
    //         ->with(['ratingsAsAhli' => function ($query) {
    //             $query->with('petani')
    //                 ->whereNotNull('feedback');
    //             // Hapus `latest()` atau ganti dengan kolom yang ada
    //             // Contoh alternatif: ->orderBy('id', 'desc') 
    //         }])
    //         ->get();

    //     return view('admin.manage-recap', compact('experts'));
    // }
}
