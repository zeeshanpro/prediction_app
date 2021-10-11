<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\v1\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Championship;
use Throwable;

class ChampionshipController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
			$championships = Championship::all();
			if($championships->isEmpty()){
				return $this->sendError('No championships found');
			}
			$data['championships'] 	= $championships;
			$data['logopath'] 		= asset('/uploads/');
			return $this->sendResponse($data, 'All championships.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Championships Not found', 'errors' => $th->getMessage()]);
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
			$data =  ['name' => $request['name'] , 'sports_id' => $request['sports_id'] ];
			$championship = Championship::create($data);
			return $this->sendResponse($championship, 'New championship created.');
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
			$championship 			= Championship::where('id',$id)->first();
			$data['championship'] 	= $championship;
			$data['logopath'] 		= asset('/uploads/');
			return $this->sendResponse($data, 'Championship found successfully.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Championship Not found', 'errors' => $th->getMessage()]);
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
	
	public function getChampionshipsBySportID($id){
		
		try{
			$championships 			= Championship::where([ 'sports_id' => $id , 'is_status' => 1 ])->latest('championships.created_at')->get();
			$data['championships'] 	= $championships;
			$data['logopath'] 		= asset('/uploads/');
			return $this->sendResponse($data, 'Championships found successfully.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Championship Not found.', 'errors' => $th->getMessage()]);
        }
		
    }
}
