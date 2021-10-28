<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Auth;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$transType = (isset($_GET['trans'])) ? $_GET['trans'] : "total";
		$transTypeArray = array("open","completed","total");
		if(!in_array(strtolower($transType),$transTypeArray))
			$transType = 'total';
		
		$transTypeID = -1;
		if(strtolower($transType) == "open")
			$transTypeID = 0;
		else if(strtolower($transType) == "completed")
			$transTypeID = 1;
		
		if($transTypeID != "-1")
		{
			$withdraws = Withdraw::where("withdraws.is_status",$transTypeID)
						->join("users","users.id","=","withdraws.user_id")
						->join("payment_methods","payment_methods.id","=","withdraws.method_id")
						->get(['withdraws.*','users.name as user_name','payment_methods.name as method_name']);
		}	
		else
		{
			$withdraws = Withdraw::join("users","users.id","=","withdraws.user_id")
						->join("payment_methods","payment_methods.id","=","withdraws.method_id")
						->get(['withdraws.*','users.name as user_name','payment_methods.name as method_name']);
		}
			
		
        return view('admin.withdraws.index',['withdraws' => $withdraws,"flag" => ucfirst($transType)]);
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
        $withdraw = Withdraw::where("withdraws.id",$id)
						->join("users","users.id","=","withdraws.user_id")
						->join("payment_methods","payment_methods.id","=","withdraws.method_id")
						->first(['withdraws.*','users.name as user_name','payment_methods.name as method_name']);
		return view('admin.withdraws.edit',['withdraw' => $withdraw]);
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
			return redirect()->route('withdraws.index')->with("error","something went wrong");
		
        Request()->validate([
			'is_status' => 'required',
		]);
		
        $data = $request->all();
		
		$data['updated_by'] = Auth::user()->id;
		
		unset($data['_token']);
		unset($data['_method']);
		
		Withdraw::where([ 'id' => $id ])->update($data);
		return redirect()->route('withdraws.index')->with("success","Game Successfully Updated.");
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

