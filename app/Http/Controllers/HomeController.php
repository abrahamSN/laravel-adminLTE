<?php

namespace App\Http\Controllers;

use App\Keluhan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuser = User::all();

        if (Auth::user()->hasRole('admin')) {
            $cks = Keluhan::where('status', 3)->get();
            $ckp = Keluhan::where('status', 2)->get();
            $ckb = Keluhan::where('status', 1)->get();

            for ($i = 1; $i <= 12; $i++) {
                $chks[$i] = Keluhan::where('status', 3)
                    ->whereMonth('created_at', '=', $i)
                    ->whereYear('created_at', '=', date('Y'))->count();
                $chkp[$i] = Keluhan::where('status', 2)
                    ->whereMonth('created_at', '=', $i)
                    ->whereYear('created_at', '=', date('Y'))->count();
                $chkb[$i] = Keluhan::where('status', 1)
                    ->whereMonth('created_at', '=', $i)
                    ->whereYear('created_at', '=', date('Y'))->count();
            }
        } else {
            if (Auth::user()->hasRole('pelanggan')) {
                $cks = Keluhan::where('status', 3)->where('user_id', Auth::user()->id)->get();
                $ckp = Keluhan::where('status', 2)->where('user_id', Auth::user()->id)->get();
                $ckb = Keluhan::where('status', 1)->where('user_id', Auth::user()->id)->get();

                for ($i = 1; $i <= 12; $i++) {
                    $chks[$i] = Keluhan::where('status', 3)
                        ->where('user_id', Auth::user()->id)
                        ->whereMonth('created_at', '=', $i)
                        ->whereYear('created_at', '=', date('Y'))->count();
                    $chkp[$i] = Keluhan::where('user_id', Auth::user()->id)
                        ->where('status', 2)
                        ->whereMonth('created_at', '=', $i)
                        ->whereYear('created_at', '=', date('Y'))->count();
                    $chkb[$i] = Keluhan::where('user_id', Auth::user()->id)
                        ->where('status', 1)
                        ->whereMonth('created_at', '=', $i)
                        ->whereYear('created_at', '=', date('Y'))->count();
                }
            } else {
                $cks = Keluhan::where('status', 3)->get();
                $ckp = Keluhan::where('status', 2)->get();
                $ckb = Keluhan::where('status', 1)->get();

                for ($i = 1; $i <= 12; $i++) {
                    $chks[$i] = Keluhan::where('status', 3)
                        ->whereMonth('created_at', '=', $i)
                        ->whereYear('created_at', '=', date('Y'))->count();
                    $chkp[$i] = Keluhan::where('status', 2)
                        ->whereMonth('created_at', '=', $i)
                        ->whereYear('created_at', '=', date('Y'))->count();
                    $chkb[$i] = Keluhan::where('status', 1)
                        ->whereMonth('created_at', '=', $i)
                        ->whereYear('created_at', '=', date('Y'))->count();
                }
            }
        }
        return view('home', compact('cuser', 'cks', 'ckp', 'ckb', 'chks', 'chkp', 'chkb'));
    }
}
