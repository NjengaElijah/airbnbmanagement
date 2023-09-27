<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddReviewRequest;
use App\Http\Requests\BookingRequest;
use App\Models\Room;
use Egulias\EmailValidator\Parser\Comment;
use Hash;
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
    public function addReview(AddReviewRequest $request)
    {
        $room = Room::findOrFail($request->room_id);
        $room->reviews()->create([
            'comment' => $request->comment,
            'rating' => $request->rating ,
            'user_id' => auth()->user()->id,
            'deleted' => 0
        ]);
        return $this->success(  $room ->fresh(), "review saved");
    }
    public function updateProfile(Request $request)
    {
        $usr = auth()->user();

        $usr->phone = isset($request->phone) ? $request->phone : $usr->phone;

        $usr->pssword = isset($request->password) ? Hash::make($request->password) : $usr->password;

        $usr->update();

        return $this->success($usr->fresh(),"user updated");
    }
}