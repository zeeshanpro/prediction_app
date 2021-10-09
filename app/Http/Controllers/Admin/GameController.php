<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\Sport;
use App\Models\Championship;
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
        return view('admin.games.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$data['sports'] = Sport::all();
		$data['championships'] = Championship::all();
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
			'team1' => 'required',
			'startdatetime' => 'required',
			'enddatetime' => 'required',
		]);
		
        $data = $request->all();

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
		
		$data['start_time'] 	= Carbon::parse($data['startdatetime'])->format('Y-m-d H:i:s');
		$data['end_time'] 	= Carbon::parse($data['enddatetime'])->format('Y-m-d H:i:s');
		
		$data['created_by'] = Auth::user()->id;
		$data['updated_by'] = Auth::user()->id;
		
		$questions = $data['questions'];
		$answers = $data['answers'];
		
		unset($data['questions']);
		unset($data['answers']);
		
		$gameID = Game::create($data)->id;
		if(!empty($gameID) && !empty($questions) && !empty($answers))
		{
			for($i=0;$i<count($questions);$i++)
			{
				$questionData['game_id'] 	= $gameID;
				$questionData['question'] 	= $questions[$i];
				$questionData['created_by'] = Auth::user()->id;
				$questionData['updated_by'] = Auth::user()->id;
				//dd($questionData);
				$questionID = Question::create($questionData)->id;
				if(!empty($questionID) && isset($answers[$i]) && !empty($answers[$i]))
				{
					for($k=0;$k<count($answers[$i]);$k++)
					{
						$answerData['game_id'] 		= $gameID;
						$answerData['question_id'] 	= $questionID;
						$answerData['answer'] 		= $answers[$i][$k];
						$answerData['created_by'] 	= Auth::user()->id;
						$answerData['updated_by'] 	= Auth::user()->id;
						$answerID = Answer::create($answerData)->id;
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
