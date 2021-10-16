<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Sport;
use App\Models\Championship;
use App\Models\Team;
use App\Models\Question;
use App\Models\Answer;
use Carbon\Carbon;
use Auth;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$games = Game::all();
        return view('admin.games.index',[ 'games' => $games ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['sports'] = Sport::where("is_status",1)->get();
		$data['championships'] = Championship::where("is_status",1)->get();
		$data['teams'] = Team::where("is_status",1)->get();
        return view('admin.games.create',[ 'data' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		Request()->validate([
			'sport_id' => 'required|integer|exists:sports,id',
			'championship_id' => 'required|integer|exists:championships,id',
			'type' => 'required|integer',
			'team1id' => 'required|integer|exists:teams,id',
			'startdatetime' => 'required',
			'enddatetime' => 'required',
		]);
		
        $data = $request->all();
		//dd($data);
		/*
		$team1Logo_name  = '';
		$team1Logo_unique_name = '';
		if($request->hasFile('team1Logo'))
		{
			$team1fileobj				= $request->file('team1Logo');
			$team1Logo_name 			= $team1fileobj->getClientOriginalName('team1Logo');
			$team1Logo_extension_name 	= $team1fileobj->getClientOriginalExtension('team1Logo');
			$team1Logo_unique_name 		= time().rand(1000,9999).'.'.$team1Logo_extension_name;
			$destinationPath			= public_path('/uploads/');
			$team1fileobj->move($destinationPath,$team1Logo_unique_name);
		}

		$data['team1Logo'] 	= $team1Logo_unique_name;

		$team2Logo_name  = '';
		$team2Logo_unique_name = '';
		if($request->hasFile('team2Logo'))
		{
			$team2fileobj				= $request->file('team2Logo');
			$team2Logo_name 			= $team2fileobj->getClientOriginalName('team2Logo');
			$team2Logo_extension_name 	= $team2fileobj->getClientOriginalExtension('team2Logo');
			$team2Logo_unique_name 		= time().rand(1000,9999).'.'.$team2Logo_extension_name;
			$destinationPath			= public_path('/uploads/');
			$team2fileobj->move($destinationPath,$team2Logo_unique_name);
		}

		$data['team2Logo'] 	= $team2Logo_unique_name;
		*/
		$data['start_time'] 	= Carbon::parse($data['startdatetime'])->format('Y-m-d H:i:s');
		$data['end_time'] 	= Carbon::parse($data['enddatetime'])->format('Y-m-d H:i:s');
		
		$data['created_by'] = Auth::user()->id;
		$data['updated_by'] = Auth::user()->id;
		
		$questions 	= (isset($data['questions'])) ? $data['questions'] : false;
		$points 	= (isset($data['points'])) ? $data['points'] : false;
		$answers 	= (isset($data['answers'])) ? $data['answers'] : false;
		$teams 		= (isset($data['teams'])) ? $data['teams'] : false;
		$trueAns 	= (isset($data['trueAns'])) ? $data['trueAns'] : false;
		
		unset($data['questions']);
		unset($data['points']);
		unset($data['answers']);
		unset($data['teams']);
		unset($data['trueAns']);
		
		//$data['is_status'] = 1;
		
		$gameID = Game::create($data)->id;
		if(!empty($gameID) && !empty($questions) && !empty($points) && !empty($answers))
		{
			foreach($questions as $i => $question)
			{
				if(isset($questions[$i]) && !empty($questions[$i]))
				{
					$questionData['game_id'] 	= $gameID;
					$questionData['question'] 	= trim($question);
					$questionData['created_by'] = Auth::user()->id;
					$questionData['updated_by'] = Auth::user()->id;
					$questionID = Question::create($questionData)->id;
					if(!empty($questionID) && isset($answers[$i]) && !empty($answers[$i]))
					{
						for($k=0;$k<count($answers[$i]);$k++)
						{
							if(isset($answers[$i][$k]) && !empty($answers[$i][$k]))
							{
								$answerData['game_id'] 		= $gameID;
								$answerData['question_id'] 	= $questionID;
								$answerData['points'] 		= trim($points[$i][$k]);
								$answerData['answer'] 		= trim($answers[$i][$k]);
								$answerData['team_id'] 		= trim($teams[$i][$k]);
								$answerData['is_true'] 		= (isset($trueAns[$i][$k+1])) ? 1 : 0;
								$answerData['created_by'] 	= Auth::user()->id;
								$answerData['updated_by'] 	= Auth::user()->id;
								$answerID = Answer::create($answerData)->id;
							}
						}
					}
				}
			}
		}
		
		return redirect()->route('games.index')->with("success","Game Successfully Created.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
