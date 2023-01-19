<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CustomValue;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;


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
