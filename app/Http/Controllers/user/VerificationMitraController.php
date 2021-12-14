<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Driver;

class VerificationMitraController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        // return view('user.mitradriver.index', compact('list_item'));
        return view('user.verifikasi');
    }

    public function storepertanyaan(Request $request){
        
    }

    public function verifikasimitra(Request $request)
    {
        dd($request->all());

        $id_user            = Auth::id();
        
        // DB::beginTransaction();
        // try {
        //     $driver                 = new Driver;
        //     $driver->user_id        = Auth::id();
        //     $driver->vehicle_type   = $request->type_mitra;
        //     $driver->vehicle_number = $request->no_kendaraan;
        //     $driver->sim_number     = $request->no_sim;
        //     $driver->ktp_number     = $request->no_ktp;
        //     $driver->photo_user     = $path_photo_user;
        //     $driver->photo_ktp      = $path_photo_ktp;
        //     $driver->photo_sim      = $path_photo_sim;
        //     $driver->photo_stnk     = $path_photo_stnk;
        //     $driver->status         = 0;

        //     $driver->save();
        //     DB::commit();

        //     return redirect()->back()->with('success', 'Pengajuan anda Terkirim.');
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return redirect()->back()->with('error', 'Pengajuan anda Ditolak.');
        // }
    }
}
