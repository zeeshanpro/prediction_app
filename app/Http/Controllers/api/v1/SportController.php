<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\v1\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Sport;
use Throwable;

class SportController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		try{
			$sports = Sport::all();
			if($sports->isEmpty()){
				return $this->sendError('No sports found');
			}
			return $this->sendResponse($sports, 'All sports.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Sports Not found', 'errors' => $th->getMessage()]);
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
		try{
			$sports = Sport::create(['name' => $request['name']]);
			return $this->sendResponse($sports, 'New sports created.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Something went wrong.', 'errors' => $th->getMessage()]);
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
		try{
			$sports = Sport::where('id',$id)->first();
			$sucess['sports'] = $sports; 
			$success['Championships'] = $sports->championships;
			return $this->sendResponse($sucess, 'Sports found successfully.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Sport Not found', 'errors' => $th->getMessage()]);
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
	
}

