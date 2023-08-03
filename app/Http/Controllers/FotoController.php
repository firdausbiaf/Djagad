<?php

namespace App\Http\Controllers;

use App\Models\Foto;
use App\Http\Requests\StoreFotoRequest;
use App\Http\Requests\UpdateFotoRequest;
use App\Models\Data;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Ambil semua data lokasi untuk membuat tab-tab
        $lokasiOptions = Data::pluck('lokasi')->unique();
        
        // Inisialisasi array untuk menyimpan foto-foto berdasarkan lokasi dan kavling
        $fotosByLokasi = [];
        
        foreach ($lokasiOptions as $lokasi) {
            // Ambil daftar kavling berdasarkan lokasi
            $kavlingOptions = Data::where('lokasi', $lokasi)->pluck('kavling')->toArray();
        
            // Ambil data foto berdasarkan lokasi dan kavling yang sesuai
            $fotos = Foto::whereHas('data', function ($dataQuery) use ($lokasi) {
                $dataQuery->where('lokasi', $lokasi);
            })->orderBy('id', 'asc')->get();
        
            $fotosByLokasi[$lokasi] = [
                'kavlingOptions' => $kavlingOptions,
                'fotos' => $fotos,
            ];
        }
        
        return view('dashboard.foto.index', compact('fotosByLokasi'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    // Ambil daftar lokasi dari model Data
    $lokasiOptions = Data::pluck('lokasi')->unique();

    // Inisialisasi array untuk menyimpan pilihan kavling berdasarkan lokasi
    $kavlingOptions = [];

    // Loop melalui setiap lokasi dan ambil pilihan kavling yang sesuai
    foreach ($lokasiOptions as $lokasi) {
        $kavlingOptions[$lokasi] = Data::where('lokasi', $lokasi)->pluck('kavling');
    }

    return view('dashboard.foto.create', compact('lokasiOptions', 'kavlingOptions'));
}



    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    
     public function store(StoreFotoRequest $request)
     {
         // Validasi form menggunakan StoreFotoRequest
         // Anda tidak perlu lagi melakukan validasi di sini karena sudah dilakukan di StoreFotoRequest
 
         // Ambil data_id berdasarkan lokasi dan kavling
         $data = Data::where('lokasi', $request->input('lokasi'))
                     ->where('kavling', $request->input('kavling'))
                     ->first();
 
         if (!$data) {
             return redirect()->route('foto.create')->with('error', 'Data kavling tidak ditemukan.');
         }
 
         $fotoPaths = []; // Simpan path file foto untuk setiap foto yang diunggah
 
         if ($request->hasFile('photo')) {
             foreach ($request->file('photo') as $file) {
                 $nama_photo = $file->store('photo', 'public');
                 $fotoPaths[] = $nama_photo;
             }
         }
 
         // Buat entri untuk setiap foto yang diunggah
         foreach ($fotoPaths as $nama_photo) {
             $foto = new Foto;
             $foto->data_id = $data->id;
             $foto->photo = $nama_photo;
             $foto->save();
         }
 
         return redirect()->route('foto.index')->with('success', 'Foto baru telah ditambahkan');
     }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $foto = Foto::findOrFail($id);
        return view('dashboard.foto.show', compact('foto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $foto = Foto::findOrFail($id);
        // Ambil daftar lokasi dari model Data
        $lokasiOptions = Data::pluck('lokasi')->unique();

        // Inisialisasi array untuk menyimpan pilihan kavling berdasarkan lokasi
        $kavlingOptions = [];

        // Loop melalui setiap lokasi dan ambil pilihan kavling yang sesuai
        foreach ($lokasiOptions as $lokasi) {
            $kavlingOptions[$lokasi] = Data::where('lokasi', $lokasi)->pluck('kavling');
        }

        return view('dashboard.foto.edit', compact('foto', 'lokasiOptions', 'kavlingOptions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFotoRequest  $request
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFotoRequest $request, $id)
    {
        $request->validate([
            'lokasi' => 'required',
            'kavling' => 'required',
            'photo' => 'image|file|max:2048',
        ]);

        $foto = Foto::findOrFail($id);

        // Ambil data_id berdasarkan lokasi dan kavling
        $data = Data::where('lokasi', $request->input('lokasi'))
                    ->where('kavling', $request->input('kavling'))
                    ->first();

        if (!$data) {
            return redirect()->route('foto.edit', $foto->id)->with('error', 'Data kavling tidak ditemukan.');
        }

        $foto->data_id = $data->id;

        if ($request->hasFile('photo')) {
            // Hapus foto lama jika ada
            if ($foto->photo && file_exists(storage_path('app/public/' . $foto->photo))) {
                Storage::delete('public/' . $foto->photo);
            }
            $nama_photo = $request->file('photo')->store('photo', 'public');
            $foto->photo = $nama_photo;
        }

        $foto->save();

        return redirect()->route('foto.index')->with('success', 'Foto berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $foto = Foto::findOrFail($id);
        if ($foto->photo && file_exists(storage_path('app/public/' . $foto->photo))) {
            Storage::delete('public/' . $foto->photo);
        }
        $foto->delete();

        return redirect()->route('foto.index')->with('success', 'Foto berhasil dihapus');
    }


    public function filter(Request $request)
    {
        $selectedKavlingId = $request->input('kavling');

        $query = Foto::query();

        if ($selectedKavlingId) {
            $query->whereHas('data', function ($dataQuery) use ($selectedKavlingId) {
                $dataQuery->where('id', $selectedKavlingId);
            });
        }

        $fotos = $query->orderBy('id', 'asc')->paginate(10);

        // Get the data for the filter dropdown
        $data = Data::pluck('kavling', 'id');

        return view('dashboard.foto.index', compact('fotos', 'data', 'selectedKavlingId'));
    }

    public function getKavlingsByLocation(Request $request)
    {
        $lokasi = $request->input('lokasi');
        $kavlings = Data::where('lokasi', $lokasi)->pluck('kavling');
        
        // Perbaiki cara mengirimkan data kavling dalam format JSON
        return response()->json($kavlings);
    }
    
}
