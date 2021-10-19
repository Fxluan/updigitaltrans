<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Merchant;

class MitraMerchantController extends Controller
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
                'title' => 'UP FOOD',
                'img' => 'img/no_img.jpeg',
                'desc' => "The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.",
                'link' => '/daftarfood'
            ),
            array(
                'id' => 1,
                'title' => 'UP MART',
                'img' => 'img/no_img.jpeg',
                'desc' => "The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.",
                'link' => '/daftarmart'
            )
        );

        return view('user.mitramerchant.index', compact('list_item'));
    }

    public function registerFood()
    {
        $form = array(
            'link' => '/storemerchant',
            'type_mitra' => 'food',
            'form' => array(
                array(
                    'type' => 'input',
                    'value_type' => 'text',
                    'id' => 'merchant_name',
                    'name' => 'merchant_name',
                    'label' => 'nama gerai',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'textarea',
                    'value_type' => 'text',
                    'id' => 'description',
                    'name' => 'description',
                    'label' => 'deskripsi singkat',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'time',
                    'id' => 'open_time',
                    'name' => 'open_time',
                    'label' => 'jam buka',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'time',
                    'id' => 'close_time',
                    'name' => 'close_time',
                    'label' => 'jam tutup',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'file',
                    'id' => 'galery_merchant',
                    'name' => 'galery_merchant',
                    'label' => 'foto gerai',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'textarea',
                    'value_type' => 'text',
                    'id' => 'address_menchant',
                    'name' => 'address_menchant',
                    'label' => 'alamat gerai',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
            )
        );

        return view('user.mitramerchant.form', compact('form'));
    }

    public function registerMart()
    {
        $form = array(
            'link' => '/storemerchant',
            'type_mitra' => 'mart',
            'form' => array(
                array(
                    'type' => 'input',
                    'value_type' => 'text',
                    'id' => 'merchant_name',
                    'name' => 'merchant_name',
                    'label' => 'nama toko',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'textarea',
                    'value_type' => 'text',
                    'id' => 'description',
                    'name' => 'description',
                    'label' => 'deskripsi singkat',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'time',
                    'id' => 'open_time',
                    'name' => 'open_time',
                    'label' => 'jam buka',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'time',
                    'id' => 'close_time',
                    'name' => 'close_time',
                    'label' => 'jam tutup',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'input',
                    'value_type' => 'file',
                    'id' => 'galery_merchant',
                    'name' => 'galery_merchant',
                    'label' => 'foto toko',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
                array(
                    'type' => 'textarea',
                    'value_type' => 'text',
                    'id' => 'address_menchant',
                    'name' => 'address_menchant',
                    'label' => 'alamat toko',
                    'desc' => '',
                    'mandatory' => 'required',
                ),
            )
        );

        return view('user.mitramerchant.form', compact('form'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merchant_name'     => 'required',
            'description'       => 'required',
            'open_time'         => 'required',
            'close_time'        => 'required',
            'galery_merchant'   => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'address_menchant'  => 'required',

        ]);

        $id_user            = Auth::id();
        $galery_merchant    = $id_user . "_" . time() . '.' . $request->galery_merchant->extension();
        $path_galery_merchant   = Storage::putFileAs('public/img/merchant', $request->file('galery_merchant'), $galery_merchant);

        DB::beginTransaction();
        try {
            $merchant                    = new Merchant;

            $merchant->user_id           = Auth::id();;
            $merchant->merchant_name     = $request->merchant_name;
            $merchant->description       = $request->description;
            $merchant->open_time         = $request->open_time;
            $merchant->close_time        = $request->close_time;
            $merchant->galery_merchant   = $path_galery_merchant;
            $merchant->address_menchant  = $request->address_menchant;
            $merchant->role              = $request->type_mitra;
            $merchant->status            = 0;

            $merchant->save();
            DB::commit();

            return redirect()->back()->with('success', 'Pengajuan anda Terkirim.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors('error', 'Pengajuan anda Ditolak.');
        }
    }
}
