<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return successResponse(200, Address::all(), 'Ip Address List');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $outlet =Address::create($request->all());
            DB::commit();
            return successResponse(201, $outlet, 'Create Successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            Log::error("$e");
            return errorResponse(500, null, 'System Error.');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {
        DB::beginTransaction();
        try {
            $address->update($request->all());
            DB::commit();
            return successResponse(200, $address, 'Updated successfully.');
        } catch (Exception | QueryException $e) {
            DB::rollback();
            Log::error("$e");
            return errorResponse(500, null, 'System Error.');
        }
    }
}
