<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataAhliTani;
use App\Models\OrderMeet;
use App\Models\User;
use App\Models\OrderKonsultasi;

class ManageExpertController extends Controller
{
    //  Menampilkan daftar expert yang statusnya 'Pending'

    public function manageExpert()
    {
        $experts = DataAhliTani::with('user')
            ->oldest()
            ->get();

        return view('admin.manage-expert', compact('experts'));
    }

    // update status expert

    public function updateStatus(DataAhliTani $expert, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:Approved,Rejected'
        ]);

        $expert->update($validated);

        return response()->json([
            'message' => 'Expert status updated successfully'
        ]);
    }

    // Delete expert

    public function destroy(DataAhliTani $expert)
    {
        try {
            // Hapus user terkait
            $user = $expert->user;
            if ($user) {
                $user->delete();
            }

            // Hapus data ahli tani
            $expert->delete();

            return response()->json(['message' => 'Expert and associated user deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete expert and associated user'], 500);
        }
    }


    // edit expert
    public function edit(DataAhliTani $expert)
    {
        return view('admin.edit-expert', compact('expert'));
    }

    public function update(Request $request, DataAhliTani $expert)
    {
        $validated = $request->validate([
            'price' => 'nullable|string',
            'status' => 'required|in:Approved,Rejected,Pending',
        ]);

        $expert->update($validated);

        return redirect()->route('admin.manage-expert')->with('success', 'Expert updated successfully.');
    }


    //   Menampilkan daftar recap  

    public function manageRecap()
    {
        $experts = User::where('role', 'expert')
            ->whereHas('dataAhliTani', function ($query) {
                $query->where('status', 'approved');
            })
            ->withAvg('ratingsAsAhli as average_rating', 'star')
            ->with(['ratingsAsAhli' => function ($query) {
                $query->with('petani')
                    ->whereNotNull('feedback');
                // Hapus `latest()` atau ganti dengan kolom yang ada
                // Contoh alternatif: ->orderBy('id', 'desc') 
            }])
            ->get();

        return view('admin.manage-recap', compact('experts'));
    }

    public function managePayment()
    {
        $paymentsKonsultasi = OrderKonsultasi::with('petani')
            // ->where('is_payment', true)
            ->get();
        
        $paymentsKonsultasi->each(function ($item) {
            $item->type = 'Konsultasi';
        });

        $paymentsMeet = OrderMeet::with('petani')
            // ->where('is_payment', true)
            ->get();
        $paymentsMeet->each(function ($item) {
            $item->type = 'Meet';
        });

        $payments = $paymentsKonsultasi->merge($paymentsMeet);

        $payments = $payments->sortByDesc('created_at')->values();

        return view('admin.manage-payment', compact('payments'));
    }
}
