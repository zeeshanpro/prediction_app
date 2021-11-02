<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\v1\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Contact_us;
use Throwable;

class ContactUsController extends BaseController
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
		try{
			Request()->validate([
				'user_id' => 'required|integer|exists:users,id',			
				'name' => 'required',
				'email' => 'required|email',
				'phone' => 'required',
				'comments' => 'required'
			]);
	   
			//if($validator->fails()){
			//	return $this->sendError('required parameters missing.', $validator->errors(),401);       
			//}
			
			$input = $request->all();
			
			$Logo_unique_name = '';
			if($request->hasFile('attachment'))
			{
				$fileobj			= $request->file('attachment');
				$name 				= $fileobj->getClientOriginalName('attachment');
				$extension_name 	= $fileobj->getClientOriginalExtension('attachment');
				$unique_name 		= time().rand(1000,9999).'.'.$extension_name;
				$destinationPath	= public_path('/uploads/contact_us/');
				$fileobj->move($destinationPath,$unique_name);
				$input['filename'] 	= $unique_name;
			}
		
			Contact_us::create($input);
			
			return response()->json(['success' => true, 'message' => 'Contact us Successfully Created'],200);
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'something went wrong.', 'errors' => $th->getMessage()],401);
        }
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
