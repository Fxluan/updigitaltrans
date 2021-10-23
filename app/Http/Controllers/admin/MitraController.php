<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Driver;
use App\Models\Merchant;

class MitraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function driverView(Request $request)
    {
        if ($request->ajax()) {
            $data = Driver::with('user')->select('id','user_id','ktp_number','sim_number','status','vehicle_number','vehicle_type');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status_validasi', function ($row) {
                    // menunggu konfirmasi
                    if ($row['status'] == 0) {
                        $lbl = "<span class=\"badge badge-info\">Menunggu validasi</span>";
                    }
                    // Diterima
                    if ($row['status'] == 1) {
                        $lbl = "<span class=\"badge badge-success\">Diterima</span>";
                    }
                    // Ditolak
                    if ($row['status'] == 2) {
                        $lbl = "<span class=\"badge badge-danger\">DiTolak</span>";
                    }
                    
                    return $lbl;
                })
                ->addColumn('action', function ($row) {
                    $btn = "<a href=\"detaildriver/" . $row['id'] . "\" class=\"edit btn btn-info btn-sm\">Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action','status_validasi'])
                ->make(true);
        }

        return view('admin.driver.index');
    }

    public function driverDetail($id)
    {
        return view('admin.driver.detail');
    }

    public function merchantView(Request $request)
    {
        if ($request->ajax()) {
            $data = Merchant::select('*');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">Validasi</a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.merchant.index');
    }
}
