<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment_method;
use Illuminate\Http\Request;
use Auth;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = Payment_method::all();
        return view('admin.payment_methods.index',['payment_methods' => $payment_methods]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.payment_methods.create');
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
			'exchange_rate' => 'required',
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
			$destinationPath		= public_path('/uploads/payment_methods/');
			$fileobj->move($destinationPath,$Logo_unique_name);
		}

		$input['logo'] 	= $Logo_unique_name;	
		$input['created_by'] = Auth::user()->id;
		$input['updated_by'] = Auth::user()->id;
		
		Payment_method::create($input);
		
		return redirect()->route('payment_method.index')->with('success','Payment Method Successfully Created.' );
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
        $payment_method = Payment_method::find($id);
		return view('admin.payment_methods.edit',[ 'payment_method' => $payment_method ]);
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
			'exchange_rate' => 'required',
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
			$destinationPath		= public_path('/uploads/payment_methods/');
			$fileobj->move($destinationPath,$Logo_unique_name);
			$input['logo'] 	= $Logo_unique_name;
		}
				
		unset($input['_token']);
		unset($input['_method']);
		
		Payment_method::where( ['id' => $id ] )->update($input);
		
		return redirect()->route('payment_method.index')->with('success','Payment Method Successfully Updated.' );
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
