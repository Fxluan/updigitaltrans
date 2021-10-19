<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
                'link'=> '/daftarmart'
            )
        );

        return view('user.mitramerchant', compact('list_item'));
    }
}
