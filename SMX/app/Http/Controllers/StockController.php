<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        $result = DB::select('select * from categories');
        return view('JXC.stock.index', ['name' => Auth::user()->username, 'categories' => $result]);
    }

    public function check()
    {
        $result = DB::select('select * from commodities');
        return view('JXC.stock.check', ['name' => Auth::user()->username, 'commodities' => $result]);
    }

    public function getCorrect()
    {
        return view('JXC.stock.correct', ['name' => Auth::user()->username]);
    }

    public function getLess()
    {
        $result = DB::select('select * from commodities where lesswarn >= number');
        return view('JXC.stock.less', ['name' => Auth::user()->username, 'warns' => $result]);
    }

    public function getMore()
    {
        $result = DB::select('select * from commodities where lesswarn >= number');
        return view('JXC.stock.more', ['name' => Auth::user()->username, 'warns' => $result]);
    }

    public function postCorrect()
    {

    }
}
