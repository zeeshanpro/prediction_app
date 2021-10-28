<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\v1\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Withdraw;
use App\Models\Payment_method;
use Throwable;

class WithdrawController extends BaseController
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
	
	public function requestForWithdraw(Request $request)
    {
        try{
			Request()->validate([
				'user_id' => 'required|integer|exists:users,id',
				'method_id' => 'required|integer|exists:payment_methods,id',
				'email' => 'required|email',
				'amount' => 'required|numeric'
			]);
			
			$data = $request->all();
			if(!empty($data) && isset($data['user_id']))
			{
				$data['created_by'] = $data['user_id'];
				$data['updated_by'] = 0;
				Withdraw::create($data);
				return response()->json(['success' => true, 'message' => 'Request successfully Submitted.']);
			}
			else
			{
				return response()->json(['success' => false, 'message' => 'Required parameter missing.']);
			}
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'something went wrong.', 'errors' => $th->getMessage()]);
        }
    }
	
	public function withdrawHistory($id)
    {
		try{
			$data['history'] = Withdraw::where('user_id',$id)
								->join('payment_methods','payment_methods.id','=','withdraws.method_id')
								->get(['withdraws.*','payment_methods.name as method_name','payment_methods.logo']);
								
			$data['logopath'] 	= asset('/uploads/payment_methods/');
			return $this->sendResponse($data, 'Data found successfully.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Data Not found', 'errors' => $th->getMessage()]);
        }
    }
	
}

