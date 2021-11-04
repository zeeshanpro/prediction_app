<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\api\v1\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Package;
use App\Models\Packageshistory;
use App\Models\User;
use Throwable;

class PackageController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		try{
			$packages = Package::all();
			if($packages->isEmpty()){
				return $this->sendError('No Packages found');
			}
			$data['packages'] 	= $packages;
			return $this->sendResponse($data, 'All Packages.');
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'Packages Not found', 'errors' => $th->getMessage()],401);
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
	
	public function buyPackage(Request $request)
    {
		
        try{
			Request()->validate([
				'userid' => 'required|integer|exists:users,id',
				'packageid' => 'required|integer|exists:packages,id',
			]);
			
			$data = $request->all();
			if(!empty($data) && isset($data['userid']))
			{
				$packageData = Package::where([ 'id' => $data['packageid'] ])->first();
				if(!empty($packageData))
				{
					$duration = $packageData['duration'];
					if(!empty($duration))
					{
						Packageshistory::create($data);
						
						$today = date('Y-m-d');
						$expiryDate = date('Y-m-d', strtotime("+".$duration." months", strtotime($today)));
						
						User::where("id" ,$data['userid'])->update(['is_premium' => 1 , 'expiry_date' => $expiryDate , 'package_id' => $data['packageid'] ]);
					
						return response()->json(['success' => true, 'message' => 'Package successfully buy.'],200);
					}
					else
					{
						return response()->json(['success' => false, 'message' => 'Please Check Package Data.'],200);
					}
				}
				else
				{
					return response()->json(['success' => false, 'message' => 'Please Check Package Data.'],200);
				}	
			}
			else
			{
				return response()->json(['success' => false, 'message' => 'Required parameter missing.'],200);
			}
		}
        catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => 'something went wrong.', 'errors' => $th->getMessage()],401);
        }
    }
	
}
