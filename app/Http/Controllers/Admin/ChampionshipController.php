<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use App\Models\Championship;
use Illuminate\Http\Request;

class ChampionshipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $championships = Championship::all();
        return view('admin.championships.index',['championships' => $championships]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$sports = Sport::all();
        return view('admin.championships.create',['sports' => $sports]);
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
			'name' => 'required',
			'sports_id' => 'required|integer|exists:sports,id',
		]);
		
		$input = $request->all();
		Championship::create($input);
		
		return redirect()->route('championships.index')->with( 'success','Championship Successfully Created.' );
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
	
	public function LoadChampionshipListBySportID()
	{
		$sportID 	= (isset($_POST['sportID']) && !empty($_POST['sportID'])) ? $_POST['sportID'] : false;
		if(!empty($sportID))
		{
			$Filterdata = Championship::where("sports_id",$sportID)
					->latest('championships.created_at')
					->get(['championships.*']);
					
			$html = '<option value="">Select Championship</option>';
			if(!empty($Filterdata->toArray()))
			{
				$i = 0;
				foreach($Filterdata as $index => $filter)
				{
					$i++;	
					$html .= '<option value="'.$filter->id.'">'.$filter->name.'</option>';
				}
			}
			return response()->json(array('html'=> $html), 200);
		}
	}

}
