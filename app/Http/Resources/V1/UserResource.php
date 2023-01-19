<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $user = Auth::user();
            if(auth('sanctum')->check()){
                auth()->user()->tokens()->delete();
            }
        return [
            'id' => $this->id,
            'f_name' => $this->f_name,
            'l_name' => $this->l_name,
            'phone' => $this->phone,
            'ref_code' => $this->ref_code,
            'ref_times' => $this->ref_times,
            'points'=> $this->points??0,
            'balance'=> $this->balance??0,
            'token' => Auth::user()->createToken('LWheelsAuth')->plainTextToken,
        ];
    }

    // public function with($request)
    // {
    //     return ['token' => ];
    // }
}
