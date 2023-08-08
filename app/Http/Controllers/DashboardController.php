<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use App\Models\Data;
use App\Models\Legalitas;

class DashboardController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::all();
        $member = User::where('role', 'member');
        $admin = User::where('role', 'admin');
        $petugas = User::where('role', 'petugas');
        $data = Data::all();
        $legalitas = Legalitas::all();
        $course = Course::all();
        $category = Category::all();
        return view('dashboard.index', [
            'transaksi' => $transaksi,
            'member' => $member,
            'admin' => $admin,
            'petugas' => $petugas,
            'data' => $data,
            'legalitas' => $legalitas,
            'course' => $course,
            'category' => $category,
        ]);
    }
}
