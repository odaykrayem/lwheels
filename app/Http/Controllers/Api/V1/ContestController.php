<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Contest;
use Illuminate\Http\Request;
use App\Http\Resources\V1\ContestResource;
use App\Http\Resources\V1\ContestCollection;
use App\Http\Requests\V1\StoreContestRequest;
use App\Models\Participant;
use App\Filters\V1\ContestsFilter;
use Database\Factories\ContestFactory;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class ContestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = new ContestsFilter();
        $filterItems = $filter->transform($request);

        $includeUsers = $request->query('includeParticipants');

        $contests = Contest::where($filterItems);//if there are no filterItems where clause will be ignored
        if($includeUsers){
            $contests = $contests->with('participants');
        }

        return new ContestCollection($contests->paginate()->appends($request->query()));

        // return new ContestCollection(Contest::all());
    }

    public function list(Request $request)
    {
        // if(isset($request['user_id'])){
            $userId =  Auth::id();
            // $user = User::find($userId);
            // $user_id = $request['user_id'];
            $contests_list = Contest::all();
            foreach ($contests_list as $contest) {
                $is_participant = Participant::where('user_id', $userId)->where('contest_id',$contest['id'])->exists();
                $contest['is_participant'] = $is_participant;
            }

            return response()->json(
                [
                    'data' => $contests_list
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
    public function store(StoreContestRequest $request)
    {
        return new ContestResource(Contest::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function show(Contest $contest)
    {
        return new ContestResource($contest);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function edit(Contest $contest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contest $contest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contest  $contest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
        //
    }
}
