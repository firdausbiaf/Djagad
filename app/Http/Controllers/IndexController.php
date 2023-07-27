<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Data;
use App\Models\Foto;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    public function index()
    {        
        if(Auth::user()){
            if(Auth::user()->role=="member"){
                $data = Data::where('user_id', Auth::id())->first();
                $foto = Foto::where('data_id', $data->id)->get();

                return view('index', [
                    'data' => $data,
                    'foto' => $foto,

                ]);
            }else{
                return view('index');
            }

        }else{
            return view('index');
        }
        
    }

}
