<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 6/20/16
 * Time: 1:41 AM
 */

namespace App\Http\Controllers;

use App\Commodity;
use App\Export;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AnalysisController extends Controller
{
    
    public function getClientAnalysis()
    {
        $package = Package::find();
        $commodityfirst = Commodity::find($package->commodityfirst);
        $commoditysecond = Commodity::find($package->commoditysecond);
        return view('JXC.manager.clientAnalysis',['package' => $package,'commodityfirst' => $commodityfirst,'commoditysecond' => $commoditysecond]);
    }

    public function getSaleAnalysis()
    {
        $commodities = DB::select('select * from commodities');
        $hotten = Commodity::soldMost()->take(10)->get();
        $coldten = Commodity::soldLeast()->take(10)->get();
        return view('JXC.manager.saleAnalysis',['name' => Auth::user()->username, 'commodities' => $commodities, 'hotten' => $hotten, 'coldten' => $coldten]);
    }

    public function getCommodityAnalysis()
    {
        return view('JXC.manager.Analysis',['package' => $package,'commodityfirst' => $commodityfirst,'commoditysecond' => $commoditysecond]);

    }

    public function getEmployeeAnalysis()
    {
        return view('JXC.manager.employeeAnalysis',['package' => $package,'commodityfirst' => $commodityfirst,'commoditysecond' => $commoditysecond]);
    }

    public function getInterestAnalysis()
    {
        return view('JXC.manager.interestAnalysis',['package' => $package,'commodityfirst' => $commodityfirst,'commoditysecond' => $commoditysecond]);
    }

    public function getMonthSaleDetail($id)
    {
        $commodity = Commodity::find($id);
        $time = [];
        $num = [];
        $avg = 0;
        for ($month = 0; $month < 12; $month++) {
            if($month < 9){
                $ym = date('Y')."-0".(string)($month+1);
            }else{
                $ym = date('Y')."-".(string)($month+1);
            }
            $condition = $ym."%";
            $num[$month] = (integer)Export::where('commodityid','=',$id)->where('created_at','LIKE',$condition)->sum('number');
            $time[$month] = $ym;
            $title = date('Y');
            $avg = $avg + $num[$month];
        }
        return view('JXC.manager.commoditySaleChart',['name' => Auth::user()->name, 'commodity' => $commodity, 'time' => $time, 'num' => $num, 'title' => $title]);
    }


    public function postMonthSaleDetail(Request $req)
    {
        $commodity = Commodity::find($req->get('commodityid'));
        $time = [];
        $num = [];
        $avg = 0;
        for ($month = 0; $month < 12; $month++) {
            if($month < 9){
                $ym = $req->get('year')."-0".(string)($month+1);
            }else{
                $ym = $req->get('year')."-".(string)($month+1);
            }
            $condition = $ym."%";
            $num[$month] = (integer)Export::where('commodityid','=',$req->get('commodityid'))->where('created_at','LIKE',$condition)->sum('number');
            $time[$month] = $ym;
            $title = $req->get('year');
            $avg = $avg + $num[$month];
        }
        return view('JXC.manager.commoditySaleChart',['name' => Auth::user()->name, 'commodity' => $commodity, 'time' => $time, 'num' => $num, 'title' => $title]);
    }

    public function getYearSaleDetail($id)
    {
        $commodity = Commodity::find($id);
        $time = ['2011','2012','2013','2014','2015','2016'];
        $num = [];
        $avg = 0;
        for ($i = 0; $i < 6; $i++) {
            $condition = $time[$i]."%";
            $num[$i] = (integer)Export::where('commodityid','=',$id)->where('created_at','LIKE',$condition)->sum('number');
        }
        return view('JXC.manager.commodityYearSaleChart',['name' => Auth::user()->name, 'commodity' => $commodity,'num' => $num]);

    }
}