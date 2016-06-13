<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    public function destroy($id)
    {
        $c = Client::find($id);
        $name = $c->name;
        $c->delete();
        session()->flash('message', $name."已经被移除");
        return Redirect::back();
    }

    public function show($id)
    {
        $c = Client::find($id);
        return view('JXC.sale.editclient',['client' => $c]);
    }

    public function edit($id)
    {
        //
    }
}
