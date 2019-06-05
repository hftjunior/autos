<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $title;

    public function __construct()
    {
        $this->middleware('auth');
        $this->title = 'Dashboard';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = $this->title;
        $list = json_encode([
            ['page'=>'Home', 'url'=>route('home')]            
        ]);

        $numClients = DB::table('clients')->count();
        $numVehicles = DB::table('vehicles')->count();
        $numAits = DB::table('aits')->count();
        $numResources = DB::table('ait_resources')->count();

        $clients = DB::table('clients')
                    ->leftJoin('aits','clients.id','=','aits.client_id')
                    ->leftJoin('ait_resources','aits.id','=','ait_resources.ait_id')
                    ->select ('clients.id as id','clients.name as name', 
                      DB::raw('count(aits.id) as numaits'),
                      DB::raw('count(ait_resources.id) as numresources'))
                    ->groupBy('clients.id','clients.name')
                    ->orderBy('clients.name')
                    ->get();
       
        return view('home', compact('title','list','numClients','numVehicles','numAits','numResources','clients')); 
    }
}
