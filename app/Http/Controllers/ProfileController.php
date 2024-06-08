<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $validasi = Validator::make($data, [
            'nomor_hp' => 'required|max:15|min:10',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'foto_profile' => 'required|mimes:png,jpg,jpeg,heic',
        ]);

        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }
        if($request->hasFile('foto_profile'))
        {
            $folder = 'public/images/profile'; // MEMBUAT FOLDER PENYIMPANAN
            $gambar = $request->file('foto_profile'); // MENGAMBIL DATA DARI REQUEST FOT0_PROFILE
            $nama_gambar = $gambar->getClientOriginalName(); // MEMEBERIKAN NAMA ASLI PADA FILE
            $path = $request->file('foto_profile')->storeAs($folder, $nama_gambar); // MENGIRIMKAN GAMBAR KE FOLDER
            $data['foto_profile'] = $nama_gambar; // MEMBERIKAN NAMA YANG DIKIRIM KE DATABASE
        }
        
        Profile::create($data);
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
