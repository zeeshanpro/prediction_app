<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\v1\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Sport;
use App\Models\Championship;
use App\Models\Team;
use App\Models\Game;
use App\Models\Question;
use App\Models\Answer;
use Throwable;

class GameController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		try{
			$games = Game::all();
			if($games->isEmpty()){
				return $this->sendError('No games found');
			}
			$data['games'] 		= $games;
			$data['logopath'] 	= asset('/uploads/');
			return $this->sendResponse($data, 'All games.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Games Not found', 'errors' => $th->getMessage()],401);
        }
		
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		try{
			$games 				= Game::where('id',$id)->first();
			
			$teams = [];
			
			if(!empty($games->team1id))
				$teams['team1'] = Team::where([ "id" => $games->team1id ,"is_status" => 1 ])->get();
			if(!empty($games->team2id))
				$teams['team2'] = Team::where([ "id" => $games->team2id ,"is_status" => 1 ])->get();
			
			$questions 			= $games->questions;
			$answers 			= $games->answers;
			$data['games'] 		= $games; 
			$data['teams'] 		= $teams; 
			$data['logopath'] 	= asset('/uploads/');
			return $this->sendResponse($data, 'Games found successfully.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Game Not found', 'errors' => $th->getMessage()],401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
	
	public function getGamesByChampionshipID($id){
		
		try{
			$today 				= date("Y-m-d H:i:s");
			$games 				= Game::where([ 'championship_id' => $id , 'games.is_status' => 1 ])
                                    ->join('championships','championships.id','=','games.championship_id')
                                    ->join('teams as t1','t1.id','=','games.team1id')
                                    ->join('teams as t2','t2.id','=','games.team2id')
                                    ->select('games.id','sport_id','championship_id','team1id','team2id','championships.name as championship','t1.name as team1_name','t2.name as team2_name','t1.logo as team1_logo','t2.logo as team2_logo','start_time','end_time')
                                    ->where("end_time" ,">=" ,$today)->latest('games.created_at')->get();
			$data['games'] 		= $games;
			$data['logopath'] 	= asset('/uploads/');
			return $this->sendResponse($data, 'Games found successfully.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Game Not found.', 'errors' => $th->getMessage()],401);
        }
		
    }

}

