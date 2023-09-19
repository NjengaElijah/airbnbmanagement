<?php

namespace App\Http\Controllers;

use App\Models\Apartment;
use App\Models\Client;
use Illuminate\Http\Request;

class ApartmentsController extends Controller
{
    //
    public function index(Request $request)
    {
        $apartments = Apartment::orderBy('id', "DESC")->get();
        return view('apartments.index', compact('apartments'));
    }
    public function create(Request $request)
    {

        if ($request->isMethod('GET')) {
            $clients = Client::all();
            return view('partials.modal', [
                'title' => 'Add Apartment',
                'action' => route('apartment_add'),
                'body' => view('apartments.create', compact('clients')),
                'submit_text' => 'Save',
            ])->render();
        }
        // dd("..");
        $request->validate(['name' => 'required', 'location' => 'required']);

        $apartment = Apartment::create(
            [
                'name' => $request->name,
                'location' => $request->location,
                'coordinates' => $request->coordinates ?? " ",
                'description' => $request->description ?? " ",
                'client_id' => $request->client_id
            ]
        );
        // dd($client->fresh());
        return redirect()->back()->with([
            'success' => 0,
            'msg' => 'apartment registered'
        ]);

    }
}