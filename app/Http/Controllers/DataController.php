<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;
use App\Models\User;
use Illuminate\Http\Request;
// use App\Http\Controllers\DataImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DataImport;
use Illuminate\Support\Facades\Storage;




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
        // $lokasiOptions = ['DJAGAD LAND BATU', 'DJAGAD LAND SINGHASARI', 'DPARK CITY'];
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

    // dd($request->all());
    try {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'kavling' => 'required',
        'lokasi' => 'required',
        'tipe' => 'required|integer',
        'spk' => 'required',
        'ptb' => 'required',
        'harga_deal' => 'required|integer',
        'progres' => 'required|integer',
        'sales' => 'required',
        'ktp.*' => 'image|mimes:jpeg,png,jpg|max:2048',

    ]);

    $data = new Data;
    $data->user_id = $request->input('user_id');
    $data->kavling = $request->input('kavling');
    $data->lokasi = $request->input('lokasi');
    $data->tipe = $request->input('tipe');
    $data->spk = $request->input('spk');
    $data->ptb = $request->input('ptb');
    $data->harga_deal = $request->input('harga_deal');
    $data->progres = $request->input('progres');
    $data->sales = $request->input('sales');
    $data->save();

    // if ($request->hasFile('ktp')) {
    //     foreach ($request->file('ktp') as $file) {
    //         $nama_ktp = $file->store('ktp', 'public');
    
    //         // Simpan nama file gambar pada kolom 'ktp' pada record Data yang sesuai
    //         $data->ktp = $nama_ktp;
    //         $data->save();
    //     }
    // }

    if ($request->hasFile('ktp')) {
        $ktpPaths = [];
        foreach ($request->file('ktp') as $file) {
            $nama_ktp = $file->store('ktp', 'public');
            $ktpPaths[] = $nama_ktp;
        }
        $data->ktp = implode(',', $ktpPaths);
        $data->save();
    }
    

    return redirect()->route('data.index')->with('success', 'Data baru telah ditambahkan');
}catch (\Exception $e) {

 // This will display the error message
    }
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

    public function viewKtp($id)
{
    try {
        $data = Data::findOrFail($id);
        return view('dashboard.data.view_ktp', compact('data'));
    } catch (\Exception $e) {
        return redirect()->route('data.index')->with('error', 'Terjadi kesalahan saat menampilkan KTP: ' . $e->getMessage());
    }
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
    try {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'kavling' => 'required',
            'tipe' => 'required|integer',
            'spk' => 'required',
            'ptb' => 'required',
            'harga_deal' => 'required|integer',
            'progres' => 'required|integer',
            'sales' => 'required',
            'ktp.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = Data::findOrFail($id);
        $data->user_id = $request->get('user_id');
        $data->kavling = $request->get('kavling');
        $data->lokasi = $request->get('lokasi');
        $data->tipe = $request->get('tipe');
        $data->harga_deal = $request->get('harga_deal');
        $data->spk = $request->get('spk');
        $data->ptb = $request->get('ptb');
        $data->progres = $request->get('progres');
        $data->sales = $request->get('sales');

        // Get existing KTP paths
        $existingKtpPaths = explode(',', $data->ktp);

        // Handle photo upload
        // if ($request->hasFile('ktp')) {
        //     $ktpPaths = [];
        //     foreach ($request->file('ktp') as $file) {
        //         $nama_ktp = $file->store('ktp', 'public');
        //         $ktpPaths[] = $nama_ktp;
        //     }

        //     // Merge existing KTP paths with new ones
        //     $ktpPaths = array_merge($existingKtpPaths, $ktpPaths);
        //     $data->ktp = implode(',', $ktpPaths);
        // }

        // $data->save();

        if ($request->hasFile('ktp')) {
            $ktpPaths = [];
            foreach ($request->file('ktp') as $file) {
                $nama_ktp = $file->store('ktp', 'public');
                $ktpPaths[] = $nama_ktp;
            }
            $data->ktp = implode(',', $ktpPaths); // Simpan hanya foto baru yang diunggah
            $data->save();
        }
        

        return redirect()->route('data.index')->with('success', 'Data berhasil diedit');
    } catch (\Exception $e) {
        return redirect()->route('data.edit', $id)->with('error', 'Terjadi kesalahan saat mengedit data: ' . $e->getMessage());
    }
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

    public function importExcel(Request $request)
    {
        $data = $request->file('file');
        $namafile = $data->getClientOriginalName();
        $data->move('data', $namafile);

        Excel::import(new DataImport, \public_path('/data/' . $namafile));
        return \redirect()->back();

        // $request->validate([
        //     'file' => 'required|mimes:xlsx,csv,ods'
        // ]);

        // // Lakukan import data dari file Excel
        // $data = Excel::import(new DataImport, $request->file('file'));

        // return redirect()->route('data.index')->with('success', 'Data berhasil diimpor dari Excel.');
    }
}
