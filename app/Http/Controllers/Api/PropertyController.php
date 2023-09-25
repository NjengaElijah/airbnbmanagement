<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Repo\ApiResponseTrait;

class PropertyController extends Controller
{
    use ApiResponseTrait;
    //list all rooms
    public function list() : JsonResponse
    {
        // $rooms = collect(Room::all()->toArray())->flatten()->map('name', 'description', 'price_per_night', 'discounted_price',  'type')->values();
        $rooms = collect(Room::all()->toArray());
        return $this->success($rooms,"rooms");
    }
    //list room types
    public function types(): JsonResponse
    {
        return $this->success(Feature::where('deleted' ,0)->where('type' , Feature::TYPE)->get(),"types");
    }
    //list room types
    public function features()
    {
        return $this->success(Feature::where('deleted', 0)->where('type', Feature::FEATURE)->get(), "features");
    }
    //filter rooms based on the parameters sent
    public function filter()
    {

    }
    public function property($id,Request $request)
    {
        return $this->success(Room::findOrFail($id),"room");
    }
}
