<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Client;
use App\Models\Review;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function index()
    {
        $no_rooms = Room::where('deleted',0)->count();
        $no_customers = User::where('type',User::TYPE['customer'] )->count();
        $no_users = Client::all()->count();

        $no_ratings = Review::where('deleted' , '0')->count();

        
        $no_bookings = Booking::where('deleted',0)->count();

        $bookings = Booking::where('deleted',0)->take(5)->get();


        return view('home.dashboard',compact('no_rooms','no_customers','no_ratings','no_bookings','no_users','bookings'));
    }
}