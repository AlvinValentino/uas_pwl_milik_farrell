<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\product;
use App\Models\masuk;
use App\Models\keluar;
use App\Models\supplier;
use Illmuninate\Support\Facades\Auth;
use Illmuninate\Support\Facades\DB;


class HomeController extends Controller
{
    /** 
     * Create a new controller instance.
     * 
     * @return void
    */
   public function __construct()
   {
    //    $this->middleware('auth'); // Example middleware
       
   }
   
    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index()
    {
        return view('pages.dashboard', ['title' => 'Dashboard Page']);
    }

    public function admin()
    {
        $jumlahMasuk = DB::table('masuks')->count();
        $jumlahKeluar = DB::table('keluars')->count();
        $jumlahSupplier = DB::table('suppliers')->count();
        $itemCountsByCategory = Product::select('kategori', DB::raw('COUNT(*) as count'))
        ->groupBy('kategori')
        ->get();

        $barangMasuk = DB::table('masuks')->count();
        $barangKeluar = DB::table('keluars')->count();
        return view('pages.admin.dashboard', compact('itemCountsByCategory', 'barangMasuk', 'barangKeluar', 'jumlahMasuk', 'jumlahKeluar', 'jumlahSupplier'));
    }

    public function operator()
    {
        $jumlahMasuk = DB::table('masuks')->count();
        $jumlahKeluar = DB::table('keluars')->count();
        $jumlahSupplier = DB::table('suppliers')->count();
        $itemCountsByCategory = Product::select('kategori', DB::raw('COUNT(*) as count'))
        ->groupBy('kategori')
        ->get();

        $barangMasuk = DB::table('masuks')->count();
        $barangKeluar = DB::table('keluars')->count();
        return view('pages.operator.dashboard', compact('itemCountsByCategory', 'barangMasuk', 'barangKeluar', 'jumlahMasuk', 'jumlahKeluar', 'jumlahSupplier'));
    }



    public function pimpinan()
    {
        $jumlahMasuk = DB::table('masuks')->count();
        $jumlahKeluar = DB::table('keluars')->count();
        $jumlahSupplier = DB::table('suppliers')->count();
        $itemCountsByCategory = Product::select('kategori', DB::raw('COUNT(*) as count'))
        ->groupBy('kategori')
        ->get();

        $barangMasuk = DB::table('masuks')->count();
        $barangKeluar = DB::table('keluars')->count();
        return view('pages.pimpinan.dashboard', compact('itemCountsByCategory', 'barangMasuk', 'barangKeluar', 'jumlahMasuk', 'jumlahKeluar', 'jumlahSupplier'));
    }
}
