<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

use App\Models\PertanyaanVerifikasi;

class VerificationMitraController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = PertanyaanVerifikasi::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = "<a href=\"detaildriver/" . $row['id'] . "\" class=\"edit btn btn-info btn-sm\">Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.verifikasi.index');
    }

    public function storepertanyaan(Request $request)
    {
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
