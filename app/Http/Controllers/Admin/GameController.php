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
use Throwable;

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
		
		$data['start_time'] = Carbon::parse($data['startdatetime'])->format('Y-m-d H:i:s');
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
		unset($data['startdatetime']);
		unset($data['enddatetime']);
				
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
								//$answerData['is_true'] 		= (isset($trueAns[$i][$k+1])) ? 1 : 0;
								$answerData['is_true'] 		= 0;
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
		$games 	= Game::where('id',$id)->first();
		$data 	= array();
		if(!empty($games) && !empty($games->id))
		{
			$data['sports'] 		= Sport::where("is_status",1)->get();
			$data['championships'] 	= Championship::where(["sports_id" => $games->sport_id , "is_status" => 1])->get();
			$data['teams'] 			= Team::where("is_status",1)->get();
						
			$questions 				= $games->questions;
			$answers 				= $games->answers;
			$data['games'] 			= $games; 
			
			$selectteams = [];
			
			if(!empty($games->team1id))
				$selectteams[] = Team::where([ "id" => $games->team1id ,"is_status" => 1 ])->first();
			if(!empty($games->team2id))
				$selectteams[] = Team::where([ "id" => $games->team2id ,"is_status" => 1 ])->first();
			
			$data['selectteams'] = $selectteams;
			
		}
		
		return view('admin.games.edit',$data);
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
		if(empty($id))
			return redirect()->route('games.index')->with("error","something went wrong");
		
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

		$data['start_time'] = Carbon::parse($data['startdatetime'])->format('Y-m-d H:i:s');
		$data['end_time'] 	= Carbon::parse($data['enddatetime'])->format('Y-m-d H:i:s');
		
		$data['updated_by'] = Auth::user()->id;
		
		$questionids 	= (isset($data['questionids'])) ? $data['questionids'] : false;
		$questions 		= (isset($data['questions'])) ? $data['questions'] : false;
		$answers 		= (isset($data['answers'])) ? $data['answers'] : false;
		$answerids 		= (isset($data['answerids'])) ? $data['answerids'] : false;
		$points 		= (isset($data['points'])) ? $data['points'] : false;
		$teams 			= (isset($data['teams'])) ? $data['teams'] : false;
		$trueAns 		= (isset($data['trueAns'])) ? $data['trueAns'] : false;
		
		unset($data['questions']);
		unset($data['questionids']);
		unset($data['answers']);
		unset($data['answerids']);
		unset($data['points']);
		unset($data['teams']);
		unset($data['trueAns']);
		unset($data['_token']);
		unset($data['_method']);
		unset($data['startdatetime']);
		unset($data['enddatetime']);
		
		$gameID = $id;
		Game::where([ 'id' => $gameID ])->update($data);
		
		if(!empty($gameID) && !empty($questions) && !empty($points) && !empty($answers))
		{
			foreach($questions as $i => $question)
			{
				$questionData = [];
				if(isset($questions[$i]) && !empty($questions[$i]))
				{
					$questionData['question'] 	= trim($question);
					$questionData['updated_by'] = Auth::user()->id;
					if(!empty($questionids) && isset($questionids[$i]) && !empty($questionids[$i]))
					{
						$questionID = $questionids[$i];
						Question::where( [ "id" => $questionID ] )->update($questionData);
					}
					else
					{
						$questionData['game_id'] 	= $gameID;
						$questionData['created_by'] = Auth::user()->id;
						$questionID = Question::create($questionData)->id;
					}
						
					if(!empty($questionID) && isset($answers[$i]) && !empty($answers[$i]))
					{
						for($k=0;$k<count($answers[$i]);$k++)
						{
							$answerData = [];
							if(isset($answers[$i][$k]) && !empty($answers[$i][$k]))
							{
								$answerData['points'] 		= trim($points[$i][$k]);
								$answerData['answer'] 		= trim($answers[$i][$k]);
								$answerData['team_id'] 		= trim($teams[$i][$k]);
								$answerData['is_true'] 		= (isset($trueAns[$i][$k+1])) ? 1 : 0;
								$answerData['updated_by'] 	= Auth::user()->id;
								
								if(!empty($answerids) && isset($answerids[$i][$k]) && !empty($answerids[$i][$k]))
								{
									$answerID = $answerids[$i][$k];
									Answer::where( [ "id" => $answerID ] )->update($answerData);
								}
								else
								{
									$answerData['game_id'] 		= $gameID;
									$answerData['question_id'] 	= $questionID;
									$answerData['created_by'] = Auth::user()->id;
									$answerID = Answer::create($answerData)->id;
								}
							}
						}
					}
				}
			}
		}
		
		return redirect()->route('games.index')->with("success","Game Successfully Updated.");
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
	
	public function removeQuestionById()
    {
        $Qid 	= (isset($_POST['Qid']) && !empty($_POST['Qid'])) ? $_POST['Qid'] : false;
		if(!empty($Qid))
		{
			try{
				Answer::where("question_id",$Qid)->delete();
				Question::where("id",$Qid)->delete();
				return response()->json(array('status' => true , 'message'=> "Question successfully Deleted"), 200);
			}catch (\Throwable $th) {
				return response()->json(['success' => false, 'message' => 'Question Not found', 'errors' => $th->getMessage()]);
			}
			
		}
    }
	
	public function removeAnswerById()
    {
        $AnsID 	= (isset($_POST['AnsID']) && !empty($_POST['AnsID'])) ? $_POST['AnsID'] : false;
		if(!empty($AnsID))
		{
			try{
				Answer::where("id",$AnsID)->delete();
				return response()->json(array('status' => true , 'message'=> "Answer successfully Deleted"), 200);
			}catch (\Throwable $th) {
				return response()->json(['success' => false, 'message' => 'Answer Not found', 'errors' => $th->getMessage()]);
			}
			
		}
    }
}
