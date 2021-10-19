<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
                'link'=> '/daftarcar'
            )
        );

        return view('user.mitradriver.mitradriver', compact('list_item'));
    }

    public function registerBike(){
        $form = array(
            'link' => '/storeDrive',
            'type_mitra' => 'drive',
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

        return view('user.mitradriver.formupbike', compact('form'));
    }

}

