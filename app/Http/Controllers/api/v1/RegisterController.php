<?php
   
namespace App\Http\Controllers\api\v1;
   
use Illuminate\Http\Request;
use App\Http\Controllers\api\v1\BaseController as BaseController;
use App\Models\User;
use App\Models\Prediction;
use Illuminate\Support\Facades\Auth;
use Validator;
   
class RegisterController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'language' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['user_type'] = 2;
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['name'] =  $user->name;
        
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt([ 'email' => $request->email, 'password' => $request->password, 'is_status' => 1 ])){ 
            $user 			= Auth::user(); 		
			$userInfo 		= $this->getUsersDetails($user);
            if(!empty($userInfo))
				$data = $userInfo;
			else
			{
				$data['token'] 	=  $user->createToken('MyApp')->accessToken;
				$data['name'] 	=  $user->name;
			}
					
            return $this->sendResponse($data, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }
	
	public function getUsersDetails($user)
	{
		$data = array();
		if(isset($user) && !empty($user))
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
			
			
			$data['id'] 				= $user->id;
			$data['name'] 				= $user->name;
			$data['email'] 				= $user->email;
			$data['is_premium'] 		= $user->is_premium;
			$data['expiry_date'] 		= $user->expiry_date;
			$data['totalPrediction'] 	= $totalPrediction;
			$data['completePrediction'] = $completePrediction;
			$data['winPrediction'] 		= $winPrediction;
			$data['losePrediction'] 	= $losePrediction;
			$data['pendingPrediction'] 	= $pendingPrediction;
			$data['winRate'] 			= $winRate;
			$data['playedGames'] 		= $playedGames;
			$data['completeGames'] 		= $completeGames;
			$data['pendingGames'] 		= $pendingGames;			
			$data['token'] 				= $user->createToken('MyApp')->accessToken;
		}
		
		return $data;
    }
}