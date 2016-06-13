<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Client;
use Illuminate\Support\Facades\Redirect;

class SaleController extends Controller
{
    public function getClient()
    {
        $result = DB::select('select * from clients');
        return view('JXC.sale.index', ['name' => Auth::user()->username, 'clients' => $result]);
    }

    public function getAddclient()
    {
        return view('JXC.sale.addclient', ['name' => Auth::user()->username]);
    }

    public function addClient(Request $req)
    {
        $this->validate($req,[
            'name' => 'required|max:50',
            'type' => 'required',
            'level' => 'required',
            'tel' => 'required',
            'address' => 'required',
            'limit' => 'required|numeric'
        ]);

        $c = new Client();
        $c->name = $req->get('name');
        $c->type = $req->get('type');
        $c->level = $req->get('level');
        $c->limit = $req->get('limit');
        $c->tel = $req->get('tel');
        $c->address = $req->get('address');
        $c->in = 0;
        $c->out = 0;
        $c->save();
        return Redirect::route('sale');

    }

    public function findClient(Request $req)
    {
        $this->validate($req,[
            'name' => 'required|max:50',
            'type' => 'required',
        ]);

        $result = DB::select('select * from clients where type = ? and name = ?', [$req->get('type'), $req->get('name')]);
        return view('JXC.sale.findresult', ['name' => Auth::user()->username, 'clients' => $result]);

    }

    public function getfindClient(Request $req)
    {
        return view('JXC.sale.findclient', ['name' => Auth::user()->username]);
    }
}
