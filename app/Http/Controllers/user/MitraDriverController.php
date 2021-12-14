<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\Driver;
use App\Models\JawabanVerifikasiUser;
use App\Models\PertanyaanVerifikasi;

class MitraDriverController extends Controller
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
        $list_item = array(
            array(
                'id' => '0',
                'title' => 'UP BIKE',
                'img' => 'img/no_img.jpeg',
                'desc' => "The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.",
                'link' => '/daftarbike'
            ),
            array(
                'id' => 1,
                'title' => 'UP CAR',
                'img' => 'img/no_img.jpeg',
                'desc' => "The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.",
                'link' => '/daftarcar'
            )
        );


        return view('user.mitradriver.index', compact('list_item'));
    }

    public function registerMotocycle()
    {
        $user_id = Auth::user()->id;

        $form_regist = array(
            'link' => '/storedrive',
            'type_mitra' => 'motorcycle',
            'form' => array(
                array(
                    'type' => 'input',
                    'value_type' => 'text',
                    'id' => 'no_kendaraan',
                    'name' => 'no_kendaraan',
                    'label' => 'NOPOL Kendaraan',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'number',
                    'id' => 'no_sim',
                    'name' => 'no_sim',
                    'label' => 'No SIM',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'number',
                    'id' => 'no_ktp',
                    'name' => 'no_ktp',
                    'label' => 'No KTP',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'file',
                    'id' => 'photo_user',
                    'name' => 'photo_user',
                    'label' => 'Foto Pengguna',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'file',
                    'id' => 'photo_ktp',
                    'name' => 'photo_ktp',
                    'label' => 'Foto KTP',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'file',
                    'id' => 'photo_sim',
                    'name' => 'photo_sim',
                    'label' => 'Foto SIM',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'file',
                    'id' => 'photo_stnk',
                    'name' => 'photo_stnk',
                    'label' => 'Foto STNK',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
            )
        );

        $pertanyaan_verifikasi = PertanyaanVerifikasi::get();

        $form_verifikasi = [];
        foreach ($pertanyaan_verifikasi as $key => $value) {
            $form_verifikasi[] = array(
                'id'            => $value->id,
                'pertanyaan'    => $value->pertanyaan,
                'pilihan_ganda' => json_decode($value->pilihan_ganda),
                'type'          => 'radio',
                'mandatory'     => 'required',
            );
        }
        $form_validasi = array(
            'link' => '/verifikasimitradriver',
            'type_mitra' => 'motorcycle',
            'form' => $form_verifikasi
        );

        $status_user = $this->checkstatus($user_id);

        $data = array(
            "form_regist"   => $form_regist,
            "form_validasi" => $form_validasi,
            "status_user"   => $status_user
        );

        return view('user.mitradriver.form', compact('data'));
    }

    public function registerCar()
    {
        $user_id = Auth::user()->id;
        $form = array(
            'link' => '/storedrive',
            'type_mitra' => 'car',
            'form' => array(
                array(
                    'type' => 'input',
                    'value_type' => 'text',
                    'id' => 'no_kendaraan',
                    'name' => 'no_kendaraan',
                    'label' => 'NOPOL Kendaraan',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'number',
                    'id' => 'no_sim',
                    'name' => 'no_sim',
                    'label' => 'No SIM',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'number',
                    'id' => 'no_ktp',
                    'name' => 'no_ktp',
                    'label' => 'No KTP',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'file',
                    'id' => 'photo_user',
                    'name' => 'photo_user',
                    'label' => 'Foto Pengguna',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'file',
                    'id' => 'photo_ktp',
                    'name' => 'photo_ktp',
                    'label' => 'Foto KTP',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'file',
                    'id' => 'photo_sim',
                    'name' => 'photo_sim',
                    'label' => 'Foto SIM',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'file',
                    'id' => 'photo_stnk',
                    'name' => 'photo_stnk',
                    'label' => 'Foto STNK',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
            )
        );

        $status_user = $this->checkstatus($user_id);
        $data = array(
            "form"        => $form,
            "status_user" => $status_user
        );

        return view('user.mitradriver.form', compact('data'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type_mitra'    => 'required',
            'no_kendaraan'  => 'required',
            'no_sim'        => 'required',
            'no_ktp'        => 'required',
            'photo_user'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_ktp'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_sim'     => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'photo_stnk'    => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $id_user            = Auth::id();
        $photo_user         = $id_user . "_" . time() . 'user.' . $request->photo_user->extension();
        $path_photo_user    = Storage::putFileAs('public/storage/img/user', $request->file('photo_user'), $photo_user);
        $photo_ktp          = $id_user . "_" . time() . 'ktp.' . $request->photo_ktp->extension();
        $path_photo_ktp     = Storage::putFileAs('public/storage/img/driver', $request->file('photo_ktp'), $photo_ktp);
        $photo_sim          = $id_user . "_" . time() . 'sim.' . $request->photo_sim->extension();
        $path_photo_sim     = Storage::putFileAs('public/storage/img/driver', $request->file('photo_sim'), $photo_sim);
        $photo_stnk         = $id_user . "_" . time() . 'stnk.' . $request->photo_stnk->extension();
        $path_photo_stnk    = Storage::putFileAs('public/storage/img/driver', $request->file('photo_stnk'), $photo_stnk);

        DB::beginTransaction();
        try {
            $driver                 = new Driver;
            $driver->user_id        = Auth::id();
            $driver->vehicle_type   = $request->type_mitra;
            $driver->vehicle_number = $request->no_kendaraan;
            $driver->sim_number     = $request->no_sim;
            $driver->ktp_number     = $request->no_ktp;
            $driver->photo_user     = $path_photo_user;
            $driver->photo_ktp      = $path_photo_ktp;
            $driver->photo_sim      = $path_photo_sim;
            $driver->photo_stnk     = $path_photo_stnk;
            $driver->status         = 0;

            $driver->save();
            DB::commit();

            return redirect()->back()->with('success', 'Pengajuan anda Terkirim.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Pengajuan anda Ditolak.');
        }
    }

    private function checkstatus($id)
    {
        $is_exist = Driver::select('status')->where('user_id', $id)->exists();

        if ($is_exist == true) {
            $get_status = Driver::select('status')->where('user_id', $id)->limit(1)->orderBy('id', 'DESC')->value('status');
        }

        if ($is_exist == false) {
            $get_status = 'not_exist';
        }

        return $get_status;
    }

    public function verificationmitra(Request $request)
    {
        $data = $request->all();

        unset($data['_token']);
        unset($data['type_mitra']);
        unset($data['pertanyaan_id']);
        $data = json_encode($data);
        $user_id = Auth::id();

        DB::beginTransaction();
        try {
            $JawabanVerifikasiUser = new JawabanVerifikasiUser;
            $JawabanVerifikasiUser->user_id = $user_id;
            $JawabanVerifikasiUser->pilihan_ganda = $data;
            $JawabanVerifikasiUser->save();

            $Driver = Driver::find($user_id);
            $Driver->status = 5;
            $Driver->save();

            DB::commit();
            return redirect()->back()->with('success', 'Pengajuan anda Terkirim.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Pengajuan anda Ditolak.');
        }
    }
}
