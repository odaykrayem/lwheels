<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\CustomValue;
use App\Http\Requests\StoreCustomValueRequest;
use App\Http\Requests\UpdateCustomValueRequest;

class CustomValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function getMinPoints()
    {
        $points = CustomValue::where('key' , 'points_price')->first();

        return response()->json(
            [
                'data' => $points
            ],200
        );

    }

     public function getMinBalance()
    {
        $points = CustomValue::where('key' , 'min_balance')->first();

        return response()->json(
            [
                'data' => $points
            ],200
        );

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
     * @param  \App\Http\Requests\StoreCustomValueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomValueRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomValue  $customValue
     * @return \Illuminate\Http\Response
     */
    public function show(CustomValue $customValue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CustomValue  $customValue
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomValue $customValue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCustomValueRequest  $request
     * @param  \App\Models\CustomValue  $customValue
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomValueRequest $request, CustomValue $customValue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomValue  $customValue
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomValue $customValue)
    {
        //
    }
}
