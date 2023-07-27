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

        if (Auth::user()) {
            if (Auth::user()->role == "member") {
                $data = Data::where('user_id', Auth::id())->paginate(10);
                $foto = Foto::where('data_id', Auth::id())->get();
                $kavlings = Data::where('user_id', Auth::id())->pluck('kavling', 'id');

                return view('index', [
                    'data' => $data,
                    'foto' => $foto,
                    'kavlings' => $kavlings,
                    'selectedKavlingId' => null,
                ]);
            }
        }

        return view('index');
    }

    public function filter(Request $request)
    {
        if (Auth::user()) {
            if (Auth::user()->role == "member") {
                $selectedKavlingId = $request->input('kavling');

                $data = Data::where('user_id', Auth::id());

                if ($selectedKavlingId) {
                    $data->where('id', $selectedKavlingId);
                }

                $data = $data->paginate(10);
                $foto = Foto::where('data_id', Auth::id())->get();
                $kavlings = Data::where('user_id', Auth::id())->pluck('kavling', 'id');

                return view('index', [
                    'data' => $data,
                    'foto' => $foto,
                    'kavlings' => $kavlings,
                    'selectedKavlingId' => $selectedKavlingId,
                ]);
            }
        }

        return view('index');
    }

}
