<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Client;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{
    public function index($id)
    {
        $c = Client::find($id);
        return view('JXC.sale.editclient',['client' => $c]);
    }

    public function destroy($id)
    {
        $c = Client::find($id);
        $c->delete();
        session()->flash('message', $c."已经被移除");
        return Redirect::back();
    }

    public function modifyClient(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'tel' => 'required|max:15',
            'address' => 'required|max:50',
        ]);
        $id = $request->input('id');
        $client = Client::find($id);
        $client->name=$request->input('name');
        $client->tel=$request->input('tel');
        $client->address=$request->input('address');
        $client->save();
        return redirect('sale');
    }
}
