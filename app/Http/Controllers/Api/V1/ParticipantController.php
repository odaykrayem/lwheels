<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ParticipantResource;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;


class ParticipantController extends Controller
{
    public function index()
    {}

    public function list(Request $request)
    {
            $userId =  Auth::id();
            $list = Participant::where('contest_id', $request['contest_id'])->where('is_winner', true)->get();

            foreach ($list as $obj) {
                $user = User::select('f_name', 'l_name', 'phone')->where('id',$obj['user_id'])->first();
                $obj['user_name'] = $user['f_name'] . " " . $user['l_name'];
                $obj['user_phone'] = $user['phone'];
            }

            return response()->json(
                [
                    'data' => $list
                ],200
            );
    }

    public function create()
    {}

    public function store(Request $request)
    {
        $userId =  Auth::id();

        $creds = [
           'user_id' => $userId,
           'contest_id' => $request->contest_id
        ];

        return new ParticipantResource(Participant::create($creds));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        //
    }
}
