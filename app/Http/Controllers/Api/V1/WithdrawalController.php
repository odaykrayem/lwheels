<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\WithdrawalCollection;
use App\Http\Resources\V1\WithdrawalResource;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class WithdrawalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new WithdrawalCollection(Withdrawal::all());
    }

    public function list(Request $request)
    {
        // if(isset($request['user_id'])){
            $userId =  Auth::id();
            // $user = User::find($userId);
            // $user_id = $request['user_id'];
            $list = Withdrawal::where('user_id', $userId)->get();

            return response()->json(
                [
                    'data' => $list
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new WithdrawalResource(Withdrawal::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show(Withdrawal $withdrawal)
    {
        return new WithdrawalResource($withdrawal);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
    }
}
