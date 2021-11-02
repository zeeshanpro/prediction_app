<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\v1\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Prediction;
use App\Models\Game;
use Throwable;

class PredictionController extends BaseController
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
	
	public function savePrediction(Request $request)
    {
        try{
			Request()->validate([
				'userid' => 'required|integer|exists:users,id',
				'game_id' => 'required|integer|exists:games,id',
				'answerids' => 'required',
				'credits' => 'required',
			]);
			
			$data = $request->all();
			if(!empty($data) && isset($data['userid']))
			{
				$answerids 	= $data['answerids'];
				$userid 	= $data['userid'];
				$game_id 	= $data['game_id'];
				$credits 	= $data['credits'];
				if(!empty($game_id))
				{
					$checkGame = Game::where(array( "id" => $game_id))->where('end_time','>=',date("Y-m-d H:i:s"))->first();
					if(!empty($checkGame))
					{
						$checkPrediction = Prediction::where(array( "game_id" => $game_id , "userid" => $userid ))->first();
						if(empty($checkPrediction))
						{
							for($i=0; $i<count($answerids);$i++)
							{
								$data['userid'] 		= $userid;
								$data['game_id'] 		= $game_id;
								$data['answerid'] 		= $answerids[$i];
								$data['credit'] 		= $credits;
								$data['is_true'] 		= 0;
								$data['gain_credit'] 	= 0;
								Prediction::create($data);
							}
							
							return response()->json(['success' => true, 'message' => 'Prediction successfully saved.']);
						}
						else
						{
							return response()->json(['success' => false, 'message' => 'This user has already made a prediction against this game.']);
						}
					}
					else
					{
						return response()->json(['success' => false, 'message' => 'Prediction Duration has been expired.']);
					}
				}
				else
				{
					return response()->json(['success' => false, 'message' => 'Game ID is missing.']);
				}
			}
			else
			{
				return response()->json(['success' => false, 'message' => 'Required parameter missing.']);
			}
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'something went wrong.', 'errors' => $th->getMessage()],401);
        }
    }
	
}

