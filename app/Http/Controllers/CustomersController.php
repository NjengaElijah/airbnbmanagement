<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    //
    public function index(Request $request)
    {
        $customers = User::where('type' , User::TYPE['customer'])->get();
        
        return view('customers.index', compact('customers'));
    }
    public function viewBookings($id, Request    $request)
    {
        $customer = User::findOrFail($id);
        $bookings = $customer->bookings;
        return view('customers.bookings',compact('customer','bookings') );
    }
    public function create(Request $request)
    {

        if ($request->isMethod('GET')) {

            return view('partials.modal', [
                'title' => 'Add Client',
                'action' => route('client_add'),
                'body' => view('clients.create'),
                'submit_text' => 'Save',
            ])->render();
        }
        // dd("..");
        $request->validate(['first_name' => 'required', 'last_name' => 'required', 'phone' => 'required|numeric', 'email' => 'required|email']);

        Client::create(
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'notes' => $request->notes ?? " ",
            ]
        );
        // dd($client->fresh());
        return back()->with([
            'success' => 1,
            'msg' => 'client registered'
        ]);

    }
}