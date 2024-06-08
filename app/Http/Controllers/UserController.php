<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Arr;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validasi = Validator::make($input,[
            'name' => 'required|max:128|string',
            'level' => 'required',
            'email' => 'required|email|max:50|string|unique:users',
            'password' => 'required|min:8|max:30'
        ]);

        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }

        $input['password'] = bcrypt($input['password']);

        User::create($input)->with('success', 'Data Berhasil Ditambahkan ✨');
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $data = $request->all();

        $validasi = Validator::make($data,[
            'name' => 'required|max:128|string',
            'level' => 'required',
            'email' => 'required|email|max:50|string',
            'password' => 'required|min:8|max:30'
        ]);

        if($validasi->fails())
        {
            return back()->withErrors($validasi)->withInput();
        }

        if($request->input('password'))
        {
            $data['password'] = bcrypt($data['password']); 
        }
        else{
            $data = Arr::except($data, ['password']);
        }

        $user->update($data);
        return redirect('/penjual');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::find($id);
        $data->delete();
        return back();
    }
}
