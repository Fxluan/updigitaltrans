<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
                // ->addColumn('action', function ($row) {
                //     $btn = "<a href=\"detaildriver/" . $row['id'] . "\" class=\"edit btn btn-info btn-sm\">Detail</a>";
                //     return $btn;
                // })
                // ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.verifikasi.index');
    }

    public function storepertanyaan(Request $request)
    {

        $pilihan_ganda = [$request->pilihanganda1, $request->pilihanganda2, $request->pilihanganda3, $request->pilihanganda4];
        $pilihan_ganda = json_encode($pilihan_ganda);

        DB::beginTransaction();
        try {
            $pertanyaan_verifikasi                  = new PertanyaanVerifikasi;
            $pertanyaan_verifikasi->pertanyaan      = $request->pertanyaan;
            $pertanyaan_verifikasi->type_mitra      = $request->type_mitra;
            $pertanyaan_verifikasi->pilihan_ganda   = $pilihan_ganda;
            $pertanyaan_verifikasi->save();

            DB::commit();

            return redirect()->back()->with('success', 'data tersimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'data gagal tersimpan.');
        }
    }
}
