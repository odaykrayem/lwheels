<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomValue;
use App\Models\Reward;
use App\Models\RewardsRegistry;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class UserController extends Controller
{

    public function wheelPoints(Request $request)
    {
        // if (isset($request['user_id'])) {
        //     $user = User::find($request->user_id);
        //     $addPointUser = CustomValue::where('key', 'wheel_points')->first();

        //     if ($user != null && $addPointUser != null) {
        //         $user->points += $addPointUser->value;
        //         $user->save();
        //     }
        // }
        $userId =  Auth::id();
        $user = User::find($userId);
        if (isset($request['points'])) {
            $user->points += $request->points;
            $user->save();
        }
    }

    public function transferPoints(Request $request)
    {
        $userId =  Auth::id();
        $user = User::where('id', $userId)->first();

        $points = CustomValue::where('key' , 'points_price')->first();

        $addBalance =  $request['points'] /  $points['value'];

        User::where('id', [$user->id])->update([
            'points' => $user->points - $request['points'],
        ]);
        User::where('id', [$user->id])->update([
            'balance' => $user->balance + $addBalance,
        ]);
        return response()->json(
            [
                'data' => $points
            ],200
        );

    }
    public function withdrawBalance(Request $request)
    {
        $userId =  Auth::id();
        $user = User::where('id', $userId)->first();

        $minBalance = CustomValue::where('key' , 'min_balance')->first();

        $bankCode = $request['bank_code'];
        $amount = $request['amount'];


        User::where('id', [$user->id])->update([
            'balance' => $user->balance - $request['amount'],
        ]);

        Withdrawal::create(
            [
                'user_id' => $userId,
                'bank_code' => $bankCode,
                'amount' => $amount
            ]
        );
        return response()->json(
            [
                'msg' =>  'Withdrawal application has been saved'
            ],200
        );

    }
    public function reward(Request $request)
    {
        $userId =  Auth::id();
        $user = User::where('id', $userId)->first();

        $rewardId = $request['reward_id'];

        $rewardExist = Reward::where('id' , $rewardId)->exists();
        if($rewardExist){
            $rewardValue = Reward::where('id' , $rewardId)->first()['value'];
            $rewardDuration = Reward::where('id' , $rewardId)->first()['duration'];

            $rewardRegistryExist = RewardsRegistry::where('reward_id' , $rewardId)->where('user_id', $userId)->exists();

            if($rewardRegistryExist){
                $rewardRegistry = RewardsRegistry::where('reward_id' , $rewardId)->where('user_id', $userId)->first();
                $isRewardAvailabelForUser = Carbon::now()->diffInMinutes($rewardRegistry['created_at']) < $rewardDuration;

                if($isRewardAvailabelForUser){
                    return response()->json(
                        [
                            'msg' =>  'Reward is not available'
                        ],400
                    );
                }else{
                    RewardsRegistry::where('reward_id' , $rewardId)->where('user_id', $userId)->update(['created_at'=>Carbon::now()]);
                    User::where('id', [$user->id])->update([
                        'points' => $user->points + $rewardValue,
                    ]);
                    return response()->json(
                        [
                            'msg' =>  'Reward has been added to your points'
                        ],200
                    );
                }
            }else{
                User::where('id', [$user->id])->update([
                    'points' => $user->points + $rewardValue,
                ]);

                RewardsRegistry::create(
                    [
                        'user_id' => $userId,
                        'reward_id' => $rewardId,
                    ]
                );
                return response()->json(
                    [
                        'msg' =>  'Reward has been added to your points'
                    ],200
                );
            }
        }else{
            return response()->json(
                [
                    'msg' =>  'Reward is not exist'
                ],400
            );
        }

    }

     public function getUserInfo()
    {
        $userId =  Auth::id();
        $user = User::where('id', $userId)->first();

         return response()->json(
            [
                'data' => $user
            ],200
        );
    }

}
