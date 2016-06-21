<?php
/**
 * Created by PhpStorm.
 * User: mac
 * Date: 6/20/16
 * Time: 1:41 AM
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class AnalysisController extends Controller
{
    
    public function getClientAnalysis()
    {
        $package = Package::find($id);
        $commodityfirst = Commodity::find($package->commodityfirst);
        $commoditysecond = Commodity::find($package->commoditysecond);
        return view('JXC.manager.packageDetail',['package' => $package,'commodityfirst' => $commodityfirst,'commoditysecond' => $commoditysecond]);
    }

    public function getSaleAnalysis()
    {
        return view('JXC.manager.packageDetail',['package' => $package,'commodityfirst' => $commodityfirst,'commoditysecond' => $commoditysecond]);
    }

    public function getCommodityAnalysis()
    {

    }

    public function getEmployeeAnalysis()
    {

    }

    public function getInterestAnalysis()
    {

    }
}