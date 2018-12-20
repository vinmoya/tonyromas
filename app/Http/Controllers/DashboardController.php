<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Code;
use App\Restaurant;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activatedCodes = Code::where('state', 'ACTIVO');
        $canceledCodes = Code::where('state', 'ANULADO');
        $codesNotActivated = Code::where('state', NULL)->get();
        $redeemedCodes = Code::where('state', 'CANJEADO')->get();

        $data1 = Code::JOIN('activate_code', 'codes.id', 'activate_code.code_id')->get();
        $data2 = Code::JOIN('activate_code', 'codes.id', 'activate_code.code_id')
                     ->JOIN('users', 'activate_code.user_id', 'users.id')->get();
        $data3 = Code::JOIN('redeem_code', 'codes.id', 'redeem_code.code_id')
                     ->JOIN('users', 'redeem_code.user_id', 'users.id')->get();

        return view('modules.dashboard.index')
                    ->with('countAC', $activatedCodes->count())
                    ->with('countCC', $canceledCodes->count())
                    ->with('countNA', $codesNotActivated->count())
                    ->with('countRC', $redeemedCodes->count())
                    ->with('countCR', $data1->count())
                    ->with('countAR', $data2->count())
                    ->with('countCCR', $data3->count());
    }
}
