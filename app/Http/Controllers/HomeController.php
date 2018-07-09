<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Problems;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Serveurs;
use App\Platformes;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->has('Platformes_id')) {
            $Problems = Problems::where('Platformes_id', request('Platformes_id'))->paginate(10)->appends('Platformes_id',request('Platformes_id'));
        }
        else if (request()->has('MessagePrb')) {
            $Problems = Problems::Where('MessagePrb', 'LIKE', '%' . request('MessagePrb') . '%')->paginate(10)->appends('MessagePrb', request('MessagePrb'));
        }
        else if (request()->has('Code_prb')) {
            $Problems = Problems::Where('Code_prb', 'LIKE', '%' . request('Code_prb') . '%')->paginate(10)->appends('Code_prb', request('Code_prb'));
        }
        else $Problems=Problems::paginate(10);

        $Serveurs= Serveurs::All();
$Platformes=Platformes::all();
        return view('home',compact('Problems','Serveurs'));



    }}
