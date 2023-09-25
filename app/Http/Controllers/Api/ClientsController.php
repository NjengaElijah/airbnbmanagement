<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Models\Room;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Repo\ApiResponseTrait;

class ClientsController extends Controller
{
    use ApiResponseTrait;
    //list bookings

    public function bookings(): JsonResponse
    {
        return $this->success(auth()->user()->bookings()->get());
    }

    //place booking
    public function addBooking(BookingRequest $request): JsonResponse
    {
        $usr = auth()->user();
        $room = Room::find($request->room_id);
        
        $booking = $usr->bookings()->create(
            $request->only(['room_id', 'start_date', 'end_date', 'no_adults', 'no_children','price_per_night'])
        );
        $booking->price_per_night = $room->price_per_night;
        $booking->update();

        return $this->success($booking->fresh(), "booking placed");
    }
}