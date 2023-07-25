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
    public function index()
    {
        $data = Data::pluck('kavling', 'id');
        $fotos = Foto::select('*')->orderBy('id', 'asc')->paginate(10);
        return view('dashboard.foto.index', compact('fotos', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ambil daftar kavling dari model Data
        $data = Data::pluck('kavling', 'id');

        return view('dashboard.foto.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFotoRequest $request)
    {
        $request->validate([
            'data_id' => 'required|exists:data,id',
            'photo.*' => 'image|file|max:2048', // Update validasi untuk menerima array file
        ]);

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
            $foto->data_id = $request->get('data_id');
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
        // Ambil daftar kavling dari model Data
        $data = Data::pluck('kavling', 'id');

        return view('dashboard.foto.edit', compact('foto', 'data'));
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
            'data_id' => 'required|exists:data,id',
            'photo' => 'image|file|max:2048',
        ]);

        $foto = Foto::findOrFail($id);
        $foto->data_id = $request->get('data_id');

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
        // Debugging: Cek nilai parameter kavling
        $selectedKavlingId = $request->input('kavling');
        dd($selectedKavlingId);
        
        // Lakukan operasi filter berdasarkan $selectedKavlingId
        $fotos = Foto::when($selectedKavlingId, function ($query, $selectedKavlingId) {
            return $query->where('data_id', $selectedKavlingId);
        })->orderBy('id', 'asc')->paginate(10);
    
        // Debugging: Cek query yang dijalankan
        dd($fotos->toSql());
    
        // Setelah melakukan operasi filter, ambil daftar kavling lagi untuk menampilkan di select option
        $data = Data::pluck('kavling', 'id');
    
        return view('dashboard.foto.index', compact('fotos', 'data'));
    }    

}
