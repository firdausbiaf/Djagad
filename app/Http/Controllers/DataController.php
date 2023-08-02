<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;
use App\Models\User;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Data::select("*")->orderBy("id", "asc")->paginate(10);
        return view('dashboard.data.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereNotIn('role', ['admin', 'petugas'])->select('id', 'name')->get();
        return view('dashboard.data.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataRequest $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alamat' => 'required',
            'kavling' => 'required',
            'lokasi' => 'required',
            'tipe' => 'required|integer',
            'spk' => 'required',
            'harga_deal' => 'required|integer',
            'uang_masuk' => 'required|integer',
            'cicilan' => 'required|integer',
            'progres' => 'required|integer',
            
        ]);

        $data = new Data;
        $data->user_id = $request->get('user_id');
        $data->alamat = $request->get('alamat');
        $data->kavling = $request->get('kavling');
        $data->lokasi = $request->get('lokasi');
        $data->tipe = $request->get('tipe');
        $data->spk = $request->get('spk');
        $data->harga_deal = $request->get('harga_deal');
        $data->uang_masuk = $request->get('uang_masuk');
        $data->cicilan = $request->get('cicilan');
        $data->progres = $request->get('progres');
        

        $data->save();
        return redirect()->route('data.index')->with('success', 'Data baru telah ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Data::findOrFail($id);
        return view('dashboard.data.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Get the data to be edited
        $data = Data::findOrFail($id);

        // Get users with roles other than "admin"
        $users = User::whereNotIn('role', ['admin', 'petugas'])->select('id', 'name')->get();

        // Enum values for 'lokasi'
        $lokasiOptions = ['DJAGAD LAND BATU', 'DJAGAD LAND SINGHASARI', 'DPARK CITY'];

        return view('dashboard.data.edit', compact('data', 'users', 'lokasiOptions'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataRequest  $request
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataRequest $request, $id)
    {
        // $data = Data::findOrFail($id);

        // $data->update($request->all());
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alamat' => 'required',
            'kavling' => 'required',
            'lokasi' => 'required',
            'tipe' => 'required|integer',
            'spk' => 'required',
            'harga_deal' => 'required|integer',
            'uang_masuk' => 'required|integer',
            'cicilan' => 'required|integer',
            'progres' => 'required|integer',
            'photo' => 'image|file|max:2048'
        ]);

        $data = Data::where('id', $id)->first();
        $data->user_id = $request->get('user_id');
        $data->alamat = $request->get('alamat');
        $data->kavling = $request->get('kavling');
        $data->lokasi = $request->get('lokasi');
        $data->tipe = $request->get('tipe');
        $data->harga_deal = $request->get('harga_deal');
        $data->spk = $request->get('spk');
        $data->uang_masuk = $request->get('uang_masuk');
        $data->progres = $request->get('progres');
        $data->cicilan = $request->get('cicilan');
        
        $data->save();

        return redirect()->route('data.index')->with('success', 'Data berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Data::findOrFail($id);
        $data->delete();

        return redirect()->route('data.index')->with('success', 'Data berhasil dihapus');
    }
}
