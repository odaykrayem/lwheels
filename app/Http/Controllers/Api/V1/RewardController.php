<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

use App\Models\Reward;
use App\Models\RewardsRegistry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class RewardController extends Controller
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

    public function list(Request $request)
    {
        // if(isset($request['user_id'])){
            $userId =  Auth::id();
            // $user = User::find($userId);
            // $user_id = $request['user_id'];
            $list = Reward::all();
            foreach ($list as $reward) {
                $rewardId = $reward['id'];
                $rewardDuration = $reward['duration'];

                $registryExist = RewardsRegistry::where('reward_id' , $rewardId)->where('user_id', $userId)->exists();
                if($registryExist){
                    $rewardRegistry = RewardsRegistry::where('reward_id' , $rewardId)->where('user_id', $userId)->first();
                    $isRewardAvailabelForUser = Carbon::now()->diffInMinutes($rewardRegistry['created_at']) >= $rewardDuration;

                }else{
                    $isRewardAvailabelForUser = false;
                }

                $reward['is_on'] = $isRewardAvailabelForUser;
            }

            return response()->json(
                [
                    'data' => $list
                ],200
            );
        // }else{
        //     echo 'no';
        // }

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
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function show(Reward $reward)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function edit(Reward $reward)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reward $reward)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reward  $reward
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reward $reward)
    {
        //
    }
}
