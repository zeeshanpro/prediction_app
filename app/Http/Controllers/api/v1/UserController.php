<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\v1\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prediction;
use Throwable;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
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
	
	public function getUsersDetails($id){
		
		try{
			$user = User::where(['id' => $id])->first();
			if(!empty($user) && isset($user->id))
			{
				$playedGames	 	= count(Prediction::where(['userid' => $user->id])->groupBy('game_id')->get(['game_id']));
				$completeGames		= count(Prediction::where(['predictions.userid' => $user->id,'games.is_status' => 2])
										->join('games','games.id','=','predictions.game_id')
										->groupBy('game_id')
										->get(['game_id']));
				$pendingGames 		= $playedGames - $completeGames ;
				
				$totalPrediction 	= Prediction::where(['userid' => $user->id])->count();					
				$winPrediction 		= Prediction::where(['userid' => $user->id,'is_true' => 1])->count();
				
				$completePrediction = Prediction::where(['predictions.userid' => $user->id,'games.is_status' => 2])
									->join('games','games.id','=','predictions.game_id')
									->count();
									
				$losePrediction 	= $completePrediction - $winPrediction;
				$pendingPrediction 	= $totalPrediction - $completePrediction;
				
				$winRate = 0;
				if(!empty($completePrediction))
					$winRate = round(( $winPrediction / $completePrediction) * 100,2)."%";
				
				
				$userArray['id'] 			= $user->id;
				$userArray['name'] 			= $user->name;
				$userArray['email'] 		= $user->email;
				
				$data['user'] 				= $userArray;
				$data['totalPrediction'] 	= $totalPrediction;
				$data['completePrediction'] = $completePrediction;
				$data['winPrediction'] 		= $winPrediction;
				$data['losePrediction'] 	= $losePrediction;
				$data['pendingPrediction'] 	= $pendingPrediction;
				$data['winRate'] 			= $winRate;
				$data['playedGames'] 		= $playedGames;
				$data['completeGames'] 		= $completeGames;
				$data['pendingGames'] 		= $pendingGames;
				
			}
			return $this->sendResponse($data, 'User found successfully.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'User Not found.', 'errors' => $th->getMessage()],401);
        }
		
    }
}

