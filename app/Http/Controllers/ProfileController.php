<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    private $title = "Setia Kawan | Profil";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profil = Profile::all();

        return view('pages.profil.index')->with([
            'title' => $this->title,
            'profil' => $profil
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Profile::updateOrCreate([
            'id' => $request->input('profile_id')
        ],[
            'nama_perusahaan' => $request->input('nama_perusahaan'),
            'pemilik_1' => $request->input('pemilik_1'),
            'pemilik_2' => $request->input('pemilik_2'),
            'deskripsi_1' => $request->input('deskripsi_1'),
            'deskripsi_2' => $request->input('deskripsi_2'),
            'alamat' => $request->input('alamat')
        ]);
        
        return redirect()->route('profil.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
