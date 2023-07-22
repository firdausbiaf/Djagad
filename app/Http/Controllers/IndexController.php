<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Course;
use App\Models\Transaksi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    public function index()
    {        
        if(Auth::user()){
            if(Auth::user()->role=="member"){
                $transaksi = Transaksi::where('user_id', Auth::id())->first();
                $category = Category::all();
                $transaksinew = Transaksi::where('user_id', Auth::id())->get();

                return view('index', [
                    'category' => $category,
                    'transaksi' => $transaksi,
                    'transaksinew' => $transaksinew
                    // 'course' => $transaksi->course,
                ]);
            }else{
                return view('index');
            }

        }else{
            return view('index');
        }
        
    }

}
