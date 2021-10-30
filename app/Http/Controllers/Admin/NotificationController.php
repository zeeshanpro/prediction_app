<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::all();
        return view('admin.notifications.index',['notifications' => $notifications]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.notifications.create');
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
			'title' => 'required',
			'message' => 'required',
			'publish_time' => 'required',
			'is_status' => 'required',
		]);
		
		$input 	= $request->all();
				
		$input['publish_time'] 	= Carbon::parse($input['publish_time'])->format('Y-m-d H:i:s');
		
		$input['created_by'] = Auth::user()->id;
		$input['updated_by'] = Auth::user()->id;
		
		Notification::create($input);
		
		return redirect()->route('notifications.index')->with('success','Notification Successfully Created.' );
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
		$notification = Notification::find($id);
		return view('admin.notifications.edit',[ 'notification' => $notification ]);
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
			'title' => 'required',
			'message' => 'required',
			'publish_time' => 'required',
			'is_status' => 'required',
		]);
		
		$input 					= $request->all();
		
		$input['publish_time'] 	= Carbon::parse($input['publish_time'])->format('Y-m-d H:i:s');
		
		$input['updated_by'] = Auth::user()->id;
				
		unset($input['_token']);
		unset($input['_method']);
		
		Notification::where( ['id' => $id ] )->update($input);
		
		return redirect()->route('notifications.index')->with('success','Notification Successfully Updated.' );
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
