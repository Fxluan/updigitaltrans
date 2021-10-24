<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Models\Driver;
use App\Models\Merchant;
use App\Models\DetailUser;
use Illuminate\Support\Facades\DB;

class MitraController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pengajuanMitra(Request $request)
    {
        if ($request->ajax()) {
            $dataDriver = collect(Driver::with('user')->select('id', 'user_id', 'vehicle_type', 'status')->where('status', 0)->orWhere('status', 3)->get());
            $dataMerchant = collect(Merchant::with('user')->select('id', 'user_id', 'merchant_name', 'role', 'status')->where('status', 0)->orWhere('status', 3)->get());
            $data = $dataDriver->merge($dataMerchant);

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('mitra', function ($row) {
                    if (isset($row['role'])) {
                        $mitra = $row['role'];
                    }
                    if (isset($row['vehicle_type'])) {
                        $mitra = $row['vehicle_type'];
                    }

                    return $mitra;
                })
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
                    // Pengajuan ulang
                    if ($row['status'] == 3) {
                        $lbl = "<span class=\"badge badge-warning\">Pengajuan Ulang</span>";
                    }
                    // Pengajuan ulang
                    if ($row['status'] == 4) {
                        $lbl = "<span class=\"badge badge-primary\">Dibekukan</span>";
                    }

                    return $lbl;
                })
                ->addColumn('action', function ($row) {
                    if (isset($row['role'])) {
                        $mitra = $row['role'];
                    }
                    if (isset($row['vehicle_type'])) {
                        $mitra = $row['vehicle_type'];
                    }
                    $btn = "<a href=\"detailpengajuan/" . $row['id'] . "/" . $mitra . "\" class=\"edit btn btn-info btn-sm\">Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action', 'status_validasi'])
                ->make(true);
        }

        return view('admin.pengajuan');
    }

    public function detailPengajuanMitra($id, $mitra)
    {
        if ($mitra == 'car' || $mitra == 'motorcycle') {
            // deklarasi variabel
            $data               = Driver::with('user')->find($id);
            $detail_user        = DetailUser::with('user')->find($data->user_id);
            $nama_lengkap       = $data->user->name;
            $email              = $data->user->email;
            $no_telepon         = $detail_user ? $detail_user->phone : '-';
            $alamat             = $detail_user ? $detail_user->address : '-';
            $tgl_lahir          = $detail_user ? $detail_user->date_of_birth : '-';
            $tipe_kendaraan     = $data->vehicle_type;
            $nopol_kendaraan    = $data->vehicle_number;
            $no_sim             = $data->sim_number;
            $no_ktp             = $data->ktp_number;
            $status             = $data->status;
            $desc_verifikasi    = $data->describe_verification;
            $foto_user          = $data->photo_user;
            $foto_ktp           = $data->photo_ktp;
            $foto_sim           = $data->photo_sim;
            $foto_stnk          = $data->photo_stnk;

            // manipulasi status
            if ($status == 0) {
                $status = "<span class=\"badge badge-info\">menunggu verifikasi</span>";
            } else if ($status == 1) {
                $status = "<span class=\"badge badge-success\">verifikasi berhasil</span>";
            } else if ($status == 2) {
                $status = "<span class=\"badge badge-danger\">verifikasi gagal</span>";
            } else if ($status == 3) {
                $status = "<span class=\"badge badge-warning\">pengajuan ulang</span>";
            } else if ($status == 4) {
                $status = "<span class=\"badge badge-primary\">akun dibekukan</span>";
            }

            // data view
            $data = array(
                'id'                => $id,
                'nama_lengkap'      => $nama_lengkap,
                'email'             => $email,
                'no_telepon'        => $no_telepon,
                'alamat'            => $alamat,
                'tgl_lahir'         => $tgl_lahir,
                'tipe_kendaraan'    => $tipe_kendaraan,
                'nopol_kendaraan'   => $nopol_kendaraan,
                'no_sim'            => $no_sim,
                'no_ktp'            => $no_ktp,
                'status'            => $status,
                'desc_verifikasi'   => $desc_verifikasi != '' ? $desc_verifikasi : 'tidak ada keterangan.',
                'foto_user'         => $foto_user,
                'foto_ktp'          => $foto_ktp,
                'foto_sim'          => $foto_sim,
                'foto_stnk'         => $foto_stnk
            );

            return view('admin.driver.detail', $data);
        }

        if ($mitra == 'food' || $mitra == 'mart') {
            // deklarasi variabel
            $data               = Merchant::with('user')->find($id);
            $detail_user        = DetailUser::with('user')->find($data->user_id);
            $nama_lengkap       = $data->user->name;
            $email              = $data->user->email;
            $no_telepon         = $detail_user ? $detail_user->phone : '-';
            $alamat             = $detail_user ? $detail_user->address : '-';
            $tgl_lahir          = $detail_user ? $detail_user->date_of_birth : '-';
            $merchant_name      = $data->merchant_name;
            $description        = $data->description;
            $open_time          = $data->open_time;
            $close_time         = $data->close_time;
            $address_menchant   = $data->address_menchant;
            $role               = $data->role;
            $status             = $data->status;
            $desc_verifikasi    = $data->describe_verification;
            $galery_merchant    = $data->galery_merchant;

            // manipulasi status
            if ($status == 0) {
                $status = "<span class=\"badge badge-info\">menunggu verifikasi</span>";
            } else if ($status == 1) {
                $status = "<span class=\"badge badge-success\">verifikasi berhasil</span>";
            } else if ($status == 2) {
                $status = "<span class=\"badge badge-danger\">verifikasi gagal</span>";
            } else if ($status == 3) {
                $status = "<span class=\"badge badge-warning\">pengajuan ulang</span>";
            } else if ($status == 4) {
                $status = "<span class=\"badge badge-primary\">akun dibekukan</span>";
            }

            // data view
            $data = array(
                'id'                => $id,
                'nama_lengkap'      => $nama_lengkap,
                'email'             => $email,
                'no_telepon'        => $no_telepon,
                'alamat'            => $alamat,
                'tgl_lahir'         => $tgl_lahir,
                'merchant_name'     => $merchant_name,
                'description'       => $description,
                'open_time'         => $open_time,
                'close_time'        => $close_time,
                'status'            => $status,
                'desc_verifikasi'   => $desc_verifikasi != '' ? $desc_verifikasi : 'tidak ada keterangan.',
                'address_menchant'  => $address_menchant,
                'role'              => $role,
                'galery_merchant'   => $galery_merchant,
            );

            return view('admin.merchant.detail', $data);
        }
    }

    public function driverView(Request $request)
    {
        if ($request->ajax()) {
            $data = Driver::with('user')->select('id', 'user_id', 'ktp_number', 'sim_number', 'status', 'vehicle_number', 'vehicle_type')->where('status', '!=', 0)->get();
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
                    // Pengajuan ulang
                    if ($row['status'] == 3) {
                        $lbl = "<span class=\"badge badge-warning\">Pengajuan Ulang</span>";
                    }
                    // Pengajuan ulang
                    if ($row['status'] == 4) {
                        $lbl = "<span class=\"badge badge-primary\">Dibekukan</span>";
                    }

                    return $lbl;
                })
                ->addColumn('action', function ($row) {
                    $btn = "<a href=\"detaildriver/" . $row['id'] . "\" class=\"edit btn btn-info btn-sm\">Detail</a>";
                    return $btn;
                })
                ->rawColumns(['action', 'status_validasi'])
                ->make(true);
        }

        return view('admin.driver.index');
    }

    public function driverDetail($id)
    {

        // deklarasi variabel
        $data               = Driver::with('user')->find($id);
        $detail_user        = DetailUser::with('user')->find($data->user_id);
        $nama_lengkap       = $data->user->name;
        $email              = $data->user->email;
        $no_telepon         = $detail_user ? $detail_user->phone : '-';
        $alamat             = $detail_user ? $detail_user->address : '-';
        $tgl_lahir          = $detail_user ? $detail_user->date_of_birth : '-';
        $tipe_kendaraan     = $data->vehicle_type;
        $nopol_kendaraan    = $data->vehicle_number;
        $no_sim             = $data->sim_number;
        $no_ktp             = $data->ktp_number;
        $status             = $data->status;
        $desc_verifikasi    = $data->describe_verification;
        $foto_user          = $data->photo_user;
        $foto_ktp           = $data->photo_ktp;
        $foto_sim           = $data->photo_sim;
        $foto_stnk          = $data->photo_stnk;

        // manipulasi status
        if ($status == 0) {
            $status = "<span class=\"badge badge-info\">menunggu verifikasi</span>";
        } else if ($status == 1) {
            $status = "<span class=\"badge badge-success\">verifikasi berhasil</span>";
        } else if ($status == 2) {
            $status = "<span class=\"badge badge-danger\">verifikasi gagal</span>";
        } else if ($status == 3) {
            $status = "<span class=\"badge badge-warning\">pengajuan ulang</span>";
        } else if ($status == 4) {
            $status = "<span class=\"badge badge-primary\">akun dibekukan</span>";
        }

        // data view
        $data = array(
            'id'                => $id,
            'nama_lengkap'      => $nama_lengkap,
            'email'             => $email,
            'no_telepon'        => $no_telepon,
            'alamat'            => $alamat,
            'tgl_lahir'         => $tgl_lahir,
            'tipe_kendaraan'    => $tipe_kendaraan,
            'nopol_kendaraan'   => $nopol_kendaraan,
            'no_sim'            => $no_sim,
            'no_ktp'            => $no_ktp,
            'status'            => $status,
            'desc_verifikasi'   => $desc_verifikasi != '' ? $desc_verifikasi : 'tidak ada keterangan.',
            'foto_user'         => $foto_user,
            'foto_ktp'          => $foto_ktp,
            'foto_sim'          => $foto_sim,
            'foto_stnk'         => $foto_stnk
        );

        return view('admin.driver.detail', $data);
    }

    public function driverVerification(Request $request)
    {
        DB::beginTransaction();
        try {
            $driver = Driver::find($request->id);
            $driver->status = $request->status;
            $driver->describe_verification = $request->deskripsi != null ? $request->deskripsi : '';
            $driver->save();
            DB::commit();

            return response()->json([
                'success' => 1,
                'message' => 'verifikasi telah diupdate.',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => 0,
                'message' => 'verifikasi gagal diupdate.',
            ]);
        }
    }

    public function merchantView(Request $request)
    {
        if ($request->ajax()) {
            $data = Merchant::select('id', 'user_id', 'merchant_name', 'description', 'open_time', 'close_time', 'role', 'address_menchant', 'status')->where('status', '!=', 0)->get();
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
                    // Pengajuan ulang
                    if ($row['status'] == 3) {
                        $lbl = "<span class=\"badge badge-warning\">Pengajuan Ulang</span>";
                    }
                    // Pengajuan ulang
                    if ($row['status'] == 4) {
                        $lbl = "<span class=\"badge badge-primary\">Dibekukan</span>";
                    }

                    return $lbl;
                })
                ->addColumn('action', function ($row) {

                    $btn = "<a href=\"detailmerchant/" . $row['id'] . "\" class=\"edit btn btn-info btn-sm\">Detail</a>";

                    return $btn;
                })
                ->rawColumns(['action', 'status_validasi'])
                ->make(true);
        }
        return view('admin.merchant.index');
    }

    public function merchantDetail($id)
    {
        // deklarasi variabel
        $data               = Merchant::with('user')->find($id);
        $detail_user        = DetailUser::with('user')->find($data->user_id);
        $nama_lengkap       = $data->user->name;
        $email              = $data->user->email;
        $no_telepon         = $detail_user ? $detail_user->phone : '-';
        $alamat             = $detail_user ? $detail_user->address : '-';
        $tgl_lahir          = $detail_user ? $detail_user->date_of_birth : '-';
        $merchant_name      = $data->merchant_name;
        $description        = $data->description;
        $open_time          = $data->open_time;
        $close_time         = $data->close_time;
        $address_menchant   = $data->address_menchant;
        $role               = $data->role;
        $status             = $data->status;
        $desc_verifikasi    = $data->describe_verification;
        $galery_merchant    = $data->galery_merchant;

        // manipulasi status
        if ($status == 0) {
            $status = "<span class=\"badge badge-info\">menunggu verifikasi</span>";
        } else if ($status == 1) {
            $status = "<span class=\"badge badge-success\">verifikasi berhasil</span>";
        } else if ($status == 2) {
            $status = "<span class=\"badge badge-danger\">verifikasi gagal</span>";
        } else if ($status == 3) {
            $status = "<span class=\"badge badge-warning\">pengajuan ulang</span>";
        } else if ($status == 4) {
            $status = "<span class=\"badge badge-primary\">akun dibekukan</span>";
        }

        // data view
        $data = array(
            'id'                => $id,
            'nama_lengkap'      => $nama_lengkap,
            'email'             => $email,
            'no_telepon'        => $no_telepon,
            'alamat'            => $alamat,
            'tgl_lahir'         => $tgl_lahir,
            'merchant_name'     => $merchant_name,
            'description'       => $description,
            'open_time'         => $open_time,
            'close_time'        => $close_time,
            'status'            => $status,
            'desc_verifikasi'   => $desc_verifikasi != '' ? $desc_verifikasi : 'tidak ada keterangan.',
            'address_menchant'  => $address_menchant,
            'role'              => $role,
            'galery_merchant'   => $galery_merchant,
        );

        return view('admin.merchant.detail', $data);
    }

    public function merchantVerification(Request $request)
    {
        DB::beginTransaction();
        try {
            $merchant = Merchant::find($request->id);
            $merchant->status = $request->status;
            $merchant->describe_verification = $request->deskripsi != null ? $request->deskripsi : '';
            $merchant->save();
            DB::commit();

            return response()->json([
                'success' => 1,
                'message' => 'verifikasi telah diupdate.',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'success' => 0,
                'message' => 'verifikasi gagal diupdate.',
            ]);
        }
    }
}
