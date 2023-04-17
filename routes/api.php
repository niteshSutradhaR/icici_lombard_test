<?php

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traveller;
use App\City;
use App\CityTravelHistory;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('user/travel-history/{user_id}', function($user_id, Request $request) {  
   try {
        if (!$user_id) {
            return response()->json([
                'status'=>'failure',
                'code'=> 422,
                'message'=> "user id is a mandatory field",
            ]);
        }
        $travel_history = DB::table('travellers')
            ->select('travellers.traveller_name','cities.city_name','city_travel_history.from_date','city_travel_history.to_date')
            ->leftjoin('city_travel_history', 'travellers.id','city_travel_history.traveller_id')
            ->leftjoin('cities','cities.id','city_travel_history.city_id')
            ->where('travellers.id', $user_id )
            ->get();

        $result = [];

        foreach ($travel_history as $key => $value) {
            $vArr = [];
            $vArr['city_name'] = $value->city_name;
            $vArr['from_date'] = $value->from_date;
            $vArr['to_date'] = $value->to_date;

            array_push($result, $vArr);
        }
        
        return response()->json([
            'status'=>'success',
            'code'=>Response::HTTP_OK, 
            'message'=> "Data retrieved successfully",
            'data'=>$result,
        ]);
   } catch (\Throwable $th) {
        return response()->json([
            'status'=>'failure',
            'code'=> Response::HTTP_BAD_REQUEST,
            'message'=> "Data couldn't be retrieved",
        ]);
   }
});

Route::get('cities/travel-history', function(Request $request) { 
    $validator = \Validator::make($request->all(), [
        'from_date' => 'required',
        'to_date' => 'required',       
    ]);
    
    if ($validator->fails()) {
        return response()->json([
            'status'=>'failure',
            'code'=> Response::HTTP_BAD_REQUEST,
            'message'=>  $validator->errors(),
        ]);
    }

   try {

        $travel_history = DB::select('select cities.city_name, count(*) as traveller_count from ( select city_id, traveller_id, count(*) as total from city_travel_history where from_date >= '.$request->from_date.' and to_date <= '.$request->to_date.' group by city_id, traveller_id) as q1 join cities on cities.id = q1.city_id group by cities.city_name');
        
        return response()->json([
            'status'=>'success',
            'code'=>Response::HTTP_OK, 
            'message'=> "Data retrieved successfully",
            'data'=>$travel_history,
        ]);
   } catch (\Throwable $th) {
        return response()->json([
            'status'=>'failure',
            'code'=> Response::HTTP_BAD_REQUEST,
            'message'=> "Data couldn't be retrieved",
        ]);
   }
});