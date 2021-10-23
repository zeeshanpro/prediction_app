<?php

namespace App\Http\Controllers;

use App\Models\Prediction;
use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $openGames		    = count(Game::where(['is_status' => 1])->get());
        $completedGames		= count(Game::where(['is_status' => 2])->get());
        $users		        = count(User::where(['user_type' => 2])->get());
        $data['openGames']  = $openGames;    
        $data['completedGames']   = $completedGames;    
        $data['users']   = $users;  

        return view('home_v2',$data);
    }
}
