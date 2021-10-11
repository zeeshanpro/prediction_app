<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sport;
use Illuminate\Http\Request;

class SportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $sports = Sport::all();
        return view('admin.sports.index',['sports' => $sports]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sports.create');
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
		Sport::create($input);
		
		return redirect()->route('sports.index')->with('success','Sport Successfully Created.' );
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
