<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\RefRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class RefRecordController extends Controller
{

    public function index()
    {}


    public function list(Request $request)
    {
            $userId =  Auth::id();
            $list = RefRecord::where('owner_id', $userId)->get();

            foreach ($list as $obj) {
                $userName = User::select('f_name', 'l_name')->where('id',$obj['user_id'])->first();
                $obj['user_name'] = $userName['f_name'] . " " . $userName['l_name'];
            }

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RefRecord  $refRecord
     * @return \Illuminate\Http\Response
     */
    public function show(RefRecord $refRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RefRecord  $refRecord
     * @return \Illuminate\Http\Response
     */
    public function edit(RefRecord $refRecord)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RefRecord  $refRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RefRecord $refRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RefRecord  $refRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(RefRecord $refRecord)
    {
        //
    }
}
