<?php

namespace App\Http\Controllers;

use App\Models\DataAhliTani;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataAhliTaniController extends Controller
{
    public function index()
    {
        $dataAhliTani = DataAhliTani::where('id_ahli_tani', Auth::id())->first();
        return view('expert.profile.index', compact('dataAhliTani'));
    }

    public function create()
    {
        return view('expert.profile.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
            'certificate' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'expired_certificate' => 'required|date',
            'price' => 'required|numeric',
            'yoe' => 'required|integer',
            'alumni' => 'required|string',
        ]);

        $data = [
            'id_ahli_tani' => Auth::id(),
            'status' => $request->status,
            'expired_certificate' => $request->expired_certificate,
            'price' => $request->price,
            'yoe' => $request->yoe,
            'alumni' => $request->alumni,
        ];

        if ($request->hasFile('certificate')) {
            $file = $request->file('certificate');
            $path = $file->store('certificates', 'public');
            $data['certificate'] = $path;
        }

        DataAhliTani::create($data);

        return redirect()->route('expert.profile.index')->with('success', 'Data ahli tani berhasil ditambahkan');
    }

    public function edit()
    {
        $dataAhliTani = DataAhliTani::where('id_ahli_tani', Auth::id())->first();
        return view('expert.profile.edit', compact('dataAhliTani'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'status' => 'required|string',
            'certificate' => 'required|string',
            'expired_certificate' => 'required|date',
            'price' => 'required|numeric',
            'yoe' => 'required|integer',
            'alumni' => 'required|string',
        ]);

        $dataAhliTani = DataAhliTani::where('id_ahli_tani', Auth::id())->first();
        $dataAhliTani->update($request->all());

        return redirect()->route('expert.profile.index')->with('success', 'Data ahli tani berhasil diperbarui');
    }
} 