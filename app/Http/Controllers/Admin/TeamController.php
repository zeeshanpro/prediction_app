<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use Auth;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::all();
        return view('admin.teams.index',['teams' => $teams]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.teams.create');
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
			'logo' => 'required',
		]);
		
		$input 				= $request->all();
		
		$Logo_name  = '';
		$Logo_unique_name = '';
		if($request->hasFile('logo'))
		{
			$fileobj				= $request->file('logo');
			$Logo_name 				= $fileobj->getClientOriginalName('logo');
			$Logo_extension_name 	= $fileobj->getClientOriginalExtension('logo');
			$Logo_unique_name 		= time().rand(1000,9999).'.'.$Logo_extension_name;
			$destinationPath		= public_path('/uploads/');
			$fileobj->move($destinationPath,$Logo_unique_name);
		}

		$input['logo'] 	= $Logo_unique_name;	
		$input['created_by'] = Auth::user()->id;
		$input['updated_by'] = Auth::user()->id;
		
		Team::create($input);
		
		return redirect()->route('teams.index')->with('success','Team Successfully Created.' );
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
		$team = Team::find($id);
		return view('admin.teams.edit',[ 'team' => $team ]);
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
        Request()->validate([
			'name' => 'required',
		]);
		
		$input 				= $request->all();
		
		$Logo_name  = '';
		$Logo_unique_name = '';
		if($request->hasFile('logo'))
		{
			$fileobj				= $request->file('logo');
			$Logo_name 				= $fileobj->getClientOriginalName('logo');
			$Logo_extension_name 	= $fileobj->getClientOriginalExtension('logo');
			$Logo_unique_name 		= time().rand(1000,9999).'.'.$Logo_extension_name;
			$destinationPath		= public_path('/uploads/');
			$fileobj->move($destinationPath,$Logo_unique_name);
			$input['logo'] 	= $Logo_unique_name;
		}
				
		unset($input['_token']);
		unset($input['_method']);
		
		$input['created_by'] = Auth::user()->id;
		$input['updated_by'] = Auth::user()->id;
		
		Team::where( ['id' => $id ] )->update($input);
		
		return redirect()->route('teams.index')->with('success','Team Successfully Updated.' );
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
