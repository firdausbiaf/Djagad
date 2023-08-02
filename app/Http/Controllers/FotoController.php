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
    $search = $request->input('search');
    $selectedLokasi = $request->input('lokasi');
    $selectedKavling = $request->input('kavling');

    // Query dasar untuk data foto
    $query = Foto::query();

    // Perform the search based on 'search' parameter (mirip seperti sebelumnya)
    if ($search) {
        $query->where(function ($innerQuery) use ($search) {
            $innerQuery->where('id', 'like', '%' . $search . '%')
                ->orWhereHas('data', function ($dataQuery) use ($search) {
                    $dataQuery->where('kavling', 'like', '%' . $search . '%');
                });
        });
    }

    // Perform the filter based on 'lokasi' parameter
    if ($selectedLokasi) {
        $query->whereHas('data', function ($dataQuery) use ($selectedLokasi) {
            $dataQuery->where('lokasi', $selectedLokasi);
        });
    }

    // Perform the filter based on 'kavling' parameter
    if ($selectedKavling) {
        $query->whereHas('data', function ($dataQuery) use ($selectedKavling) {
            $dataQuery->where('kavling', $selectedKavling);
        });
    }

    // Get the data for the filter dropdown
    $lokasiOptions = Data::pluck('lokasi')->unique();
    $kavlingOptions = Data::when($selectedLokasi, function ($query, $selectedLokasi) {
        return $query->where('lokasi', $selectedLokasi)->pluck('kavling');
    })->pluck('kavling');

    // Get the paginated results
    $fotos = $query->orderBy('id', 'asc')->paginate(10);

    return view('dashboard.foto.index', compact('fotos', 'lokasiOptions', 'kavlingOptions', 'selectedLokasi', 'selectedKavling', 'search'));
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
        $kavlings = Data::where('lokasi', $lokasi)->pluck('kavling', 'kavling');

        return Response::json($kavlings);
    }
}
